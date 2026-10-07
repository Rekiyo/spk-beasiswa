@extends('layouts.app')

@section('content')
<h4>Edit Periode</h4>

<div class="card mt-3">
    <div class="card-body">
        <form action="{{ route('periode.update', $periode) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Periode</label>
                <input type="text" name="nama" value="{{ old('nama', $periode->nama) }}"
                       class="form-control @error('nama') is-invalid @enderror">
                @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" value="{{ old('tahun', $periode->tahun) }}"
                       class="form-control @error('tahun') is-invalid @enderror">
                @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kuota Penerima</label>
                <input type="number" name="kuota" value="{{ old('kuota', $periode->kuota) }}"
                       class="form-control @error('kuota') is-invalid @enderror">
                @error('kuota') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                       value="{{ old('tanggal_mulai', $periode->tanggal_mulai->format('Y-m-d')) }}"
                       class="form-control @error('tanggal_mulai') is-invalid @enderror">
                @error('tanggal_mulai') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline"
                       value="{{ old('deadline', $periode->deadline->format('Y-m-d')) }}"
                       class="form-control @error('deadline') is-invalid @enderror">
                <div class="form-text">Setelah deadline, data periode tidak bisa diubah lagi.</div>
                @error('deadline') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('periode.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

{{-- Zona hapus: sengaja DI LUAR form edit, karena form tidak boleh bersarang --}}
<div class="card border-danger mt-4">
    <div class="card-body">
        <h6 class="text-danger">Hapus Periode</h6>
        <p class="small text-muted mb-3">
            Semua kriteria (dan nanti data siswa serta nilainya) di periode ini ikut terhapus
            dan tidak bisa dikembalikan.
        </p>
        <form action="{{ route('periode.destroy', $periode) }}" method="POST"
              onsubmit="return confirm('Yakin hapus periode {{ $periode->nama }}? Data tidak bisa dikembalikan.')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger">Hapus Periode Ini</button>
        </form>
    </div>
</div>
@endsection