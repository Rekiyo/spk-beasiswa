<?php

namespace Tests\Feature;

use App\Models\CalonPenerima;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Periode;
use App\Services\SawService;
use Database\Seeders\SpkDemoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardPeriodeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(SpkDemoSeeder::class);
    }

    /**
     * Prioritas 1: Dashboard secara otomatis memilih periode aktif yang sedang berlangsung.
     */
    public function test_prioritas_1_dashboard_memilih_periode_aktif_yang_sedang_berlangsung(): void
    {
        // Bersihkan periode demo agar kita bisa membuat skenario terkontrol
        Periode::query()->delete();

        // Periode Selesai di masa lalu
        $pSelesai = Periode::create([
            'nama' => 'TA 2025/2026 Genap - Selesai',
            'tahun' => 2025,
            'kuota' => 10,
            'tanggal_mulai' => now()->subMonths(6)->toDateString(),
            'deadline' => now()->subMonths(2)->toDateString(),
            'is_final' => true,
        ]);

        // Periode Aktif sedang berlangsung (hari ini di antara tanggal_mulai dan deadline)
        $pAktif = Periode::create([
            'nama' => 'TA 2026/2027 Ganjil - Sedang Berlangsung',
            'tahun' => 2026,
            'kuota' => 15,
            'tanggal_mulai' => now()->subDays(10)->toDateString(),
            'deadline' => now()->addDays(20)->toDateString(),
            'is_final' => false,
        ]);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('TA 2026/2027 Ganjil - Sedang Berlangsung');
        $response->assertSee('value="'.$pAktif->id.'" selected', false);
    }

    /**
     * Prioritas 1 Tiebreaker: Jika ada beberapa periode aktif sedang berlangsung,
     * pilih periode dengan tanggal_mulai paling baru.
     */
    public function test_prioritas_1_tiebreaker_jika_ada_beberapa_periode_berlangsung_pilih_tanggal_mulai_terbaru(): void
    {
        Periode::query()->delete();

        // Periode Aktif A: mulai 20 hari lalu
        $pAktifA = Periode::create([
            'nama' => 'Periode Aktif Awal',
            'tahun' => 2026,
            'kuota' => 5,
            'tanggal_mulai' => now()->subDays(20)->toDateString(),
            'deadline' => now()->addDays(15)->toDateString(),
            'is_final' => false,
        ]);

        // Periode Aktif B: mulai 5 hari lalu (lebih baru)
        $pAktifB = Periode::create([
            'nama' => 'Periode Aktif Terbaru',
            'tahun' => 2026,
            'kuota' => 8,
            'tanggal_mulai' => now()->subDays(5)->toDateString(),
            'deadline' => now()->addDays(25)->toDateString(),
            'is_final' => false,
        ]);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Periode Aktif Terbaru');
        $response->assertSee('value="'.$pAktifB->id.'" selected', false);
    }

    /**
     * Prioritas 2: Jika tidak ada periode yang sedang berlangsung,
     * pilih periode aktif mendatang yang tanggal mulainya paling dekat di masa mendatang.
     * Tidak boleh memilih periode yang sudah berakhir jika masih ada periode aktif mendatang.
     */
    public function test_prioritas_2_pilih_periode_aktif_mendatang_terdekat_bukan_periode_selesai(): void
    {
        Periode::query()->delete();

        // Periode Selesai di masa lalu
        $pSelesai = Periode::create([
            'nama' => 'Periode Lalu Selesai',
            'tahun' => 2025,
            'kuota' => 5,
            'tanggal_mulai' => now()->subMonths(4)->toDateString(),
            'deadline' => now()->subMonths(1)->toDateString(),
            'is_final' => true,
        ]);

        // Periode Mendatang 1: mulai 3 hari lagi (paling dekat)
        $pMendatang1 = Periode::create([
            'nama' => 'Periode Mendatang Terdekat',
            'tahun' => 2027,
            'kuota' => 12,
            'tanggal_mulai' => now()->addDays(3)->toDateString(),
            'deadline' => now()->addDays(40)->toDateString(),
            'is_final' => false,
        ]);

        // Periode Mendatang 2: mulai 30 hari lagi (lebih jauh)
        $pMendatang2 = Periode::create([
            'nama' => 'Periode Mendatang Jauh',
            'tahun' => 2027,
            'kuota' => 20,
            'tanggal_mulai' => now()->addDays(30)->toDateString(),
            'deadline' => now()->addDays(70)->toDateString(),
            'is_final' => false,
        ]);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        // Harus memilih Periode Mendatang Terdekat, bukan periode selesai maupun yang lebih jauh
        $response->assertSee('Periode Mendatang Terdekat');
        $response->assertSee('value="'.$pMendatang1->id.'" selected', false);
    }

    /**
     * Prioritas 3: Jika tidak ada periode aktif berlangsung maupun mendatang,
     * tampilkan periode terakhir yang selesai berdasarkan tanggal selesai/mulai terbaru.
     */
    public function test_prioritas_3_jika_semua_selesai_pilih_periode_terakhir_berakhir(): void
    {
        Periode::query()->delete();

        // Periode Selesai Lama: selesai 6 bulan lalu
        $pLama = Periode::create([
            'nama' => 'Periode Selesai Tahun Lalu',
            'tahun' => 2024,
            'kuota' => 5,
            'tanggal_mulai' => now()->subMonths(10)->toDateString(),
            'deadline' => now()->subMonths(6)->toDateString(),
            'is_final' => true,
        ]);

        // Periode Selesai Baru: selesai 1 bulan lalu
        $pBaru = Periode::create([
            'nama' => 'Periode Selesai Baru Saja',
            'tahun' => 2025,
            'kuota' => 10,
            'tanggal_mulai' => now()->subMonths(4)->toDateString(),
            'deadline' => now()->subMonths(1)->toDateString(),
            'is_final' => true,
        ]);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Periode Selesai Baru Saja');
        $response->assertSee('value="'.$pBaru->id.'" selected', false);
    }

    /**
     * Prioritas 4: Jika database kosong tanpa periode,
     * dashboard menampilkan keadaan kosong yang informatif tanpa error atau angka palsu.
     */
    public function test_prioritas_4_keadaan_kosong_informatif_saat_tidak_ada_periode(): void
    {
        Periode::query()->delete();

        $response = $this->get(route('dashboard'));

        $response->assertOk();
        $response->assertSee('Belum Ada Periode Dibuat');
        $response->assertSee('Belum Ada Periode Seleksi');
        $response->assertSee('0 Siswa');
        $response->assertSee('Siswa Penerima');
        $response->assertSee('1:0');
        $response->assertSee('0% Terinput');
        // Tidak menampilkan dummy nama calon siswa
        $response->assertDontSee('Rizky Pratama Saputra');
    }

    /**
     * Fitur Pemilih Periode: Dropdown dapat mengganti periode yang ditampilkan via query parameter.
     */
    public function test_dropdown_dapat_mengganti_periode_yang_ditampilkan(): void
    {
        $periodes = Periode::orderBy('id')->get();
        $this->assertGreaterThanOrEqual(2, $periodes->count());

        $p1 = $periodes[0];
        $p2 = $periodes[1];

        // Pilih Periode 2 secara eksplisit
        $response = $this->get(route('dashboard', ['periode_id' => $p2->id]));

        $response->assertOk();
        $response->assertSee($p2->nama);
        $response->assertSee('value="'.$p2->id.'" selected', false);

        // Pilih Periode 1 secara eksplisit
        $response2 = $this->get(route('dashboard', ['periode_id' => $p1->id]));

        $response2->assertOk();
        $response2->assertSee($p1->nama);
        $response2->assertSee('value="'.$p1->id.'" selected', false);
    }

    /**
     * Fallback: Jika periode_id tidak valid atau tidak ditemukan di database,
     * gunakan periode default prioritas.
     */
    public function test_fallback_periode_default_saat_id_tidak_valid(): void
    {
        $response = $this->get(route('dashboard', ['periode_id' => 999999]));

        $response->assertOk();
        $defaultPeriode = Periode::determineDashboardDefault();
        $this->assertNotNull($defaultPeriode);
        $response->assertSee($defaultPeriode->nama);
    }

    /**
     * Sinkronisasi Komponen: Seluruh statistik, kuota, pendaftar, dan bobot AHP
     * mengikuti periode terpilih secara sinkron tanpa mencampur data antar periode.
     */
    public function test_seluruh_komponen_dashboard_sinkron_dengan_periode_terpilih(): void
    {
        Periode::query()->delete();

        // Periode X dengan kuota 7, kriteria C1 berbobot 0.60
        $pX = Periode::create([
            'nama' => 'Periode Khusus X',
            'tahun' => 2026,
            'kuota' => 7,
            'tanggal_mulai' => now()->subDays(5)->toDateString(),
            'deadline' => now()->addDays(20)->toDateString(),
            'is_final' => false,
            'cr' => 0.045,
        ]);
        $kX1 = Kriteria::create([
            'periode_id' => $pX->id,
            'kode' => 'C1',
            'nama' => 'Kriteria Eksklusif X',
            'atribut' => 'benefit',
            'tipe_input' => 'angka',
            'bobot' => 0.60,
        ]);
        $kX2 = Kriteria::create([
            'periode_id' => $pX->id,
            'kode' => 'C2',
            'nama' => 'Kriteria Biaya X',
            'atribut' => 'cost',
            'tipe_input' => 'angka',
            'bobot' => 0.40,
        ]);

        // Buat 3 pendaftar pada Periode X
        for ($i = 1; $i <= 3; $i++) {
            $c = CalonPenerima::create([
                'periode_id' => $pX->id,
                'nim' => "NIM-X-{$i}",
                'nama' => "Siswa Spesifik X {$i}",
                'program_studi' => 'RPL',
                'semester' => 'XII',
                'jalur' => 'Reguler',
            ]);
            Penilaian::create(['calon_penerima_id' => $c->id, 'kriteria_id' => $kX1->id, 'nilai' => 85]);
            Penilaian::create(['calon_penerima_id' => $c->id, 'kriteria_id' => $kX2->id, 'nilai' => 2000000]);
        }

        // Jalankan SAW untuk periode X
        (new SawService)->hitung($pX);

        // Periode Y dengan kuota 2, kriteria C1 berbobot 0.25
        $pY = Periode::create([
            'nama' => 'Periode Khusus Y',
            'tahun' => 2026,
            'kuota' => 2,
            'tanggal_mulai' => now()->subDays(2)->toDateString(),
            'deadline' => now()->addDays(15)->toDateString(),
            'is_final' => false,
            'cr' => 0.030,
        ]);
        $kY1 = Kriteria::create([
            'periode_id' => $pY->id,
            'kode' => 'C1',
            'nama' => 'Kriteria Unik Y',
            'atribut' => 'benefit',
            'tipe_input' => 'angka',
            'bobot' => 0.25,
        ]);
        $kY2 = Kriteria::create([
            'periode_id' => $pY->id,
            'kode' => 'C2',
            'nama' => 'Kriteria Nilai Y',
            'atribut' => 'cost',
            'tipe_input' => 'angka',
            'bobot' => 0.75,
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $c = CalonPenerima::create([
                'periode_id' => $pY->id,
                'nim' => "NIM-Y-{$i}",
                'nama' => "Siswa Spesifik Y {$i}",
                'program_studi' => 'TKJ',
                'semester' => 'XI',
                'jalur' => 'Reguler',
            ]);
            Penilaian::create(['calon_penerima_id' => $c->id, 'kriteria_id' => $kY1->id, 'nilai' => 90]);
            Penilaian::create(['calon_penerima_id' => $c->id, 'kriteria_id' => $kY2->id, 'nilai' => 1500000]);
        }

        (new SawService)->hitung($pY);

        // 1. Uji tampilan saat memilih Periode X
        $resX = $this->get(route('dashboard', ['periode_id' => $pX->id]));
        $resX->assertOk();
        $resX->assertSee('Periode Khusus X');
        $resX->assertSee('7'); // Kuota 7 kursi
        $resX->assertSee('3'); // 3 pendaftar
        $resX->assertSee('Siswa Spesifik X 1');
        $resX->assertSee('Kriteria Eksklusif X');
        $resX->assertSee('60%');
        $resX->assertDontSee('Siswa Spesifik Y 1');
        $resX->assertDontSee('Kriteria Unik Y');

        // 2. Uji tampilan saat memilih Periode Y
        $resY = $this->get(route('dashboard', ['periode_id' => $pY->id]));
        $resY->assertOk();
        $resY->assertSee('Periode Khusus Y');
        $resY->assertSee('2'); // Kuota 2 kursi
        $resY->assertSee('5'); // 5 pendaftar
        $resY->assertSee('Siswa Spesifik Y 1');
        $resY->assertSee('Kriteria Unik Y');
        $resY->assertSee('25%');
        $resY->assertDontSee('Siswa Spesifik X 1');
        $resY->assertDontSee('Kriteria Eksklusif X');
    }

    /**
     * Integritas Data: Memilih periode pada dashboard tidak mengubah status atau data apapun di database.
     */
    public function test_pemilihan_periode_dashboard_tidak_mengubah_data_database(): void
    {
        $periode = Periode::first();
        $this->assertNotNull($periode);

        $statusSebelum = $periode->is_final;
        $kuotaSebelum = $periode->kuota;
        $updatedAtSebelum = $periode->updated_at;

        $this->get(route('dashboard', ['periode_id' => $periode->id]));

        $periodeSesudah = Periode::find($periode->id);
        $this->assertEquals($statusSebelum, $periodeSesudah->is_final);
        $this->assertEquals($kuotaSebelum, $periodeSesudah->kuota);
        $this->assertEquals($updatedAtSebelum->timestamp, $periodeSesudah->updated_at->timestamp);
    }
}
