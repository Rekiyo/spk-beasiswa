<?php

namespace Tests\Unit;

use App\Services\AhpService;
use PHPUnit\Framework\TestCase;

class AhpServiceTest extends TestCase
{
    protected AhpService $ahpService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ahpService = new AhpService;
    }

    /**
     * Memverifikasi perhitungan AHP dengan matriks referensi Excel SPK Beasiswa
     */
    public function test_perhitungan_ahp_sesuai_dengan_matriks_referensi_excel(): void
    {
        $keys = ['C1', 'C2', 'C3', 'C4', 'C5'];

        // Matriks berpasangan perbandingan Saaty sesuai screenshot referensi
        // Hanya segitiga atas yang perlu didefinisikan (segitiga bawah dihitung otomatis sebagai 1/v)
        $matrix = [
            'C1' => ['C2' => 2.0, 'C3' => 3.0, 'C4' => 4.0, 'C5' => 3.0],
            'C2' => ['C3' => 2.0, 'C4' => 3.0, 'C5' => 2.0],
            'C3' => ['C4' => 2.0, 'C5' => 2.0],
            'C4' => ['C5' => 2.0],
        ];

        $result = $this->ahpService->hitung($keys, $matrix);

        // 1. Verifikasi Elemen Matriks Normalisasi (A_norm[i][j] = A[i][j] / ColSum[j])
        // Memverifikasi baris C1 normalisasi: 0.4138, 0.4615, 0.4286, 0.3810, 0.3000
        $this->assertEquals(0.41, round($result['normalized']['C1']['C1'], 2));
        $this->assertEquals(0.46, round($result['normalized']['C1']['C2'], 2));
        $this->assertEquals(0.43, round($result['normalized']['C1']['C3'], 2));
        $this->assertEquals(0.38, round($result['normalized']['C1']['C4'], 2));
        $this->assertEquals(0.30, round($result['normalized']['C1']['C5'], 2));

        // 2. Verifikasi Vektor Bobot Prioritas W_i (Presisi Penuh vs Excel)
        // Nilai presisi penuh matematis:
        $this->assertEqualsWithDelta(0.396971074902, $result['weights']['C1'], 1e-8);
        $this->assertEqualsWithDelta(0.241818870784, $result['weights']['C2'], 1e-8);
        $this->assertEqualsWithDelta(0.157329796640, $result['weights']['C3'], 1e-8);
        $this->assertEqualsWithDelta(0.109407603890, $result['weights']['C4'], 1e-8);
        $this->assertEqualsWithDelta(0.094472653783, $result['weights']['C5'], 1e-8);

        // Tampilan 2 desimal sesuai kolom "Average (Bobot Prioritas)" di Excel:
        // C1 = 0.40; C2 = 0.24; C3 = 0.16; C4 = 0.11; C5 = 0.09
        $this->assertEquals(0.40, round($result['weights']['C1'], 2));
        $this->assertEquals(0.24, round($result['weights']['C2'], 2));
        $this->assertEquals(0.16, round($result['weights']['C3'], 2));
        $this->assertEquals(0.11, round($result['weights']['C4'], 2));
        $this->assertEquals(0.09, round($result['weights']['C5'], 2));

        // Total bobot = 1.000000000
        $this->assertEqualsWithDelta(1.000000000, array_sum($result['weights']), 1e-8);

        // 3. Verifikasi Total Kolom Matriks Perbandingan
        $this->assertEqualsWithDelta(2.416666667, $result['column_sums']['C1'], 1e-8);
        $this->assertEqualsWithDelta(4.333333333, $result['column_sums']['C2'], 1e-8);
        $this->assertEqualsWithDelta(7.000000000, $result['column_sums']['C3'], 1e-8);
        $this->assertEqualsWithDelta(10.50000000, $result['column_sums']['C4'], 1e-8);
        $this->assertEqualsWithDelta(10.00000000, $result['column_sums']['C5'], 1e-8);

        // 4. Verifikasi Lambda Maksimum (λmax = Σ Total Kolom_j × Bobot_j)
        // Target referensi: 5.202043493
        $this->assertEqualsWithDelta(5.202043493, $result['lambda_max'], 1e-7);

        // 5. Verifikasi Consistency Index (CI = (λmax - n)/(n - 1))
        // Target referensi: 0.050510873
        $this->assertEqualsWithDelta(0.050510873, $result['ci'], 1e-7);

        // 6. Verifikasi Consistency Ratio (CR = CI / 1.12)
        // Target referensi: 0.045098994
        $this->assertEqualsWithDelta(0.045098994, $result['cr'], 1e-7);

        // 7. Verifikasi Status Konsistensi (CR <= 0.10)
        $this->assertTrue($result['is_consistent']);
    }

    /**
     * Memverifikasi penanganan matriks identitas sempurna (CR = 0)
     */
    public function test_matriks_identitas_menghasilkan_cr_nol(): void
    {
        $keys = ['C1', 'C2', 'C3'];
        $matrix = [
            'C1' => ['C2' => 1.0, 'C3' => 1.0],
            'C2' => ['C3' => 1.0],
        ];

        $result = $this->ahpService->hitung($keys, $matrix);

        $this->assertEqualsWithDelta(3.0, $result['lambda_max'], 0.0001);
        $this->assertEqualsWithDelta(0.0, $result['ci'], 0.0001);
        $this->assertEqualsWithDelta(0.0, $result['cr'], 0.0001);
        $this->assertTrue($result['is_consistent']);
    }
}
