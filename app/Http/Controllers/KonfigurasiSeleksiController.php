<?php

namespace App\Http\Controllers;

use App\Models\KonfigurasiSeleksi;
use App\Services\AhpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonfigurasiSeleksiController extends Controller
{
    public function __construct(
        protected AhpService $ahpService
    ) {}

    /**
     * Daftar seluruh paket konfigurasi seleksi
     */
    public function index(Request $request)
    {
        $query = KonfigurasiSeleksi::with(['kriterias.subKriterias', 'periodes'])
            ->orderByDesc('id');

        // Filter tab status
        $tab = $request->input('tab', 'semua');
        if ($tab === 'siap') {
            $query->where('is_siap', true);
        } elseif ($tab === 'draf') {
            $query->where('is_siap', false);
        } elseif ($tab === 'konsisten') {
            $query->where('is_konsisten', true);
        }

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $allConfigs = KonfigurasiSeleksi::with('periodes')->get();
        $totalKonfigurasi = $allConfigs->count();
        $totalSiap = $allConfigs->where('is_siap', true)->count();
        $totalKonsisten = $allConfigs->where('is_konsisten', true)->count();
        $totalTerpakai = $allConfigs->filter(fn ($c) => $c->periodes->count() > 0)->count();

        $konfigurasis = $query->paginate(6)->withQueryString();

        return view('konfigurasi.index', compact(
            'konfigurasis',
            'totalKonfigurasi',
            'totalSiap',
            'totalKonsisten',
            'totalTerpakai',
            'tab'
        ));
    }

    /**
     * Form pembuatan paket konfigurasi baru
     */
    public function create()
    {
        $defaultKriterias = [
            [
                'kode' => 'C1',
                'nama' => 'Nilai Akademik',
                'atribut' => 'benefit',
                'tipe_input' => 'angka',
                'min_val' => 0,
                'max_val' => 100,
                'satuan' => '/ 100 (Rapor)',
                'rentang' => '0 – 100 (Nilai Rapor Siswa SMK)',
                'pilihan' => [],
            ],
            [
                'kode' => 'C2',
                'nama' => 'Penghasilan Orang Tua',
                'atribut' => 'cost',
                'tipe_input' => 'angka',
                'min_val' => 0,
                'max_val' => 10000000,
                'satuan' => 'Rupiah (Slip Gaji)',
                'rentang' => 'Rp 0 s/d > Rp 10.000.000',
                'pilihan' => [],
            ],
            [
                'kode' => 'C3',
                'nama' => 'Tanggungan Orang Tua',
                'atribut' => 'benefit',
                'tipe_input' => 'angka',
                'min_val' => 1,
                'max_val' => 10,
                'satuan' => 'Orang',
                'rentang' => '1 s/d 10 Orang Tanggungan',
                'pilihan' => [],
            ],
            [
                'kode' => 'C4',
                'nama' => 'Ekstrakurikuler',
                'atribut' => 'cost',
                'tipe_input' => 'pilihan',
                'min_val' => 1,
                'max_val' => 5,
                'satuan' => 'Paket',
                'rentang' => 'Menu Paket: Paket 1 s/d 5 (Konversi SAW Nilai 1 s/d 5)',
                'pilihan' => [
                    ['label' => 'Paket 1: Pramuka, Komputer, dan Paskibra', 'nilai' => 1],
                    ['label' => 'Paket 2: Komputer dan Paskibra', 'nilai' => 2],
                    ['label' => 'Paket 3: Pramuka dan Paskibra', 'nilai' => 3],
                    ['label' => 'Paket 4: Olahraga', 'nilai' => 4],
                    ['label' => 'Paket 5: Pakata', 'nilai' => 5],
                ],
            ],
            [
                'kode' => 'C5',
                'nama' => 'Ketidakhadiran',
                'atribut' => 'cost',
                'tipe_input' => 'angka',
                'min_val' => 0,
                'max_val' => 30,
                'satuan' => 'Hari Alpa',
                'rentang' => '0 Hari s/d > 5 Hari (Rekap Presensi/Alpa)',
                'pilihan' => [],
            ],
        ];

        $defaultMatrix = [
            'C1' => ['C1' => 1.0, 'C2' => 2.0, 'C3' => 3.0, 'C4' => 4.0, 'C5' => 3.0],
            'C2' => ['C1' => 0.5, 'C2' => 1.0, 'C3' => 2.0, 'C4' => 3.0, 'C5' => 2.0],
            'C3' => ['C1' => 0.333, 'C2' => 0.5, 'C3' => 1.0, 'C4' => 2.0, 'C5' => 2.0],
            'C4' => ['C1' => 0.25, 'C2' => 0.333, 'C3' => 0.5, 'C4' => 1.0, 'C5' => 2.0],
            'C5' => ['C1' => 0.333, 'C2' => 0.5, 'C3' => 0.5, 'C4' => 0.5, 'C5' => 1.0],
        ];

        $ahpResult = $this->ahpService->hitung(['C1', 'C2', 'C3', 'C4', 'C5'], $defaultMatrix);

        return view('konfigurasi.create', compact('defaultKriterias', 'defaultMatrix', 'ahpResult'));
    }

    /**
     * Simpan paket konfigurasi baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_draf' => 'nullable|boolean',
            'kriterias' => 'required|array|size:5',
            'kriterias.*.kode' => 'required|string|in:C1,C2,C3,C4,C5',
            'kriterias.*.nama' => 'required|string|max:255',
            'kriterias.*.atribut' => 'required|in:benefit,cost',
            'kriterias.*.tipe_input' => 'required|in:angka,pilihan',
            'matrix' => 'required|array',
        ]);

        $matrix = $request->input('matrix', []);
        $kriteriasInput = $request->input('kriterias', []);
        $kriteriaCodes = array_column($kriteriasInput, 'kode');

        $ahpResult = $this->ahpService->hitung($kriteriaCodes, $matrix);
        $isConsistent = ($ahpResult['cr'] <= 0.10);
        $isDraf = $request->boolean('is_draf');

        // Jika user memilih simpan siap pakai namun belum konsisten, simpan sebagai draf
        $isSiap = (! $isDraf && $isConsistent);

        DB::transaction(function () use ($data, $kriteriasInput, $ahpResult, $isConsistent, $isSiap, &$konfigurasi) {
            $konfigurasi = KonfigurasiSeleksi::create([
                'nama' => $data['nama'],
                'deskripsi' => $data['deskripsi'] ?? null,
                'versi' => 1,
                'parent_id' => null,
                'matriks_ahp' => $ahpResult['matrix'] ?? null,
                'lambda_max' => $ahpResult['lambda_max'] ?? null,
                'ci' => $ahpResult['ci'] ?? null,
                'cr' => $ahpResult['cr'] ?? null,
                'is_konsisten' => $isConsistent,
                'is_siap' => $isSiap,
                'is_aktif' => true,
            ]);

            $urutan = 1;
            foreach ($kriteriasInput as $kData) {
                $kode = $kData['kode'];
                $bobot = $ahpResult['weights'][$kode] ?? 0.20;
                $tipe = $kData['tipe_input'];

                $minVal = isset($kData['min_val']) ? floatval($kData['min_val']) : 0;
                $maxVal = isset($kData['max_val']) ? floatval($kData['max_val']) : 100;
                $satuan = $kData['satuan'] ?? null;
                $rentang = $kData['rentang'] ?? ($tipe === 'angka' ? "Rentang: {$minVal} s/d {$maxVal}".($satuan ? " ({$satuan})" : '') : 'Pilihan');

                $kriteria = $konfigurasi->kriterias()->create([
                    'kode' => $kode,
                    'nama' => $kData['nama'],
                    'atribut' => $kData['atribut'],
                    'tipe_input' => $tipe,
                    'rentang' => $rentang,
                    'min_val' => $minVal,
                    'max_val' => $maxVal,
                    'satuan' => $satuan,
                    'bobot' => $bobot,
                    'urutan' => $urutan++,
                ]);

                if ($tipe === 'pilihan') {
                    $pilihanArr = $kData['pilihan'] ?? [];
                    if (! empty($pilihanArr) && is_array($pilihanArr)) {
                        $pUrutan = 1;
                        foreach ($pilihanArr as $p) {
                            if (! empty($p['label'])) {
                                $kriteria->subKriterias()->create([
                                    'label' => trim($p['label']),
                                    'nilai' => intval($p['nilai'] ?? 1),
                                    'urutan' => $pUrutan++,
                                ]);
                            }
                        }
                    }
                }
            }
        });

        $msg = $isSiap
            ? "Paket konfigurasi seleksi '{$konfigurasi->nama}' berhasil disimpan dan siap digunakan untuk periode baru."
            : "Paket konfigurasi seleksi disimpan sebagai DRAF (CR = {$ahpResult['cr']}".(! $isConsistent ? ' > 0.10 belum konsisten' : '').'). Konfigurasi draf belum dapat dipilih untuk periode baru.';

        return redirect()->route('konfigurasi.index')
            ->with($isSiap ? 'sukses' : 'gagal', $msg);
    }

    /**
     * Tampilkan detail paket konfigurasi
     */
    public function show(KonfigurasiSeleksi $konfigurasi)
    {
        $konfigurasi->load(['kriterias.subKriterias', 'periodes']);
        $ahpResult = $this->ahpService->hitung(
            $konfigurasi->kriterias->pluck('kode')->toArray(),
            $konfigurasi->matriks_ahp ?? []
        );

        return view('konfigurasi.show', compact('konfigurasi', 'ahpResult'));
    }

    /**
     * Form edit paket konfigurasi
     */
    public function edit(KonfigurasiSeleksi $konfigurasi)
    {
        $konfigurasi->load(['kriterias.subKriterias', 'periodes']);

        $kriterias = $konfigurasi->kriterias;
        $kriteriaCodes = $kriterias->pluck('kode')->toArray();

        $matrix = $konfigurasi->matriks_ahp ?? [];
        if (empty($matrix) && ! empty($kriteriaCodes)) {
            $matrix = [];
            foreach ($kriteriaCodes as $i) {
                foreach ($kriteriaCodes as $j) {
                    $matrix[$i][$j] = ($i === $j) ? 1.0 : 1.0;
                }
            }
        }

        $ahpResult = $this->ahpService->hitung($kriteriaCodes, $matrix);
        $nextVersion = $konfigurasi->getNextVersionNumber();

        return view('konfigurasi.edit', compact('konfigurasi', 'kriterias', 'matrix', 'ahpResult', 'nextVersion'));
    }

    /**
     * Perbarui paket konfigurasi (Menerapkan Versioning jika sudah digunakan oleh periode)
     */
    public function update(Request $request, KonfigurasiSeleksi $konfigurasi)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'is_draf' => 'nullable|boolean',
            'kriterias' => 'required|array|size:5',
            'kriterias.*.kode' => 'required|string|in:C1,C2,C3,C4,C5',
            'kriterias.*.nama' => 'required|string|max:255',
            'kriterias.*.atribut' => 'required|in:benefit,cost',
            'kriterias.*.tipe_input' => 'required|in:angka,pilihan',
            'matrix' => 'required|array',
        ]);

        $matrix = $request->input('matrix', []);
        $kriteriasInput = $request->input('kriterias', []);
        $kriteriaCodes = array_column($kriteriasInput, 'kode');

        $ahpResult = $this->ahpService->hitung($kriteriaCodes, $matrix);
        $isConsistent = ($ahpResult['cr'] <= 0.10);
        $isDraf = $request->boolean('is_draf');
        $isSiap = (! $isDraf && $isConsistent);

        $sudahDigunakan = $konfigurasi->isDigunakan();

        DB::transaction(function () use ($konfigurasi, $data, $kriteriasInput, $ahpResult, $isConsistent, $isSiap, $sudahDigunakan, &$targetKonfigurasi) {
            if ($sudahDigunakan) {
                // STRATEGI VERSIONING: Buat versi baru agar periode lama tetap konsisten tanpa mengubah data historis
                $nextVersion = $konfigurasi->getNextVersionNumber();
                $targetKonfigurasi = KonfigurasiSeleksi::create([
                    'nama' => $data['nama'],
                    'deskripsi' => $data['deskripsi'] ?? $konfigurasi->deskripsi,
                    'versi' => $nextVersion,
                    'parent_id' => $konfigurasi->id,
                    'matriks_ahp' => $ahpResult['matrix'] ?? null,
                    'lambda_max' => $ahpResult['lambda_max'] ?? null,
                    'ci' => $ahpResult['ci'] ?? null,
                    'cr' => $ahpResult['cr'] ?? null,
                    'is_konsisten' => $isConsistent,
                    'is_siap' => $isSiap,
                    'is_aktif' => true,
                ]);
            } else {
                // Konfigurasi belum digunakan oleh periode manapun: update in-place
                $konfigurasi->update([
                    'nama' => $data['nama'],
                    'deskripsi' => $data['deskripsi'] ?? null,
                    'matriks_ahp' => $ahpResult['matrix'] ?? null,
                    'lambda_max' => $ahpResult['lambda_max'] ?? null,
                    'ci' => $ahpResult['ci'] ?? null,
                    'cr' => $ahpResult['cr'] ?? null,
                    'is_konsisten' => $isConsistent,
                    'is_siap' => $isSiap,
                ]);

                // Hapus kriteria lama untuk digantikan yang baru
                foreach ($konfigurasi->kriterias as $oldK) {
                    $oldK->subKriterias()->delete();
                    $oldK->delete();
                }
                $konfigurasi->unsetRelation('kriterias');

                $targetKonfigurasi = $konfigurasi;
            }

            // Simpan 5 kriteria baru
            $urutan = 1;
            foreach ($kriteriasInput as $kData) {
                $kode = $kData['kode'];
                $bobot = $ahpResult['weights'][$kode] ?? 0.20;
                $tipe = $kData['tipe_input'];

                $minVal = isset($kData['min_val']) ? floatval($kData['min_val']) : 0;
                $maxVal = isset($kData['max_val']) ? floatval($kData['max_val']) : 100;
                $satuan = $kData['satuan'] ?? null;
                $rentang = $kData['rentang'] ?? ($tipe === 'angka' ? "Rentang: {$minVal} s/d {$maxVal}".($satuan ? " ({$satuan})" : '') : 'Pilihan');

                $kriteria = $targetKonfigurasi->kriterias()->create([
                    'kode' => $kode,
                    'nama' => $kData['nama'],
                    'atribut' => $kData['atribut'],
                    'tipe_input' => $tipe,
                    'rentang' => $rentang,
                    'min_val' => $minVal,
                    'max_val' => $maxVal,
                    'satuan' => $satuan,
                    'bobot' => $bobot,
                    'urutan' => $urutan++,
                ]);

                if ($tipe === 'pilihan') {
                    $pilihanArr = $kData['pilihan'] ?? [];
                    if (! empty($pilihanArr) && is_array($pilihanArr)) {
                        $pUrutan = 1;
                        foreach ($pilihanArr as $p) {
                            if (! empty($p['label'])) {
                                $kriteria->subKriterias()->create([
                                    'label' => trim($p['label']),
                                    'nilai' => intval($p['nilai'] ?? 1),
                                    'urutan' => $pUrutan++,
                                ]);
                            }
                        }
                    }
                }
            }
        });

        if ($sudahDigunakan) {
            $msg = "Konfigurasi telah digunakan oleh periode, sehingga sistem otomatis membuat Konfigurasi Versi {$targetKonfigurasi->versi}. Periode lama tetap aman menggunakan versi {$konfigurasi->versi}.";
        } else {
            $msg = "Paket konfigurasi seleksi '{$targetKonfigurasi->nama}' berhasil diperbarui.";
        }

        return redirect()->route('konfigurasi.index')
            ->with('sukses', $msg);
    }

    /**
     * Hapus paket konfigurasi (dengan perlindungan jika masih digunakan oleh periode)
     */
    public function destroy(KonfigurasiSeleksi $konfigurasi)
    {
        $nama = $konfigurasi->nama;
        $countPeriode = $konfigurasi->periodes()->count();

        if ($countPeriode > 0) {
            return redirect()->route('konfigurasi.index')
                ->with('gagal', "Konfigurasi '{$nama}' tidak dapat dihapus karena sedang digunakan oleh {$countPeriode} periode seleksi aktif/historis.");
        }

        DB::transaction(function () use ($konfigurasi) {
            foreach ($konfigurasi->kriterias as $k) {
                $k->subKriterias()->delete();
                $k->delete();
            }
            $konfigurasi->delete();
        });

        return redirect()->route('konfigurasi.index')
            ->with('sukses', "Paket konfigurasi seleksi '{$nama}' berhasil dihapus.");
    }

    /**
     * Duplikasi paket konfigurasi
     */
    public function duplikat(KonfigurasiSeleksi $konfigurasi)
    {
        $konfigurasi->load(['kriterias.subKriterias']);

        DB::transaction(function () use ($konfigurasi, &$baru) {
            $baru = KonfigurasiSeleksi::create([
                'nama' => 'Salinan '.$konfigurasi->nama,
                'deskripsi' => $konfigurasi->deskripsi ? ('Salinan dari '.$konfigurasi->nama.'. '.$konfigurasi->deskripsi) : 'Salinan dari '.$konfigurasi->nama,
                'versi' => 1,
                'parent_id' => null,
                'matriks_ahp' => $konfigurasi->matriks_ahp,
                'lambda_max' => $konfigurasi->lambda_max,
                'ci' => $konfigurasi->ci,
                'cr' => $konfigurasi->cr,
                'is_konsisten' => $konfigurasi->is_konsisten,
                'is_siap' => $konfigurasi->is_siap,
                'is_aktif' => true,
            ]);

            foreach ($konfigurasi->kriterias as $k) {
                $kBaru = $baru->kriterias()->create([
                    'kode' => $k->kode,
                    'nama' => $k->nama,
                    'atribut' => $k->atribut,
                    'tipe_input' => $k->tipe_input,
                    'rentang' => $k->rentang,
                    'min_val' => $k->min_val,
                    'max_val' => $k->max_val,
                    'satuan' => $k->satuan,
                    'bobot' => $k->bobot,
                    'urutan' => $k->urutan,
                ]);

                foreach ($k->subKriterias as $sub) {
                    $kBaru->subKriterias()->create([
                        'label' => $sub->label,
                        'nilai' => $sub->nilai,
                        'urutan' => $sub->urutan,
                    ]);
                }
            }
        });

        return redirect()->route('konfigurasi.edit', $baru)
            ->with('sukses', "Salinan paket konfigurasi '{$baru->nama}' berhasil dibuat. Anda dapat langsung mengeditnya.");
    }

    /**
     * API AJAX untuk perhitungan matriks AHP real-time
     */
    public function hitungAhp(Request $request)
    {
        $matrix = $request->input('matrix', []);
        $kriterias = $request->input('kriterias', ['C1', 'C2', 'C3', 'C4', 'C5']);

        $result = $this->ahpService->hitung($kriterias, $matrix);

        return response()->json($result);
    }
}
