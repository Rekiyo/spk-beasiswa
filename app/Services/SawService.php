<?php

namespace App\Services;

use App\Models\CalonPenerima;
use App\Models\Periode;
use Illuminate\Support\Facades\DB;

class SawService
{
    /**
     * Ambang batas kelulusan default V_i
     */
    public const AMBANG_BATAS = 0.800;

    /**
     * Hitung SAW dan perbarui ranking calon penerima pada periode
     *
     * @return array Hasil rekapitulasi lengkap
     */
    public function hitung(Periode $periode): array
    {
        $kriterias = $periode->kriterias()->orderBy('kode')->get();
        $calonList = $periode->calonPenerimas()->with(['penilaians'])->get();

        if ($kriterias->isEmpty() || $calonList->isEmpty()) {
            return [
                'kriterias' => $kriterias,
                'calon_list' => $calonList,
                'matrix_x' => [],
                'matrix_r' => [],
                'weights' => [],
                'min_max' => [],
            ];
        }

        // 1. Ekstrak bobot kriteria (W)
        $weights = [];
        $totalWeight = $kriterias->sum(fn ($k) => floatval($k->bobot));
        foreach ($kriterias as $k) {
            if ($totalWeight > 0) {
                $weights[$k->id] = floatval($k->bobot) / $totalWeight;
            } else {
                $weights[$k->id] = 1.0 / $kriterias->count();
            }
        }

        // 2. Matriks Keputusan Asli X[calon_id][kriteria_id]
        $matrixX = [];
        foreach ($calonList as $c) {
            $penilaianMap = $c->penilaians->keyBy('kriteria_id');
            foreach ($kriterias as $k) {
                $p = $penilaianMap->get($k->id);
                $val = $p ? floatval($p->nilai) : 0.0;
                $matrixX[$c->id][$k->id] = $val;
            }
        }

        // 3. Tentukan nilai Max dan Min untuk setiap kriteria
        $minMax = [];
        foreach ($kriterias as $k) {
            $values = [];
            foreach ($calonList as $c) {
                $values[] = $matrixX[$c->id][$k->id] ?? 0.0;
            }
            $maxVal = ! empty($values) ? max($values) : 1.0;
            $minVal = ! empty($values) ? min(array_filter($values, fn ($v) => $v > 0) ?: [1.0]) : 1.0;

            $minMax[$k->id] = [
                'max' => $maxVal > 0 ? $maxVal : 1.0,
                'min' => $minVal > 0 ? $minVal : 1.0,
                'atribut' => strtolower($k->atribut),
            ];
        }

        // 4. Normalisasi Matriks R[calon_id][kriteria_id]
        $matrixR = [];
        $scores = [];

        foreach ($calonList as $c) {
            $preferenceVi = 0.0;
            foreach ($kriterias as $k) {
                $x = $matrixX[$c->id][$k->id] ?? 0.0;
                $attrib = $minMax[$k->id]['atribut'];
                $maxVal = $minMax[$k->id]['max'];
                $minVal = $minMax[$k->id]['min'];

                if ($attrib === 'benefit') {
                    $r = $maxVal > 0 ? ($x / $maxVal) : 0.0;
                } else { // cost
                    if ($x <= 0) {
                        // Ketidakhadiran 0 hari atau penghasilan 0 adalah nilai terbaik untuk kriteria cost
                        $r = 1.0;
                    } else {
                        $r = $minVal > 0 ? ($minVal / $x) : (1.0 / (1.0 + $x));
                    }
                }

                $matrixR[$c->id][$k->id] = round(min(1.0, max(0.0, $r)), 4);
                $preferenceVi += $weights[$k->id] * $matrixR[$c->id][$k->id];
            }

            $scores[$c->id] = round($preferenceVi, 4);
        }

        // 5. Urutkan berdasarkan Skor V_i Descending dengan aturan Tie-Breaker yang konsisten:
        // Prioritas 1: Skor preferensi Vi tertinggi
        // Prioritas 2 (Tie-breaker 1): Nilai Akademik C1 tertinggi (kriteria benefit utama SMK)
        // Prioritas 3 (Tie-breaker 2): Nilai Penghasilan Orang Tua C2 terendah (kebutuhan ekonomi prioritas)
        // Prioritas 4 (Tie-breaker 3): Tingkat Ketidakhadiran C5 terendah (kedisiplinan siswa)
        // Prioritas 5 (Tie-breaker 4): Pendaftaran lebih awal (ID calon penerima lebih kecil)
        $kriteriaByKode = $kriterias->keyBy('kode');
        $c1Id = $kriteriaByKode->get('C1')?->id;
        $c2Id = $kriteriaByKode->get('C2')?->id;
        $c5Id = $kriteriaByKode->get('C5')?->id;

        $calonSorted = $calonList->sort(function ($a, $b) use ($scores, $matrixX, $c1Id, $c2Id, $c5Id) {
            $skorA = $scores[$a->id] ?? 0.0;
            $skorB = $scores[$b->id] ?? 0.0;

            if (abs($skorB - $skorA) > 0.00001) {
                return $skorB <=> $skorA;
            }

            if ($c1Id !== null) {
                $c1A = floatval($matrixX[$a->id][$c1Id] ?? 0);
                $c1B = floatval($matrixX[$b->id][$c1Id] ?? 0);
                if (abs($c1B - $c1A) > 0.00001) {
                    return $c1B <=> $c1A;
                }
            }

            if ($c2Id !== null) {
                $c2A = floatval($matrixX[$a->id][$c2Id] ?? 0);
                $c2B = floatval($matrixX[$b->id][$c2Id] ?? 0);
                if (abs($c2A - $c2B) > 0.00001) {
                    return $c2A <=> $c2B;
                }
            }

            if ($c5Id !== null) {
                $c5A = floatval($matrixX[$a->id][$c5Id] ?? 0);
                $c5B = floatval($matrixX[$b->id][$c5Id] ?? 0);
                if (abs($c5A - $c5B) > 0.00001) {
                    return $c5A <=> $c5B;
                }
            }

            return $a->id <=> $b->id;
        })->values();

        // 6. Tentukan Ranking & Status Kelulusan Berdasarkan Kuota Utama & Cadangan:
        // - Lolos: Siswa peringkat 1 sampai kuota penerima
        // - Cadangan: Siswa di luar kuota utama tetapi masih masuk batas cadangan (sama dengan kuota penerima: kuota + 1 s/d kuota * 2)
        // - Tidak Lolos: Siswa di luar kuota dan batas cadangan
        $kuota = max(1, intval($periode->kuota));
        $cadanganLimit = $kuota * 2; // Alokasi cadangan sama dengan kuota penerima

        $rankings = [];
        $rank = 1;
        $cutoffKuota = null;

        DB::transaction(function () use ($calonSorted, $scores, $kuota, $cadanganLimit, &$rankings, &$rank, &$cutoffKuota) {
            foreach ($calonSorted as $calon) {
                $calonId = $calon->id;
                $skorVi = $scores[$calonId] ?? 0.0;

                if ($rank <= $kuota) {
                    $status = 'lolos';
                    // Cutoff visual kuota adalah skor siswa peringkat terakhir dalam kuota
                    $cutoffKuota = $skorVi;
                } elseif ($rank <= $cadanganLimit) {
                    $status = 'cadangan';
                } else {
                    $status = 'tidak_lolos';
                }

                CalonPenerima::where('id', $calonId)->update([
                    'skor_saw' => $skorVi,
                    'ranking' => $rank,
                    'status_kelulusan' => $status,
                ]);

                $rankings[$calonId] = [
                    'ranking' => $rank,
                    'skor_saw' => $skorVi,
                    'status' => $status,
                ];

                $rank++;
            }
        });

        // Muat ulang data terbaru calon penerima terurut ranking
        $updatedCalonList = $periode->calonPenerimas()
            ->with(['penilaians.kriteria', 'penilaians.subKriteria'])
            ->orderBy('ranking')
            ->get();

        return [
            'kriterias' => $kriterias,
            'calon_list' => $updatedCalonList,
            'matrix_x' => $matrixX,
            'matrix_r' => $matrixR,
            'weights' => $weights,
            'min_max' => $minMax,
            'cutoff_kuota' => $cutoffKuota,
        ];
    }
}
