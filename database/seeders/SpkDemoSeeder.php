<?php

namespace Database\Seeders;

use App\Models\CalonPenerima;
use App\Models\KonfigurasiKriteria;
use App\Models\KonfigurasiSeleksi;
use App\Models\KonfigurasiSubKriteria;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Periode;
use App\Models\SubKriteria;
use App\Services\SawService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

class SpkDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama agar hanya menyisakan data demo yang bersih
        Schema::disableForeignKeyConstraints();
        Penilaian::truncate();
        CalonPenerima::truncate();
        SubKriteria::truncate();
        Kriteria::truncate();
        Periode::truncate();
        KonfigurasiSubKriteria::truncate();
        KonfigurasiKriteria::truncate();
        KonfigurasiSeleksi::truncate();
        Schema::enableForeignKeyConstraints();

        $sawService = new SawService;

        // =========================================================================
        // MASTER KONFIGURASI SELEKSI BAKU
        // =========================================================================
        $defaultMatrix = [
            'C1' => ['C1' => 1.0, 'C2' => 2.0, 'C3' => 3.0, 'C4' => 4.0, 'C5' => 3.0],
            'C2' => ['C1' => 0.5, 'C2' => 1.0, 'C3' => 2.0, 'C4' => 3.0, 'C5' => 2.0],
            'C3' => ['C1' => 0.333, 'C2' => 0.5, 'C3' => 1.0, 'C4' => 2.0, 'C5' => 2.0],
            'C4' => ['C1' => 0.250, 'C2' => 0.333, 'C3' => 0.5, 'C4' => 1.0, 'C5' => 2.0],
            'C5' => ['C1' => 0.333, 'C2' => 0.5, 'C3' => 0.5, 'C4' => 0.5, 'C5' => 1.0],
        ];

        $masterKonfigurasi = KonfigurasiSeleksi::create([
            'nama' => 'Standar Seleksi Prestasi Siswa SMK',
            'deskripsi' => 'Paket konfigurasi seleksi baku beasiswa prestasi dengan 5 kriteria standar kejuruan dan perbandingan AHP konsisten (CR < 0.10).',
            'versi' => 1,
            'matriks_ahp' => $defaultMatrix,
            'lambda_max' => 5.202,
            'ci' => 0.051,
            'cr' => 0.045,
            'is_konsisten' => true,
            'is_siap' => true,
            'is_aktif' => true,
        ]);

        $masterKriteriasData = [
            ['kode' => 'C1', 'nama' => 'Prestasi Akademik', 'atribut' => 'benefit', 'tipe_input' => 'angka', 'min_val' => 0, 'max_val' => 100, 'satuan' => '/ 100', 'rentang' => '0 – 100 (Nilai Rapor Siswa)', 'bobot' => 0.400000, 'urutan' => 1],
            ['kode' => 'C2', 'nama' => 'Penghasilan Orang Tua', 'atribut' => 'cost', 'tipe_input' => 'angka', 'min_val' => 0, 'max_val' => 10000000, 'satuan' => 'Rp', 'rentang' => 'Rp 0 s/d > Rp 10.000.000', 'bobot' => 0.240000, 'urutan' => 2],
            ['kode' => 'C3', 'nama' => 'Tanggungan Anak', 'atribut' => 'benefit', 'tipe_input' => 'angka', 'min_val' => 1, 'max_val' => 10, 'satuan' => 'Orang', 'rentang' => '1 s/d 10 Orang Anak', 'bobot' => 0.160000, 'urutan' => 3],
            ['kode' => 'C4', 'nama' => 'Ekstrakurikuler', 'atribut' => 'cost', 'tipe_input' => 'pilihan', 'min_val' => 1, 'max_val' => 5, 'satuan' => 'Paket', 'rentang' => 'Paket 1 s/d 5 (Pramuka, Komputer, Paskibra, Olahraga, Pakata)', 'bobot' => 0.110000, 'urutan' => 4],
            ['kode' => 'C5', 'nama' => 'Ketidakhadiran', 'atribut' => 'cost', 'tipe_input' => 'angka', 'min_val' => 0, 'max_val' => 30, 'satuan' => 'Hari', 'rentang' => '0 – 10 Hari Alpa', 'bobot' => 0.090000, 'urutan' => 5],
        ];

        foreach ($masterKriteriasData as $mkData) {
            $mk = $masterKonfigurasi->kriterias()->create($mkData);
            if ($mkData['kode'] === 'C4') {
                $mk->subKriterias()->createMany([
                    ['label' => 'Paket 1: Pramuka, Komputer, dan Paskibra', 'nilai' => 1, 'urutan' => 1],
                    ['label' => 'Paket 2: Komputer dan Paskibra', 'nilai' => 2, 'urutan' => 2],
                    ['label' => 'Paket 3: Pramuka dan Paskibra', 'nilai' => 3, 'urutan' => 3],
                    ['label' => 'Paket 4: Olahraga', 'nilai' => 4, 'urutan' => 4],
                    ['label' => 'Paket 5: Pakata', 'nilai' => 5, 'urutan' => 5],
                ]);
            }
        }

        // =========================================================================
        // 1. PERIODE 1: AKTIF (TA 2026/2027 Ganjil – SMK Negeri 1 Prestasi)
        // =========================================================================
        $periodeAktif = Periode::create([
            'nama' => 'TA 2026/2027 Ganjil – SMK Negeri 1 Prestasi',
            'tahun' => 2026,
            'kuota' => 12,
            'ambang_batas' => SawService::AMBANG_BATAS,
            'konfigurasi_seleksi_id' => $masterKonfigurasi->id,
            'tanggal_mulai' => Carbon::create(2026, 8, 1),
            'deadline' => Carbon::create(2026, 11, 30),
            'lambda_max' => 5.168,
            'ci' => 0.042,
            'cr' => 0.038,
            'is_final' => false,
            'matriks_ahp' => $defaultMatrix,
        ]);

        $this->setupKriteriaDanSiswa($periodeAktif, $sawService, true);

        // =========================================================================
        // 2. PERIODE 2: HISTORIS TUNTAS (TA 2025/2026 Genap – SMK Negeri 1 Prestasi)
        // =========================================================================
        $periodeSelesai = Periode::create([
            'nama' => 'TA 2025/2026 Genap – SMK Negeri 1 Prestasi',
            'tahun' => 2026,
            'kuota' => 5,
            'ambang_batas' => SawService::AMBANG_BATAS,
            'konfigurasi_seleksi_id' => $masterKonfigurasi->id,
            'tanggal_mulai' => Carbon::create(2026, 1, 10),
            'deadline' => Carbon::create(2026, 4, 20),
            'lambda_max' => 5.150,
            'ci' => 0.038,
            'cr' => 0.034,
            'is_final' => true,
            'matriks_ahp' => [
                'C1' => ['C1' => 1.0, 'C2' => 3.0, 'C3' => 4.0, 'C4' => 5.0, 'C5' => 6.0],
                'C2' => ['C1' => 0.333, 'C2' => 1.0, 'C3' => 2.0, 'C4' => 3.0, 'C5' => 4.0],
                'C3' => ['C1' => 0.250, 'C2' => 0.500, 'C3' => 1.0, 'C4' => 2.0, 'C5' => 3.0],
                'C4' => ['C1' => 0.200, 'C2' => 0.333, 'C3' => 0.500, 'C4' => 1.0, 'C5' => 2.0],
                'C5' => ['C1' => 0.167, 'C2' => 0.250, 'C3' => 0.333, 'C4' => 0.500, 'C5' => 1.0],
            ],
        ]);

        $this->setupKriteriaDanSiswa($periodeSelesai, $sawService, false);
    }

    /**
     * Konfigurasi 5 Kriteria Baku SMK & Data Siswa Per Periode
     */
    private function setupKriteriaDanSiswa(Periode $periode, SawService $sawService, bool $isPeriodeUtama): void
    {
        // 5 Kriteria Baku Sesuai Dokumen Perhitungan Manual SPK
        $kriteriasData = [
            [
                'kode' => 'C1',
                'nama' => 'Prestasi Akademik',
                'atribut' => 'benefit',
                'tipe_input' => 'angka',
                'bobot' => 0.400000,
            ],
            [
                'kode' => 'C2',
                'nama' => 'Penghasilan Orang Tua',
                'atribut' => 'cost',
                'tipe_input' => 'angka',
                'bobot' => 0.240000,
            ],
            [
                'kode' => 'C3',
                'nama' => 'Tanggungan Anak',
                'atribut' => 'benefit',
                'tipe_input' => 'angka',
                'bobot' => 0.160000,
            ],
            [
                'kode' => 'C4',
                'nama' => 'Ekstrakurikuler',
                'atribut' => 'cost',
                'tipe_input' => 'pilihan',
                'bobot' => 0.110000,
            ],
            [
                'kode' => 'C5',
                'nama' => 'Ketidakhadiran',
                'atribut' => 'cost',
                'tipe_input' => 'angka',
                'bobot' => 0.090000,
            ],
        ];

        $kModels = [];
        foreach ($kriteriasData as $kData) {
            $k = Kriteria::create([
                'periode_id' => $periode->id,
                'kode' => $kData['kode'],
                'nama' => $kData['nama'],
                'atribut' => $kData['atribut'],
                'tipe_input' => $kData['tipe_input'],
                'bobot' => $kData['bobot'],
            ]);
            $kModels[$kData['kode']] = $k;
        }

        // Sub Kriteria C4: Menu Paket Ekstrakurikuler
        $subKriteriaC4 = [
            ['label' => 'Paket 1: Pramuka, Komputer, dan Paskibra', 'nilai' => 1],
            ['label' => 'Paket 2: Komputer dan Paskibra', 'nilai' => 2],
            ['label' => 'Paket 3: Pramuka dan Paskibra', 'nilai' => 3],
            ['label' => 'Paket 4: Olahraga', 'nilai' => 4],
            ['label' => 'Paket 5: Pakata', 'nilai' => 5],
        ];
        $subC4Map = [];
        foreach ($subKriteriaC4 as $sub) {
            $subModel = SubKriteria::create([
                'kriteria_id' => $kModels['C4']->id,
                'label' => $sub['label'],
                'nilai' => $sub['nilai'],
            ]);
            $subC4Map[$sub['nilai']] = $subModel;
        }

        // Data 15 Siswa Calon Penerima (Patrick Jane, Teresa Lisbon, David Martinez, Lucy, Roman Carax, dst.)
        $siswaData = $isPeriodeUtama ? [
            ['nisn' => '0071234001', 'nama' => 'Patrick Jane', 'jurusan' => 'Rekayasa Perangkat Lunak', 'kelas' => 'XII RPL 1', 'c1' => 96.00, 'c2' => 1200000, 'c3' => 4, 'c4' => 1, 'c5' => 0],
            ['nisn' => '0071234002', 'nama' => 'Teresa Lisbon', 'jurusan' => 'Teknik Komputer & Jaringan', 'kelas' => 'XII TKJ 1', 'c1' => 92.50, 'c2' => 1800000, 'c3' => 5, 'c4' => 2, 'c5' => 1],
            ['nisn' => '0071234003', 'nama' => 'Kimball Cho', 'jurusan' => 'Rekayasa Perangkat Lunak', 'kelas' => 'XII RPL 2', 'c1' => 90.00, 'c2' => 2000000, 'c3' => 3, 'c4' => 1, 'c5' => 0],
            ['nisn' => '0071234004', 'nama' => 'Grace Van Pelt', 'jurusan' => 'Desain Komunikasi Visual', 'kelas' => 'XII DKV 1', 'c1' => 87.50, 'c2' => 2400000, 'c3' => 4, 'c4' => 2, 'c5' => 1],
            ['nisn' => '0071234005', 'nama' => 'Wayne Rigsby', 'jurusan' => 'Teknik Kendaraan Ringan', 'kelas' => 'XII TKR 1', 'c1' => 84.00, 'c2' => 2800000, 'c3' => 3, 'c4' => 3, 'c5' => 2],
            ['nisn' => '0071234006', 'nama' => 'Farrel Ahnaf Putra Chaniago', 'jurusan' => 'Teknik Komputer & Jaringan', 'kelas' => 'XII TKJ 2', 'c1' => 81.50, 'c2' => 3200000, 'c3' => 4, 'c4' => 2, 'c5' => 1],
            ['nisn' => '0071234007', 'nama' => 'Muhammad Ghibran Aditya', 'jurusan' => 'Akuntansi & Keuangan Lembaga', 'kelas' => 'XII AKL 1', 'c1' => 78.00, 'c2' => 4000000, 'c3' => 2, 'c4' => 4, 'c5' => 3],
            ['nisn' => '0071234008', 'nama' => 'Red John', 'jurusan' => 'Manajemen Perkantoran', 'kelas' => 'XII MP 1', 'c1' => 71.50, 'c2' => 6000000, 'c3' => 1, 'c4' => 5, 'c5' => 5],
            ['nisn' => '0071234009', 'nama' => 'David Martinez', 'jurusan' => 'Teknik Komputer & Jaringan', 'kelas' => 'XII TKJ 1', 'c1' => 93.00, 'c2' => 1400000, 'c3' => 2, 'c4' => 1, 'c5' => 1],
            ['nisn' => '0071234010', 'nama' => 'Lucy', 'jurusan' => 'Rekayasa Perangkat Lunak', 'kelas' => 'XII RPL 1', 'c1' => 94.00, 'c2' => 1600000, 'c3' => 1, 'c4' => 1, 'c5' => 0],
            ['nisn' => '0071234011', 'nama' => 'Roman Carax', 'jurusan' => 'Desain Komunikasi Visual', 'kelas' => 'XII DKV 2', 'c1' => 86.50, 'c2' => 2100000, 'c3' => 3, 'c4' => 2, 'c5' => 1],
            ['nisn' => '0071234012', 'nama' => 'Yang Talia', 'jurusan' => 'Akuntansi & Keuangan Lembaga', 'kelas' => 'XII AKL 2', 'c1' => 85.00, 'c2' => 1900000, 'c3' => 4, 'c4' => 3, 'c5' => 0],
            ['nisn' => '0071234013', 'nama' => 'Weak Kingsley', 'jurusan' => 'Manajemen Perkantoran', 'kelas' => 'XII MP 2', 'c1' => 80.00, 'c2' => 3500000, 'c3' => 3, 'c4' => 3, 'c5' => 2],
            ['nisn' => '0071234014', 'nama' => 'Omi', 'jurusan' => 'Teknik Kendaraan Ringan', 'kelas' => 'XII TKR 2', 'c1' => 77.00, 'c2' => 2900000, 'c3' => 2, 'c4' => 4, 'c5' => 2],
            ['nisn' => '0071234015', 'nama' => 'D', 'jurusan' => 'Desain Komunikasi Visual', 'kelas' => 'XII DKV 1', 'c1' => 74.00, 'c2' => 4800000, 'c3' => 1, 'c4' => 4, 'c5' => 4],
        ] : [
            // 10 Siswa untuk Periode Historis
            ['nisn' => '0068112201', 'nama' => 'Aditya Yoga Pratama', 'jurusan' => 'Rekayasa Perangkat Lunak', 'kelas' => 'XII RPL 1', 'c1' => 97.00, 'c2' => 1400000, 'c3' => 4, 'c4' => 5, 'c5' => 0],
            ['nisn' => '0068112202', 'nama' => 'Bella Safitri Ningsih', 'jurusan' => 'Akuntansi & Keuangan Lembaga', 'kelas' => 'XII AKL 1', 'c1' => 94.50, 'c2' => 1700000, 'c3' => 5, 'c4' => 4, 'c5' => 0],
            ['nisn' => '0068112203', 'nama' => 'Candra Wijaya Kusuma', 'jurusan' => 'Teknik Komputer & Jaringan', 'kelas' => 'XII TKJ 2', 'c1' => 93.00, 'c2' => 2100000, 'c3' => 3, 'c4' => 4, 'c5' => 1],
            ['nisn' => '0068112204', 'nama' => 'Dina Amelia Siregar', 'jurusan' => 'Desain Komunikasi Visual', 'kelas' => 'XII DKV 1', 'c1' => 91.50, 'c2' => 2300000, 'c3' => 4, 'c4' => 3, 'c5' => 1],
            ['nisn' => '0068112205', 'nama' => 'Eko Prasetyo Utomo', 'jurusan' => 'Teknik Kendaraan Ringan', 'kelas' => 'XII TKR 1', 'c1' => 90.00, 'c2' => 2600000, 'c3' => 3, 'c4' => 4, 'c5' => 1],
            ['nisn' => '0068112206', 'nama' => 'Farhan Alamsyah Rasyid', 'jurusan' => 'Rekayasa Perangkat Lunak', 'kelas' => 'XII RPL 2', 'c1' => 88.50, 'c2' => 3400000, 'c3' => 3, 'c4' => 3, 'c5' => 2],
            ['nisn' => '0068112207', 'nama' => 'Gita Gutawa Maharani', 'jurusan' => 'Akuntansi & Keuangan Lembaga', 'kelas' => 'XII AKL 2', 'c1' => 86.00, 'c2' => 4200000, 'c3' => 2, 'c4' => 3, 'c5' => 2],
            ['nisn' => '0068112208', 'nama' => 'Haris Firmansyah', 'jurusan' => 'Teknik Komputer & Jaringan', 'kelas' => 'XII TKJ 1', 'c1' => 84.50, 'c2' => 5200000, 'c3' => 2, 'c4' => 2, 'c5' => 3],
            ['nisn' => '0068112209', 'nama' => 'Indah Permatasari', 'jurusan' => 'Desain Komunikasi Visual', 'kelas' => 'XII DKV 2', 'c1' => 82.00, 'c2' => 6800000, 'c3' => 2, 'c4' => 2, 'c5' => 3],
            ['nisn' => '0068112210', 'nama' => 'Kurnia Sandy Pratama', 'jurusan' => 'Teknik Kendaraan Ringan', 'kelas' => 'XII TKR 2', 'c1' => 78.00, 'c2' => 9000000, 'c3' => 1, 'c4' => 1, 'c5' => 4],
        ];

        foreach ($siswaData as $s) {
            $calon = CalonPenerima::create([
                'periode_id' => $periode->id,
                'nim' => $s['nisn'],
                'nama' => $s['nama'],
                'program_studi' => $s['jurusan'],
                'semester' => $s['kelas'],
                'jalur' => 'Reguler Prestasi SMK',
            ]);

            // C1: Nilai Akademik (0-100)
            Penilaian::create([
                'calon_penerima_id' => $calon->id,
                'kriteria_id' => $kModels['C1']->id,
                'nilai' => $s['c1'],
            ]);

            // C2: Penghasilan Orang Tua (Rp 0 s/d > 10.000.000)
            Penilaian::create([
                'calon_penerima_id' => $calon->id,
                'kriteria_id' => $kModels['C2']->id,
                'nilai' => $s['c2'],
            ]);

            // C3: Tanggungan Anak (Angka)
            Penilaian::create([
                'calon_penerima_id' => $calon->id,
                'kriteria_id' => $kModels['C3']->id,
                'nilai' => $s['c3'],
            ]);

            // C4: Ekstrakurikuler (Paket 1..5)
            $subC4 = $subC4Map[$s['c4']] ?? null;
            Penilaian::create([
                'calon_penerima_id' => $calon->id,
                'kriteria_id' => $kModels['C4']->id,
                'sub_kriteria_id' => $subC4?->id,
                'nilai' => $s['c4'], // 1 s/d 5 sesuai paket
            ]);

            // C5: Ketidakhadiran (0..5+ hari)
            Penilaian::create([
                'calon_penerima_id' => $calon->id,
                'kriteria_id' => $kModels['C5']->id,
                'nilai' => $s['c5'],
            ]);
        }

        // Jalankan perhitungan SAW otomatis untuk menghitung skor Vi, peringkat, dan status
        $sawService->hitung($periode);
    }
}
