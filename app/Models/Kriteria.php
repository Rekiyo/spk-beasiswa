<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = ['periode_id', 'kode', 'nama', 'atribut', 'tipe_input'];

public function subKriterias()
{
    return $this->hasMany(SubKriteria::class)->orderBy('nilai');
}

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}

