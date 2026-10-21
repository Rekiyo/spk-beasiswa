<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CalonPenerima extends Model
{
    use HasFactory;

    protected $table = 'calon_penerimas';

    protected $fillable = [
        'periode_id',
        'nim',
        'nama',
        'program_studi',
        'semester',
        'jalur',
        'skor_saw',
        'ranking',
        'status_kelulusan',
        'catatan',
    ];

    protected $casts = [
        'skor_saw' => 'decimal:4',
        'ranking' => 'integer',
    ];

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function penilaians(): HasMany
    {
        return $this->hasMany(Penilaian::class);
    }

    /**
     * Helper to get initials for avatar
     */
    public function getInisialAttribute(): string
    {
        $words = preg_split('/\s+/', trim($this->nama));
        $initials = '';
        foreach (array_slice($words, 0, 2) as $w) {
            $initials .= strtoupper(mb_substr($w, 0, 1));
        }

        return $initials ?: 'M';
    }
}
