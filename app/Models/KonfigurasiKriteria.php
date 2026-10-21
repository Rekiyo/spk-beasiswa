<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KonfigurasiKriteria extends Model
{
    use HasFactory;

    protected $table = 'konfigurasi_kriterias';

    protected $fillable = [
        'konfigurasi_seleksi_id',
        'kode',
        'nama',
        'atribut',
        'tipe_input',
        'rentang',
        'min_val',
        'max_val',
        'satuan',
        'bobot',
        'urutan',
    ];

    protected $casts = [
        'min_val' => 'float',
        'max_val' => 'float',
        'bobot' => 'decimal:6',
        'urutan' => 'integer',
    ];

    public function konfigurasiSeleksi(): BelongsTo
    {
        return $this->belongsTo(KonfigurasiSeleksi::class, 'konfigurasi_seleksi_id');
    }

    public function subKriterias(): HasMany
    {
        return $this->hasMany(KonfigurasiSubKriteria::class, 'konfigurasi_kriteria_id')
            ->orderBy('nilai');
    }
}
