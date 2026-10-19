<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Periode;
use App\Services\AhpService;
use App\Services\SawService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    public function __construct(
        protected AhpService $ahpService,
        protected SawService $sawService
    ) {}

    /**
     * Menampilkan daftar periode seleksi (Image 2)
     */
    public function index(Request $request)
    {
        $query = Periode::with(['kriterias', 'calonPenerimas'])
            ->orderByDesc('tahun')
            ->orderByDesc('id');

        // Filter tab
        $tab = $request->input('tab', 'semua');
        if ($tab === 'aktif') {
            $query->whereDate('deadline', '>=', now()->startOfDay());
        } elseif ($tab === 'selesai') {
            $query->where(function ($q) {
                $q->whereDate('deadline', '<', now()->startOfDay())
                    ->orWhere('is_final', true);
            });
        }

        // Search
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('tahun', 'like', "%{$search}%");
            });
        }

        $allPeriodes = Periode::with(['kriterias', 'calonPenerimas'])
            ->orderByDesc('tahun')
            ->orderByDesc('id')
            ->get();

        $periodes = $query->paginate(6)->withQueryString();

        $periodeAktif = $allPeriodes->first(fn ($p) => ! $p->isTerkunci()) ?? $allPeriodes->first();

        $totalPeriode = $allPeriodes->count();
        $totalAktif = $allPeriodes->filter(fn ($p) => ! $p->isTerkunci())->count();
        $totalSelesai = $allPeriodes->filter(fn ($p) => $p->isTerkunci() || $p->is_final)->count();
        $totalKuota = $allPeriodes->sum('kuota');
        $totalPendaftarAktif = $periodeAktif ? $periodeAktif->calonPenerimas->count() : 0;

        return view('periode.index', compact(
            'periodes',
            'periodeAktif',
            'totalPeriode',
            'totalAktif',
            'totalSelesai',
            'totalKuota',
            'totalPendaftarAktif',
            'tab'
        ));
    }

    /**
     * Menampilkan formulir pembuatan periode baru lengkap (Image 3)
     */
    public function create()
    {
        $defaultKriterias = [
            [
                'kode' => 'C1',
                'nama' => 'Nilai Akademik',
                'atribut' => 'benefit',
                'tipe_input' => 'angka',
                'min_val' => 0,
                'max_val' => 100,
                'satuan' => '/ 100 (Rapor)',
                'rentang' => '0 – 100 (Nilai Rapor Siswa SMK)',
                'pilihan' => [],
            ],
            [
                'kode' => 'C2',
                'nama' => 'Penghasilan Orang Tua',
                'atribut' => 'cost',
                'tipe_input' => 'angka',
                'min_val' => 0,
                'max_val' => 10000000,
                'satuan' => 'Rupiah (Slip Gaji)',
                'rentang' => 'Rp 0 s/d > Rp 10.000.000',
                'pilihan' => [],
            ],
            [
                'kode' => 'C3',
                'nama' => 'Tanggungan Orang Tua',
                'atribut' => 'benefit',
                'tipe_input' => 'pilihan',
                'min_val' => 1,
                'max_val' => 5,
                'satuan' => 'Orang',
                'rentang' => '1 s/d > 4 Orang Tanggungan',
                'pilihan' => [
                    ['label' => '1 Orang Tanggungan', 'nilai' => 1],
                    ['label' => '2 Orang Tanggungan', 'nilai' => 2],
                    ['label' => '3 Orang Tanggungan', 'nilai' => 3],
                    ['label' => '4 Orang Tanggungan', 'nilai' => 4],
                    ['label' => '> 4 Orang Tanggungan', 'nilai' => 5],
                ],
            ],
            [
                'kode' => 'C4',
                'nama' => 'Ekstrakurikuler',
                'atribut' => 'benefit',
                'tipe_input' => 'pilihan',
                'min_val' => 1,
                'max_val' => 5,
                'satuan' => 'Paket',
                'rentang' => 'Menu Paket: Paket 1 s/d 5 (Konversi SAW Nilai 1 s/d 5)',
                'pilihan' => [
                    ['label' => 'Paket 1: Pramuka, Komputer, dan Paskibra', 'nilai' => 1],
                    ['label' => 'Paket 2: Komputer dan Paskibra', 'nilai' => 2],
                    ['label' => 'Paket 3: Pramuka dan Paskibra', 'nilai' => 3],
                    ['label' => 'Paket 4: Olahraga', 'nilai' => 4],
                    ['label' => 'Paket 5: Palang Merah / PMR & Organisasi', 'nilai' => 5],
                ],
            ],
            [
                'kode' => 'C5',
                'nama' => 'Ketidakhadiran',
                'atribut' => 'cost',
                'tipe_input' => 'angka',
                'min_val' => 0,
                'max_val' => 30,
                'satuan' => 'Hari Alpa',
                'rentang' => '0 Hari s/d > 5 Hari (Rekap Presensi/Alpa)',
                'pilihan' => [],
            ],
        ];

        // Default AHP Matrix (menghasilkan CR = 0.038 / konsisten)
        $defaultMatrix = [
            'C1' => ['C1' => 1.0, 'C2' => 3.0, 'C3' => 4.0, 'C4' => 5.0, 'C5' => 6.0],
            'C2' => ['C1' => 0.333, 'C2' => 1.0, 'C3' => 2.0, 'C4' => 3.0, 'C5' => 4.0],
            'C3' => ['C1' => 0.250, 'C2' => 0.500, 'C3' => 1.0, 'C4' => 2.0, 'C5' => 3.0],
            'C4' => ['C1' => 0.200, 'C2' => 0.333, 'C3' => 0.500, 'C4' => 1.0, 'C5' => 2.0],
            'C5' => ['C1' => 0.167, 'C2' => 0.250, 'C3' => 0.333, 'C4' => 0.500, 'C5' => 1.0],
        ];

        $ahpResult = $this->ahpService->hitung(['C1', 'C2', 'C3', 'C4', 'C5'], $defaultMatrix);

        return view('periode.create', compact('defaultKriterias', 'defaultMatrix', 'ahpResult'));
    }

    /**
     * Menyimpan periode baru beserta kriteria dan pembobotan AHP
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'deadline' => 'required|date|after_or_equal:tanggal_mulai',
            'kriterias' => 'nullable|array',
            'matrix' => 'nullable|array',
        ]);

        $matrix = $request->input('matrix', []);
        $kriteriasInput = $request->input('kriterias', []);

        $kriteriaCodes = ! empty($kriteriasInput)
            ? array_column($kriteriasInput, 'kode')
            : ['C1', 'C2', 'C3', 'C4', 'C5'];

        $ahpResult = $this->ahpService->hitung($kriteriaCodes, $matrix);

        DB::transaction(function () use ($data, $kriteriasInput, $ahpResult, &$periode) {
            $periode = Periode::create([
                'nama' => $data['nama'],
                'tahun' => $data['tahun'],
                'kuota' => $data['kuota'],
                'tanggal_mulai' => $data['tanggal_mulai'],
                'deadline' => $data['deadline'],
                'lambda_max' => $ahpResult['lambda_max'] ?? null,
                'ci' => $ahpResult['ci'] ?? null,
                'cr' => $ahpResult['cr'] ?? null,
                'matriks_ahp' => $ahpResult['matrix'] ?? null,
                'is_final' => false,
            ]);

            // Jika form menyertakan data kriteria kustom
            if (! empty($kriteriasInput)) {
                foreach ($kriteriasInput as $kData) {
                    $kode = $kData['kode'];
                    $bobot = $ahpResult['weights'][$kode] ?? (1.0 / count($kriteriasInput));
                    $tipe = $kData['tipe_input'] ?? 'angka';

                    $minVal = isset($kData['min_val']) ? floatval($kData['min_val']) : 0;
                    $maxVal = isset($kData['max_val']) ? floatval($kData['max_val']) : 100;
                    $satuan = $kData['satuan'] ?? null;
                    $rentang = $kData['rentang'] ?? ($tipe === 'angka' ? "Rentang: {$minVal} s/d {$maxVal}" . ($satuan ? " ({$satuan})" : "") : 'Pilihan');

                    $kriteria = $periode->kriterias()->create([
                        'kode' => $kode,
                        'nama' => $kData['nama'],
                        'atribut' => $kData['atribut'],
                        'tipe_input' => $tipe,
                        'rentang' => $rentang,
                        'min_val' => $minVal,
                        'max_val' => $maxVal,
                        'satuan' => $satuan,
                        'bobot' => $bobot,
                    ]);

                    // Jika tipe pilihan, simpan sub-kriteria kustom dari form
                    if ($tipe === 'pilihan') {
                        $pilihanArr = $kData['pilihan'] ?? [];
                        if (! empty($pilihanArr) && is_array($pilihanArr)) {
                            foreach ($pilihanArr as $p) {
                                if (! empty($p['label'])) {
                                    $kriteria->subKriterias()->create([
                                        'label' => trim($p['label']),
                                        'nilai' => intval($p['nilai'] ?? 1),
                                    ]);
                                }
                            }
                        } else {
                            $kriteria->subKriterias()->createMany([
                                ['label' => 'Tingkat 1 / Opsi 1', 'nilai' => 1],
                                ['label' => 'Tingkat 2 / Opsi 2', 'nilai' => 2],
                                ['label' => 'Tingkat 3 / Opsi 3', 'nilai' => 3],
                                ['label' => 'Tingkat 4 / Opsi 4', 'nilai' => 4],
                                ['label' => 'Tingkat 5 / Opsi 5', 'nilai' => 5],
                            ]);
                        }
                    }
                }
            } else {
                // Buat 5 kriteria standar
                $defaultKriterias = [
                    ['kode' => 'C1', 'nama' => 'Nilai Akademik', 'atribut' => 'benefit', 'tipe_input' => 'angka', 'min_val' => 0, 'max_val' => 100, 'satuan' => '/ 100', 'rentang' => '0 – 100 (Nilai Rapor Siswa SMK)'],
                    ['kode' => 'C2', 'nama' => 'Penghasilan Orang Tua', 'atribut' => 'cost', 'tipe_input' => 'angka', 'min_val' => 0, 'max_val' => 10000000, 'satuan' => 'Rp', 'rentang' => 'Rp 0 s/d > Rp 10.000.000'],
                    ['kode' => 'C3', 'nama' => 'Tanggungan Orang Tua', 'atribut' => 'benefit', 'tipe_input' => 'pilihan', 'min_val' => 1, 'max_val' => 5, 'satuan' => 'Orang', 'rentang' => '1 s/d > 4 Orang Tanggungan'],
                    ['kode' => 'C4', 'nama' => 'Ekstrakurikuler', 'atribut' => 'benefit', 'tipe_input' => 'pilihan', 'min_val' => 1, 'max_val' => 5, 'satuan' => 'Paket', 'rentang' => 'Paket 1 s/d 5 (Pramuka, Komputer, Paskibra, Olahraga, PMR)'],
                    ['kode' => 'C5', 'nama' => 'Ketidakhadiran', 'atribut' => 'cost', 'tipe_input' => 'angka', 'min_val' => 0, 'max_val' => 30, 'satuan' => 'Hari', 'rentang' => '0 – > 5 Hari Alpa'],
                ];
                foreach ($defaultKriterias as $kData) {
                    $kode = $kData['kode'];
                    $bobot = $ahpResult['weights'][$kode] ?? 0.20;
                    $kriteria = $periode->kriterias()->create([
                        'kode' => $kode,
                        'nama' => $kData['nama'],
                        'atribut' => $kData['atribut'],
                        'tipe_input' => $kData['tipe_input'],
                        'rentang' => $kData['rentang'],
                        'min_val' => $kData['min_val'] ?? 0,
                        'max_val' => $kData['max_val'] ?? 100,
                        'satuan' => $kData['satuan'] ?? null,
                        'bobot' => $bobot,
                    ]);

                    if ($kode === 'C3') {
                        $kriteria->subKriterias()->createMany([
                            ['label' => '1 Orang Tanggungan', 'nilai' => 1],
                            ['label' => '2 Orang Tanggungan', 'nilai' => 2],
                            ['label' => '3 Orang Tanggungan', 'nilai' => 3],
                            ['label' => '4 Orang Tanggungan', 'nilai' => 4],
                            ['label' => '> 4 Orang Tanggungan', 'nilai' => 5],
                        ]);
                    } elseif ($kode === 'C4') {
                        $kriteria->subKriterias()->createMany([
                            ['label' => 'Paket 1: Pramuka, Komputer, dan Paskibra', 'nilai' => 1],
                            ['label' => 'Paket 2: Komputer dan Paskibra', 'nilai' => 2],
                            ['label' => 'Paket 3: Pramuka dan Paskibra', 'nilai' => 3],
                            ['label' => 'Paket 4: Olahraga', 'nilai' => 4],
                            ['label' => 'Paket 5: Palang Merah / PMR & Organisasi', 'nilai' => 5],
                        ]);
                    }
                }
            }
        });

        return redirect()->route('periode.index')
            ->with('sukses', 'Periode seleksi dan pembobotan AHP berhasil disimpan.');
    }

    /**
     * Menampilkan form edit periode
     */
    public function edit(Periode $periode)
    {
        if ($periode->isTerkunci()) {
            return redirect()->route('periode.index')
                ->with('gagal', 'Periode sudah melewati deadline, data tidak dapat diedit.');
        }

        $kriterias = $periode->kriterias()->with('subKriterias')->get();
        $kriteriaCodes = $kriterias->pluck('kode')->toArray();

        $matrix = $periode->matriks_ahp ?? [];
        if (empty($matrix) && ! empty($kriteriaCodes)) {
            $matrix = [];
            foreach ($kriteriaCodes as $i) {
                foreach ($kriteriaCodes as $j) {
                    $matrix[$i][$j] = ($i === $j) ? 1.0 : 1.0;
                }
            }
        }

        $ahpResult = $this->ahpService->hitung($kriteriaCodes, $matrix);

        return view('periode.edit', compact('periode', 'kriterias', 'matrix', 'ahpResult'));
    }

    /**
     * Menyimpan perubahan periode
     */
    public function update(Request $request, Periode $periode)
    {
        if ($periode->isTerkunci()) {
            return redirect()->route('periode.index')
                ->with('gagal', 'Periode sudah melewati deadline, data tidak dapat diubah.');
        }

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'deadline' => 'required|date|after_or_equal:tanggal_mulai',
            'kriterias' => 'nullable|array',
            'matrix' => 'nullable|array',
        ]);

        $matrix = $request->input('matrix', $periode->matriks_ahp ?? []);
        $kriterias = $periode->kriterias()->get();
        $kriteriaCodes = ['C1', 'C2', 'C3', 'C4', 'C5'];

        $ahpResult = $this->ahpService->hitung($kriteriaCodes, $matrix);

        DB::transaction(function () use ($periode, $data, $ahpResult, $kriterias, $request) {
            $periode->update([
                'nama' => $data['nama'],
                'tahun' => $data['tahun'],
                'kuota' => $data['kuota'],
                'tanggal_mulai' => $data['tanggal_mulai'],
                'deadline' => $data['deadline'],
                'lambda_max' => $ahpResult['lambda_max'] ?? $periode->lambda_max,
                'ci' => $ahpResult['ci'] ?? $periode->ci,
                'cr' => $ahpResult['cr'] ?? $periode->cr,
                'matriks_ahp' => $ahpResult['matrix'] ?? $periode->matriks_ahp,
            ]);

            // Perbarui nama, atribut, tipe_input, rentang, dan bobot masing-masing kriteria (5 kriteria tetap)
            $inputKriterias = $request->input('kriterias', []);
            $kriteriasMap = collect($inputKriterias)->keyBy('kode');

            foreach ($kriterias as $k) {
                $updateData = [];
                if (isset($ahpResult['weights'][$k->kode])) {
                    $updateData['bobot'] = $ahpResult['weights'][$k->kode];
                }
                if ($input = $kriteriasMap->get($k->kode)) {
                    if (! empty($input['nama'])) {
                        $updateData['nama'] = $input['nama'];
                    }
                    if (! empty($input['atribut']) && in_array($input['atribut'], ['benefit', 'cost'])) {
                        $updateData['atribut'] = $input['atribut'];
                    }
                    if (! empty($input['tipe_input']) && in_array($input['tipe_input'], ['angka', 'pilihan'])) {
                        $updateData['tipe_input'] = $input['tipe_input'];
                    }
                    $tipe = $input['tipe_input'] ?? $k->tipe_input;
                    if ($tipe === 'angka') {
                        $minVal = isset($input['min_val']) ? floatval($input['min_val']) : ($k->min_val ?? 0);
                        $maxVal = isset($input['max_val']) ? floatval($input['max_val']) : ($k->max_val ?? 100);
                        $satuan = $input['satuan'] ?? $k->satuan;
                        $updateData['min_val'] = $minVal;
                        $updateData['max_val'] = $maxVal;
                        $updateData['satuan'] = $satuan;
                        if (! empty($input['rentang'])) {
                            $updateData['rentang'] = $input['rentang'];
                        } else {
                            $updateData['rentang'] = "Rentang: {$minVal} s/d {$maxVal}" . ($satuan ? " ({$satuan})" : '');
                        }
                    } else {
                        // Tipe input pilihan: update atau buat sub-kriteria kustom dari user
                        $pilihanInputs = $input['pilihan'] ?? [];
                        if (! empty($pilihanInputs) && is_array($pilihanInputs)) {
                            $k->subKriterias()->delete();
                            $labels = [];
                            foreach ($pilihanInputs as $p) {
                                if (! empty($p['label'])) {
                                    $k->subKriterias()->create([
                                        'label' => trim($p['label']),
                                        'nilai' => intval($p['nilai'] ?? 1),
                                    ]);
                                    $labels[] = trim($p['label']);
                                }
                            }
                            $updateData['rentang'] = ! empty($labels) ? 'Pilihan: ' . implode(', ', array_slice($labels, 0, 3)) . (count($labels) > 3 ? '...' : '') : 'Pilihan sub-kriteria';
                        } elseif (isset($input['rentang'])) {
                            $updateData['rentang'] = $input['rentang'];
                        }
                    }
                }
                if (! empty($updateData)) {
                    $k->update($updateData);
                }

                // Pastikan subkriteria terisi jika tipe_input adalah pilihan dan masih kosong
                if ($k->tipe_input === 'pilihan' && $k->subKriterias()->count() === 0) {
                    if ($k->kode === 'C3') {
                        $k->subKriterias()->createMany([
                            ['label' => '1 Orang Tanggungan', 'nilai' => 1],
                            ['label' => '2 Orang Tanggungan', 'nilai' => 2],
                            ['label' => '3 Orang Tanggungan', 'nilai' => 3],
                            ['label' => '4 Orang Tanggungan', 'nilai' => 4],
                            ['label' => '> 4 Orang Tanggungan', 'nilai' => 5],
                        ]);
                    } elseif ($k->kode === 'C4') {
                        $k->subKriterias()->createMany([
                            ['label' => 'Paket 1: Pramuka, Komputer, dan Paskibra', 'nilai' => 1],
                            ['label' => 'Paket 2: Komputer dan Paskibra', 'nilai' => 2],
                            ['label' => 'Paket 3: Pramuka dan Paskibra', 'nilai' => 3],
                            ['label' => 'Paket 4: Olahraga', 'nilai' => 4],
                            ['label' => 'Paket 5: Palang Merah / PMR & Organisasi', 'nilai' => 5],
                        ]);
                    } else {
                        $k->subKriterias()->createMany([
                            ['label' => 'Tingkat 1 / Opsi 1', 'nilai' => 1],
                            ['label' => 'Tingkat 2 / Opsi 2', 'nilai' => 2],
                            ['label' => 'Tingkat 3 / Opsi 3', 'nilai' => 3],
                            ['label' => 'Tingkat 4 / Opsi 4', 'nilai' => 4],
                            ['label' => 'Tingkat 5 / Opsi 5', 'nilai' => 5],
                        ]);
                    }
                }
            }

            // Hitung ulang SAW jika terdapat calon terdaftar
            if ($periode->calonPenerimas()->count() > 0) {
                $this->sawService->hitung($periode);
            }
        });

        return redirect()->route('periode.index')
            ->with('sukses', 'Periode seleksi dan pembobotan kriteria AHP berhasil diperbarui.');
    }

    /**
     * Hapus periode
     */
    public function destroy(Periode $periode)
    {
        $namaPeriode = $periode->nama;

        DB::transaction(function () use ($periode) {
            foreach ($periode->calonPenerimas as $calon) {
                $calon->penilaians()->delete();
                $calon->delete();
            }
            foreach ($periode->kriterias as $kriteria) {
                $kriteria->subKriterias()->delete();
                $kriteria->delete();
            }
            $periode->delete();
        });

        return redirect()->route('periode.index')
            ->with('sukses', "Periode seleksi '{$namaPeriode}' beserta data kriteria dan calon siswa berhasil dihapus.");
    }

    /**
     * Finalisasi periode seleksi
     */
    public function finalisasi(Periode $periode)
    {
        $periode->update(['is_final' => true]);

        return redirect()->route('periode.index')
            ->with('sukses', "Periode {$periode->nama} berhasil difinalisasi.");
    }

    /**
     * API AJAX untuk perhitungan matriks AHP real-time
     */
    public function hitungAhp(Request $request)
    {
        $matrix = $request->input('matrix', []);
        $kriterias = $request->input('kriterias', ['C1', 'C2', 'C3', 'C4', 'C5']);

        $result = $this->ahpService->hitung($kriterias, $matrix);

        return response()->json($result);
    }
}
