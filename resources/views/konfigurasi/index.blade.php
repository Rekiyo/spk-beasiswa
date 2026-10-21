@php
    $pageCss = 'konfigurasi';
@endphp

@extends('layouts.app')

@section('title', 'Manajemen Konfigurasi Seleksi - SPK Beasiswa Prestasi')

@section('content')
<div class="konfigurasi-page">

    {{-- PAGE HEADER --}}
    <div class="konfigurasi-page__header">
        <div>
            <h1>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#be185d" stroke-width="2.5"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                Manajemen Konfigurasi Seleksi
            </h1>
            <p>
                Kelola paket baku 5 kriteria seleksi beasiswa dan matriks pembobotan Analytical Hierarchy Process (AHP).
                Paket konfigurasi yang valid dan konsisten dapat digunakan kembali untuk berbagai periode seleksi.
            </p>
        </div>
        <a href="{{ route('konfigurasi.create') }}" class="konfigurasi-btn konfigurasi-btn--primary">
            <span style="font-size:16px; font-weight:800; line-height:1;">+</span> Buat Konfigurasi Baru
        </a>
    </div>

    {{-- STATISTICS CARDS --}}
    <section class="konfigurasi-stat-grid">
        {{-- CARD 1: TOTAL KONFIGURASI --}}
        <article class="konfigurasi-stat-card">
            <div class="konfigurasi-stat-card__top">
                <span>Total Konfigurasi</span>
                <span class="konfigurasi-stat-card__icon">
                    <svg viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                </span>
            </div>
            <div class="konfigurasi-stat-number">
                <strong>{{ $totalKonfigurasi }}</strong>
                <span>Paket Tersimpan</span>
            </div>
            <div class="konfigurasi-stat-card__footer">
                <span>Arsip Master Seleksi</span>
                <strong style="color:#be185d; font-size:11px;">5 Kriteria Baku</strong>
            </div>
        </article>

        {{-- CARD 2: SIAP DIGUNAKAN --}}
        <article class="konfigurasi-stat-card">
            <div class="konfigurasi-stat-card__top">
                <span>Siap Digunakan</span>
                <span class="konfigurasi-stat-card__icon icon-emerald">
                    <svg viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </span>
            </div>
            <div class="konfigurasi-stat-number">
                <strong style="color:#059669;">{{ $totalSiap }}</strong>
                <span>Paket Valid</span>
            </div>
            <div class="konfigurasi-stat-card__footer">
                <span>Memenuhi CR &lt; 0.10</span>
                <span class="stat-positive">Siap Pakai</span>
            </div>
        </article>

        {{-- CARD 3: KONSISTENSI AHP --}}
        <article class="konfigurasi-stat-card">
            <div class="konfigurasi-stat-card__top">
                <span>Konsisten (CR &lt; 10%)</span>
                <span class="konfigurasi-stat-card__icon icon-accent">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
                </span>
            </div>
            <div class="konfigurasi-stat-number">
                <strong style="color:#d97706;">{{ $totalKonsisten }}</strong>
                <span>Tervalidasi Matematis</span>
            </div>
            <div class="konfigurasi-stat-card__footer">
                <span>Standar Saaty n=5</span>
                <strong style="color:#111827; font-size:11px;">AHP Valid</strong>
            </div>
        </article>

        {{-- CARD 4: TERPAKAI PERIODE --}}
        <article class="konfigurasi-stat-card">
            <div class="konfigurasi-stat-card__top">
                <span>Terpakai Periode</span>
                <span class="konfigurasi-stat-card__icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </span>
            </div>
            <div class="konfigurasi-stat-number">
                <strong style="color:#1e40af;">{{ $totalTerpakai }}</strong>
                <span>Paket Aktif</span>
            </div>
            <div class="konfigurasi-stat-card__footer">
                <span>Proteksi Integritas</span>
                <span style="color:#2563eb; font-weight:700;">Terkunci Otomatis</span>
            </div>
        </article>
    </section>

    {{-- TABLE BOX --}}
    <div class="konfigurasi-box">
        <div class="konfigurasi-controls">
            {{-- SEARCH FORM --}}
            <form action="{{ route('konfigurasi.index') }}" method="GET" class="konfigurasi-search">
                <span class="search-icon">
                    <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau deskripsi konfigurasi...">
                @if (request('tab'))
                    <input type="hidden" name="tab" value="{{ request('tab') }}">
                @endif
            </form>

            {{-- TABS FILTER --}}
            <div class="konfigurasi-tabs">
                <a href="{{ route('konfigurasi.index', ['tab' => 'semua', 'search' => request('search')]) }}" class="{{ ($tab ?? 'semua') === 'semua' ? 'active' : '' }}">
                    Semua ({{ $totalKonfigurasi }})
                </a>
                <a href="{{ route('konfigurasi.index', ['tab' => 'siap', 'search' => request('search')]) }}" class="{{ ($tab ?? '') === 'siap' ? 'active' : '' }}">
                    Siap Digunakan ({{ $totalSiap }})
                </a>
                <a href="{{ route('konfigurasi.index', ['tab' => 'draf', 'search' => request('search')]) }}" class="{{ ($tab ?? '') === 'draf' ? 'active' : '' }}">
                    Draf ({{ $totalKonfigurasi - $totalSiap }})
                </a>
            </div>
        </div>

        {{-- TABLE DATA --}}
        <div class="konfigurasi-table-wrapper">
            <table class="konfigurasi-table">
                <thead>
                    <tr>
                        <th style="min-width: 240px;">PAKET KONFIGURASI</th>
                        <th>KRITERIA</th>
                        <th>KONSISTENSI AHP</th>
                        <th>STATUS KESIAPAN</th>
                        <th>PENGGUNAAN</th>
                        <th>PEMBARUAN</th>
                        <th style="text-align: right; padding-right: 24px;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($konfigurasis as $cfg)
                    @php
                        $periodesCount = $cfg->periodes->count();
                        $isUsed = $periodesCount > 0;
                    @endphp
                    <tr>
                        <td>
                            <div style="display:flex; flex-direction:column; gap:4px;">
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <strong style="color:#111827; font-size:14px;">{{ $cfg->nama }}</strong>
                                    <span class="pill-version">v{{ $cfg->versi }}</span>
                                    @if ($cfg->parent_id)
                                        <span style="font-size:10px; color:#9ca3af;" title="Turunan dari Versi sebelumnya">
                                            (Revisi dari #{{ $cfg->parent_id }})
                                        </span>
                                    @endif
                                </div>
                                <span style="color:#64748b; font-size:12px; line-height:1.4;">
                                    {{ Str::limit($cfg->deskripsi ?: 'Paket konfigurasi seleksi beasiswa prestasi SMK.', 70) }}
                                </span>
                            </div>
                        </td>

                        <td>
                            <div>
                                <span style="font-weight:700; color:#111827; font-size:12px;">5 Kriteria</span>
                                <div style="display:flex; gap:3px; margin-top:3px;">
                                    @foreach ($cfg->kriterias as $k)
                                        <span style="display:inline-block; padding:1px 5px; font-size:9px; font-weight:700; border-radius:3px; font-family:monospace; background:{{ $k->atribut === 'benefit' ? '#ecfdf5' : '#fff1f2' }}; color:{{ $k->atribut === 'benefit' ? '#047857' : '#be123c' }};" title="{{ $k->kode }} - {{ $k->nama }} ({{ $k->atribut }})">
                                            {{ $k->kode }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </td>

                        <td>
                            @if ($cfg->is_konsisten)
                                <span class="pill-consistent">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                    Konsisten
                                </span>
                            @else
                                <span class="pill-inconsistent">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                    Tidak Konsisten
                                </span>
                            @endif
                            <div style="font-family:monospace; font-size:11px; color:#475569; margin-top:3px;">
                                CR = {{ number_format($cfg->cr ?? 0, 3) }}
                            </div>
                        </td>

                        <td>
                            @if ($cfg->is_siap)
                                <span class="pill-ready">
                                    ● Siap Digunakan
                                </span>
                            @else
                                <span class="pill-draft">
                                    ○ Draf
                                </span>
                            @endif
                        </td>

                        <td>
                            @if ($isUsed)
                                <span class="badge-used" title="Digunakan oleh {{ $periodesCount }} periode">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    {{ $periodesCount }} Periode
                                </span>
                            @else
                                <span class="badge-unused">
                                    Belum Digunakan
                                </span>
                            @endif
                        </td>

                        <td>
                            <div style="font-size:12px; color:#475569;">
                                {{ $cfg->updated_at->format('d M Y') }}
                            </div>
                            <span style="font-size:10px; color:#9ca3af;">
                                {{ $cfg->updated_at->format('H:i') }} WIB
                            </span>
                        </td>

                        <td style="text-align: right; padding-right: 24px;">
                            <div class="action-group" style="justify-content: flex-end;">
                                {{-- LIHAT DETAIL --}}
                                <a href="{{ route('konfigurasi.show', $cfg) }}" class="btn-icon" title="Lihat Rincian Paket">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('konfigurasi.edit', $cfg) }}" class="btn-icon" title="{{ $isUsed ? 'Edit (Membuat Versi Baru karena sedang digunakan periode)' : 'Edit Konfigurasi Langsung' }}">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </a>

                                {{-- DUPLIKAT --}}
                                <form action="{{ route('konfigurasi.duplikat', $cfg) }}" method="POST" style="margin:0; display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-icon" title="Duplikasi / Buat Paket Baru dari Ini">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                    </button>
                                </form>

                                {{-- HAPUS (DILINDUNGI BILA SUDAH DIGUNAKAN) --}}
                                @if ($isUsed)
                                    <button type="button" class="btn-icon btn-icon--disabled" title="Konfigurasi tidak dapat dihapus karena sedang digunakan oleh {{ $periodesCount }} periode" onclick="alert('Konfigurasi ini tidak dapat dihapus karena sedang digunakan oleh {{ $periodesCount }} periode seleksi. Silakan periksa relasi periode terlebih dahulu.')">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                    </button>
                                @else
                                    <form id="delete-cfg-form-{{ $cfg->id }}" action="{{ route('konfigurasi.destroy', $cfg) }}" method="POST" style="margin:0; display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDeleteForm('delete-cfg-form-{{ $cfg->id }}', '{{ addslashes($cfg->nama) }}', 'Paket Konfigurasi Seleksi')" title="Hapus Paket Konfigurasi" class="btn-icon btn-icon--danger">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 48px; color: #64748b;">
                            <div style="display:flex; flex-direction:column; align-items:center; gap:12px;">
                                <div style="width:48px; height:48px; border-radius:12px; background:#fdf2f8; color:#be185d; display:flex; align-items:center; justify-content:center;">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                                </div>
                                <strong style="font-size:14px; color:#111827;">Belum Ada Paket Konfigurasi</strong>
                                <p style="font-size:12px; color:#6b7280; max-width:400px; margin:0;">
                                    Belum ada data konfigurasi seleksi yang sesuai filter pencarian. Klik tombol di bawah untuk membuat konfigurasi seleksi baru.
                                </p>
                                <a href="{{ route('konfigurasi.create') }}" class="konfigurasi-btn konfigurasi-btn--primary" style="margin-top:6px;">
                                    + Buat Konfigurasi Seleksi Baru
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION FOOTER --}}
        <div class="konfigurasi-footer">
            <span>
                Menampilkan {{ $konfigurasis->firstItem() ?? 0 }} – {{ $konfigurasis->lastItem() ?? 0 }} dari {{ $konfigurasis->total() }} paket konfigurasi seleksi
            </span>

            <div style="display:flex; gap:6px;">
                @if ($konfigurasis->onFirstPage())
                    <button class="konfigurasi-btn konfigurasi-btn--secondary" style="padding:5px 12px; font-size:11px;" disabled>Sebelumnya</button>
                @else
                    <a href="{{ $konfigurasis->previousPageUrl() }}" class="konfigurasi-btn konfigurasi-btn--secondary" style="padding:5px 12px; font-size:11px;">Sebelumnya</a>
                @endif

                @foreach ($konfigurasis->getUrlRange(1, $konfigurasis->lastPage()) as $page => $url)
                    @if ($page == $konfigurasis->currentPage())
                        <button class="konfigurasi-btn konfigurasi-btn--primary" style="padding:5px 12px; font-size:11px;">{{ $page }}</button>
                    @else
                        <a href="{{ $url }}" class="konfigurasi-btn konfigurasi-btn--secondary" style="padding:5px 12px; font-size:11px;">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($konfigurasis->hasMorePages())
                    <a href="{{ $konfigurasis->nextPageUrl() }}" class="konfigurasi-btn konfigurasi-btn--secondary" style="padding:5px 12px; font-size:11px;">Berikutnya</a>
                @else
                    <button class="konfigurasi-btn konfigurasi-btn--secondary" style="padding:5px 12px; font-size:11px;" disabled>Berikutnya</button>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
