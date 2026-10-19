<?php

namespace Tests\Feature;

use App\Models\Periode;
use App\Services\AhpService;
use Database\Seeders\SpkDemoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpkFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_renders_successfully(): void
    {
        $this->seed(SpkDemoSeeder::class);

        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee('Sistem Pendukung Keputusan');
        $response->assertSee('Distribusi Kriteria & Top Skor SAW');
    }

    public function test_periode_index_renders_successfully(): void
    {
        $this->seed(SpkDemoSeeder::class);

        $response = $this->get(route('periode.index'));
        $response->assertStatus(200);
        $response->assertSee('Manajemen Periode Seleksi');
        $response->assertSee('Tambah Periode Baru');
    }

    public function test_periode_create_renders_successfully(): void
    {
        $response = $this->get(route('periode.create'));
        $response->assertStatus(200);
        $response->assertSee('Tambah Periode Seleksi Baru');
        $response->assertSee('Data Pembobotan Kriteria');
    }

    public function test_seleksi_page_renders_with_saw_rankings(): void
    {
        $this->seed(SpkDemoSeeder::class);

        $periode = Periode::latest('id')->first();
        $this->assertNotNull($periode);

        $response = $this->get(route('periode.seleksi', $periode));
        $response->assertStatus(200);
        $response->assertSee('Kelola Seleksi & Perangkingan');
        $response->assertSee('Hasil Rekapitulasi Perangkingan');
    }

    public function test_ahp_service_computes_consistent_ratio(): void
    {
        $ahp = new AhpService;
        $keys = ['C1', 'C2', 'C3', 'C4', 'C5'];
        $matrix = [
            'C1' => ['C1' => 1.0, 'C2' => 3.0, 'C3' => 4.0, 'C4' => 5.0, 'C5' => 6.0],
            'C2' => ['C1' => 0.333, 'C2' => 1.0, 'C3' => 2.0, 'C4' => 3.0, 'C5' => 4.0],
            'C3' => ['C1' => 0.250, 'C2' => 0.500, 'C3' => 1.0, 'C4' => 2.0, 'C5' => 3.0],
            'C4' => ['C1' => 0.200, 'C2' => 0.333, 'C3' => 0.500, 'C4' => 1.0, 'C5' => 2.0],
            'C5' => ['C1' => 0.167, 'C2' => 0.250, 'C3' => 0.333, 'C4' => 0.500, 'C5' => 1.0],
        ];

        $res = $ahp->hitung($keys, $matrix);

        $this->assertArrayHasKey('weights', $res);
        $this->assertArrayHasKey('cr', $res);
        $this->assertTrue($res['is_consistent']);
        $this->assertLessThan(0.10, $res['cr']);
        $this->assertEqualsWithDelta(1.0, array_sum($res['weights']), 0.01);
    }

    public function test_export_sk_renders_successfully(): void
    {
        $this->seed(SpkDemoSeeder::class);

        $periode = Periode::latest('id')->first();
        $this->assertNotNull($periode);

        $response = $this->get(route('periode.seleksi.export', $periode));
        $response->assertStatus(200);
        $response->assertSee('SURAT KEPUTUSAN KEPALA SEKOLAH MENENGAH KEJURUAN');
    }

    public function test_candidate_store_with_smk_criteria_and_recalculates_saw(): void
    {
        $this->seed(SpkDemoSeeder::class);
        $periode = Periode::where('is_final', false)->first();
        $kriterias = $periode->kriterias()->get()->keyBy('kode');

        $payload = [
            'nama' => 'Bambang Pamungkas Siswa',
            'nim' => '0078999999',
            'program_studi' => 'Rekayasa Perangkat Lunak',
            'semester' => 'XII RPL 1',
            'jalur' => 'Reguler Prestasi SMK',
            'nilai' => [
                $kriterias['C1']->id => 98.00, // Nilai Akademik 0-100
                $kriterias['C2']->id => 1200000, // Penghasilan Orang Tua
                $kriterias['C3']->id => 4, // Tanggungan Orang Tua (1..5)
                $kriterias['C4']->id => 5, // Paket 5 Ekstrakurikuler
                $kriterias['C5']->id => 0, // Ketidakhadiran (0..5+)
            ],
        ];

        $response = $this->post(route('periode.seleksi.store', $periode), $payload);
        $response->assertRedirect(route('periode.seleksi', $periode));
        $response->assertSessionHas('sukses');

        $this->assertDatabaseHas('calon_penerimas', [
            'periode_id' => $periode->id,
            'nim' => '0078999999',
            'nama' => 'Bambang Pamungkas Siswa',
        ]);
    }

    public function test_candidate_update_shows_edit_notification(): void
    {
        $this->seed(SpkDemoSeeder::class);
        $periode = Periode::where('is_final', false)->first();
        $calon = $periode->calonPenerimas()->first();
        $kriterias = $periode->kriterias()->get()->keyBy('kode');

        $payload = [
            'calon_id' => $calon->id,
            'nama' => 'Nama Siswa Terupdate',
            'nim' => $calon->nim,
            'program_studi' => 'Desain Komunikasi Visual',
            'semester' => 'XII DKV 1',
            'jalur' => 'Reguler Prestasi SMK',
            'nilai' => [
                $kriterias['C1']->id => 95.00,
                $kriterias['C2']->id => 1500000,
                $kriterias['C3']->id => 3,
                $kriterias['C4']->id => 4,
                $kriterias['C5']->id => 1,
            ],
        ];

        $response = $this->post(route('periode.seleksi.store', $periode), $payload);
        $response->assertRedirect(route('periode.seleksi', $periode));
        $response->assertSessionHas('sukses', "Data siswa Nama Siswa Terupdate berhasil diperbarui dan ranking SAW dihitung ulang.");

        $this->assertDatabaseHas('calon_penerimas', [
            'id' => $calon->id,
            'nama' => 'Nama Siswa Terupdate',
            'program_studi' => 'Desain Komunikasi Visual',
        ]);
    }

    public function test_candidate_destroy_shows_delete_notification(): void
    {
        $this->seed(SpkDemoSeeder::class);
        $periode = Periode::where('is_final', false)->first();
        $calon = $periode->calonPenerimas()->first();
        $nama = $calon->nama;

        $response = $this->delete(route('periode.seleksi.destroy', [$periode, $calon]));
        $response->assertRedirect();
        $response->assertSessionHas('sukses', "Data siswa {$nama} berhasil dihapus dari daftar seleksi.");

        $this->assertDatabaseMissing('calon_penerimas', [
            'id' => $calon->id,
        ]);
    }

    public function test_candidate_csv_import_and_template_download(): void
    {
        $this->seed(SpkDemoSeeder::class);
        $periode = Periode::where('is_final', false)->first();

        // 1. Template CSV
        $templateResponse = $this->get(route('periode.seleksi.template', $periode));
        $templateResponse->assertStatus(200);
        $templateResponse->assertHeader('content-type', 'text/csv; charset=UTF-8');

        // 2. Import CSV text
        $csvData = "NISN,Nama Siswa,Jurusan SMK,Kelas,C1_Rapor,C2_Gaji,C3_Tanggungan,C4_Ekskul,C5_Alpa\n"
                 . "0091112223,Siswa Baru Import,Teknik Otomotif,XII TKR 1,91.50,1800000,3,4,0\n"
                 . "0091112224,Siswa Kedua Import,Rekayasa Perangkat Lunak,XII RPL 2,88.00,2200000,2,3,1\n";

        $importResponse = $this->post(route('periode.seleksi.import', $periode), [
            'raw_csv' => $csvData,
        ]);

        $importResponse->assertRedirect(route('periode.seleksi', $periode));
        $importResponse->assertSessionHas('sukses', "Berhasil mengimpor 2 data siswa dan memperbarui perangkingan SAW.");

        $this->assertDatabaseHas('calon_penerimas', [
            'periode_id' => $periode->id,
            'nim' => '0091112223',
            'nama' => 'Siswa Baru Import',
        ]);
    }

    public function test_periode_update_saves_criteria_rentang_and_tipe_input(): void
    {
        $this->seed(SpkDemoSeeder::class);
        $periode = Periode::where('is_final', false)->first();

        $payload = [
            'nama' => $periode->nama . ' - Diperbarui',
            'tahun' => $periode->tahun,
            'kuota' => 6,
            'tanggal_mulai' => $periode->tanggal_mulai->format('Y-m-d'),
            'deadline' => $periode->deadline->format('Y-m-d'),
            'kriterias' => [
                [
                    'kode' => 'C1',
                    'nama' => 'Nilai Rapor Akademik Kejuruan',
                    'atribut' => 'benefit',
                    'tipe_input' => 'angka',
                    'rentang' => '0 – 100 Rata-rata Rapor Semester 1-5',
                ],
                [
                    'kode' => 'C2',
                    'nama' => 'Penghasilan Total Orang Tua',
                    'atribut' => 'cost',
                    'tipe_input' => 'angka',
                    'rentang' => 'Rp 0 s/d > Rp 10.000.000',
                ],
                [
                    'kode' => 'C3',
                    'nama' => 'Jumlah Anak Tanggungan',
                    'atribut' => 'benefit',
                    'tipe_input' => 'pilihan',
                    'rentang' => '1 s/d > 4 Orang Tanggungan',
                ],
                [
                    'kode' => 'C4',
                    'nama' => 'Menu Paket Ekstrakurikuler Kejuruan',
                    'atribut' => 'benefit',
                    'tipe_input' => 'pilihan',
                    'rentang' => 'Paket 1 s/d 5 (Pramuka, Komputer, Paskibra, Olahraga, PMR)',
                ],
                [
                    'kode' => 'C5',
                    'nama' => 'Kedisiplinan Kehadiran',
                    'atribut' => 'cost',
                    'tipe_input' => 'angka',
                    'rentang' => '0 Hari s/d > 5 Hari Alpa',
                ],
            ],
            'matrix' => $periode->matriks_ahp,
        ];

        $response = $this->put(route('periode.update', $periode), $payload);
        $response->assertRedirect(route('periode.index'));
        $response->assertSessionHas('sukses');

        $this->assertDatabaseHas('kriterias', [
            'periode_id' => $periode->id,
            'kode' => 'C1',
            'nama' => 'Nilai Rapor Akademik Kejuruan',
            'rentang' => '0 – 100 Rata-rata Rapor Semester 1-5',
        ]);
    }

    public function test_periode_destroy_deletes_periode_and_cascades(): void
    {
        $this->seed(SpkDemoSeeder::class);
        $periode = Periode::first();
        $this->assertNotNull($periode);

        $response = $this->delete(route('periode.destroy', $periode));
        $response->assertRedirect(route('periode.index'));
        $response->assertSessionHas('sukses');

        $this->assertDatabaseMissing('periodes', ['id' => $periode->id]);
    }

    public function test_expired_periode_can_be_deleted_by_admin(): void
    {
        $this->seed(SpkDemoSeeder::class);
        $expiredPeriode = Periode::where('deadline', '<', now())->first();
        if (! $expiredPeriode) {
            $expiredPeriode = Periode::create([
                'nama' => 'Periode Uji Expired',
                'tahun' => 2024,
                'kuota' => 5,
                'tanggal_mulai' => now()->subDays(60),
                'deadline' => now()->subDays(30),
            ]);
        }

        $this->assertTrue($expiredPeriode->isTerkunci());

        $response = $this->delete(route('periode.destroy', $expiredPeriode));
        $response->assertRedirect(route('periode.index'));
        $response->assertSessionHas('sukses');

        $this->assertDatabaseMissing('periodes', ['id' => $expiredPeriode->id]);
    }

    public function test_seleksi_destroy_deletes_student_and_recalculates(): void
    {
        $this->seed(SpkDemoSeeder::class);
        $periode = Periode::whereHas('calonPenerimas')->first();
        $this->assertNotNull($periode);

        $calon = $periode->calonPenerimas()->first();
        $this->assertNotNull($calon);

        $response = $this->delete(route('periode.seleksi.destroy', [$periode, $calon]));
        $response->assertRedirect();
        $response->assertSessionHas('sukses');

        $this->assertDatabaseMissing('calon_penerimas', ['id' => $calon->id]);
    }

    public function test_student_in_expired_periode_can_be_deleted_by_admin(): void
    {
        $this->seed(SpkDemoSeeder::class);
        $expiredPeriode = Periode::where('deadline', '<', now())->whereHas('calonPenerimas')->first();
        if (! $expiredPeriode) {
            $expiredPeriode = Periode::create([
                'nama' => 'Periode Uji Expired Calon',
                'tahun' => 2024,
                'kuota' => 5,
                'tanggal_mulai' => now()->subDays(60),
                'deadline' => now()->subDays(30),
            ]);
            $calon = $expiredPeriode->calonPenerimas()->create([
                'nim' => '0099999999',
                'nama' => 'Siswa Expired Test',
                'program_studi' => 'RPL',
                'semester' => 'XII',
            ]);
        } else {
            $calon = $expiredPeriode->calonPenerimas()->first();
        }

        $this->assertTrue($expiredPeriode->isTerkunci());

        $response = $this->delete(route('periode.seleksi.destroy', [$expiredPeriode, $calon]));
        $response->assertRedirect();
        $response->assertSessionHas('sukses');

        $this->assertDatabaseMissing('calon_penerimas', ['id' => $calon->id]);
    }
}
