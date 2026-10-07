@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Daftar Periode</h4>
    <a href="{{ route('periode.create') }}" class="btn btn-primary">+ Periode Baru</a>
</div>

<div class="card">
    <table class="table table-striped mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tahun</th>
                <th>Kuota</th>
                <th>Mulai</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($periodes as $p)
                <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $p->nama }}</td>
    <td>{{ $p->tahun }}</td>
    <td>{{ $p->kuota }}</td>
    <td>{{ $p->tanggal_mulai->format('d/m/Y') }}</td>
    <td>{{ $p->deadline->format('d/m/Y') }}</td>
    <td>
        <span class="badge {{ $p->isTerkunci() ? 'bg-danger' : 'bg-success' }}">
            {{ $p->status }}
        </span>
    </td>
<td>
    <a href="{{ route('kriteria.index', $p) }}" class="btn btn-sm btn-outline-primary">Kriteria</a>
    @if (!$p->isTerkunci())
        <a href="{{ route('periode.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
    @endif
</td>
</tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada periode.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection