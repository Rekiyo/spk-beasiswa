<?php

namespace Tests\Feature;

use App\Models\CalonPenerima;
use App\Models\Penilaian;
use App\Models\Periode;
use App\Services\SawService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CutoffSeleksiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper membuat periode dengan 5 kriteria standar dan bobot yang telah terdefinisi.
     */
    protected function createPeriodeWithCriteria(int $kuota = 15, float $ambangBatas = 0.800): Periode
    {
        $periode = Periode::create([
            'nama' => 'Periode Uji Cutoff SMK',
            'tahun' => 2026,
            'kuota' => $kuota,
            'total_siswa' => 100,
            'ambang_batas' => $ambangBatas,
            'tanggal_mulai' => now()->subDays(5)->toDateString(),
            'deadline' => now()->addDays(20)->toDateString(),
            'lambda_max' => 5.168,
            'ci' => 0.042,
            'cr' => 0.038,
            'is_final' => false,
        ]);

        // C1: Nilai Akademik (Benefit, W: 0.40)
        $periode->kriterias()->create([
            'kode' => 'C1',
            'nama' => 'Nilai Akademik',
            'atribut' => 'benefit',
            'tipe_input' => 'angka',
            'min_val' => 0,
            'max_val' => 100,
            'bobot' => 0.40,
            'urutan' => 1,
        ]);

        // C2: Penghasilan Orang Tua (Cost, W: 0.25)
        $periode->kriterias()->create([
            'kode' => 'C2',
            'nama' => 'Penghasilan Orang Tua',
            'atribut' => 'cost',
            'tipe_input' => 'angka',
            'min_val' => 0,
            'max_val' => 10000000,
            'bobot' => 0.25,
            'urutan' => 2,
        ]);

        // C3: Tanggungan Orang Tua (Benefit, W: 0.15)
        $periode->kriterias()->create([
            'kode' => 'C3',
            'nama' => 'Tanggungan Orang Tua',
            'atribut' => 'benefit',
            'tipe_input' => 'pilihan',
            'min_val' => 1,
            'max_val' => 5,
            'bobot' => 0.15,
            'urutan' => 3,
        ]);

        // C4: Ekstrakurikuler (Benefit, W: 0.10)
        $periode->kriterias()->create([
            'kode' => 'C4',
            'nama' => 'Ekstrakurikuler',
            'atribut' => 'benefit',
            'tipe_input' => 'pilihan',
            'min_val' => 1,
            'max_val' => 5,
            'bobot' => 0.10,
            'urutan' => 4,
        ]);

        // C5: Ketidakhadiran (Cost, W: 0.10)
        $periode->kriterias()->create([
            'kode' => 'C5',
            'nama' => 'Ketidakhadiran',
            'atribut' => 'cost',
            'tipe_input' => 'angka',
            'min_val' => 0,
            'max_val' => 30,
            'bobot' => 0.10,
            'urutan' => 5,
        ]);

        return $periode;
    }

    /**
     * Helper mendaftarkan siswa dengan nilai kriteria
     */
    protected function registerCandidate(Periode $periode, string $nim, string $nama, array $nilaiMap): CalonPenerima
    {
        $calon = $periode->calonPenerimas()->create([
            'nim' => $nim,
            'nama' => $nama,
            'program_studi' => 'Rekayasa Perangkat Lunak',
            'semester' => 'XII RPL 1',
            'jalur' => 'Reguler Prestasi SMK',
        ]);

        $kriterias = $periode->kriterias()->get()->keyBy('kode');
        foreach ($nilaiMap as $kode => $val) {
            if (isset($kriterias[$kode])) {
                Penilaian::create([
                    'calon_penerima_id' => $calon->id,
                    'kriteria_id' => $kriterias[$kode]->id,
                    'nilai' => $val,
                ]);
            }
        }

        return $calon;
    }

    /**
     * 1. Kuota 15 menghasilkan 15 siswa lolos ketika tersedia setidaknya 15 siswa dengan penilaian valid.
     */
    public function test_kuota_15_menghasilkan_15_siswa_lolos_ketika_tersedia_minimal_15_siswa_valid(): void
    {
        $periode = $this->createPeriodeWithCriteria(kuota: 15);
        $saw = new SawService;

        // Buat 35 siswa dengan variasi skor berjenjang
        for ($i = 1; $i <= 35; $i++) {
            $nim = sprintf('%03d', $i);
            $c1 = 98 - ($i * 1.0); // 97, 96, ..., turun bertahap
            $c2 = 1000000 + ($i * 100000);
            $c3 = max(1, 5 - intval($i / 8));
            $c4 = max(1, 5 - intval($i / 8));
            $c5 = min(10, intval($i / 4));

            $this->registerCandidate($periode, $nim, "Siswa Ke-{$i}", [
                'C1' => $c1, 'C2' => $c2, 'C3' => $c3, 'C4' => $c4, 'C5' => $c5,
            ]);
        }

        $saw->hitung($periode);

        $totalLolos = $periode->calonPenerimas()->where('status_kelulusan', 'lolos')->count();
        $this->assertEquals(15, $totalLolos);

        // Siswa peringkat 1 sampai 15 semuanya lolos
        $lolosCandidates = $periode->calonPenerimas()->where('status_kelulusan', 'lolos')->orderBy('ranking')->get();
        $this->assertCount(15, $lolosCandidates);
        $this->assertEquals(1, $lolosCandidates->first()->ranking);
        $this->assertEquals(15, $lolosCandidates->last()->ranking);
    }

    /**
     * 2. Skor peringkat ke-15 menjadi cutoff kuota (dinamis dari peringkat terakhir kuota).
     */
    public function test_skor_peringkat_ke_15_menjadi_cutoff_kuota(): void
    {
        $periode = $this->createPeriodeWithCriteria(kuota: 15);
        $saw = new SawService;

        for ($i = 1; $i <= 30; $i++) {
            $nim = sprintf('%03d', $i);
            $this->registerCandidate($periode, $nim, "Siswa Ke-{$i}", [
                'C1' => 96 - ($i * 0.8),
                'C2' => 1200000 + ($i * 80000),
                'C3' => max(1, 4 - intval($i / 10)),
                'C4' => max(1, 4 - intval($i / 10)),
                'C5' => min(5, intval($i / 6)),
            ]);
        }

        $result = $saw->hitung($periode);
        $rank15 = $periode->calonPenerimas()->where('ranking', 15)->first();

        $this->assertNotNull($rank15);
        $this->assertNotNull($periode->cutoff_kuota);
        $this->assertEquals($rank15->skor_saw, $periode->cutoff_kuota);
        $this->assertEquals($rank15->skor_saw, $result['cutoff_kuota']);
    }

    /**
     * 3. Siswa peringkat 16 dan seterusnya tidak dinyatakan lolos kuota utama.
     */
    public function test_siswa_peringkat_16_dan_seterusnya_tidak_dinyatakan_lolos_kuota_utama(): void
    {
        $periode = $this->createPeriodeWithCriteria(kuota: 15);
        $saw = new SawService;

        for ($i = 1; $i <= 35; $i++) {
            $nim = sprintf('%03d', $i);
            $this->registerCandidate($periode, $nim, "Siswa Ke-{$i}", [
                'C1' => 97 - ($i * 0.9),
                'C2' => 1000000 + ($i * 100000),
                'C3' => 4,
                'C4' => 4,
                'C5' => 0,
            ]);
        }

        $saw->hitung($periode);

        // Siswa peringkat 16 s/d 35 tidak boleh berstatus lolos
        $nonLolos = $periode->calonPenerimas()->where('ranking', '>=', 16)->get();
        foreach ($nonLolos as $c) {
            $this->assertNotEquals('lolos', $c->status_kelulusan);
        }

        // Peringkat 16 adalah cadangan
        $rank16 = $periode->calonPenerimas()->where('ranking', 16)->first();
        $this->assertEquals('cadangan', $rank16->status_kelulusan);
    }

    /**
     * 4. Status cadangan mengikuti batas cadangan yang berlaku (kuota + 1 sampai 2 * kuota).
     */
    public function test_status_cadangan_mengikuti_batas_cadangan_yang_berlaku(): void
    {
        $periode = $this->createPeriodeWithCriteria(kuota: 15);
        $saw = new SawService;

        for ($i = 1; $i <= 35; $i++) {
            $nim = sprintf('%03d', $i);
            $this->registerCandidate($periode, $nim, "Siswa Ke-{$i}", [
                'C1' => 95 - ($i * 0.8),
                'C2' => 1500000 + ($i * 50000),
                'C3' => 3,
                'C4' => 3,
                'C5' => 1,
            ]);
        }

        $saw->hitung($periode);

        // Kuota 15 -> Batas cadangan adalah 15 siswa (rank 16 s/d 30)
        $totalCadangan = $periode->calonPenerimas()->where('status_kelulusan', 'cadangan')->count();
        $this->assertEquals(15, $totalCadangan);

        $rank30 = $periode->calonPenerimas()->where('ranking', 30)->first();
        $this->assertEquals('cadangan', $rank30->status_kelulusan);

        // Peringkat 31 adalah tidak lolos
        $rank31 = $periode->calonPenerimas()->where('ranking', 31)->first();
        $this->assertEquals('tidak_lolos', $rank31->status_kelulusan);
    }

    /**
     * 5. Jumlah siswa valid kurang dari kuota tidak menyebabkan error (semua dinyatakan lolos).
     */
    public function test_jumlah_siswa_valid_kurang_dari_kuota_tidak_menyebabkan_error(): void
    {
        // Kuota 15, tetapi hanya ada 4 siswa terdaftar
        $periode = $this->createPeriodeWithCriteria(kuota: 15);
        $saw = new SawService;

        $this->registerCandidate($periode, '001', 'Siswa A', ['C1' => 90, 'C2' => 2000000, 'C3' => 3, 'C4' => 4, 'C5' => 0]);
        $this->registerCandidate($periode, '002', 'Siswa B', ['C1' => 88, 'C2' => 2500000, 'C3' => 2, 'C4' => 3, 'C5' => 1]);
        $this->registerCandidate($periode, '003', 'Siswa C', ['C1' => 85, 'C2' => 3000000, 'C3' => 3, 'C4' => 2, 'C5' => 0]);
        $this->registerCandidate($periode, '004', 'Siswa D', ['C1' => 80, 'C2' => 3500000, 'C3' => 1, 'C4' => 2, 'C5' => 2]);

        $saw->hitung($periode);

        $totalLolos = $periode->calonPenerimas()->where('status_kelulusan', 'lolos')->count();
        $totalCadangan = $periode->calonPenerimas()->where('status_kelulusan', 'cadangan')->count();
        $totalTidakLolos = $periode->calonPenerimas()->where('status_kelulusan', 'tidak_lolos')->count();

        $this->assertEquals(4, $totalLolos);
        $this->assertEquals(0, $totalCadangan);
        $this->assertEquals(0, $totalTidakLolos);

        // Cutoff kuota adalah skor siswa lolos terendah (peringkat ke-4)
        $rank4 = $periode->calonPenerimas()->where('ranking', 4)->first();
        $this->assertEquals($rank4->skor_saw, $periode->cutoff_kuota);
    }

    /**
     * 6. Periode tanpa hasil SAW tidak menampilkan cutoff palsu.
     */
    public function test_periode_tanpa_hasil_saw_tidak_menampilkan_cutoff_palsu(): void
    {
        $periode = $this->createPeriodeWithCriteria(kuota: 15);

        $this->registerCandidate($periode, '001', 'Siswa Belum Dihitung', [
            'C1' => 90, 'C2' => 2000000, 'C3' => 3, 'C4' => 4, 'C5' => 0,
        ]);

        // SAW belum dihitung
        $this->assertNull($periode->cutoff_kuota);

        $response = $this->get(route('dashboard', ['periode_id' => $periode->id]));
        $response->assertOk();

        // Tidak boleh ada cutoff palsu 0.800
        $response->assertDontSee('Cutoff: 0.800');
        $response->assertDontSee('Cutoff Kuota Penerima (Rank 1–');
        // Harus menampilkan informasi bahwa kalkulasi SAW belum dijalankan
        $response->assertSee('Kalkulasi SAW belum dijalankan untuk periode ini');
    }

    /**
     * 7. Dashboard dan halaman seleksi menampilkan cutoff serta rekapitulasi status yang konsisten.
     */
    public function test_dashboard_dan_halaman_seleksi_menampilkan_cutoff_serta_rekapitulasi_status_yang_konsisten(): void
    {
        $periode = $this->createPeriodeWithCriteria(kuota: 15);
        $saw = new SawService;

        for ($i = 1; $i <= 32; $i++) {
            $nim = sprintf('%03d', $i);
            $this->registerCandidate($periode, $nim, "Siswa {$nim}", [
                'C1' => 96 - ($i * 0.7),
                'C2' => 1000000 + ($i * 90000),
                'C3' => 3,
                'C4' => 3,
                'C5' => min(5, intval($i / 5)),
            ]);
        }

        $saw->hitung($periode);

        $cutoff = $periode->cutoff_kuota;
        $this->assertNotNull($cutoff);
        $formattedCutoff = number_format($cutoff, 3);

        // Cek Dashboard
        $dashboardResponse = $this->get(route('dashboard', ['periode_id' => $periode->id]));
        $dashboardResponse->assertOk();
        $dashboardResponse->assertSee("Cutoff Kuota Penerima (Rank 1–15): <strong>V &ge; {$formattedCutoff}</strong>", false);
        $dashboardResponse->assertSee('15 Lolos Kuota');
        $dashboardResponse->assertSee("Cutoff: {$formattedCutoff}");
        $dashboardResponse->assertSee('Lolos: 15 Siswa');
        $dashboardResponse->assertSee('Cadangan: 15 Siswa');
        $dashboardResponse->assertSee('Tidak Lolos: 2 Siswa');

        // Cek Halaman Seleksi
        $seleksiResponse = $this->get(route('periode.seleksi', $periode));
        $seleksiResponse->assertOk();
        $seleksiResponse->assertSee('Batas kuota: <strong>15 Siswa Penerima</strong>', false);
        $seleksiResponse->assertSee("Cutoff Kuota Utama (Rank 15): <strong>V &ge; {$formattedCutoff}</strong>", false);
        $seleksiResponse->assertSee('Lolos Kuota (15)');
        $seleksiResponse->assertSee('Cadangan (15)');
        $seleksiResponse->assertSee('Tidak Lolos (2)');
    }

    /**
     * 8. Perubahan tidak merusak perhitungan bobot AHP, normalisasi SAW, dan tie-breaker deterministik.
     */
    public function test_aturan_tie_breaker_konsisten_dan_tidak_merusak_normalisasi_saw(): void
    {
        $periode = $this->createPeriodeWithCriteria(kuota: 5);
        $saw = new SawService;

        // Buat 2 kandidat dengan nilai yang hampir identik kecuali C1 (Tie-breaker Akademik)
        $c1 = $this->registerCandidate($periode, '001', 'Kandidat C1 Lebih Rendah', [
            'C1' => 88.0, 'C2' => 2000000, 'C3' => 3, 'C4' => 3, 'C5' => 0,
        ]);

        $c2 = $this->registerCandidate($periode, '002', 'Kandidat C1 Lebih Tinggi', [
            'C1' => 92.0, 'C2' => 2000000, 'C3' => 3, 'C4' => 3, 'C5' => 0,
        ]);

        $result = $saw->hitung($periode);

        $c1->refresh();
        $c2->refresh();

        // Normalisasi matriks R harus berada dalam rentang [0, 1]
        foreach ($result['matrix_r'] as $calonId => $criteriaValues) {
            foreach ($criteriaValues as $critId => $rVal) {
                $this->assertGreaterThanOrEqual(0.0, $rVal);
                $this->assertLessThanOrEqual(1.0, $rVal);
            }
        }

        // Bobot kriteria harus total mendekati 1.0
        $sumWeights = array_sum($result['weights']);
        $this->assertEqualsWithDelta(1.0, $sumWeights, 0.001);

        // Kandidat dengan nilai rapor C1 lebih tinggi harus mendapat ranking lebih atas
        $this->assertEquals(1, $c2->ranking);
        $this->assertEquals(2, $c1->ranking);
        $this->assertGreaterThanOrEqual($c1->skor_saw, $c2->skor_saw);
    }
}
