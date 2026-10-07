<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $fillable = ['nama', 'tahun', 'kuota', 'tanggal_mulai', 'deadline'];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'deadline'      => 'date',
    ];

    public function kriterias()
{
    return $this->hasMany(Kriteria::class)->orderBy('kode');
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