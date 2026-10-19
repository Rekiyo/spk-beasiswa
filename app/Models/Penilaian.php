<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaians';

    protected $fillable = [
        'calon_penerima_id',
        'kriteria_id',
        'sub_kriteria_id',
        'nilai',
    ];

    protected $casts = [
        'nilai' => 'float',
    ];

    public function calonPenerima(): BelongsTo
    {
        return $this->belongsTo(CalonPenerima::class);
    }

    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function subKriteria(): BelongsTo
    {
        return $this->belongsTo(SubKriteria::class);
    }
}
