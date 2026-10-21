<?php

namespace Tests\Feature;

use App\Models\KonfigurasiSeleksi;
use App\Models\Periode;
use Database\Seeders\SpkDemoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KonfigurasiSeleksiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SpkDemoSeeder::class);
    }

    public function test_konfigurasi_index_renders_successfully(): void
    {
        $response = $this->get(route('konfigurasi.index'));

        $response->assertOk();
        $response->assertSee('Manajemen Konfigurasi Seleksi');
        $response->assertSee('Buat Konfigurasi Baru');
    }

    public function test_konfigurasi_create_renders_successfully(): void
    {
        $response = $this->get(route('konfigurasi.create'));

        $response->assertOk();
        $response->assertSee('Buat Paket Konfigurasi Seleksi Baru');
        $response->assertSee('Informasi Konfigurasi');
        $response->assertSee('Pengaturan Lima Kriteria');
        $response->assertSee('Pembobotan AHP');
    }

    public function test_membuat_konfigurasi_dengan_lima_kriteria_dan_ahp_konsisten(): void
    {
        $payload = [
            'nama' => 'Paket Beasiswa Unggulan Vokasi 2026',
            'deskripsi' => 'Paket seleksi khusus siswa SMK berprestasi akademik dan kejuruan tinggi.',
            'kriterias' => [
                [
                    'kode' => 'C1',
                    'nama' => 'Nilai Rata-rata Rapor Kejuruan',
                    'atribut' => 'benefit',
                    'tipe_input' => 'angka',
                    'min_val' => 0,
                    'max_val' => 100,
                    'satuan' => 'Poin',
                    'rentang' => '0 - 100 Nilai Rapor',
                ],
                [
                    'kode' => 'C2',
                    'nama' => 'Penghasilan Orang Tua',
                    'atribut' => 'cost',
                    'tipe_input' => 'angka',
                    'min_val' => 0,
                    'max_val' => 15000000,
                    'satuan' => 'Rp',
                    'rentang' => 'Rp 0 s/d Rp 15.000.000',
                ],
                [
                    'kode' => 'C3',
                    'nama' => 'Jumlah Tanggungan Keluarga',
                    'atribut' => 'benefit',
                    'tipe_input' => 'angka',
                    'min_val' => 1,
                    'max_val' => 10,
                    'satuan' => 'Orang',
                    'rentang' => '1 s/d 10 Anak/Tanggungan',
                ],
                [
                    'kode' => 'C4',
                    'nama' => 'Kategori Prestasi / Sertifikasi',
                    'atribut' => 'benefit',
                    'tipe_input' => 'pilihan',
                    'rentang' => 'Tingkat Sekolah s/d Nasional',
                    'pilihan' => [
                        ['label' => 'Tingkat Sekolah / Lokal', 'nilai' => 1],
                        ['label' => 'Tingkat Kota / Kabupaten', 'nilai' => 2],
                        ['label' => 'Tingkat Provinsi', 'nilai' => 3],
                        ['label' => 'Tingkat Nasional / LKS', 'nilai' => 5],
                    ],
                ],
                [
                    'kode' => 'C5',
                    'nama' => 'Catatan Presensi & Disiplin',
                    'atribut' => 'cost',
                    'tipe_input' => 'angka',
                    'min_val' => 0,
                    'max_val' => 30,
                    'satuan' => 'Hari',
                    'rentang' => '0 s/d 30 Hari Alpa',
                ],
            ],
            'matrix' => [
                'C1' => ['C1' => 1, 'C2' => 3, 'C3' => 5, 'C4' => 4, 'C5' => 7],
                'C2' => ['C1' => 0.333, 'C2' => 1, 'C3' => 2, 'C4' => 2, 'C5' => 5],
                'C3' => ['C1' => 0.2, 'C2' => 0.5, 'C3' => 1, 'C4' => 0.5, 'C5' => 3],
                'C4' => ['C1' => 0.25, 'C2' => 0.5, 'C3' => 2, 'C4' => 1, 'C5' => 4],
                'C5' => ['C1' => 0.143, 'C2' => 0.2, 'C3' => 0.333, 'C4' => 0.25, 'C5' => 1],
            ],
        ];

        $response = $this->post(route('konfigurasi.store'), $payload);

        $response->assertRedirect(route('konfigurasi.index'));
        $response->assertSessionHas('sukses');

        $this->assertDatabaseHas('konfigurasi_seleksis', [
            'nama' => 'Paket Beasiswa Unggulan Vokasi 2026',
            'is_siap' => true,
            'is_konsisten' => true,
        ]);

        $konf = KonfigurasiSeleksi::where('nama', 'Paket Beasiswa Unggulan Vokasi 2026')->first();
        $this->assertNotNull($konf);
        $this->assertEquals(5, $konf->kriterias()->count());
        $this->assertLessThan(0.10, $konf->cr);

        // Kategori pilihan tersimpan
        $c4 = $konf->kriterias()->where('kode', 'C4')->first();
        $this->assertEquals(4, $c4->subKriterias()->count());
    }

    public function test_konfigurasi_dengan_cr_tidak_konsisten_tersimpan_sebagai_draf_tidak_siap(): void
    {
        // Matriks AHP yang sengaja sangat inkonsisten
        $inconsistentMatrix = [
            'C1' => ['C1' => 1, 'C2' => 9, 'C3' => 1, 'C4' => 9, 'C5' => 1],
            'C2' => ['C1' => 0.111, 'C2' => 1, 'C3' => 9, 'C4' => 1, 'C5' => 9],
            'C3' => ['C1' => 1, 'C2' => 0.111, 'C3' => 1, 'C4' => 9, 'C5' => 1],
            'C4' => ['C1' => 0.111, 'C2' => 1, 'C3' => 0.111, 'C4' => 1, 'C5' => 9],
            'C5' => ['C1' => 1, 'C2' => 0.111, 'C3' => 1, 'C4' => 0.111, 'C5' => 1],
        ];

        $payload = [
            'nama' => 'Paket AHP Inkonsisten',
            'deskripsi' => 'Pengujian konsistensi AHP',
            'kriterias' => [
                ['kode' => 'C1', 'nama' => 'K1', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C2', 'nama' => 'K2', 'atribut' => 'cost', 'tipe_input' => 'angka'],
                ['kode' => 'C3', 'nama' => 'K3', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C4', 'nama' => 'K4', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C5', 'nama' => 'K5', 'atribut' => 'cost', 'tipe_input' => 'angka'],
            ],
            'matrix' => $inconsistentMatrix,
        ];

        $response = $this->post(route('konfigurasi.store'), $payload);

        $response->assertRedirect(route('konfigurasi.index'));
        $konf = KonfigurasiSeleksi::where('nama', 'Paket AHP Inkonsisten')->first();
        $this->assertNotNull($konf);
        $this->assertFalse((bool) $konf->is_konsisten);
        $this->assertFalse((bool) $konf->is_siap);
        $this->assertGreaterThanOrEqual(0.10, $konf->cr);
    }

    public function test_konfigurasi_tidak_siap_atau_tidak_konsisten_ditolak_saat_buat_periode_baru(): void
    {
        $inconsistentKonf = KonfigurasiSeleksi::create([
            'nama' => 'Draf Inkonsisten Tidak Siap',
            'versi' => 1,
            'is_siap' => false,
            'is_konsisten' => false,
            'cr' => 0.35,
            'lambda_max' => 6.2,
            'ci' => 0.30,
        ]);

        $payload = [
            'nama' => 'TA 2026/2027 Gagal',
            'tahun' => '2026',
            'kuota' => 10,
            'tanggal_mulai' => '2026-09-01',
            'deadline' => '2026-10-01',
            'konfigurasi_seleksi_id' => $inconsistentKonf->id,
        ];

        $response = $this->post(route('periode.store'), $payload);

        $response->assertSessionHas('gagal');
        $this->assertDatabaseMissing('periodes', [
            'nama' => 'TA 2026/2027 Gagal',
        ]);
    }

    public function test_membuat_periode_dengan_memilih_satu_konfigurasi_valid_dan_snapshot_kriteria(): void
    {
        $konfValid = KonfigurasiSeleksi::where('is_siap', true)->where('is_konsisten', true)->first();
        $this->assertNotNull($konfValid);

        $payload = [
            'nama' => 'TA 2027/2028 - Beasiswa Prestasi Baru',
            'tahun' => '2027',
            'kuota' => 20,
            'tanggal_mulai' => '2027-01-10',
            'deadline' => '2027-03-31',
            'konfigurasi_seleksi_id' => $konfValid->id,
        ];

        $response = $this->post(route('periode.store'), $payload);

        $response->assertRedirect(route('periode.index'));
        $response->assertSessionHas('sukses');

        $periode = Periode::where('nama', 'TA 2027/2028 - Beasiswa Prestasi Baru')->first();
        $this->assertNotNull($periode);
        $this->assertEquals($konfValid->id, $periode->konfigurasi_seleksi_id);
        $this->assertEquals(5, $periode->kriterias()->count());
        $this->assertEquals($konfValid->cr, $periode->cr);

        // Snapshot kriteria independen
        foreach ($konfValid->kriterias as $masterKriteria) {
            $this->assertDatabaseHas('kriterias', [
                'periode_id' => $periode->id,
                'kode' => $masterKriteria->kode,
                'nama' => $masterKriteria->nama,
            ]);
        }
    }

    public function test_mengedit_konfigurasi_yang_sudah_digunakan_menghasilkan_versi_baru_dan_periode_lama_tetap_konsisten(): void
    {
        $konfLama = KonfigurasiSeleksi::where('is_siap', true)->first();
        $this->assertNotNull($konfLama);

        // Pastikan konfigurasi ini dipakai oleh minimal 1 periode
        $periodeLama = Periode::first();
        $periodeLama->update(['konfigurasi_seleksi_id' => $konfLama->id]);
        $kriteriaLamaNama = $periodeLama->kriterias()->first()->nama;

        $payloadUpdate = [
            'nama' => 'Paket Konfigurasi Diperbarui v2',
            'deskripsi' => 'Deskripsi versi 2 yang baru',
            'kriterias' => [
                [
                    'kode' => 'C1',
                    'nama' => 'Nilai Ujian Sekolah Khusus (Nama Berubah)',
                    'atribut' => 'benefit',
                    'tipe_input' => 'angka',
                    'min_val' => 0,
                    'max_val' => 100,
                    'satuan' => 'Poin',
                ],
                [
                    'kode' => 'C2',
                    'nama' => 'Penghasilan Orang Tua',
                    'atribut' => 'cost',
                    'tipe_input' => 'angka',
                    'min_val' => 0,
                    'max_val' => 10000000,
                    'satuan' => 'Rp',
                ],
                [
                    'kode' => 'C3',
                    'nama' => 'Jumlah Tanggungan',
                    'atribut' => 'benefit',
                    'tipe_input' => 'angka',
                    'min_val' => 1,
                    'max_val' => 10,
                ],
                [
                    'kode' => 'C4',
                    'nama' => 'Ekstrakurikuler Pilihan',
                    'atribut' => 'benefit',
                    'tipe_input' => 'pilihan',
                    'pilihan' => [
                        ['label' => 'Opsi A', 'nilai' => 1],
                        ['label' => 'Opsi B', 'nilai' => 3],
                    ],
                ],
                [
                    'kode' => 'C5',
                    'nama' => 'Kedisiplinan Presensi',
                    'atribut' => 'cost',
                    'tipe_input' => 'angka',
                    'min_val' => 0,
                    'max_val' => 10,
                ],
            ],
            'matrix' => $konfLama->matriks_ahp,
        ];

        $response = $this->put(route('konfigurasi.update', $konfLama), $payloadUpdate);

        $response->assertRedirect(route('konfigurasi.index'));
        $response->assertSessionHas('sukses');

        // Master lama tetap ada dengan versi awal
        $konfLamaSegar = KonfigurasiSeleksi::find($konfLama->id);
        $this->assertNotNull($konfLamaSegar);
        $this->assertEquals(1, $konfLamaSegar->versi);

        // Versi baru dibuat dengan parent_id menunjuk ke konfLama
        $versiBaru = KonfigurasiSeleksi::where('parent_id', $konfLama->id)->first();
        $this->assertNotNull($versiBaru);
        $this->assertEquals(2, $versiBaru->versi);
        $this->assertEquals('Paket Konfigurasi Diperbarui v2', $versiBaru->nama);

        // Periode lama tetap terhubung ke versi lama dan data kriterianya tidak berubah
        $periodeLamaSegar = Periode::find($periodeLama->id);
        $this->assertEquals($konfLama->id, $periodeLamaSegar->konfigurasi_seleksi_id);
        $this->assertEquals($kriteriaLamaNama, $periodeLamaSegar->kriterias()->first()->nama);
    }

    public function test_mengedit_konfigurasi_yang_belum_digunakan_memperbarui_secara_langsung(): void
    {
        $konfBaru = KonfigurasiSeleksi::create([
            'nama' => 'Konfigurasi Belum Digunakan',
            'versi' => 1,
            'is_siap' => true,
            'is_konsisten' => true,
            'cr' => 0.04,
            'lambda_max' => 5.16,
            'ci' => 0.04,
            'matriks_ahp' => [],
        ]);

        $payload = [
            'nama' => 'Nama Baru Diubah Langsung',
            'deskripsi' => 'Deskripsi edit in-place',
            'kriterias' => [
                ['kode' => 'C1', 'nama' => 'K1 Baru', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C2', 'nama' => 'K2 Baru', 'atribut' => 'cost', 'tipe_input' => 'angka'],
                ['kode' => 'C3', 'nama' => 'K3 Baru', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C4', 'nama' => 'K4 Baru', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C5', 'nama' => 'K5 Baru', 'atribut' => 'cost', 'tipe_input' => 'angka'],
            ],
            'matrix' => [
                'C1' => ['C1' => 1, 'C2' => 3, 'C3' => 5, 'C4' => 4, 'C5' => 7],
                'C2' => ['C1' => 0.333, 'C2' => 1, 'C3' => 2, 'C4' => 2, 'C5' => 5],
                'C3' => ['C1' => 0.2, 'C2' => 0.5, 'C3' => 1, 'C4' => 0.5, 'C5' => 3],
                'C4' => ['C1' => 0.25, 'C2' => 0.5, 'C3' => 2, 'C4' => 1, 'C5' => 4],
                'C5' => ['C1' => 0.143, 'C2' => 0.2, 'C3' => 0.333, 'C4' => 0.25, 'C5' => 1],
            ],
        ];

        $response = $this->put(route('konfigurasi.update', $konfBaru), $payload);

        $response->assertRedirect(route('konfigurasi.index'));
        $konfBaru->refresh();
        $this->assertEquals('Nama Baru Diubah Langsung', $konfBaru->nama);
        $this->assertEquals(1, $konfBaru->versi);
    }

    public function test_konfigurasi_yang_masih_digunakan_periode_tidak_dapat_dihapus(): void
    {
        $konf = KonfigurasiSeleksi::where('is_siap', true)->first();
        $this->assertNotNull($konf);

        $periode = Periode::first();
        $periode->update(['konfigurasi_seleksi_id' => $konf->id]);

        $response = $this->delete(route('konfigurasi.destroy', $konf));

        $response->assertRedirect(route('konfigurasi.index'));
        $response->assertSessionHas('gagal');
        $this->assertDatabaseHas('konfigurasi_seleksis', [
            'id' => $konf->id,
        ]);
    }

    public function test_konfigurasi_yang_tidak_digunakan_dapat_dihapus(): void
    {
        $konfKosong = KonfigurasiSeleksi::create([
            'nama' => 'Konfigurasi Bebas Hapus',
            'versi' => 1,
            'is_siap' => false,
            'is_konsisten' => false,
            'cr' => 0.05,
            'lambda_max' => 5.1,
            'ci' => 0.02,
        ]);

        $response = $this->delete(route('konfigurasi.destroy', $konfKosong));

        $response->assertRedirect(route('konfigurasi.index'));
        $response->assertSessionHas('sukses');
        $this->assertDatabaseMissing('konfigurasi_seleksis', [
            'id' => $konfKosong->id,
        ]);
    }

    public function test_duplikat_konfigurasi_berhasil_membuat_draf_baru(): void
    {
        $konf = KonfigurasiSeleksi::where('is_siap', true)->first();
        $this->assertNotNull($konf);

        $response = $this->post(route('konfigurasi.duplikat', $konf));

        $response->assertRedirect();
        $response->assertSessionHas('sukses');

        $this->assertDatabaseHas('konfigurasi_seleksis', [
            'nama' => 'Salinan '.$konf->nama,
            'versi' => 1,
        ]);
    }

    public function test_hitung_ahp_ajax_endpoint_mengembalikan_json_valid(): void
    {
        $payload = [
            'kriterias' => ['C1', 'C2', 'C3', 'C4', 'C5'],
            'matrix' => [
                'C1' => ['C1' => 1, 'C2' => 3, 'C3' => 5, 'C4' => 4, 'C5' => 7],
                'C2' => ['C1' => 0.333, 'C2' => 1, 'C3' => 2, 'C4' => 2, 'C5' => 5],
                'C3' => ['C1' => 0.2, 'C2' => 0.5, 'C3' => 1, 'C4' => 0.5, 'C5' => 3],
                'C4' => ['C1' => 0.25, 'C2' => 0.5, 'C3' => 2, 'C4' => 1, 'C5' => 4],
                'C5' => ['C1' => 0.143, 'C2' => 0.2, 'C3' => 0.333, 'C4' => 0.25, 'C5' => 1],
            ],
        ];

        $response = $this->postJson(route('konfigurasi.hitung-ahp'), $payload);

        $response->assertOk();
        $response->assertJsonStructure([
            'weights',
            'lambda_max',
            'ci',
            'cr',
            'is_consistent',
            'column_sums',
        ]);
        $response->assertJson([
            'is_consistent' => true,
        ]);
    }

    public function test_dashboard_tetap_berfungsi_dan_tidak_berubah(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Sistem Pendukung Keputusan');
        $response->assertSee('Distribusi Kriteria & Top Skor SAW');
    }

    public function test_tampilan_vektor_prioritas_bobot_saw_dua_desimal_dan_persen_bulat(): void
    {
        $konf = KonfigurasiSeleksi::where('is_siap', true)->first();
        $this->assertNotNull($konf);

        // 1. Create page
        $createRes = $this->get(route('konfigurasi.create'));
        $createRes->assertOk();
        $createRes->assertSee('Total = 1.00 (100%)');
        $createRes->assertSee('0.40 (40%)');
        $createRes->assertSee('0.24 (24%)');
        $createRes->assertSee('0.16 (16%)');
        $createRes->assertSee('0.11 (11%)');
        $createRes->assertSee('0.09 (9%)');
        $createRes->assertDontSee('0.397 &bull; 39.7%');
        $createRes->assertSee('Random Index (RI n=5)');
        $createRes->assertSee('Principal Eigenvalue');

        // 2. Show page
        $showRes = $this->get(route('konfigurasi.show', $konf));
        $showRes->assertOk();
        $showRes->assertSee('Total = 1.00 (100%)');
        $showRes->assertSee('0.40 (40%)');
        $showRes->assertSee('0.24 (24%)');
        $showRes->assertSee('0.16 (16%)');
        $showRes->assertSee('0.11 (11%)');
        $showRes->assertSee('0.09 (9%)');
        $showRes->assertDontSee('0.397 &bull; 39.7%');
        $showRes->assertSee('Random Index (RI n=5)');
        $showRes->assertSee('Consistency Ratio (CR)');

        // 3. Edit page
        $editRes = $this->get(route('konfigurasi.edit', $konf));
        $editRes->assertOk();
        $editRes->assertSee('Total = 1.00 (100%)');
        $editRes->assertSee('0.40 (40%)');
        $editRes->assertSee('0.24 (24%)');
        $editRes->assertSee('0.16 (16%)');
        $editRes->assertSee('0.11 (11%)');
        $editRes->assertSee('0.09 (9%)');
        $editRes->assertDontSee('0.397 &bull; 39.7%');
        $editRes->assertSee('Random Index (RI n=5)');
        $editRes->assertSee('Consistency Ratio (CR)');
    }

    public function test_mengedit_konfigurasi_yang_belum_digunakan_mempertahankan_id_dan_jumlah_data(): void
    {
        $konf = KonfigurasiSeleksi::create([
            'nama' => 'Konfigurasi Belum Dipakai Testing',
            'versi' => 1,
            'is_siap' => true,
            'is_konsisten' => true,
            'cr' => 0.04,
            'lambda_max' => 5.16,
            'ci' => 0.04,
            'matriks_ahp' => [],
        ]);

        $initialId = $konf->id;
        $totalBefore = KonfigurasiSeleksi::count();

        $payload = [
            'nama' => 'Nama Baru Diperbarui In-Place',
            'deskripsi' => 'Deskripsi baru in-place',
            'kriterias' => [
                ['kode' => 'C1', 'nama' => 'K1 Baru', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C2', 'nama' => 'K2 Baru', 'atribut' => 'cost', 'tipe_input' => 'angka'],
                ['kode' => 'C3', 'nama' => 'K3 Baru', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C4', 'nama' => 'K4 Baru', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C5', 'nama' => 'K5 Baru', 'atribut' => 'cost', 'tipe_input' => 'angka'],
            ],
            'matrix' => [
                'C1' => ['C1' => 1, 'C2' => 3, 'C3' => 5, 'C4' => 4, 'C5' => 7],
                'C2' => ['C1' => 0.333, 'C2' => 1, 'C3' => 2, 'C4' => 2, 'C5' => 5],
                'C3' => ['C1' => 0.2, 'C2' => 0.5, 'C3' => 1, 'C4' => 0.5, 'C5' => 3],
                'C4' => ['C1' => 0.25, 'C2' => 0.5, 'C3' => 2, 'C4' => 1, 'C5' => 4],
                'C5' => ['C1' => 0.143, 'C2' => 0.2, 'C3' => 0.333, 'C4' => 0.25, 'C5' => 1],
            ],
        ];

        $response = $this->put(route('konfigurasi.update', $konf), $payload);

        $response->assertRedirect(route('konfigurasi.index'));
        $response->assertSessionHas('sukses');

        $this->assertEquals($totalBefore, KonfigurasiSeleksi::count(), 'Jumlah konfigurasi tidak boleh bertambah saat mengedit konfigurasi yang belum digunakan.');

        $konf->refresh();
        $this->assertEquals($initialId, $konf->id);
        $this->assertEquals('Nama Baru Diperbarui In-Place', $konf->nama);
        $this->assertEquals(1, $konf->versi);
        $this->assertNull($konf->parent_id);
    }

    public function test_mengedit_konfigurasi_terpakai_menghasilkan_versi_berikutnya_secara_berurutan_tanpa_duplikasi_nomor_versi(): void
    {
        $konfMaster = KonfigurasiSeleksi::where('is_siap', true)->first();
        $periode = Periode::first();
        $periode->update(['konfigurasi_seleksi_id' => $konfMaster->id]);

        $payload = [
            'nama' => 'Konfigurasi Revisi v2',
            'deskripsi' => 'Revisi pertama',
            'kriterias' => [
                ['kode' => 'C1', 'nama' => 'K1 Rev', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C2', 'nama' => 'K2 Rev', 'atribut' => 'cost', 'tipe_input' => 'angka'],
                ['kode' => 'C3', 'nama' => 'K3 Rev', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C4', 'nama' => 'K4 Rev', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C5', 'nama' => 'K5 Rev', 'atribut' => 'cost', 'tipe_input' => 'angka'],
            ],
            'matrix' => $konfMaster->matriks_ahp,
        ];

        // 1. Edit pertama dari konfMaster -> Buat v2
        $response1 = $this->put(route('konfigurasi.update', $konfMaster), $payload);
        $response1->assertRedirect(route('konfigurasi.index'));

        $v2 = KonfigurasiSeleksi::where('parent_id', $konfMaster->id)->where('versi', 2)->first();
        $this->assertNotNull($v2);
        $this->assertEquals('Konfigurasi Revisi v2', $v2->nama);
        $this->assertEquals(2, $v2->versi);

        // 2. Edit kedua dari konfMaster yang sama -> Harus menghasilkan v3, BUKAN v2 lagi
        $payload['nama'] = 'Konfigurasi Revisi v3 dari Master';
        $response2 = $this->put(route('konfigurasi.update', $konfMaster), $payload);
        $response2->assertRedirect(route('konfigurasi.index'));

        $v3 = KonfigurasiSeleksi::where('parent_id', $konfMaster->id)->where('versi', 3)->first();
        $this->assertNotNull($v3, 'Versi berikutnya harus 3 untuk mencegah duplikasi nomor versi dalam satu silsilah.');
        $this->assertEquals(3, $v3->versi);

        // Master awal tetap versi 1 dan tetap terhubung ke periode
        $konfMaster->refresh();
        $this->assertEquals(1, $konfMaster->versi);
        $this->assertEquals($konfMaster->id, $periode->refresh()->konfigurasi_seleksi_id);
    }

    public function test_tombol_edit_tidak_berperilaku_seperti_tombol_duplikasi(): void
    {
        $konf = KonfigurasiSeleksi::create([
            'nama' => 'Konfigurasi Asli Tanpa Duplikat',
            'versi' => 1,
            'is_siap' => true,
            'is_konsisten' => true,
            'cr' => 0.04,
            'lambda_max' => 5.16,
            'ci' => 0.04,
            'matriks_ahp' => [],
        ]);

        $payloadEdit = [
            'nama' => 'Konfigurasi Diedit Bukan Diduplikasi',
            'deskripsi' => 'Edit via PUT',
            'kriterias' => [
                ['kode' => 'C1', 'nama' => 'K1', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C2', 'nama' => 'K2', 'atribut' => 'cost', 'tipe_input' => 'angka'],
                ['kode' => 'C3', 'nama' => 'K3', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C4', 'nama' => 'K4', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C5', 'nama' => 'K5', 'atribut' => 'cost', 'tipe_input' => 'angka'],
            ],
            'matrix' => [
                'C1' => ['C1' => 1, 'C2' => 3, 'C3' => 5, 'C4' => 4, 'C5' => 7],
                'C2' => ['C1' => 0.333, 'C2' => 1, 'C3' => 2, 'C4' => 2, 'C5' => 5],
                'C3' => ['C1' => 0.2, 'C2' => 0.5, 'C3' => 1, 'C4' => 0.5, 'C5' => 3],
                'C4' => ['C1' => 0.25, 'C2' => 0.5, 'C3' => 2, 'C4' => 1, 'C5' => 4],
                'C5' => ['C1' => 0.143, 'C2' => 0.2, 'C3' => 0.333, 'C4' => 0.25, 'C5' => 1],
            ],
        ];

        // Edit melalui PUT: memperbarui in-place tanpa prefix 'Salinan '
        $this->put(route('konfigurasi.update', $konf), $payloadEdit);

        $konf->refresh();
        $this->assertEquals('Konfigurasi Diedit Bukan Diduplikasi', $konf->nama);
        $this->assertStringNotContainsString('Salinan ', $konf->nama);

        // Aksi duplikasi melalui POST duplikat: sengaja membuat baris baru dengan prefix 'Salinan '
        $countBeforeDup = KonfigurasiSeleksi::count();
        $dupRes = $this->post(route('konfigurasi.duplikat', $konf));
        $dupRes->assertRedirect();

        $this->assertEquals($countBeforeDup + 1, KonfigurasiSeleksi::count());
        $this->assertDatabaseHas('konfigurasi_seleksis', [
            'nama' => 'Salinan Konfigurasi Diedit Bukan Diduplikasi',
            'versi' => 1,
            'parent_id' => null,
        ]);
    }

    public function test_snapshot_konfigurasi_periode_lama_tidak_berubah_saat_konfigurasi_diedit(): void
    {
        $konf = KonfigurasiSeleksi::where('is_siap', true)->first();
        $periode = Periode::first();
        $periode->update([
            'konfigurasi_seleksi_id' => $konf->id,
            'lambda_max' => 5.202,
            'ci' => 0.051,
            'cr' => 0.045,
        ]);

        $periodeKriteriasCount = $periode->kriterias()->count();
        $periodeFirstKriteriaNama = $periode->kriterias()->first()->nama;
        $periodeCrAwal = $periode->cr;
        $periodeMatrixAwal = $periode->matriks_ahp;

        // Edit konfigurasi yang digunakan
        $payload = [
            'nama' => 'Nama Konfigurasi Baru Berubah',
            'deskripsi' => 'Deskripsi baru',
            'kriterias' => [
                ['kode' => 'C1', 'nama' => 'Nama Kriteria 1 Baru Berubah Total', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C2', 'nama' => 'Nama Kriteria 2 Baru', 'atribut' => 'cost', 'tipe_input' => 'angka'],
                ['kode' => 'C3', 'nama' => 'Nama Kriteria 3 Baru', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C4', 'nama' => 'Nama Kriteria 4 Baru', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C5', 'nama' => 'Nama Kriteria 5 Baru', 'atribut' => 'cost', 'tipe_input' => 'angka'],
            ],
            'matrix' => $konf->matriks_ahp,
        ];

        $this->put(route('konfigurasi.update', $konf), $payload);

        // Snapshot pada tabel periodes dan kriterias periode tidak boleh berubah sedikitpun
        $periode->refresh();
        $this->assertEquals($konf->id, $periode->konfigurasi_seleksi_id);
        $this->assertEquals($periodeCrAwal, $periode->cr);
        $this->assertEquals($periodeMatrixAwal, $periode->matriks_ahp);
        $this->assertEquals($periodeKriteriasCount, $periode->kriterias()->count());
        $this->assertEquals($periodeFirstKriteriaNama, $periode->kriterias()->first()->nama);
    }

    public function test_nama_nomor_versi_status_penggunaan_dan_relasi_ditampilkan_konsisten_pada_index(): void
    {
        $konfMaster = KonfigurasiSeleksi::where('is_siap', true)->first();
        $periode = Periode::first();
        $periode->update(['konfigurasi_seleksi_id' => $konfMaster->id]);

        $payload = [
            'nama' => 'Standar Seleksi Beasiswa Prestasi SMK v2',
            'deskripsi' => 'Versi 2 revisi',
            'kriterias' => [
                ['kode' => 'C1', 'nama' => 'K1 Rev', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C2', 'nama' => 'K2 Rev', 'atribut' => 'cost', 'tipe_input' => 'angka'],
                ['kode' => 'C3', 'nama' => 'K3 Rev', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C4', 'nama' => 'K4 Rev', 'atribut' => 'benefit', 'tipe_input' => 'angka'],
                ['kode' => 'C5', 'nama' => 'K5 Rev', 'atribut' => 'cost', 'tipe_input' => 'angka'],
            ],
            'matrix' => $konfMaster->matriks_ahp,
        ];

        $this->put(route('konfigurasi.update', $konfMaster), $payload);

        $v2 = KonfigurasiSeleksi::where('nama', 'Standar Seleksi Beasiswa Prestasi SMK v2')->first();
        $this->assertNotNull($v2);

        $indexRes = $this->get(route('konfigurasi.index'));
        $indexRes->assertOk();

        // 1. Konfigurasi lama: v1, dipakai oleh periode
        $indexRes->assertSee($konfMaster->nama);
        $indexRes->assertSee('v'.$konfMaster->versi);
        $indexRes->assertSee($konfMaster->periodes()->count().' Periode');

        // 2. Konfigurasi baru: v2, revisi dari parent, belum digunakan
        $indexRes->assertSee('Standar Seleksi Beasiswa Prestasi SMK v2');
        $indexRes->assertSee('v'.$v2->versi);
        $indexRes->assertSee('(Revisi dari #'.$konfMaster->id.')');
        $indexRes->assertSee('Belum Digunakan');
    }
}
