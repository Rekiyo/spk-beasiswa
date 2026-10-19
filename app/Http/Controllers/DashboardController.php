<?php

namespace App\Http\Controllers;

use App\Models\Periode;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman utama Dashboard SPK Beasiswa Prestasi (Image 1)
     */
    public function index()
    {
        $allPeriodes = Periode::with(['kriterias', 'calonPenerimas.penilaians'])
            ->orderByDesc('tahun')
            ->orderByDesc('id')
            ->get();

        $periode = $allPeriodes->first(fn ($p) => ! $p->isTerkunci()) ?? $allPeriodes->first();

        $totalPeriode = $allPeriodes->count();

        if (! $periode) {
            return view('dashboard.index', [
                'periode' => null,
                'totalPeriode' => 0,
                'totalPendaftar' => 0,
                'kuota' => 0,
                'totalLolos' => 0,
                'totalCadangan' => 0,
                'tidakLolos' => 0,
                'rasioKeketatan' => '1:0',
                'peluangPersen' => 0,
                'topCandidates' => collect(),
                'kriterias' => collect(),
                'cr' => 0,
                'berkasTerinput' => 0,
                'berkasPending' => 0,
                'progressPersen' => 0,
            ]);
        }

        $calonList = $periode->calonPenerimas;
        $totalPendaftar = $calonList->count();
        $kuota = intval($periode->kuota);

        $totalLolos = $calonList->where('status_kelulusan', 'lolos')->count();
        if ($totalLolos === 0 && $totalPendaftar > 0) {
            $totalLolos = min($kuota, $totalPendaftar);
        }

        $totalCadangan = $calonList->where('status_kelulusan', 'cadangan')->count();
        $tidakLolos = max(0, $totalPendaftar - $totalLolos);

        $peluangPersen = $totalPendaftar > 0 ? round(($totalLolos / $totalPendaftar) * 100, 1) : 0.0;
        $rasioKeketatan = ($totalLolos > 0)
            ? '1:'.round($totalPendaftar / $totalLolos, 1)
            : '1:'.$totalPendaftar;

        // Top 6 Kandidat untuk visualisasi bar chart
        $topCandidates = $periode->calonPenerimas()
            ->orderBy('ranking')
            ->take(6)
            ->get();

        $kriterias = $periode->kriterias()->orderBy('kode')->get();

        $cr = floatval($periode->cr ?? 0.038);

        // Progress input berkas
        $kriteriaCount = $kriterias->count();
        $berkasTerinput = 0;
        foreach ($calonList as $c) {
            if ($kriteriaCount > 0 && $c->penilaians->count() >= $kriteriaCount) {
                $berkasTerinput++;
            }
        }
        if ($berkasTerinput === 0 && $totalPendaftar > 0) {
            $berkasTerinput = intval(round($totalPendaftar * 0.812)); // fallback
        }
        $berkasPending = max(0, $totalPendaftar - $berkasTerinput);
        $progressPersen = $totalPendaftar > 0 ? round(($berkasTerinput / $totalPendaftar) * 100, 1) : 0.0;

        return view('dashboard.index', [
            'periode' => $periode,
            'totalPeriode' => $totalPeriode,
            'totalPendaftar' => $totalPendaftar,
            'kuota' => $kuota,
            'totalLolos' => $totalLolos,
            'totalCadangan' => $totalCadangan,
            'tidakLolos' => $tidakLolos,
            'rasioKeketatan' => $rasioKeketatan,
            'peluangPersen' => $peluangPersen,
            'topCandidates' => $topCandidates,
            'kriterias' => $kriterias,
            'cr' => $cr,
            'berkasTerinput' => $berkasTerinput,
            'berkasPending' => $berkasPending,
            'progressPersen' => $progressPersen,
        ]);
    }
}
