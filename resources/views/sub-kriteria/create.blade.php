@extends('layouts.app')

@section('title', 'Tambah Sub-kriteria')

@section('content')

<div class="container py-4">

    <a href="{{ route('sub-kriteria.index', [$periode, $kriteria]) }}"
       class="text-decoration-none">
        &larr; Kembali ke Sub-kriteria
    </a>

    <div class="my-3">
        <h4 class="mb-1">
            Tambah Sub-kriteria
        </h4>

        <div class="text-muted">
            {{ $kriteria->kode }} - {{ $kriteria->nama }}
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">

        <div class="card-body">

            <form
                action="{{ route('sub-kriteria.store', [$periode, $kriteria]) }}"
                method="POST"
            >

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Label Pilihan
                    </label>

                    <input
                        type="text"
                        name="label"
                        value="{{ old('label') }}"
                        class="form-control @error('label') is-invalid @enderror"
                        placeholder="Contoh: Juara Nasional"
                    >

                    @error('label')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Nilai
                    </label>

                    <input
                        type="number"
                        name="nilai"
                        value="{{ old('nilai') }}"
                        min="1"
                        max="100"
                        class="form-control @error('nilai') is-invalid @enderror"
                        placeholder="Contoh: 5"
                    >

                    <div class="form-text">
                        Nilai yang digunakan sistem dalam proses perhitungan SPK.
                    </div>

                    @error('nilai')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <button class="btn btn-primary">
                    Simpan
                </button>

                <a
                    href="{{ route('sub-kriteria.index', [$periode, $kriteria]) }}"
                    class="btn btn-secondary"
                >
                    Batal
                </a>

            </form>

        </div>

    </div>

</div>

@endsection