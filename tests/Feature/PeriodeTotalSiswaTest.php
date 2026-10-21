<?php

namespace Tests\Feature;

use App\Models\CalonPenerima;
use App\Models\KonfigurasiSeleksi;
use App\Models\Periode;
use Database\Seeders\SpkDemoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PeriodeTotalSiswaTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Memastikan pembuatan periode baru dapat menyimpan total_siswa secara terpisah dari kuota.
     */
    public function test_pembuatan_periode_menyimpan_total_siswa_dan_kuota_secara_terpisah(): void
    {
        $this->seed(SpkDemoSeeder::class);

        $konfigurasi = KonfigurasiSeleksi::where('is_siap', true)->first();
        $this->assertNotNull($konfigurasi);

        $postData = [
            'nama' => 'Seleksi Prestasi SMK 2026/2027',
            'tahun' => '2026',
            'kuota' => 15,
            'total_siswa' => 300,
            'tanggal_mulai' => now()->format('Y-m-d'),
            'deadline' => now()->addDays(30)->format('Y-m-d'),
            'konfigurasi_seleksi_id' => $konfigurasi->id,
        ];

        $response = $this->post(route('periode.store'), $postData);
        $response->assertRedirect(route('periode.index'));

        $this->assertDatabaseHas('periodes', [
            'nama' => 'Seleksi Prestasi SMK 2026/2027',
            'kuota' => 15,
            'total_siswa' => 300,
        ]);

        $periode = Periode::where('nama', 'Seleksi Prestasi SMK 2026/2027')->first();
        $this->assertEquals(15, $periode->kuota);
        $this->assertEquals(300, $periode->total_siswa);
    }

    /**
     * Memastikan pengeditan periode mempertahankan dan memperbarui total_siswa.
     */
    public function test_pengeditan_periode_memperbarui_total_siswa(): void
    {
        $this->seed(SpkDemoSeeder::class);

        $periode = Periode::first();
        $this->assertNotNull($periode);

        $updateData = [
            'nama' => $periode->nama.' Diperbarui',
            'tahun' => $periode->tahun,
            'kuota' => 20,
            'total_siswa' => 450,
            'tanggal_mulai' => $periode->tanggal_mulai->format('Y-m-d'),
            'deadline' => $periode->deadline->format('Y-m-d'),
        ];

        $response = $this->put(route('periode.update', $periode), $updateData);
        $response->assertRedirect();

        $periode->refresh();
        $this->assertEquals(20, $periode->kuota);
        $this->assertEquals(450, $periode->total_siswa);
    }

    /**
     * Memastikan ringkasan pendaftar masuk menampilkan progres 180 / 300 Siswa Terdaftar (60%).
     */
    public function test_ringkasan_pendaftar_dan_persentase_sesuai_target(): void
    {
        $periode = Periode::create([
            'nama' => 'Periode Uji Coba 60 Persen',
            'tahun' => '2026',
            'kuota' => 15,
            'total_siswa' => 300,
            'tanggal_mulai' => now()->subDays(5),
            'deadline' => now()->addDays(25),
            'is_final' => false,
        ]);

        // Buat 180 calon siswa terdaftar
        for ($i = 1; $i <= 180; $i++) {
            CalonPenerima::create([
                'periode_id' => $periode->id,
                'nama' => "Siswa Uji {$i}",
                'nim' => sprintf('00781%05d', $i),
                'program_studi' => 'Rekayasa Perangkat Lunak',
                'semester' => 'Kelas XII',
            ]);
        }

        $this->assertEquals('180 / 300 Siswa Terdaftar', $periode->ringkasan_pendaftar_text);
        $this->assertEquals('60% dari Target Pendaftaran', $periode->ringkasan_target_text);
        $this->assertEquals(60.0, $periode->persentase_pendaftaran);

        $response = $this->get(route('periode.index'));
        $response->assertOk();
        $response->assertSee('180 / 300 Siswa Terdaftar');
        $response->assertSee('60% dari Target Pendaftaran');
        $response->assertSee('15 Siswa Penerima');
        $response->assertDontSee('Kursi Penerima');
        $response->assertDontSee('Alokasi DIPA Universitas');
    }

    /**
     * Memastikan kondisi 0 siswa terdaftar: menampilkan 0 / 300 Siswa Terdaftar dan 0% dari Target Pendaftaran.
     */
    public function test_kondisi_nol_pendaftar_menampilkan_nol_persen_dari_target(): void
    {
        $periode = Periode::create([
            'nama' => 'Periode Nol Pendaftar',
            'tahun' => '2026',
            'kuota' => 10,
            'total_siswa' => 300,
            'tanggal_mulai' => now()->subDays(2),
            'deadline' => now()->addDays(20),
            'is_final' => false,
        ]);

        $this->assertEquals('0 / 300 Siswa Terdaftar', $periode->ringkasan_pendaftar_text);
        $this->assertEquals('0% dari Target Pendaftaran', $periode->ringkasan_target_text);
        $this->assertEquals(0.0, $periode->persentase_pendaftaran);
    }

    /**
     * Memastikan jika total_siswa belum ditetapkan (0), tidak terjadi pembagian nol dan teks informatif ditampilkan.
     */
    public function test_kondisi_target_belum_ditetapkan_tidak_terjadi_pembagian_nol(): void
    {
        $periode = Periode::create([
            'nama' => 'Periode Tanpa Target',
            'tahun' => '2026',
            'kuota' => 10,
            'total_siswa' => 0,
            'tanggal_mulai' => now()->subDays(2),
            'deadline' => now()->addDays(20),
            'is_final' => false,
        ]);

        CalonPenerima::create([
            'periode_id' => $periode->id,
            'nama' => 'Siswa Mandiri',
            'nim' => '0078129999',
            'program_studi' => 'Teknik Komputer Jaringan',
            'semester' => 'Kelas XII',
        ]);

        $this->assertNull($periode->persentase_pendaftaran);
        $this->assertEquals('1 Siswa Terdaftar', $periode->ringkasan_pendaftar_text);
        $this->assertEquals('Target Belum Ditetapkan', $periode->ringkasan_target_text);
    }

    /**
     * Memastikan jika pendaftar melebihi target (contoh: 350 dari target 300), persentase tidak dibatasi diam-diam.
     */
    public function test_kondisi_pendaftar_melebihi_target_menampilkan_persentase_aktual(): void
    {
        $periode = Periode::create([
            'nama' => 'Periode Pendaftar Melimpah',
            'tahun' => '2026',
            'kuota' => 20,
            'total_siswa' => 300,
            'tanggal_mulai' => now()->subDays(10),
            'deadline' => now()->addDays(15),
            'is_final' => false,
        ]);

        for ($i = 1; $i <= 350; $i++) {
            CalonPenerima::create([
                'periode_id' => $periode->id,
                'nama' => "Siswa {$i}",
                'nim' => sprintf('00782%05d', $i),
                'program_studi' => 'RPL',
                'semester' => 'Kelas XII',
            ]);
        }

        $this->assertEquals('350 / 300 Siswa Terdaftar', $periode->ringkasan_pendaftar_text);
        $this->assertEquals('116.7% dari Target Pendaftaran', $periode->ringkasan_target_text);
        $this->assertEquals(116.7, $periode->persentase_pendaftaran);
    }

    /**
     * Memastikan sisa waktu pendaftaran dihitung sesuai tanggal sebenarnya.
     */
    public function test_sisa_waktu_pendaftaran_dihitung_secara_akurat(): void
    {
        // 1. Periode aktif tersisa 18 hari
        $periode = Periode::create([
            'nama' => 'Periode Aktif 18 Hari',
            'tahun' => '2026',
            'kuota' => 15,
            'total_siswa' => 300,
            'tanggal_mulai' => now()->subDays(10),
            'deadline' => now()->addDays(18),
            'is_final' => false,
        ]);

        $this->assertStringContainsString('18 Hari Tersisa', $periode->sisa_waktu_text);

        // 2. Periode telah ditutup (deadline lewat)
        $periodeTutup = Periode::create([
            'nama' => 'Periode Ditutup',
            'tahun' => '2025',
            'kuota' => 10,
            'total_siswa' => 200,
            'tanggal_mulai' => now()->subDays(40),
            'deadline' => now()->subDays(5),
            'is_final' => false,
        ]);

        $this->assertEquals('Pendaftaran Telah Ditutup', $periodeTutup->sisa_waktu_text);

        // 3. Periode belum dimulai
        $periodeMendatang = Periode::create([
            'nama' => 'Periode Mendatang',
            'tahun' => '2027',
            'kuota' => 20,
            'total_siswa' => 350,
            'tanggal_mulai' => now()->addDays(7),
            'deadline' => now()->addDays(37),
            'is_final' => false,
        ]);

        $this->assertEquals('Dibuka dalam 7 Hari', $periodeMendatang->sisa_waktu_text);
    }
}
