<?php

namespace App\Services;

class AhpService
{
    /**
     * Tabel Random Index (RI) standar Saaty untuk ukuran matriks n = 1 .. 10
     */
    private const RANDOM_INDEX = [
        1 => 0.00,
        2 => 0.00,
        3 => 0.58,
        4 => 0.90,
        5 => 1.12,
        6 => 1.24,
        7 => 1.32,
        8 => 1.41,
        9 => 1.45,
        10 => 1.49,
    ];

    /**
     * Hitung AHP dari pairwise comparison matrix
     *
     * @param  array<int|string>  $kriteriaKeys  Daftar kode atau ID kriteria, misal ['C1', 'C2', 'C3', 'C4', 'C5']
     * @param  array<string, array<string, float>>  $matrix  Matriks perbandingan berpasangan A[i][j]
     */
    public function hitung(array $kriteriaKeys, array $matrix): array
    {
        $n = count($kriteriaKeys);
        if ($n === 0) {
            return [
                'weights' => [],
                'lambda_max' => 0.0,
                'ci' => 0.0,
                'ri' => 0.0,
                'cr' => 0.0,
                'is_consistent' => true,
                'matrix' => [],
                'normalized' => [],
                'column_sums' => [],
            ];
        }

        // 1. Lengkapi dan pastikan konsistensi matriks A:
        // A[i][i] = 1, dan jika A[i][j] bernilai v, maka A[j][i] = 1/v
        $fullMatrix = [];
        foreach ($kriteriaKeys as $i) {
            $fullMatrix[$i] = [];
            foreach ($kriteriaKeys as $j) {
                if ($i === $j) {
                    $fullMatrix[$i][$j] = 1.0;
                } elseif (isset($matrix[$i][$j]) && floatval($matrix[$i][$j]) > 0) {
                    $val = floatval($matrix[$i][$j]);
                    $fullMatrix[$i][$j] = $val;
                } elseif (isset($matrix[$j][$i]) && floatval($matrix[$j][$i]) > 0) {
                    $fullMatrix[$i][$j] = 1.0 / floatval($matrix[$j][$i]);
                } else {
                    $fullMatrix[$i][$j] = 1.0;
                }
            }
        }

        // 2. Hitung jumlah setiap kolom (sum column)
        $colSums = [];
        foreach ($kriteriaKeys as $j) {
            $sum = 0.0;
            foreach ($kriteriaKeys as $i) {
                $sum += $fullMatrix[$i][$j];
            }
            $colSums[$j] = $sum > 0 ? $sum : 1.0;
        }

        // 3. Normalisasi matriks & hitung Eigen Vektor (Priority Weights W_i)
        $normalized = [];
        $weights = [];
        foreach ($kriteriaKeys as $i) {
            $rowSum = 0.0;
            $normalized[$i] = [];
            foreach ($kriteriaKeys as $j) {
                $normVal = $fullMatrix[$i][$j] / $colSums[$j];
                $normalized[$i][$j] = $normVal;
                $rowSum += $normVal;
            }
            $weights[$i] = round($rowSum / $n, 5);
        }

        // Pastikan normalisasi total bobot = 1.000
        $sumWeights = array_sum($weights);
        if ($sumWeights > 0 && abs($sumWeights - 1.0) > 0.0001) {
            foreach ($weights as $k => $w) {
                $weights[$k] = round($w / $sumWeights, 5);
            }
        }

        // 4. Hitung Lambda Max (Principal Eigenvalue)
        // WSV (Weighted Sum Vector): v_i = sum_j (A[i][j] * W[j])
        // lambda_i = v_i / W[i]
        // lambda_max = average(lambda_i)
        $lambdaList = [];
        foreach ($kriteriaKeys as $i) {
            $wsv = 0.0;
            foreach ($kriteriaKeys as $j) {
                $wsv += $fullMatrix[$i][$j] * $weights[$j];
            }
            $wi = $weights[$i] > 0 ? $weights[$i] : 0.00001;
            $lambdaList[] = $wsv / $wi;
        }
        $lambdaMax = $n > 0 ? array_sum($lambdaList) / $n : 0.0;

        // 5. Hitung Consistency Index (CI) & Consistency Ratio (CR)
        $ci = $n > 1 ? ($lambdaMax - $n) / ($n - 1) : 0.0;
        $ci = max(0.0, $ci);

        $ri = self::RANDOM_INDEX[$n] ?? 1.49;
        $cr = ($ri > 0) ? ($ci / $ri) : 0.0;

        $isConsistent = ($cr <= 0.10);

        return [
            'matrix' => $fullMatrix,
            'column_sums' => $colSums,
            'normalized' => $normalized,
            'weights' => $weights,
            'lambda_max' => round($lambdaMax, 4),
            'ci' => round($ci, 4),
            'ri' => round($ri, 3),
            'cr' => round($cr, 4),
            'is_consistent' => $isConsistent,
        ];
    }
}
