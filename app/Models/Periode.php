<?php

namespace App\Models;

use App\Services\SawService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Periode extends Model
{
    protected $fillable = [
        'nama',
        'tahun',
        'kuota',
        'total_siswa',
        'ambang_batas',
        'tanggal_mulai',
        'deadline',
        'konfigurasi_seleksi_id',
        'lambda_max',
        'ci',
        'cr',
        'matriks_ahp',
        'is_final',
    ];

    protected $casts = [
        'kuota' => 'integer',
        'total_siswa' => 'integer',
        'ambang_batas' => 'float',
        'tanggal_mulai' => 'date',
        'deadline' => 'date',
        'lambda_max' => 'decimal:5',
        'ci' => 'decimal:5',
        'cr' => 'decimal:5',
        'matriks_ahp' => 'array',
        'is_final' => 'boolean',
    ];

    public function konfigurasiSeleksi()
    {
        return $this->belongsTo(KonfigurasiSeleksi::class, 'konfigurasi_seleksi_id');
    }

    public function kriterias()
    {
        return $this->hasMany(Kriteria::class)->orderBy('kode');
    }

    public function calonPenerimas()
    {
        return $this->hasMany(CalonPenerima::class)->orderBy('ranking');
    }

    /**
     * Ambang batas kelulusan preferensi Vi (standar indikator historis/referensi).
     */
    public function getAmbangBatasAttribute(): float
    {
        return isset($this->attributes['ambang_batas']) && $this->attributes['ambang_batas'] !== null
            ? floatval($this->attributes['ambang_batas'])
            : SawService::AMBANG_BATAS;
    }

    /**
     * Cutoff Kuota Utama (skor preferensi Vi dari siswa peringkat terakhir yang masuk kuota penerima).
     * Merupakan batas visual dinamis dan informasi skor minimum kuota aktual; null jika belum ada hasil SAW.
     */
    public function getCutoffKuotaAttribute(): ?float
    {
        if ($this->relationLoaded('calonPenerimas')) {
            $lastLolos = $this->calonPenerimas
                ->where('status_kelulusan', 'lolos')
                ->whereNotNull('skor_saw')
                ->sortByDesc('ranking')
                ->first();
        } else {
            $lastLolos = $this->calonPenerimas()
                ->reorder('ranking', 'desc')
                ->where('status_kelulusan', 'lolos')
                ->whereNotNull('skor_saw')
                ->first();
        }

        return $lastLolos ? floatval($lastLolos->skor_saw) : null;
    }

    // True kalau hari ini sudah lewat deadline
    public function isTerkunci(): bool
    {
        return $this->deadline && now()->startOfDay()->gt($this->deadline);
    }

    // Cek apakah periode sedang berlangsung (hari ini berada di antara tanggal_mulai dan deadline)
    public function isSedangBerlangsung(?\DateTimeInterface $referenceDate = null): bool
    {
        $today = $referenceDate ? Carbon::parse($referenceDate)->startOfDay() : now()->startOfDay();

        return ! $this->is_final
            && $this->tanggal_mulai
            && $this->deadline
            && $today->gte($this->tanggal_mulai->copy()->startOfDay())
            && $today->lte($this->deadline->copy()->startOfDay());
    }

    // Cek apakah periode aktif yang belum dimulai (tanggal_mulai di masa mendatang)
    public function isBelumDimulai(?\DateTimeInterface $referenceDate = null): bool
    {
        $today = $referenceDate ? Carbon::parse($referenceDate)->startOfDay() : now()->startOfDay();

        return ! $this->is_final
            && $this->tanggal_mulai
            && $today->lt($this->tanggal_mulai->copy()->startOfDay());
    }

    // Cek apakah periode sudah selesai (lewat deadline atau is_final)
    public function isSelesai(?\DateTimeInterface $referenceDate = null): bool
    {
        $today = $referenceDate ? Carbon::parse($referenceDate)->startOfDay() : now()->startOfDay();

        return (bool) $this->is_final || ($this->deadline && $today->gt($this->deadline->copy()->startOfDay()));
    }

    // Status teks otomatis berdasarkan tanggal dan finalisasi
    public function getStatusAttribute(): string
    {
        if ($this->is_final) {
            return 'Selesai (final)';
        }

        $hariIni = now()->startOfDay();

        if ($this->tanggal_mulai && $hariIni->lt($this->tanggal_mulai)) {
            return 'Belum dimulai';
        }

        if ($this->deadline && $hariIni->gt($this->deadline)) {
            return 'Selesai (terkunci)';
        }

        return 'Aktif (Berjalan)';
    }

    // Label singkat status untuk badge antarmuka
    public function getStatusBadgeLabelAttribute(): string
    {
        if ($this->is_final) {
            return 'Selesai';
        }

        if ($this->isSedangBerlangsung()) {
            return 'Aktif';
        }

        if ($this->isBelumDimulai()) {
            return 'Akan Datang';
        }

        return 'Selesai';
    }

    /**
     * Menentukan periode default dashboard berdasarkan 4 prioritas:
     * 1. Periode aktif yang sedang berlangsung (terbaru berdasarkan tanggal_mulai)
     * 2. Periode aktif mendatang yang belum dimulai (terdekat dengan tanggal hari ini)
     * 3. Periode terakhir yang selesai (terbaru berdasarkan deadline / tanggal_mulai)
     * 4. Null jika tidak ada data periode
     */
    public static function determineDashboardDefault(?iterable $periodes = null, ?\DateTimeInterface $referenceDate = null): ?self
    {
        $list = $periodes instanceof Collection
            ? $periodes
            : ($periodes ? collect($periodes) : self::all());

        if ($list->isEmpty()) {
            return null;
        }

        $today = $referenceDate ? Carbon::parse($referenceDate)->startOfDay() : now()->startOfDay();

        // Prioritas 1: Periode aktif yang sedang berlangsung
        // Filter: !is_final && tanggal_mulai <= today <= deadline
        // Urutkan: tanggal_mulai DESC, id DESC
        $ongoing = $list->filter(function (self $p) use ($today): bool {
            return ! $p->is_final
                && $p->tanggal_mulai
                && $p->deadline
                && $today->gte($p->tanggal_mulai->copy()->startOfDay())
                && $today->lte($p->deadline->copy()->startOfDay());
        })->sort(function (self $a, self $b): int {
            $cmp = $b->tanggal_mulai->copy()->startOfDay()->timestamp <=> $a->tanggal_mulai->copy()->startOfDay()->timestamp;

            return $cmp !== 0 ? $cmp : ($b->id <=> $a->id);
        });

        if ($ongoing->isNotEmpty()) {
            return $ongoing->first();
        }

        // Prioritas 2: Periode aktif yang belum dimulai (masa mendatang)
        // Filter: !is_final && today < tanggal_mulai
        // Urutkan: tanggal_mulai ASC, id ASC (terdekat dari hari ini)
        $upcoming = $list->filter(function (self $p) use ($today): bool {
            return ! $p->is_final
                && $p->tanggal_mulai
                && $today->lt($p->tanggal_mulai->copy()->startOfDay());
        })->sort(function (self $a, self $b): int {
            $cmp = $a->tanggal_mulai->copy()->startOfDay()->timestamp <=> $b->tanggal_mulai->copy()->startOfDay()->timestamp;

            return $cmp !== 0 ? $cmp : ($a->id <=> $b->id);
        });

        if ($upcoming->isNotEmpty()) {
            return $upcoming->first();
        }

        // Prioritas 3: Periode terakhir yang selesai
        // Urutkan: deadline DESC, tanggal_mulai DESC, id DESC
        $ended = $list->sort(function (self $a, self $b): int {
            $d1 = $b->deadline ? $b->deadline->copy()->startOfDay()->timestamp : 0;
            $d2 = $a->deadline ? $a->deadline->copy()->startOfDay()->timestamp : 0;
            if ($d1 !== $d2) {
                return $d1 <=> $d2;
            }

            $m1 = $b->tanggal_mulai ? $b->tanggal_mulai->copy()->startOfDay()->timestamp : 0;
            $m2 = $a->tanggal_mulai ? $a->tanggal_mulai->copy()->startOfDay()->timestamp : 0;
            if ($m1 !== $m2) {
                return $m1 <=> $m2;
            }

            return $b->id <=> $a->id;
        });

        return $ended->first();
    }

    /**
     * Menghitung sisa hari pendaftaran sesuai tanggal sebenarnya.
     */
    public function getSisaWaktuTextAttribute(): string
    {
        $hariIni = now()->startOfDay();

        if ($this->is_final) {
            return 'Seleksi Selesai (Final)';
        }

        if ($this->deadline && $hariIni->gt($this->deadline->copy()->startOfDay())) {
            return 'Pendaftaran Telah Ditutup';
        }

        if ($this->tanggal_mulai && $hariIni->lt($this->tanggal_mulai->copy()->startOfDay())) {
            $sisaMulai = $hariIni->diffInDays($this->tanggal_mulai->copy()->startOfDay());

            return "Dibuka dalam {$sisaMulai} Hari";
        }

        if ($this->deadline) {
            $sisaHari = $hariIni->diffInDays($this->deadline->copy()->startOfDay());
            $durasi = $this->tanggal_mulai ? $this->tanggal_mulai->diffInDays($this->deadline) : null;
            $durasiText = $durasi ? " (Durasi {$durasi} Hari)" : '';

            return "{$sisaHari} Hari Tersisa{$durasiText}";
        }

        return '-';
    }

    /**
     * Menghitung persentase pendaftaran berdasarkan target total siswa.
     */
    public function getPersentasePendaftaranAttribute(): ?float
    {
        $target = intval($this->total_siswa);
        if ($target <= 0) {
            return null;
        }

        $terdaftar = $this->calonPenerimas()->count();

        return round(($terdaftar / $target) * 100, 1);
    }

    /**
     * Teks ringkasan progres pendaftaran (misal: "180 / 300 Siswa Terdaftar").
     */
    public function getRingkasanPendaftarTextAttribute(): string
    {
        $terdaftar = $this->calonPenerimas()->count();
        $target = intval($this->total_siswa);

        if ($target > 0) {
            return "{$terdaftar} / {$target} Siswa Terdaftar";
        }

        return "{$terdaftar} Siswa Terdaftar";
    }

    /**
     * Teks sub-ringkasan progres target (misal: "60% dari Target Pendaftaran").
     */
    public function getRingkasanTargetTextAttribute(): string
    {
        $target = intval($this->total_siswa);
        if ($target <= 0) {
            return 'Target Belum Ditetapkan';
        }

        $terdaftar = $this->calonPenerimas()->count();
        $persen = round(($terdaftar / $target) * 100, 1);
        $persenDisplay = ((int) $persen == $persen) ? intval($persen) : $persen;

        return "{$persenDisplay}% dari Target Pendaftaran";
    }

    /**
     * Evaluasi status kesiapan mesin perhitungan SAW berdasarkan kondisi data sebenarnya.
     *
     * @return array{status: string, sub: string, is_ready: bool}
     */
    public function getStatusSawInfoAttribute(): array
    {
        $kriteriaCount = $this->kriterias()->count();
        $siswaCount = $this->calonPenerimas()->count();
        $isKonsisten = ($this->cr !== null && floatval($this->cr) <= 0.10);

        $siswaLengkap = 0;
        if ($kriteriaCount > 0 && $siswaCount > 0) {
            $siswaLengkap = $this->calonPenerimas()
                ->withCount('penilaians')
                ->get()
                ->filter(fn ($c) => $c->penilaians_count >= $kriteriaCount)
                ->count();
        }

        $hasHasilSaw = $this->calonPenerimas()->whereNotNull('skor_saw')->whereNotNull('ranking')->exists();

        if ($siswaCount === 0) {
            return [
                'status' => 'Menunggu Siswa Mendaftar',
                'sub' => $isKonsisten ? 'Bobot AHP Siap (CR = '.number_format($this->cr ?? 0, 3).')' : 'Kriteria Belum Dikonfigurasi',
                'is_ready' => false,
            ];
        }

        if ($hasHasilSaw) {
            return [
                'status' => 'Hasil Perangkingan Selesai',
                'sub' => "{$siswaCount} Siswa Terhitung SAW",
                'is_ready' => true,
            ];
        }

        if ($siswaLengkap >= $siswaCount && $siswaCount > 0 && $isKonsisten) {
            return [
                'status' => 'Matriks Siap Dihitung',
                'sub' => "{$siswaLengkap}/{$siswaCount} Nilai Kriteria Lengkap",
                'is_ready' => true,
            ];
        }

        return [
            'status' => 'Pengisian Nilai Berjalan',
            'sub' => "{$siswaLengkap}/{$siswaCount} Siswa Terisi Lengkap",
            'is_ready' => false,
        ];
    }
}
