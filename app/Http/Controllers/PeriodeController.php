<?php

namespace App\Http\Controllers;

use App\Models\KonfigurasiSeleksi;
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
     * Menampilkan formulir pembuatan periode baru dengan pemilihan konfigurasi seleksi
     */
    public function create()
    {
        $konfigurasis = KonfigurasiSeleksi::with(['kriterias.subKriterias'])
            ->where('is_siap', true)
            ->where('is_konsisten', true)
            ->orderByDesc('id')
            ->get();

        return view('periode.create', compact('konfigurasis'));
    }

    /**
     * Menyimpan periode baru beserta paket konfigurasi seleksi terpilih
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'kuota' => 'required|integer|min:1',
            'total_siswa' => 'nullable|integer|min:0',
            'ambang_batas' => 'nullable|numeric|between:0,1',
            'tanggal_mulai' => 'required|date',
            'deadline' => 'required|date|after_or_equal:tanggal_mulai',
            'konfigurasi_seleksi_id' => 'required|exists:konfigurasi_seleksis,id',
        ]);

        $konfigurasi = KonfigurasiSeleksi::with(['kriterias.subKriterias'])
            ->findOrFail($data['konfigurasi_seleksi_id']);

        if (! $konfigurasi->is_siap || ! $konfigurasi->is_konsisten) {
            return back()->withInput()->with('gagal', 'Paket konfigurasi seleksi yang dipilih belum memenuhi syarat konsistensi AHP atau belum berstatus siap.');
        }

        DB::transaction(function () use ($data, $konfigurasi, &$periode) {
            $periode = Periode::create([
                'nama' => $data['nama'],
                'tahun' => $data['tahun'],
                'kuota' => $data['kuota'],
                'total_siswa' => isset($data['total_siswa']) ? intval($data['total_siswa']) : 0,
                'ambang_batas' => isset($data['ambang_batas']) && $data['ambang_batas'] !== null ? floatval($data['ambang_batas']) : SawService::AMBANG_BATAS,
                'tanggal_mulai' => $data['tanggal_mulai'],
                'deadline' => $data['deadline'],
                'konfigurasi_seleksi_id' => $konfigurasi->id,
                'lambda_max' => $konfigurasi->lambda_max,
                'ci' => $konfigurasi->ci,
                'cr' => $konfigurasi->cr,
                'matriks_ahp' => $konfigurasi->matriks_ahp,
                'is_final' => false,
            ]);

            // Salin / Snapshot 5 kriteria beserta sub-kriterianya ke periode ini
            foreach ($konfigurasi->kriterias as $kData) {
                $kriteria = $periode->kriterias()->create([
                    'kode' => $kData->kode,
                    'nama' => $kData->nama,
                    'atribut' => $kData->atribut,
                    'tipe_input' => $kData->tipe_input,
                    'rentang' => $kData->rentang,
                    'min_val' => $kData->min_val,
                    'max_val' => $kData->max_val,
                    'satuan' => $kData->satuan,
                    'bobot' => $kData->bobot,
                ]);

                if ($kData->tipe_input === 'pilihan') {
                    foreach ($kData->subKriterias as $sub) {
                        $kriteria->subKriterias()->create([
                            'label' => $sub->label,
                            'nilai' => $sub->nilai,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('periode.index')
            ->with('sukses', "Periode seleksi '{$periode->nama}' berhasil dibuat menggunakan paket konfigurasi '{$konfigurasi->nama}'.");
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
            'total_siswa' => 'nullable|integer|min:0',
            'ambang_batas' => 'nullable|numeric|between:0,1',
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
                'total_siswa' => array_key_exists('total_siswa', $data) ? (intval($data['total_siswa']) ?: 0) : $periode->total_siswa,
                'ambang_batas' => array_key_exists('ambang_batas', $data) && $data['ambang_batas'] !== null ? floatval($data['ambang_batas']) : $periode->ambang_batas,
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
                            $updateData['rentang'] = "Rentang: {$minVal} s/d {$maxVal}".($satuan ? " ({$satuan})" : '');
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
                            $updateData['rentang'] = ! empty($labels) ? 'Pilihan: '.implode(', ', array_slice($labels, 0, 3)).(count($labels) > 3 ? '...' : '') : 'Pilihan sub-kriteria';
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
                            ['label' => 'Paket 5: Pakata', 'nilai' => 5],
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
