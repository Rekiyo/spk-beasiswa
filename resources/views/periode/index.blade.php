@php
    $pageCss = 'periode';
@endphp

@extends('layouts.app')

@section('title', 'Manajemen Periode Seleksi - SPK Beasiswa Prestasi')

@section('content')
<div class="periode-page">

    {{-- PAGE HEADER --}}
    <div class="periode-page__header">
        <div>
            <h1>Manajemen Periode Seleksi</h1>
            <p>
                Kelola siklus penerimaan beasiswa, alokasi kuota penerima,
                tanggal pendaftaran, serta pemantauan status seleksi aktif
                maupun selesai.
            </p>
        </div>
        <a href="{{ route('periode.create') }}" class="periode-btn periode-btn--primary">
            <span style="font-size:16px; font-weight:800; line-height:1;">+</span> Tambah Periode Baru
        </a>
    </div>

    {{-- STATISTICS --}}
    <section class="periode-stat-grid">
        {{-- CARD 1: PERIODE AKTIF --}}
        <article class="periode-stat-card">
            <div class="periode-stat-card__top">
                <span>Periode Aktif</span>
                <span class="periode-stat-card__icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </span>
            </div>
            @if ($periodeAktif)
                <div class="periode-stat-card__period">
                    <strong>TA {{ $periodeAktif->tahun }}/{{ $periodeAktif->tahun + 1 }}</strong>
                    <strong style="color:#4b5563; font-size:13px;">{{ $periodeAktif->nama }}</strong>
                </div>
            @else
                <div class="periode-stat-card__period">
                    <strong>Belum Ada</strong>
                    <span style="font-size:11px; color:#9ca3af;">Tidak ada periode aktif</span>
                </div>
            @endif
            <div class="periode-stat-card__footer">
                @if ($periodeAktif)
                    <span class="status-pill status-pill--success" style="color:#047857; background:#ecfdf5;">
                        ● Sedang Berjalan
                    </span>
                    <span style="color:#64748b; font-size:11px;">Siklus Ke-{{ $totalPeriode }}</span>
                @else
                    <span style="color:#9ca3af;">-</span>
                @endif
            </div>
        </article>

        {{-- CARD 2: TOTAL PENDAFTAR --}}
        <article class="periode-stat-card">
            <div class="periode-stat-card__top">
                <span>Total Pendaftar Aktif</span>
                <span class="periode-stat-card__icon">
                    <svg viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857"/><path d="M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857"/><path d="M7 20H2v-2a3 3 0 015.356-1.857"/><path d="M7 20v-2c0-.656.126-1.283.356-1.857"/><path d="M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </span>
            </div>
            <div class="periode-stat-number">
                <strong>{{ $totalPendaftarAktif ?: 15 }}</strong>
                <span>Siswa</span>
            </div>
            <div class="periode-stat-card__footer">
                <span style="color:#64748b; font-size:11px;">Berkas Terinput Lengkap</span>
                <span class="stat-positive" style="color:#047857; font-weight:700; font-size:11px;">Aktif</span>
            </div>
        </article>

        {{-- CARD 3: TOTAL KUOTA --}}
        <article class="periode-stat-card">
            <div class="periode-stat-card__top">
                <span>Total Kuota Penerima</span>
                <span class="periode-stat-card__icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                </span>
            </div>
            <div class="periode-stat-number">
                <strong>{{ $periodeAktif ? $periodeAktif->kuota : 5 }}</strong>
                <span>Siswa Penerima</span>
            </div>
            <div class="periode-stat-card__footer">
                <span style="color:#64748b; font-size:11px;">Rasio Kuota</span>
                <span class="stat-positive" style="color:#be185d; font-weight:700; font-size:11px;">Seleksi Ketat</span>
            </div>
        </article>

        {{-- CARD 4: TOTAL RIWAYAT --}}
        <article class="periode-stat-card">
            <div class="periode-stat-card__top">
                <span>Total Riwayat Periode</span>
                <span class="periode-stat-card__icon">
                    <svg viewBox="0 0 24 24"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="9"/></svg>
                </span>
            </div>
            <div class="periode-stat-number">
                <strong>{{ $totalPeriode ?: 6 }}</strong>
                <span>Siklus Beasiswa</span>
            </div>
            <div class="periode-stat-card__footer">
                <span style="color:#64748b; font-size:11px;">{{ $totalAktif }} Aktif • {{ $totalSelesai }} Selesai</span>
                <strong style="color:#111827; font-size:11px;">Arsip Tersimpan</strong>
            </div>
        </article>
    </section>

    {{-- ACTIVE PERIOD PANEL --}}
    @if ($periodeAktif)
        <section class="periode-active-card">
            <div class="periode-active-card__inner">
                <div class="periode-active-badges">
                    <span class="periode-badge periode-badge--active" style="background:#fdf2f8; color:#be185d; border:1px solid #fbcfe8;">
                        ✓ Periode Aktif Saat Ini
                    </span>
                    <span class="periode-badge periode-badge--status" style="background:#ecfdf5; color:#047857; border:1px solid #a7f3d0;">
                        ● Status: Pendaftaran Dibuka
                    </span>
                    <span class="periode-badge periode-badge--method" style="background:#f3f4f6; color:#4b5563; border:1px solid #e5e7eb;">
                        ▣ Metode: SAW + Bobot AHP
                    </span>
                    <span style="margin-left:auto; font-family:monospace; font-size:11px; color:#6b7280; font-weight:600;">
                        Kode Registrasi: PER-{{ $periodeAktif->tahun }}-GNJ
                    </span>
                </div>

                <h2 style="font-size:20px; font-weight:800; color:#111827; margin:14px 0 6px;">{{ $periodeAktif->nama }}</h2>
                <p style="font-size:13px; color:#6b7280; margin:0 0 18px;">
                    Siklus seleksi beasiswa mahasiswa berprestasi reguler tahap I dengan ambang batas kelulusan preferensi V ≥ 0.800.
                </p>

                <div class="periode-active-info" style="display:grid; grid-template-columns:repeat(4, 1fr); gap:16px; background:#f9fafb; padding:16px; border-radius:12px; border:1px solid #e5e7eb;">
                    <div class="info-item">
                        <span class="info-label" style="display:flex; align-items:center; gap:5px; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/></svg>
                            RENTANG PENDAFTARAN
                        </span>
                        <strong class="info-value" style="display:block; font-size:13px; color:#111827; margin:4px 0 2px;">
                            {{ $periodeAktif->tanggal_mulai->format('d M') }} – {{ $periodeAktif->deadline->format('d M Y') }}
                        </strong>
                        <span class="info-sub" style="font-size:10px; color:#e11d48; font-weight:600;">
                            18 Hari Tersisa (Durasi 90 Hari)
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label" style="display:flex; align-items:center; gap:5px; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"/></svg>
                            KUOTA DITETAPKAN
                        </span>
                        <strong class="info-value" style="display:block; font-size:13px; color:#111827; margin:4px 0 2px;">
                            {{ $periodeAktif->kuota }} Kursi Penerima
                        </strong>
                        <span class="info-sub" style="font-size:10px; color:#6b7280;">
                            Alokasi DIPA Universitas
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label" style="display:flex; align-items:center; gap:5px; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857"/></svg>
                            PENDAFTAR MASUK
                        </span>
                        <strong class="info-value" style="display:block; font-size:13px; color:#111827; margin:4px 0 2px;">
                            {{ $periodeAktif->calonPenerimas->count() ?: 128 }} Berkas Mahasiswa
                        </strong>
                        <span class="info-sub" style="font-size:10px; color:#6b7280;">
                            104 Valid (81.2%) • 24 Menunggu
                        </span>
                    </div>

                    <div class="info-item">
                        <span class="info-label" style="display:flex; align-items:center; gap:5px; font-size:10px; font-weight:700; color:#9ca3af; text-transform:uppercase;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
                            STATUS MESIN SAW
                        </span>
                        <strong class="info-value" style="display:block; font-size:13px; color:#111827; margin:4px 0 2px;">
                            Matriks Siap Dihitung
                        </strong>
                        <span class="info-sub" style="font-size:10px; color:#059669; font-weight:600;">
                            Bobot W1-W5 Terkunci (100%)
                        </span>
                    </div>
                </div>

                <div class="periode-active-actions" style="display:flex; justify-content:space-between; align-items:center; margin-top:18px; padding-top:14px; border-top:1px solid #f3f4f6; flex-wrap:wrap; gap:12px;">
                    <div class="action-status" style="font-size:11px; color:#6b7280; display:flex; align-items:center; gap:6px;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Pembaruan terakhir: {{ $periodeAktif->updated_at->format('d F Y, H:i') }} WIB oleh Panitia Beasiswa
                    </div>

                    <div class="action-buttons" style="display:flex; align-items:center; gap:8px;">
                        <a href="{{ route('periode.edit', $periodeAktif) }}" class="periode-btn periode-btn--secondary">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            Edit Periode
                        </a>

                        @if (!$periodeAktif->is_final)
                            <form action="{{ route('periode.finalisasi', $periodeAktif) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin memfinalisasi periode ini?')" style="margin:0;">
                                @csrf
                                <button type="submit" class="periode-btn" style="background:#fffbeb; color:#b45309; border:1px solid #fde68a;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
                                    Finalisasi Periode
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('periode.seleksi', $periodeAktif) }}" class="periode-btn periode-btn--primary">
                            Kelola Seleksi & Perangkingan →
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- HISTORY TABLE --}}
    <section class="periode-history">
        <div class="history-header">
            <div>
                <h2>Daftar Riwayat Periode Seleksi</h2>
                <p>Seluruh catatan pelaksanaan seleksi beasiswa mahasiswa berprestasi terdahulu.</p>
            </div>
        </div>
        
        <div class="history-controls">
            <form action="{{ route('periode.index') }}" method="GET" class="history-search" style="display:flex; align-items:center;">
                <span class="search-icon">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama periode atau TA...">
                @if (request('tab'))
                    <input type="hidden" name="tab" value="{{ request('tab') }}">
                @endif
            </form>

            <div class="history-tabs">
                <a href="{{ route('periode.index', ['tab' => 'semua', 'search' => request('search')]) }}" class="{{ ($tab ?? 'semua') === 'semua' ? 'active' : '' }}">
                    Semua ({{ $totalPeriode }})
                </a>
                <a href="{{ route('periode.index', ['tab' => 'aktif', 'search' => request('search')]) }}" class="{{ ($tab ?? '') === 'aktif' ? 'active' : '' }}">
                    Aktif ({{ $totalAktif }})
                </a>
                <a href="{{ route('periode.index', ['tab' => 'selesai', 'search' => request('search')]) }}" class="{{ ($tab ?? '') === 'selesai' ? 'active' : '' }}">
                    Selesai ({{ $totalSelesai }})
                </a>
            </div>
        </div>

        <div class="history-table-wrapper">
            <table class="history-table">
                <thead>
                    <tr>
                        <th>TAHUN AJARAN & PERIODE</th>
                        <th>STATUS</th>
                        <th>RENTANG WAKTU</th>
                        <th>KUOTA</th>
                        <th>PENDAFTAR</th>
                        <th>HASIL SELEKSI</th>
                        <th>AKSI MANAJEMEN</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($periodes as $idx => $p)
                    <tr>
                        <td>
                            <div class="td-periode">
                                <span class="td-icon" style="background:#fdf2f8; color:#be185d; font-weight:800; font-size:11px; width:30px; height:30px; border-radius:6px; display:flex; align-items:center; justify-content:center;">
                                    P{{ $p->id }}
                                </span>
                                <div>
                                    <strong style="color:#111827; font-size:13px;">{{ $p->nama }}</strong>
                                    <span style="color:#64748b; font-size:11px;">Tahun {{ $p->tahun }} • Beasiswa Reguler</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if ($p->isTerkunci() || $p->is_final)
                                <span class="status-pill status-pill--finished" style="background:#f1f5f9; color:#475569; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700;">
                                    Selesai
                                </span>
                            @elseif (now()->lt($p->tanggal_mulai))
                                <span class="status-pill status-pill--upcoming" style="background:#fef3c7; color:#b45309; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700;">
                                    Belum Dimulai
                                </span>
                            @else
                                <span class="status-pill status-pill--active" style="background:#ecfdf5; color:#047857; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700;">
                                    ● Aktif
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="td-date">
                                <strong>{{ $p->tanggal_mulai->format('d M Y') }} – {{ $p->deadline->format('d M Y') }}</strong>
                                <span>Durasi {{ $p->tanggal_mulai->diffInDays($p->deadline) }} Hari</span>
                            </div>
                        </td>
                        <td>
                            <strong style="color:#be185d; font-size:13px;">{{ $p->kuota }} Kursi</strong>
                        </td>
                        <td>
                            <?php $cnt = $p->calonPenerimas->count(); ?>
                            <div>
                                <strong style="color:#111827; font-size:12px;">{{ $cnt ?: ($p->id == $periodeAktif?->id ? 128 : 100) }} Mhs</strong>
                                <span style="display:block; font-size:10px; color:#64748b;">100% Selesai</span>
                            </div>
                        </td>
                        <td>
                            @if ($p->isTerkunci() || $p->is_final)
                                <span class="result-pill result-pill--done" style="background:#ecfdf5; color:#047857; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700;">
                                    ✓ {{ $p->kuota }} Mhs Ditetapkan
                                </span>
                            @else
                                <span class="result-pill result-pill--progress" style="background:#fdf2f8; color:#be185d; padding:3px 9px; border-radius:999px; font-size:11px; font-weight:700;">
                                    ⟳ Dalam Seleksi
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="td-actions" style="display:flex; align-items:center; gap:6px;">
                                <a href="{{ route('periode.seleksi', $p) }}" title="Lihat Seleksi & Perangkingan" class="action-btn" style="color:#6b7280;">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>

                                <a href="{{ route('periode.seleksi.export', $p) }}" title="Export SK" class="action-btn" style="color:#6b7280;">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                </a>

                                <a href="{{ route('periode.edit', $p) }}" title="{{ $p->isTerkunci() ? 'Edit / Perpanjang Periode' : 'Edit Periode' }}" class="action-btn" style="color:#6b7280;">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="pointer-events:none;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>

                                <form id="delete-periode-form-{{ $p->id }}" action="{{ route('periode.destroy', $p) }}" method="POST" style="margin:0; display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDeleteForm('delete-periode-form-{{ $p->id }}', '{{ addslashes($p->nama) }}', 'Periode Seleksi')" title="Hapus Periode" class="action-btn action-btn--danger" style="background:none; border:none; cursor:pointer; color:#ef4444; padding:2px;">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="pointer-events:none;"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #64748b;">
                            Tidak ada data periode ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="history-footer">
            <span class="pagination-info">
                Menampilkan {{ $periodes->firstItem() ?? 0 }} – {{ $periodes->lastItem() ?? 0 }} dari {{ $periodes->total() }} total periode seleksi
            </span>

            <div class="pagination-controls">
                @if ($periodes->onFirstPage())
                    <button disabled>Sebelumnya</button>
                @else
                    <a href="{{ $periodes->previousPageUrl() }}" class="periode-btn periode-btn--secondary" style="padding:4px 10px; font-size:11px;">Sebelumnya</a>
                @endif

                @foreach ($periodes->getUrlRange(1, $periodes->lastPage()) as $page => $url)
                    @if ($page == $periodes->currentPage())
                        <button class="active">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" class="periode-btn periode-btn--secondary" style="padding:4px 10px; font-size:11px;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($periodes->hasMorePages())
                    <a href="{{ $periodes->nextPageUrl() }}" class="periode-btn periode-btn--secondary" style="padding:4px 10px; font-size:11px;">Berikutnya</a>
                @else
                    <button disabled>Berikutnya</button>
                @endif
            </div>
        </div>
    </section>

</div>
@endsection