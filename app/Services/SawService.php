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

        // 5. Urutkan berdasarkan Skor V_i Descending
        arsort($scores);

        // 6. Tentukan Ranking & Status Kelulusan
        $kuota = max(1, intval($periode->kuota));
        $cadanganLimit = $kuota + min(10, max(3, $kuota));

        $rankings = [];
        $rank = 1;

        DB::transaction(function () use ($scores, $kuota, $cadanganLimit, &$rankings, &$rank) {
            foreach ($scores as $calonId => $skorVi) {
                if ($rank <= $kuota) {
                    $status = 'lolos';
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
        ];
    }
}
