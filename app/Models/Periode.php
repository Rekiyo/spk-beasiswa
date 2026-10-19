<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $fillable = [
        'nama',
        'tahun',
        'kuota',
        'tanggal_mulai',
        'deadline',
        'lambda_max',
        'ci',
        'cr',
        'matriks_ahp',
        'is_final',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'deadline' => 'date',
        'lambda_max' => 'decimal:5',
        'ci' => 'decimal:5',
        'cr' => 'decimal:5',
        'matriks_ahp' => 'array',
        'is_final' => 'boolean',
    ];

    public function kriterias()
    {
        return $this->hasMany(Kriteria::class)->orderBy('kode');
    }

    public function calonPenerimas()
    {
        return $this->hasMany(CalonPenerima::class)->orderBy('ranking');
    }

    // True kalau hari ini sudah lewat deadline
    public function isTerkunci(): bool
    {
        return now()->startOfDay()->gt($this->deadline);
    }

    // Status otomatis berdasarkan tanggal
    public function getStatusAttribute(): string
    {
        $hariIni = now()->startOfDay();

        if ($hariIni->lt($this->tanggal_mulai)) {
            return 'Belum dimulai';
        }
        if ($hariIni->gt($this->deadline)) {
            return 'Selesai (terkunci)';
        }

        return 'Berjalan';
    }
}
