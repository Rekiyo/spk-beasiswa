<?php

namespace App\Http\Controllers;

use App\Models\CalonPenerima;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Periode;
use App\Services\SawService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeleksiController extends Controller
{
    public function __construct(
        protected SawService $sawService
    ) {}

    /**
     * Tampilkan halaman Kelola Seleksi & Perangkingan (Image 4)
     */
    public function index(Request $request, Periode $periode)
    {
        $kriterias = $periode->kriterias()->with('subKriterias')->orderBy('kode')->get();

        // Filter & Search
        $query = $periode->calonPenerimas()
            ->with(['penilaians.kriteria', 'penilaians.subKriteria']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('program_studi', 'like', "%{$search}%");
            });
        }

        if ($status = $request->input('status')) {
            if ($status === 'lolos') {
                $query->where('status_kelulusan', 'lolos');
            } elseif ($status === 'cadangan') {
                $query->where('status_kelulusan', 'cadangan');
            } elseif ($status === 'tidak_lolos') {
                $query->where('status_kelulusan', 'tidak_lolos');
            }
        }

        // Sorting
        $sort = $request->input('sort', 'rank_asc');
        if ($sort === 'rank_desc') {
            $query->orderByDesc('ranking');
        } elseif ($sort === 'nama_asc') {
            $query->orderBy('nama');
        } elseif ($sort === 'skor_asc') {
            $query->orderBy('skor_saw');
        } else {
            $query->orderBy('ranking');
        }

        $totalCalon = $periode->calonPenerimas()->count();
        $totalLolos = $periode->calonPenerimas()->where('status_kelulusan', 'lolos')->count();
        $totalCadangan = $periode->calonPenerimas()->where('status_kelulusan', 'cadangan')->count();
        $totalTidakLolos = $periode->calonPenerimas()->where('status_kelulusan', 'tidak_lolos')->count();

        // Paginate results
        $calonPenerimas = $query->paginate(15)->withQueryString();

        return view('seleksi.index', compact(
            'periode',
            'kriterias',
            'calonPenerimas',
            'totalCalon',
            'totalLolos',
            'totalCadangan',
            'totalTidakLolos'
        ));
    }

    /**
     * Simpan data calon siswa baru atau perbarui nilai kriteria
     */
    public function store(Request $request, Periode $periode)
    {
        if ($periode->isTerkunci()) {
            return back()->with('gagal', 'Periode seleksi telah ditutup dan terkunci.');
        }

        $kriterias = $periode->kriterias()->get();
        if ($kriterias->isEmpty()) {
            return back()->with('gagal', 'Kriteria seleksi belum dikonfigurasi untuk periode ini.');
        }

        $validated = $request->validate([
            'calon_id' => 'nullable|integer',
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:30',
            'program_studi' => 'required|string|max:255',
            'semester' => 'nullable|string|max:50',
            'jalur' => 'nullable|string|max:100',
            'nilai' => 'required|array',
            'sub_kriteria' => 'nullable|array',
        ]);

        $isEdit = ! empty($validated['calon_id']);
        $namaSiswa = $validated['nama'];

        DB::transaction(function () use ($periode, $validated, $kriterias, &$namaSiswa) {
            $calonId = $validated['calon_id'] ?? null;
            if ($calonId) {
                $calon = CalonPenerima::where('periode_id', $periode->id)->findOrFail($calonId);
                $calon->update([
                    'nim' => $validated['nim'],
                    'nama' => $validated['nama'],
                    'program_studi' => $validated['program_studi'],
                    'semester' => $validated['semester'] ?? 'Kelas XII',
                    'jalur' => $validated['jalur'] ?? 'Reguler Prestasi SMK',
                ]);
            } else {
                $calon = CalonPenerima::updateOrCreate(
                    ['periode_id' => $periode->id, 'nim' => $validated['nim']],
                    [
                        'nama' => $validated['nama'],
                        'program_studi' => $validated['program_studi'],
                        'semester' => $validated['semester'] ?? 'Kelas XII',
                        'jalur' => $validated['jalur'] ?? 'Reguler Prestasi SMK',
                    ]
                );
            }

            $namaSiswa = $calon->nama;

            foreach ($kriterias as $k) {
                $nilaiRaw = $validated['nilai'][$k->id] ?? null;
                $subKriteriaId = $validated['sub_kriteria'][$k->id] ?? null;

                // Bersihkan nilai angka jika ada format ribuan / string / mata uang
                if (is_string($nilaiRaw)) {
                    $nilaiClean = trim(str_replace(['Rp', 'rp', ' '], '', $nilaiRaw));
                    // Jika ada koma sebagai pemisah desimal (misal 85,50)
                    if (str_contains($nilaiClean, ',') && ! str_contains($nilaiClean, '.')) {
                        $nilaiClean = str_replace(',', '.', $nilaiClean);
                    } else {
                        // Hilangkan titik ribuan jika ada (misal 2.500.000)
                        $nilaiClean = str_replace('.', '', $nilaiClean);
                        $nilaiClean = str_replace(',', '.', $nilaiClean);
                    }
                    $nilaiFloat = floatval($nilaiClean);
                } else {
                    $nilaiFloat = floatval($nilaiRaw);
                }

                // Jika sub_kriteria_id belum diset tetapi kriteria memiliki sub-kriteria, cari berdasarkan nilai
                if (! $subKriteriaId && $k->subKriterias()->exists()) {
                    $subKriteriaId = $k->subKriterias()->where('nilai', intval($nilaiFloat))->value('id');
                }

                Penilaian::updateOrCreate(
                    ['calon_penerima_id' => $calon->id, 'kriteria_id' => $k->id],
                    [
                        'nilai' => $nilaiFloat,
                        'sub_kriteria_id' => $subKriteriaId,
                    ]
                );
            }

            // Hitung ulang seluruh ranking SAW secara otomatis
            $this->sawService->hitung($periode);
        });

        $suksesMsg = $isEdit
            ? "Data siswa {$namaSiswa} berhasil diperbarui dan ranking SAW dihitung ulang."
            : "Data siswa {$namaSiswa} berhasil ditambahkan dan ranking SAW dihitung ulang.";

        return redirect()->route('periode.seleksi', $periode)
            ->with('sukses', $suksesMsg);
    }

    /**
     * Import calon penerima via CSV
     */
    public function import(Request $request, Periode $periode)
    {
        if ($periode->isTerkunci()) {
            return back()->with('gagal', 'Periode seleksi telah ditutup.');
        }

        $request->validate([
            'file_csv' => 'nullable|file|mimes:csv,txt|max:4096',
            'raw_csv' => 'nullable|string',
        ]);

        $content = '';
        if ($request->hasFile('file_csv')) {
            $content = file_get_contents($request->file('file_csv')->getRealPath());
        } elseif ($request->filled('raw_csv')) {
            $content = $request->input('raw_csv');
        }

        if (empty(trim($content))) {
            return back()->with('gagal', 'Harap pilih file CSV atau tempelkan data teks CSV.');
        }

        $kriterias = $periode->kriterias()->orderBy('kode')->get();
        if ($kriterias->isEmpty()) {
            return back()->with('gagal', 'Kriteria seleksi belum dikonfigurasi untuk periode ini.');
        }

        $lines = preg_split('/\r\n|\r|\n/', trim($content));
        $importedCount = 0;

        DB::transaction(function () use ($lines, $periode, $kriterias, &$importedCount) {
            $headerSkipped = false;
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) {
                    continue;
                }

                $cols = str_getcsv($line, ',');
                if (count($cols) < 5) {
                    $cols = str_getcsv($line, ';');
                }

                // Cek jika baris header
                $firstCol = strtolower(trim($cols[0] ?? ''));
                if (! $headerSkipped && (str_contains($firstCol, 'nisn') || str_contains($firstCol, 'nim') || str_contains($firstCol, 'no'))) {
                    $headerSkipped = true;
                    continue;
                }

                if (count($cols) < 3) {
                    continue;
                }

                $nim = trim($cols[0] ?? '');
                $nama = trim($cols[1] ?? '');
                $prodi = trim($cols[2] ?? 'Rekayasa Perangkat Lunak');
                $kelas = trim($cols[3] ?? 'Kelas XII');

                if (empty($nim) || empty($nama)) {
                    continue;
                }

                $calon = CalonPenerima::updateOrCreate(
                    ['periode_id' => $periode->id, 'nim' => $nim],
                    [
                        'nama' => $nama,
                        'program_studi' => $prodi,
                        'semester' => $kelas,
                        'jalur' => 'Reguler Prestasi SMK',
                    ]
                );

                // Default skor jika index 4..8 disediakan
                $c1 = isset($cols[4]) ? floatval(str_replace(['Rp', '.', ' '], '', $cols[4])) : 85.0;
                $c2 = isset($cols[5]) ? floatval(str_replace(['Rp', '.', ' '], '', $cols[5])) : 2500000;
                $c3 = isset($cols[6]) ? intval($cols[6]) : 3;
                $c4 = isset($cols[7]) ? intval($cols[7]) : 4;
                $c5 = isset($cols[8]) ? intval($cols[8]) : 0;

                $scores = ['C1' => $c1, 'C2' => $c2, 'C3' => $c3, 'C4' => $c4, 'C5' => $c5];

                foreach ($kriterias as $k) {
                    $val = $scores[$k->kode] ?? 80.0;
                    $subId = null;
                    if ($k->subKriterias()->exists()) {
                        $subId = $k->subKriterias()->where('nilai', intval($val))->value('id');
                    }

                    Penilaian::updateOrCreate(
                        ['calon_penerima_id' => $calon->id, 'kriteria_id' => $k->id],
                        [
                            'nilai' => $val,
                            'sub_kriteria_id' => $subId,
                        ]
                    );
                }

                $importedCount++;
            }

            if ($importedCount > 0) {
                $this->sawService->hitung($periode);
            }
        });

        if ($importedCount === 0) {
            return back()->with('gagal', 'Format data CSV tidak terbaca. Pastikan baris data memiliki NISN dan Nama Siswa.');
        }

        return redirect()->route('periode.seleksi', $periode)
            ->with('sukses', "Berhasil mengimpor {$importedCount} data siswa dan memperbarui perangkingan SAW.");
    }

    /**
     * Download format template CSV
     */
    public function templateCsv(Periode $periode)
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="template_siswa_beasiswa_smk.csv"',
        ];

        $callback = function () {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF"); // UTF-8 BOM
            fputcsv($file, ['NISN', 'Nama Siswa', 'Jurusan SMK', 'Kelas', 'C1_Nilai_Rapor', 'C2_Penghasilan_Ortu', 'C3_Tanggungan', 'C4_Paket_Ekskul', 'C5_Ketidakhadiran_Hari']);
            fputcsv($file, ['0081234561', 'Budi Santoso', 'Rekayasa Perangkat Lunak', 'XII RPL 1', '89.50', '2000000', '3', '4', '0']);
            fputcsv($file, ['0081234562', 'Siti Rahmawati', 'Teknik Komputer & Jaringan', 'XII TKJ 2', '92.00', '1500000', '4', '5', '1']);
            fputcsv($file, ['0081234563', 'Andi Pratama', 'Desain Komunikasi Visual', 'XII DKV 1', '87.20', '3500000', '2', '2', '0']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Hapus calon penerima
     */
    public function destroy(Periode $periode, CalonPenerima $calonPenerima)
    {
        if ($calonPenerima->periode_id !== $periode->id) {
            abort(404);
        }

        $namaSiswa = $calonPenerima->nama;

        DB::transaction(function () use ($periode, $calonPenerima) {
            $calonPenerima->penilaians()->delete();
            $calonPenerima->delete();

            // Hitung ulang SAW jika masih ada calon siswa
            $this->sawService->hitung($periode);
        });

        return back()->with('sukses', "Data siswa {$namaSiswa} berhasil dihapus dari daftar seleksi.");
    }

    /**
     * Export Laporan Keputusan SK Beasiswa
     */
    public function exportSk(Periode $periode)
    {
        $kriterias = $periode->kriterias()->orderBy('kode')->get();
        $lolosCalon = $periode->calonPenerimas()
            ->where('status_kelulusan', 'lolos')
            ->orderBy('ranking')
            ->get();

        $cadanganCalon = $periode->calonPenerimas()
            ->where('status_kelulusan', 'cadangan')
            ->orderBy('ranking')
            ->get();

        return view('seleksi.export', compact('periode', 'kriterias', 'lolosCalon', 'cadanganCalon'));
    }
}
