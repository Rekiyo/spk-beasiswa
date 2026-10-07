<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    // Menampilkan daftar periode
    public function index()
    {
        $periodes = Periode::orderByDesc('tahun')->orderByDesc('id')->get();
        return view('periode.index', compact('periodes'));
    }

    // Menampilkan form tambah periode
    public function create()
    {
        return view('periode.create');
    }

    // Menyimpan periode baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'  => 'required|string|max:255',
            'tahun' => 'required|digits:4',
            'kuota' => 'required|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'deadline' => 'required|date|after_or_equal:tanggal_mulai',
        ]);


        Periode::create($data);

        return redirect()->route('periode.index')
            ->with('sukses', 'Periode berhasil ditambahkan.');
    }
    // Menampilkan form edit
public function edit(Periode $periode)
{
    if ($periode->isTerkunci()) {
        return $this->tolakTerkunci();
    }
    return view('periode.edit', compact('periode'));
}

// Menyimpan perubahan
public function update(Request $request, Periode $periode)
{
    if ($periode->isTerkunci()) {
        return $this->tolakTerkunci();
    }

    $data = $request->validate([
        'nama'          => 'required|string|max:255',
        'tahun'         => 'required|digits:4',
        'kuota'         => 'required|integer|min:1',
        'tanggal_mulai' => 'required|date',
        'deadline'      => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    $periode->update($data);

    return redirect()->route('periode.index')
        ->with('sukses', 'Periode berhasil diperbarui.');
}

// Menghapus periode
public function destroy(Periode $periode)
{
    if ($periode->isTerkunci()) {
        return $this->tolakTerkunci();
    }

    $periode->delete();

    return redirect()->route('periode.index')
        ->with('sukses', 'Periode berhasil dihapus.');
}

private function tolakTerkunci()
{
    return redirect()->route('periode.index')
        ->with('gagal', 'Periode sudah melewati deadline, data tidak bisa diubah atau dihapus.');
}
}