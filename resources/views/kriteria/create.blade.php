@extends('layouts.app')

@section('content')
<h4>Tambah Kriteria: {{ $periode->nama }}</h4>

<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('kriteria.store', $periode) }}" method="POST">
            @csrf

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

            <div class="mb-3">
                <label class="form-label">Kode</label>
                <input type="text" name="kode" value="{{ old('kode') }}"
                       class="form-control @error('kode') is-invalid @enderror"
                       placeholder="Contoh: C1">
                @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Kriteria</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                       class="form-control @error('nama') is-invalid @enderror"
                       placeholder="Contoh: IPK / Penghasilan Orang Tua">
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Atribut</label>
                <select name="atribut" class="form-select @error('atribut') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="benefit" @selected(old('atribut') === 'benefit')>Benefit</option>
                    <option value="cost" @selected(old('atribut') === 'cost')>Cost</option>
                </select>
                @error('atribut') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
    <label class="form-label">Tipe Input Nilai</label>
    <select name="tipe_input" class="form-select @error('tipe_input') is-invalid @enderror">
        <option value="angka" @selected(old('tipe_input', 'angka') === 'angka')>
            Angka (diketik langsung)
        </option>
        <option value="pilihan" @selected(old('tipe_input') === 'pilihan')>
            Pilihan (dropdown, dikonversi ke angka)
        </option>
    </select>
    <div class="form-text">
        Pilih "Pilihan" untuk kriteria seperti Ekstrakurikuler. Daftar pilihannya diatur setelah kriteria disimpan.
    </div>
    @error('tipe_input') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('kriteria.index', $periode) }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection