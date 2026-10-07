<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KriteriaController extends Controller
{
    public function index(Periode $periode)
    {
        $kriterias = $periode->kriterias;
        return view('kriteria.index', compact('periode', 'kriterias'));
    }

    public function create(Periode $periode)
    {
        if ($periode->isTerkunci()) {
            return $this->tolakTerkunci($periode);
        }
        return view('kriteria.create', compact('periode'));
    }

    public function store(Request $request, Periode $periode)
    {
        if ($periode->isTerkunci()) {
            return $this->tolakTerkunci($periode);
        }

        $data = $request->validate([
            'kode'    => [
                'required', 'string', 'max:10',
                Rule::unique('kriterias')->where('periode_id', $periode->id),
            ],
            'nama'    => 'required|string|max:255',
            'atribut' => 'required|in:benefit,cost',
            'tipe_input' => 'required|in:angka,pilihan',
        ]);

        $periode->kriterias()->create($data);

        return redirect()->route('kriteria.index', $periode)
            ->with('sukses', 'Kriteria berhasil ditambahkan.');
    }

    public function destroy(Periode $periode, Kriteria $kriteria)
    {
        if ($periode->isTerkunci()) {
            return $this->tolakTerkunci($periode);
        }
        abort_if($kriteria->periode_id !== $periode->id, 404);

        $kriteria->delete();

        return redirect()->route('kriteria.index', $periode)
            ->with('sukses', 'Kriteria berhasil dihapus.');
    }

    private function tolakTerkunci(Periode $periode)
    {
        return redirect()->route('kriteria.index', $periode)
            ->with('gagal', 'Periode sudah melewati deadline, data tidak bisa diubah.');
    }
}