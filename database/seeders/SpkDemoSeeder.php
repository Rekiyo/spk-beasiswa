<?php

namespace Database\Seeders;

use App\Models\CalonPenerima;
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
        // Bersihkan data lama agar hanya menyisakan 2 periode tuntas (Sesuai Ketentuan 9)
        Schema::disableForeignKeyConstraints();
        Penilaian::truncate();
        CalonPenerima::truncate();
        SubKriteria::truncate();
        Kriteria::truncate();
        Periode::truncate();
        Schema::enableForeignKeyConstraints();

        $sawService = new SawService;

        // =========================================================================
        // 1. PERIODE 1: AKTIF (TA 2026/2027 Ganjil – SMK Negeri 1 Prestasi)
        // =========================================================================
        $periodeAktif = Periode::create([
            'nama' => 'TA 2026/2027 Ganjil – SMK Negeri 1 Prestasi',
            'tahun' => 2026,
            'kuota' => 5,
            'tanggal_mulai' => Carbon::create(2026, 8, 1),
            'deadline' => Carbon::create(2026, 11, 30),
            'lambda_max' => 5.168,
            'ci' => 0.042,
            'cr' => 0.038,
            'is_final' => false,
            'matriks_ahp' => [
                'C1' => ['C1' => 1.0, 'C2' => 3.0, 'C3' => 4.0, 'C4' => 5.0, 'C5' => 6.0],
                'C2' => ['C1' => 0.333, 'C2' => 1.0, 'C3' => 2.0, 'C4' => 3.0, 'C5' => 4.0],
                'C3' => ['C1' => 0.250, 'C2' => 0.500, 'C3' => 1.0, 'C4' => 2.0, 'C5' => 3.0],
                'C4' => ['C1' => 0.200, 'C2' => 0.333, 'C3' => 0.500, 'C4' => 1.0, 'C5' => 2.0],
                'C5' => ['C1' => 0.167, 'C2' => 0.250, 'C3' => 0.333, 'C4' => 0.500, 'C5' => 1.0],
            ],
        ]);

        $this->setupKriteriaDanSiswa($periodeAktif, $sawService, true);

        // =========================================================================
        // 2. PERIODE 2: HISTORIS TUNTAS (TA 2025/2026 Genap – SMK Negeri 1 Prestasi)
        // =========================================================================
        $periodeSelesai = Periode::create([
            'nama' => 'TA 2025/2026 Genap – SMK Negeri 1 Prestasi',
            'tahun' => 2026,
            'kuota' => 5,
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
        // 5 Kriteria Baku SMK
        $kriteriasData = [
            [
                'kode' => 'C1',
                'nama' => 'Nilai Akademik',
                'atribut' => 'benefit',
                'tipe_input' => 'angka',
                'bobot' => 0.442000,
            ],
            [
                'kode' => 'C2',
                'nama' => 'Penghasilan Orang Tua',
                'atribut' => 'cost',
                'tipe_input' => 'angka',
                'bobot' => 0.243000,
            ],
            [
                'kode' => 'C3',
                'nama' => 'Tanggungan Orang Tua',
                'atribut' => 'benefit',
                'tipe_input' => 'pilihan',
                'bobot' => 0.163000,
            ],
            [
                'kode' => 'C4',
                'nama' => 'Ekstrakurikuler',
                'atribut' => 'benefit',
                'tipe_input' => 'pilihan',
                'bobot' => 0.098000,
            ],
            [
                'kode' => 'C5',
                'nama' => 'Ketidakhadiran',
                'atribut' => 'cost',
                'tipe_input' => 'angka',
                'bobot' => 0.054000,
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

        // Sub Kriteria C3 (Tanggungan Orang Tua: 1 sampai > 4)
        $subKriteriaC3 = [
            ['label' => '1 Orang Tanggungan', 'nilai' => 1],
            ['label' => '2 Orang Tanggungan', 'nilai' => 2],
            ['label' => '3 Orang Tanggungan', 'nilai' => 3],
            ['label' => '4 Orang Tanggungan', 'nilai' => 4],
            ['label' => '> 4 Orang Tanggungan', 'nilai' => 5],
        ];
        $subC3Map = [];
        foreach ($subKriteriaC3 as $sub) {
            $subModel = SubKriteria::create([
                'kriteria_id' => $kModels['C3']->id,
                'label' => $sub['label'],
                'nilai' => $sub['nilai'],
            ]);
            $subC3Map[$sub['nilai']] = $subModel;
        }

        // Sub Kriteria C4: Menu Paket Ekstrakurikuler Sesuai Ketentuan 6
        // Paket 1 = 1, Paket 2 = 2, Paket 3 = 3, Paket 4 = 4, Paket 5 = 5
        $subKriteriaC4 = [
            ['label' => 'Paket 1: Pramuka, Komputer, dan Paskibra', 'nilai' => 1],
            ['label' => 'Paket 2: Komputer dan Paskibra', 'nilai' => 2],
            ['label' => 'Paket 3: Pramuka dan Paskibra', 'nilai' => 3],
            ['label' => 'Paket 4: Olahraga', 'nilai' => 4],
            ['label' => 'Paket 5: Palang Merah / PMR & Organisasi', 'nilai' => 5],
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

        // Data Calon Penerima Siswa SMK Indonesia
        $siswaData = $isPeriodeUtama ? [
            // 15 Siswa untuk Periode Aktif
            ['nisn' => '0078123401', 'nama' => 'Rizky Pratama Saputra', 'jurusan' => 'Rekayasa Perangkat Lunak', 'kelas' => 'XII RPL 1', 'c1' => 96.50, 'c2' => 1500000, 'c3' => 4, 'c4' => 5, 'c5' => 0],
            ['nisn' => '0078123402', 'nama' => 'Siti Aisyah Nuraini', 'jurusan' => 'Akuntansi & Keuangan Lembaga', 'kelas' => 'XII AKL 2', 'c1' => 95.00, 'c2' => 1800000, 'c3' => 5, 'c4' => 4, 'c5' => 0],
            ['nisn' => '0078123403', 'nama' => 'Muhammad Budi Santoso', 'jurusan' => 'Teknik Komputer & Jaringan', 'kelas' => 'XII TKJ 1', 'c1' => 93.80, 'c2' => 2000000, 'c3' => 3, 'c4' => 5, 'c5' => 1],
            ['nisn' => '0078123404', 'nama' => 'Dwi Lestari Handayani', 'jurusan' => 'Desain Komunikasi Visual', 'kelas' => 'XI DKV 1', 'c1' => 92.40, 'c2' => 2200000, 'c3' => 4, 'c4' => 4, 'c5' => 0],
            ['nisn' => '0078123405', 'nama' => 'Fajar Nugroho Setiawan', 'jurusan' => 'Teknik Kendaraan Ringan', 'kelas' => 'XII TKR 2', 'c1' => 91.20, 'c2' => 2500000, 'c3' => 4, 'c4' => 3, 'c5' => 1],
            ['nisn' => '0078123406', 'nama' => 'Anisa Rahmawati Putri', 'jurusan' => 'Rekayasa Perangkat Lunak', 'kelas' => 'XI RPL 2', 'c1' => 89.50, 'c2' => 3000000, 'c3' => 3, 'c4' => 4, 'c5' => 1],
            ['nisn' => '0078123407', 'nama' => 'Bagus Hendra Wicaksono', 'jurusan' => 'Teknik Komputer & Jaringan', 'kelas' => 'XII TKJ 2', 'c1' => 88.00, 'c2' => 3500000, 'c3' => 3, 'c4' => 3, 'c5' => 2],
            ['nisn' => '0078123408', 'nama' => 'Cindy Claudia Marwah', 'jurusan' => 'Akuntansi & Keuangan Lembaga', 'kelas' => 'XI AKL 1', 'c1' => 87.20, 'c2' => 3200000, 'c3' => 2, 'c4' => 5, 'c5' => 1],
            ['nisn' => '0078123409', 'nama' => 'Dimas Arya Pamungkas', 'jurusan' => 'Teknik Kendaraan Ringan', 'kelas' => 'XII TKR 1', 'c1' => 86.00, 'c2' => 4000000, 'c3' => 3, 'c4' => 2, 'c5' => 2],
            ['nisn' => '0078123410', 'nama' => 'Eka Wahyu Prasetya', 'jurusan' => 'Desain Komunikasi Visual', 'kelas' => 'XII DKV 2', 'c1' => 85.50, 'c2' => 4500000, 'c3' => 2, 'c4' => 4, 'c5' => 2],
            ['nisn' => '0078123411', 'nama' => 'Fitriani Indah Permata', 'jurusan' => 'Rekayasa Perangkat Lunak', 'kelas' => 'X RPL 1', 'c1' => 84.00, 'c2' => 5000000, 'c3' => 2, 'c4' => 3, 'c5' => 3],
            ['nisn' => '0078123412', 'nama' => 'Gilang Ramadhan Kusuma', 'jurusan' => 'Teknik Komputer & Jaringan', 'kelas' => 'XI TKJ 1', 'c1' => 82.50, 'c2' => 6000000, 'c3' => 2, 'c4' => 2, 'c5' => 3],
            ['nisn' => '0078123413', 'nama' => 'Hesti Wulandari Astuti', 'jurusan' => 'Akuntansi & Keuangan Lembaga', 'kelas' => 'X AKL 2', 'c1' => 81.00, 'c2' => 7500000, 'c3' => 1, 'c4' => 3, 'c5' => 4],
            ['nisn' => '0078123414', 'nama' => 'Ilham Maulana Akbar', 'jurusan' => 'Teknik Kendaraan Ringan', 'kelas' => 'X TKR 1', 'c1' => 79.50, 'c2' => 8500000, 'c3' => 2, 'c4' => 1, 'c5' => 4],
            ['nisn' => '0078123415', 'nama' => 'Joko Susilo Purnomo', 'jurusan' => 'Desain Komunikasi Visual', 'kelas' => 'X DKV 1', 'c1' => 76.00, 'c2' => 11000000, 'c3' => 1, 'c4' => 1, 'c5' => 5],
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

            // C3: Tanggungan Orang Tua (1..5)
            $subC3 = $subC3Map[$s['c3']] ?? null;
            Penilaian::create([
                'calon_penerima_id' => $calon->id,
                'kriteria_id' => $kModels['C3']->id,
                'sub_kriteria_id' => $subC3?->id,
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
