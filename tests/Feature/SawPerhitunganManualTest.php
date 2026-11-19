<?php

namespace Tests\Feature;

use App\Models\CalonPenerima;
use App\Models\Penilaian;
use App\Models\Periode;
use App\Services\SawService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SawPerhitunganManualTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Hasil SAW web harus sama dengan tabel "PERHITUNGAN SAW ARTIKEL" (perhitungan manual).
     */
    public function test_hasil_saw_sesuai_perhitungan_manual_artikel(): void
    {
        $periode = Periode::create([
            'nama' => 'Periode Uji SAW Artikel',
            'tahun' => 2026,
            'kuota' => 3,
            'total_siswa' => 10,
            'ambang_batas' => 0.8,
            'tanggal_mulai' => now()->subDay()->toDateString(),
            'deadline' => now()->addDays(10)->toDateString(),
            'is_final' => false,
        ]);

        // Bobot AHP presisi penuh (web akan membulatkan ke 0.40, 0.24, 0.16, 0.11, 0.09)
        $kriteriaData = [
            ['kode' => 'C1', 'nama' => 'Prestasi Akademik', 'atribut' => 'benefit', 'bobot' => 0.396983],
            ['kode' => 'C2', 'nama' => 'Penghasilan Orang Tua', 'atribut' => 'cost', 'bobot' => 0.241828],
            ['kode' => 'C3', 'nama' => 'Tanggungan Anak', 'atribut' => 'benefit', 'bobot' => 0.157302],
            ['kode' => 'C4', 'nama' => 'Ekstrakurikuler', 'atribut' => 'cost', 'bobot' => 0.109367],
            ['kode' => 'C5', 'nama' => 'Ketidakhadiran', 'atribut' => 'cost', 'bobot' => 0.094520],
        ];

        $kriterias = [];
        foreach ($kriteriaData as $i => $data) {
            $kriterias[] = $periode->kriterias()->create($data + [
                'tipe_input' => 'angka',
                'min_val' => 0,
                'max_val' => 10000000,
                'urutan' => $i + 1,
            ]);
        }

        $alternatif = [
            'Bagas Wicaksono' => [78, 2500000, 4, 3, 3],
            'Intan Permata' => [91, 1800000, 6, 2, 4],
            'Kevin Saputra' => [72, 4500000, 2, 4, 2],
            'Rendra Mahendra' => [95, 1200000, 7, 1, 1],
            'Salsa Maharani' => [84, 3200000, 5, 3, 3],
            'Tiara Anggraini' => [68, 5500000, 3, 5, 4],
            'Nadia Kusuma' => [89, 3800000, 1, 2, 2],
            'Wahyu Hidayat' => [76, 6500000, 8, 4, 5],
            'Dimas Prasetyo' => [82, 2800000, 3, 3, 1],
            'Farah Aulia' => [70, 4000000, 5, 4, 2],
        ];

        $nomor = 1;
        foreach ($alternatif as $nama => $nilaiList) {
            $calon = CalonPenerima::create([
                'periode_id' => $periode->id,
                'nim' => 'A'.$nomor++,
                'nama' => $nama,
                'program_studi' => 'Umum',
            ]);

            foreach ($nilaiList as $index => $nilai) {
                Penilaian::create([
                    'calon_penerima_id' => $calon->id,
                    'kriteria_id' => $kriterias[$index]->id,
                    'nilai' => $nilai,
                ]);
            }
        }

        app(SawService::class)->hitung($periode);

        $expected = [
            'Rendra Mahendra' => [0.9800, 1],
            'Intan Permata' => [0.7407, 2],
            'Dimas Prasetyo' => [0.6348, 3],
            'Salsa Maharani' => [0.6104, 4],
            'Bagas Wicaksono' => [0.5903, 5],
            'Nadia Kusuma' => [0.5705, 6],
            'Wahyu Hidayat' => [0.5698, 7],
            'Farah Aulia' => [0.5392, 8],
            'Kevin Saputra' => [0.4797, 9],
            'Tiara Anggraini' => [0.4432, 10],
        ];

        foreach ($expected as $nama => [$skor, $ranking]) {
            $calon = CalonPenerima::where('nama', $nama)->first();
            $this->assertEqualsWithDelta($skor, (float) $calon->skor_saw, 0.0001, "Skor {$nama}");
            $this->assertSame($ranking, (int) $calon->ranking, "Ranking {$nama}");
        }
    }
}
