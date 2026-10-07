@extends('layouts.app')

@section('content')
<h4>Tambah Periode Baru</h4>

<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('periode.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Periode</label>
                <input type="text" name="nama" value="{{ old('nama') }}"
                       class="form-control @error('nama') is-invalid @enderror"
                       placeholder="Contoh: Beasiswa Semester Ganjil 2026">
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}"
                       class="form-control @error('tahun') is-invalid @enderror">
                @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kuota Penerima</label>
                <input type="number" name="kuota" value="{{ old('kuota') }}"
                       class="form-control @error('kuota') is-invalid @enderror">
                @error('kuota') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                class="form-control @error('tanggal_mulai') is-invalid @enderror">
    @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Deadline</label>
    <input type="date" name="deadline" value="{{ old('deadline') }}"
           class="form-control @error('deadline') is-invalid @enderror">
    <div class="form-text">Setelah deadline, data periode tidak bisa diubah lagi.</div>
    @error('deadline') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('periode.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection