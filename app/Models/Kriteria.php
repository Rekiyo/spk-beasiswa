<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'periode_id',
        'kode',
        'nama',
        'atribut',
        'tipe_input',
        'rentang',
        'min_val',
        'max_val',
        'satuan',
        'bobot',
    ];

    protected $casts = [
        'min_val' => 'float',
        'max_val' => 'float',
        'bobot' => 'decimal:6',
    ];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class)
            ->orderBy('nilai');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
