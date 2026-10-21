<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function index(Periode $periode, Kriteria $kriteria)
    {
        $this->pastikanKriteriaMilikPeriode($periode, $kriteria);

        $subKriterias = $kriteria->subKriterias;

        return view('sub-kriteria.index', compact(
            'periode',
            'kriteria',
            'subKriterias'
        ));
    }

    public function create(Periode $periode, Kriteria $kriteria)
    {
        $this->pastikanKriteriaMilikPeriode($periode, $kriteria);

        if ($periode->isTerkunci()) {
            return redirect()
                ->route('kriteria.index', $periode)
                ->with('gagal', 'Periode sudah melewati deadline.');
        }

        if ($kriteria->tipe_input !== 'pilihan') {
            return redirect()
                ->route('kriteria.index', $periode)
                ->with('gagal', 'Sub-kriteria hanya digunakan untuk kriteria tipe pilihan.');
        }

        return view('sub-kriteria.create', compact(
            'periode',
            'kriteria'
        ));
    }

    public function store(
        Request $request,
        Periode $periode,
        Kriteria $kriteria
    ) {
        $this->pastikanKriteriaMilikPeriode($periode, $kriteria);

        if ($periode->isTerkunci()) {
            return redirect()
                ->route('kriteria.index', $periode)
                ->with('gagal', 'Periode sudah melewati deadline.');
        }

        if ($kriteria->tipe_input !== 'pilihan') {
            return redirect()
                ->route('kriteria.index', $periode)
                ->with('gagal', 'Sub-kriteria hanya digunakan untuk kriteria tipe pilihan.');
        }

        $data = $request->validate([
            'label' => 'required|string|max:255',
            'nilai' => 'required|integer|min:1|max:100',
        ]);

        $sudahAda = $kriteria->subKriterias()
            ->where('label', $data['label'])
            ->exists();

        if ($sudahAda) {
            return back()
                ->withInput()
                ->withErrors([
                    'label' => 'Label sub-kriteria tersebut sudah ada.',
                ]);
        }

        $kriteria->subKriterias()->create($data);

        return redirect()
            ->route('sub-kriteria.index', [$periode, $kriteria])
            ->with('sukses', 'Sub-kriteria berhasil ditambahkan.');
    }

    public function destroy(
        Periode $periode,
        Kriteria $kriteria,
        SubKriteria $subKriteria
    ) {
        $this->pastikanKriteriaMilikPeriode($periode, $kriteria);

        if ($periode->isTerkunci()) {
            return redirect()
                ->route('sub-kriteria.index', [$periode, $kriteria])
                ->with('gagal', 'Periode sudah melewati deadline.');
        }

        if ($subKriteria->kriteria_id !== $kriteria->id) {
            abort(404);
        }

        $subKriteria->delete();

        return redirect()
            ->route('sub-kriteria.index', [$periode, $kriteria])
            ->with('sukses', 'Sub-kriteria berhasil dihapus.');
    }

    private function pastikanKriteriaMilikPeriode(
        Periode $periode,
        Kriteria $kriteria
    ): void {
        if ($kriteria->periode_id !== $periode->id) {
            abort(404);
        }
    }
}
