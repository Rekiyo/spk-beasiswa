@extends('layouts.app')

@section('title', 'Sub-kriteria ' . $kriteria->kode)

@section('content')

<div class="container py-4">

    <a href="{{ route('kriteria.index', $periode) }}"
       class="text-decoration-none">
        &larr; Kembali ke Kriteria
    </a>

    <div class="d-flex justify-content-between align-items-center my-3">
        <div>
            <h4 class="mb-1">
                Sub-kriteria {{ $kriteria->kode }} - {{ $kriteria->nama }}
            </h4>

            <small class="text-muted">
                Periode: {{ $periode->nama }}
            </small>
        </div>

        @if (!$periode->isTerkunci())
            <a href="{{ route('sub-kriteria.create', [$periode, $kriteria]) }}"
               class="btn btn-primary">
                + Sub-kriteria
            </a>
        @endif
    </div>

    @if ($periode->isTerkunci())
        <div class="alert alert-warning">
            Periode sudah terkunci. Data hanya bisa dilihat.
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <div class="mb-3">
                <strong>Daftar Pilihan</strong>
                <div class="text-muted small">
                    Setiap pilihan akan dikonversi menjadi nilai untuk proses SPK.
                </div>
            </div>

            <table class="table table-striped mb-0">

                <thead>
                    <tr>
                        <th width="80">No</th>
                        <th>Label Pilihan</th>
                        <th width="180">Nilai</th>

                        @if (!$periode->isTerkunci())
                            <th width="120">Aksi</th>
                        @endif
                    </tr>
                </thead>

                <tbody>

                    @forelse ($subKriterias as $sub)

                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $sub->label }}
                            </td>

                            <td>
                                <strong>
                                    {{ $sub->nilai }}
                                </strong>
                            </td>

                            @if (!$periode->isTerkunci())
                                <td>

                                    <form
                                        action="{{ route('sub-kriteria.destroy', [$periode, $kriteria, $sub]) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus sub-kriteria ini?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            @endif

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="{{ $periode->isTerkunci() ? 3 : 4 }}"
                                class="text-center text-muted py-4"
                            >
                                Belum ada sub-kriteria.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection