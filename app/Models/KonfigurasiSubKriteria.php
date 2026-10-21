<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KonfigurasiSubKriteria extends Model
{
    use HasFactory;

    protected $table = 'konfigurasi_sub_kriterias';

    protected $fillable = [
        'konfigurasi_kriteria_id',
        'label',
        'nilai',
        'urutan',
    ];

    protected $casts = [
        'nilai' => 'integer',
        'urutan' => 'integer',
    ];

    public function konfigurasiKriteria(): BelongsTo
    {
        return $this->belongsTo(KonfigurasiKriteria::class, 'konfigurasi_kriteria_id');
    }
}
