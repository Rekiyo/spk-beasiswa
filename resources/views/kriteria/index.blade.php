@extends('layouts.app')

@section('content')
<a href="{{ route('periode.index') }}" class="text-decoration-none">&larr; Kembali ke periode</a>

<div class="d-flex justify-content-between align-items-center my-3">
    <div>
        <h4 class="mb-0">Kriteria: {{ $periode->nama }}</h4>
        <small class="text-muted">
            Deadline {{ $periode->deadline->format('d/m/Y') }} &middot; {{ $periode->status }}
        </small>
    </div>

    @if (!$periode->isTerkunci())
        <a href="{{ route('kriteria.create', $periode) }}" class="btn btn-primary">+ Kriteria</a>
    @endif
</div>

@if ($periode->isTerkunci())
    <div class="alert alert-warning">Periode sudah terkunci, data hanya bisa dilihat.</div>
@endif

<div class="card">
    <table class="table table-striped mb-0">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Kriteria</th>
                <th>Atribut</th>
                <th>Tipe Input</th>
                <th>Bobot</th>
                @if (!$periode->isTerkunci())
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($kriterias as $k)
                <tr>
                    <td>{{ $k->kode }}</td>
                    <td>{{ $k->nama }}</td>
                    <td>
                        <span class="badge {{ $k->atribut === 'benefit' ? 'bg-success' : 'bg-warning text-dark' }}">
                            {{ $k->atribut }}
                        </span>
                    </td>
                    <td>{{ $k->tipe_input === 'pilihan' ? 'Pilihan' : 'Angka' }}</td>
                    <td>{{ $k->bobot ?? '-' }}</td>
                    @if (!$periode->isTerkunci())
                        <td>
                            <form action="{{ route('kriteria.destroy', [$periode, $k]) }}" method="POST"
                                  onsubmit="return confirm('Hapus kriteria ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada kriteria.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection