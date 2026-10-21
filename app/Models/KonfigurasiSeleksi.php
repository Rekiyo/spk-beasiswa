<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KonfigurasiSeleksi extends Model
{
    use HasFactory;

    protected $table = 'konfigurasi_seleksis';

    protected $fillable = [
        'nama',
        'deskripsi',
        'versi',
        'parent_id',
        'matriks_ahp',
        'lambda_max',
        'ci',
        'cr',
        'is_konsisten',
        'is_siap',
        'is_aktif',
    ];

    protected $casts = [
        'versi' => 'integer',
        'matriks_ahp' => 'array',
        'lambda_max' => 'decimal:5',
        'ci' => 'decimal:5',
        'cr' => 'decimal:5',
        'is_konsisten' => 'boolean',
        'is_siap' => 'boolean',
        'is_aktif' => 'boolean',
    ];

    public function kriterias(): HasMany
    {
        return $this->hasMany(KonfigurasiKriteria::class)->orderBy('kode');
    }

    public function periodes(): HasMany
    {
        return $this->hasMany(Periode::class, 'konfigurasi_seleksi_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function versions(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderByDesc('versi');
    }

    /**
     * Memeriksa apakah konfigurasi sedang digunakan oleh setidaknya satu periode
     */
    public function isDigunakan(): bool
    {
        return $this->periodes()->exists();
    }

    /**
     * Menghitung status kelengkapan data (5 kriteria terisi & AHP lengkap)
     */
    public function isLengkap(): bool
    {
        if ($this->kriterias()->count() !== 5) {
            return false;
        }

        foreach ($this->kriterias as $k) {
            if (empty($k->nama) || empty($k->atribut) || empty($k->tipe_input)) {
                return false;
            }
            if ($k->tipe_input === 'pilihan' && $k->subKriterias()->count() === 0) {
                return false;
            }
        }

        return ! empty($this->matriks_ahp);
    }

    /**
     * Dapatkan ID konfigurasi akar (root) dalam riwayat silsilah versi.
     */
    public function getRootId(): int
    {
        $root = $this;
        while ($root->parent_id && $root->parent) {
            $root = $root->parent;
        }

        return (int) $root->id;
    }

    /**
     * Menghitung nomor versi berikutnya saat konfigurasi ini direvisi.
     * Mencegah duplikasi nomor versi pada silsilah konfigurasi yang sama.
     */
    public function getNextVersionNumber(): int
    {
        $rootId = $this->getRootId();

        $maxVersion = (int) (self::where('id', $rootId)
            ->orWhere('parent_id', $rootId)
            ->orWhere('parent_id', $this->id)
            ->max('versi') ?? $this->versi);

        return max((int) $this->versi, $maxVersion) + 1;
    }
}
