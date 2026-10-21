@extends('layouts.app')

@section('title', 'Dashboard Seleksi - SPK Beasiswa Prestasi')

@php
    $pageCss = 'dashboard';

    $namaPeriode = $periode?->nama ?? 'Tidak Ada Periode';
    $tahunPeriode = $periode?->tahun ?? date('Y');
@endphp

@section('content')

<main class="dashboard-page">

    <div class="dashboard-stack">

        {{-- Hero Banner & Period Selector --}}
        <section class="dashboard-hero">

            <div class="dashboard-hero__wrapper">

                {{-- Left: Informasi Utama & Deskripsi --}}
                <div class="dashboard-hero__content">

                    <div class="dashboard-hero__badge">
                        <span class="dashboard-hero__badge-dot" style="background: {{ $periode ? ($periode->isSedangBerlangsung() ? '#34d399' : ($periode->isBelumDimulai() ? '#fbbf24' : '#94a3b8')) : '#ef4444' }};"></span>
                        @if ($periode)
                            Tahun Ajaran {{ $tahunPeriode }}/{{ $tahunPeriode + 1 }} • Status: {{ $periode->status }}
                            @if ($periode->tanggal_mulai && $periode->deadline)
                                • {{ $periode->tanggal_mulai->format('d M') }} s/d {{ $periode->deadline->format('d M Y') }}
                            @endif
                        @else
                            Belum Ada Periode Dibuat • Sistem Standby
                        @endif
                    </div>

                    <h1>
                        Sistem Pendukung Keputusan Penentuan Penerima Beasiswa
                    </h1>

                    <p>
                        Penyelenggaraan seleksi objektif dan transparan menggunakan algoritma normalisasi multi-kriteria
                        Simple Additive Weighting (SAW) berbobot Analytical Hierarchy Process (AHP).
                    </p>

                </div>

                {{-- Right: Dropdown Pemilih Periode Aktif / Historis --}}
                <div class="dashboard-hero__picker">
                    <div class="picker-header">
                        <span style="display:flex; align-items:center; gap:6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            PILIH PERIODE SELEKSI
                        </span>
                        <span style="font-size:10px; opacity:0.85; font-family:monospace;">
                            {{ $totalPeriode }} Periode
                        </span>
                    </div>

                    <form method="GET" action="{{ route('dashboard') }}" id="formDashboardPeriode">
                        <div class="picker-select-wrapper">
                            <select id="dashboardPeriodeSelect" name="periode_id" class="picker-select" onchange="this.form.submit()">
                                @forelse ($allPeriodes as $p)
                                    @php
                                        $labelStatus = $p->status_badge_label;
                                    @endphp
                                    <option value="{{ $p->id }}" {{ $periode && $periode->id === $p->id ? 'selected' : '' }}>
                                        {{ $p->nama }} ({{ $p->tahun }}) — [{{ $labelStatus }}]
                                    </option>
                                @empty
                                    <option value="" disabled selected>Belum ada periode di database</option>
                                @endforelse
                            </select>
                            <span class="picker-select-arrow">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="6 9 12 15 18 9"/></svg>
                            </span>
                        </div>
                    </form>

                    <div class="picker-footer">
                        @if ($periode)
                            <span>Kuota: <strong>{{ $kuota }} Siswa Penerima</strong> • <strong>{{ $totalPendaftar }} Siswa</strong></span>
                            <a href="{{ route('periode.index') }}">Kelola Periode →</a>
                        @else
                            <span>Belum ada data periode</span>
                            <a href="{{ route('periode.create') }}">+ Buat Periode</a>
                        @endif
                    </div>
                </div>

            </div>

        </section>


        {{-- Statistik Cards --}}
        <section class="dashboard-stats">

            {{-- Card 1: Total Pendaftar --}}
            <article class="stat-card">
                <div>
                    <div class="stat-card__top">
                        <span class="stat-card__label">
                            Total Pendaftar
                        </span>

                        <div class="stat-card__icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>

                    <div class="stat-card__value">
                        <span class="stat-card__number">
                            {{ $totalPendaftar }}
                        </span>

                        <span class="stat-card__unit">
                            Siswa
                        </span>
                    </div>
                </div>

                <div class="stat-card__bottom">
                    <span class="stat-pill" style="background:#ecfdf5; color:#047857;">
                        ● Terdaftar
                    </span>

                    <span>
                        Periode: {{ Str::limit($namaPeriode, 24) }}
                    </span>
                </div>
            </article>


            {{-- Card 2: Kuota Beasiswa --}}
            <article class="stat-card">
                <div>
                    <div class="stat-card__top">
                        <span class="stat-card__label">
                            Kuota Beasiswa
                        </span>

                        <div class="stat-card__icon" style="color:#be185d; font-size:11px; font-weight:800;">
                            {{ $peluangPersen }}%
                        </div>
                    </div>

                    <div class="stat-card__value">
                        <span class="stat-card__number">
                            {{ $kuota }}
                        </span>

                        <span class="stat-card__unit">
                            Siswa Penerima
                        </span>
                    </div>
                </div>

                <div class="stat-card__bottom">
                    <span>
                        <span style="color:#be185d;">●</span>
                        {{ $tidakLolos }} Belum Terakomodasi
                    </span>

                    <strong style="color:#111827;">
                        {{ $peluangPersen }}% Rasio
                    </strong>
                </div>
            </article>


            {{-- Card 3: Ratio Keketatan --}}
            <article class="stat-card">
                <div>
                    <div class="stat-card__top">
                        <span class="stat-card__label">
                            Ratio Keketatan
                        </span>

                        <div class="stat-card__icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
                        </div>
                    </div>

                    <div class="stat-card__value">
                        <span class="stat-card__number">
                            {{ $rasioKeketatan }}
                        </span>

                        <span class="stat-pill" style="color:#be185d; background:#fdf2f8;">
                            {{ $peluangPersen }}% Peluang
                        </span>
                    </div>
                </div>

                <div>
                    <div class="stat-progress">
                        <div class="stat-progress__bar" style="width: {{ $peluangPersen }}%;"></div>
                    </div>

                    <div class="stat-card__bottom" style="border-top:0; padding-top:8px;">
                        <span>
                            ● {{ $totalLolos }} Kuota Lolos
                        </span>

                        <span>
                            • {{ $totalPendaftar }} Pendaftar Total
                        </span>
                    </div>
                </div>
            </article>


            {{-- Card 4: Progress Input Data --}}
            <article class="stat-card">
                <div>
                    <div class="stat-card__top">
                        <span class="stat-card__label">
                            Progress Input Data
                        </span>

                        <div class="stat-card__icon">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                        </div>
                    </div>

                    <div class="stat-card__value">
                        <span class="stat-pill">
                            <span style="color:#10b981;">●</span>
                            {{ $progressPersen }}% Terinput
                        </span>
                    </div>
                </div>

                <div class="stat-card__bottom">
                    <div>
                        <div style="font-size:9px; color:#94a3b8; text-transform:uppercase; font-weight:700;">
                            Status Kelengkapan
                        </div>

                        <strong style="color:#111827;">
                            {{ $berkasTerinput }} / {{ $totalPendaftar }} Berkas
                        </strong>
                    </div>

                    <span style="background:#f1f5f9; padding:4px 8px; border-radius:6px; font-weight:700; color:#475569;">
                        {{ $berkasPending }} Tersisa
                    </span>
                </div>
            </article>

        </section>


        {{-- Main Grid: Distribusi & Sidebar --}}
        <div class="dashboard-main-grid">

            {{-- Kolom Kiri: Distribusi Kriteria & Top Skor SAW --}}
            <section class="dashboard-card dashboard-card--main">

                @php
                    $startTermepet = max(6, $kuota - 5);
                    $hasGap = ($kuota > 10 && $totalLolos >= $startTermepet);
                    $labelTopBatasCount = $hasGap ? 10 : min($totalLolos, 10);
                @endphp

                <div class="dashboard-card__header">
                    <div>
                        <h2 class="dashboard-card__title">
                            Distribusi Kriteria &amp; Top Skor SAW
                        </h2>

                        <p class="dashboard-card__description">
                            Visualisasi skor preferensi kandidat teratas dari normalisasi matriks <strong>R × Bobot W</strong>
                        </p>
                    </div>

                    <div class="dashboard-badges">
                        <span class="dashboard-badge dashboard-badge--periode">
                            <span class="badge-dot"></span>
                            Periode: {{ Str::limit($namaPeriode, 24) }}
                        </span>

                        <span class="dashboard-badge dashboard-badge--fokus">
                            <span class="badge-dot"></span>
                            Top &amp; Batas ({{ $labelTopBatasCount }})
                        </span>
                    </div>
                </div>


                {{-- Ambang Batas Alert --}}
                <div class="cutoff-banner">
                    <span style="display:flex; align-items:center; gap:6px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        @if ($hasHasilSaw && $cutoff !== null)
                            Cutoff Kuota Penerima (Rank 1–{{ $totalLolos }}): <strong>V &ge; {{ number_format($cutoff, 3) }}</strong>
                        @elseif ($hasHasilSaw)
                            Perangkingan SAW tersedia, tetapi belum ada siswa yang masuk kuota kelulusan.
                        @elseif ($periode && $totalPendaftar > 0)
                            Kalkulasi SAW belum dijalankan untuk periode ini (<strong>{{ $totalPendaftar }} siswa terdaftar</strong>).
                        @elseif ($periode)
                            Belum ada calon penerima yang didaftarkan pada periode ini.
                        @else
                            Belum ada periode seleksi yang terdaftar.
                        @endif
                    </span>

                    <span class="cutoff-valid">
                        {{ $totalLolos }} Lolos Kuota
                    </span>
                </div>


                {{-- Ranking Bar Chart / Informative Empty States --}}
                <div class="ranking-list" id="rankingListContainer">

                    @if ($hasHasilSaw && $topCandidates->isNotEmpty())

                        @php
                            $renderedIndex = 0;
                        @endphp

                        @foreach ($topCandidates as $candidate)
                            @php
                                $rank = $candidate->ranking ?? $loop->iteration;
                                $isTop5 = $rank <= 5;
                                $isTermepet = ($rank >= $startTermepet && $rank <= $kuota);
                                $isFokus = ($hasGap) ? ($isTop5 || $isTermepet) : ($rank <= $kuota);

                                // Hanya tampilkan 5 teratas dan 5 termepet kuota
                                if (! $isFokus) {
                                    continue;
                                }

                                $renderedIndex++;
                                $skorSaw = floatval($candidate->skor_saw ?? 0);
                                $isLolos = $candidate->status_kelulusan === 'lolos';
                                $isReserve = $candidate->status_kelulusan === 'cadangan';
                                $statusLabel = match($candidate->status_kelulusan) {
                                    'lolos' => 'Lolos',
                                    'cadangan' => 'Cadangan',
                                    default => 'Tidak Lolos',
                                };
                                $statusClass = match($candidate->status_kelulusan) {
                                    'lolos' => 'status-badge--lolos',
                                    'cadangan' => 'status-badge--reserve',
                                    default => 'status-badge--fail',
                                };
                                $barClass = match($candidate->status_kelulusan) {
                                    'lolos' => '',
                                    'cadangan' => 'ranking-bar__fill--reserve',
                                    default => 'ranking-bar__fill--fail',
                                };
                            @endphp

                            <div class="ranking-row" data-status="{{ $candidate->status_kelulusan }}" data-rank="{{ $rank }}">

                                <span class="ranking-number">
                                    {{ $rank }}
                                </span>

                                <div class="ranking-name">
                                    <strong>
                                        {{ $candidate->nama }}
                                    </strong>

                                    <span>
                                        {{ $candidate->program_studi }} • {{ $candidate->semester }}
                                    </span>
                                </div>

                                <div class="ranking-bar-container">
                                    @if ($cutoff !== null)
                                        <div class="cutoff-header-badge" style="left: {{ number_format($cutoffPercent, 2) }}%; display: {{ $renderedIndex === 1 ? 'block' : 'none' }};">Cutoff: {{ number_format($cutoff, 3) }}</div>
                                        <div class="cutoff-guide-line" style="left: {{ number_format($cutoffPercent, 2) }}%;"></div>
                                    @endif

                                    <div class="ranking-bar">
                                        <div
                                            class="ranking-bar__fill {{ $barClass }}"
                                            style="width: {{ min(100, max(18, $skorSaw * 100)) }}%;"
                                        >
                                            {{ number_format($skorSaw, 3) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="ranking-status">
                                    <span class="status-badge {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </div>

                            </div>

                            {{-- Pemisah / Ellipsis setelah peringkat 5 jika kuota > 10 --}}
                            @if ($hasGap && $rank === 5)
                                <div class="ranking-divider" data-divider="true">
                                    <div class="ranking-divider__bar"></div>
                                    <div class="ranking-divider__content">
                                        <span class="ranking-divider__dots">● ● ●</span>
                                        <span class="ranking-divider__text">
                                            {{ $startTermepet - 6 }} siswa peringkat 6–{{ $startTermepet - 1 }} di dalam kuota tidak ditampilkan
                                        </span>
                                    </div>
                                    <div class="ranking-divider__bar"></div>
                                </div>
                            @endif

                        @endforeach

                    @elseif ($periode && $totalPendaftar > 0 && ! $hasHasilSaw)

                        {{-- Pesan informatif jika pendaftar ada tapi SAW belum dihitung --}}
                        <div class="dashboard-empty-panel">
                            <div class="dashboard-empty-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
                            </div>
                            <h3 class="dashboard-empty-title">Hasil Perhitungan SAW Belum Tersedia</h3>
                            <p class="dashboard-empty-desc">
                                Sebanyak <strong>{{ $totalPendaftar }} calon penerima</strong> telah terdaftar pada periode <strong>{{ $namaPeriode }}</strong>, namun proses normalisasi dan perankingan SAW belum dijalankan.
                            </p>
                            <a href="{{ route('periode.seleksi', $periode) }}" style="display:inline-flex; align-items:center; gap:6px; background:#be185d; color:#fff; font-size:12px; font-weight:700; padding:9px 18px; border-radius:8px; text-decoration:none; margin-top:4px;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                                Buka Menu Seleksi &amp; Hitung SAW
                            </a>
                        </div>

                    @elseif ($periode && $totalPendaftar === 0)

                        {{-- Pesan informatif jika periode belum memiliki pendaftar --}}
                        <div class="dashboard-empty-panel">
                            <div class="dashboard-empty-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </div>
                            <h3 class="dashboard-empty-title">Belum Ada Calon Penerima Terdaftar</h3>
                            <p class="dashboard-empty-desc">
                                Periode <strong>{{ $namaPeriode }}</strong> belum memiliki pendaftar beasiswa. Silakan input data siswa dan penilaian kriteria.
                            </p>
                            <a href="{{ route('periode.seleksi', $periode) }}" style="display:inline-flex; align-items:center; gap:6px; background:#be185d; color:#fff; font-size:12px; font-weight:700; padding:9px 18px; border-radius:8px; text-decoration:none; margin-top:4px;">
                                + Kelola &amp; Tambah Calon Penerima
                            </a>
                        </div>

                    @else

                        {{-- Keadaan Kosong Utama: Belum ada periode sama sekali --}}
                        <div class="dashboard-empty-panel">
                            <div class="dashboard-empty-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </div>
                            <h3 class="dashboard-empty-title">Belum Ada Periode Seleksi</h3>
                            <p class="dashboard-empty-desc">
                                Database sistem belum memiliki periode seleksi beasiswa. Buat periode baru dengan konfigurasi kriteria AHP untuk memulai proses SPK.
                            </p>
                            <a href="{{ route('periode.create') }}" style="display:inline-flex; align-items:center; gap:6px; background:#be185d; color:#fff; font-size:12px; font-weight:700; padding:9px 18px; border-radius:8px; text-decoration:none; margin-top:4px;">
                                + Buat Periode Seleksi Baru
                            </a>
                        </div>

                    @endif

                </div>


                {{-- Footer Chart --}}
                <div class="ranking-footer">

                    <div class="ranking-legend">
                        <span class="legend-item">
                            <span class="legend-dot legend-dot--lolos"></span>
                            Lolos Kuota (Peringkat 1–{{ $kuota }})
                        </span>

                        <span class="legend-item">
                            <span class="legend-dot legend-dot--amber"></span>
                            Cadangan (Peringkat {{ $kuota + 1 }}–{{ $kuota * 2 }})
                        </span>

                        <span class="legend-item">
                            <span class="legend-dot legend-dot--fail"></span>
                            Tidak Lolos (Peringkat &gt; {{ $kuota * 2 }})
                        </span>
                    </div>

                    @if ($periode)
                        <a href="{{ route('periode.seleksi', $periode) }}" class="ranking-link">
                            Lihat Semua {{ $totalPendaftar }} Pendaftar →
                        </a>
                    @else
                        <a href="{{ route('periode.index') }}" class="ranking-link">
                            Buka Manajemen Periode →
                        </a>
                    @endif

                </div>

            </section>


            {{-- Kolom Kanan: Alokasi & Bobot SAW --}}
            <div class="dashboard-side">

                {{-- Card Alokasi Hasil Seleksi --}}
                <section class="dashboard-card">

                    <div class="dashboard-card__header">
                        <div>
                            <h2 class="dashboard-card__title" style="font-size:15px;">
                                Alokasi Hasil Seleksi
                            </h2>

                            <p class="dashboard-card__description">
                                Proporsi {{ $totalPendaftar }} pendaftar terdaftar
                            </p>
                        </div>

                        <div class="stat-card__icon" style="width:28px; height:28px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                        </div>
                    </div>

                    @php
                        $cadanganPersen = ($totalPendaftar > 0 && $totalCadangan > 0) ? round(($totalCadangan / $totalPendaftar) * 100, 1) : 0.0;
                        $tidakLolosPersen = $totalPendaftar > 0 ? round(($tidakLolos / $totalPendaftar) * 100, 1) : 0.0;
                    @endphp

                    <div style="margin-top:16px;">

                        <div class="allocation-labels">
                            <span class="allocation-labels__success">
                                Lolos: {{ $totalLolos }} Siswa ({{ $peluangPersen }}%)
                            </span>

                            @if ($totalCadangan > 0)
                                <span style="color:#b45309; font-weight:700; font-size:11px;">
                                    Cadangan: {{ $totalCadangan }} Siswa ({{ $cadanganPersen }}%)
                                </span>
                            @endif

                            <span class="allocation-labels__failed">
                                Tidak Lolos: {{ $tidakLolos }} Siswa ({{ $tidakLolosPersen }}%)
                            </span>
                        </div>

                        <div class="allocation-bar">
                            @if ($totalPendaftar > 0 && $hasHasilSaw)
                                <div class="allocation-bar__success" style="width: {{ $peluangPersen }}%;"></div>
                                @if ($totalCadangan > 0)
                                    <div style="width: {{ $cadanganPersen }}%; height:100%; background:#f59e0b;"></div>
                                @endif
                                <div class="allocation-bar__failed" style="width: {{ max(0, 100 - $peluangPersen - $cadanganPersen) }}%;"></div>
                            @else
                                <div style="width:100%; height:100%; background:#e2e8f0; border-radius:999px;"></div>
                            @endif
                        </div>

                    </div>


                    <div class="allocation-items">

                        <div class="allocation-item allocation-item--success">
                            <div>
                                <div class="allocation-item__title">
                                    Lolos Seleksi
                                </div>

                                <div class="allocation-item__description">
                                    Peringkat 1 s/d kuota penerima ({{ $kuota }})
                                </div>
                            </div>

                            <div class="allocation-item__value">
                                {{ $totalLolos }} Siswa
                                <br>
                                {{ $peluangPersen }}%
                            </div>
                        </div>

                        @if ($totalCadangan > 0)
                            <div class="allocation-item" style="background:#fffbeb; border:1px solid #fde68a;">
                                <div>
                                    <div class="allocation-item__title" style="color:#b45309;">
                                        Cadangan
                                    </div>

                                    <div class="allocation-item__description" style="color:#92400e;">
                                        Alokasi cadangan (Peringkat {{ $kuota + 1 }}–{{ $kuota * 2 }})
                                    </div>
                                </div>

                                <div class="allocation-item__value" style="color:#b45309;">
                                    {{ $totalCadangan }} Siswa
                                    <br>
                                    {{ $cadanganPersen }}%
                                </div>
                            </div>
                        @endif

                        <div class="allocation-item allocation-item--failed">
                            <div>
                                <div class="allocation-item__title">
                                    Tidak Lolos Seleksi
                                </div>

                                <div class="allocation-item__description">
                                    Di luar kuota utama &amp; cadangan
                                </div>
                            </div>

                            <div class="allocation-item__value">
                                {{ $tidakLolos }} Siswa
                                <br>
                                {{ $tidakLolosPersen }}%
                            </div>
                        </div>

                    </div>

                </section>


                {{-- Card Bobot Kriteria SAW & Donut Chart --}}
                <section class="dashboard-card">

                    <div class="dashboard-card__header">
                        <div>
                            <h2 class="dashboard-card__title" style="font-size:15px;">
                                Bobot Kriteria SAW
                            </h2>

                            <p class="dashboard-card__description">
                                Vektor Prioritas W (Snapshot AHP Periode)
                            </p>
                        </div>

                        <span class="dashboard-badge" style="color:#be185d; background:#fdf2f8; border:1px solid #fbcfe8;">
                            CR = {{ number_format($cr, 3) }}
                        </span>
                    </div>


                    <div class="weight-chart">

                        @php
                            $circumference = 238.761; // 2 * pi * 38
                            $colorMap = ['#be185d', '#f59e0b', '#fb7185', '#818cf8', '#fcd34d'];
                            $weightItems = [];
                            $accumOffset = 0.0;

                            if ($kriterias->isNotEmpty()) {
                                foreach ($kriterias as $idx => $k) {
                                    $w = floatval($k->bobot ?? 0.20);
                                    $pct = round($w * 100);
                                    $attrLabel = ucfirst($k->atribut);
                                    $color = $colorMap[$idx % count($colorMap)];
                                    $dash = round($w * $circumference, 1);
                                    $gap = round($circumference - $dash, 1);

                                    $weightItems[] = [
                                        'name' => "{$k->kode}: {$k->nama} ({$attrLabel})",
                                        'value' => "{$pct}%",
                                        'color' => $color,
                                        'dash' => $dash,
                                        'gap' => $gap,
                                        'offset' => $accumOffset,
                                    ];

                                    $accumOffset += $dash;
                                }
                            }
                        @endphp

                        <svg viewBox="0 0 100 100">
                            @if (! empty($weightItems))
                                @foreach ($weightItems as $wItem)
                                    <circle
                                        cx="50"
                                        cy="50"
                                        r="38"
                                        fill="transparent"
                                        stroke="{{ $wItem['color'] }}"
                                        stroke-width="14"
                                        stroke-dasharray="{{ $wItem['dash'] }} {{ $wItem['gap'] }}"
                                        stroke-dashoffset="-{{ $wItem['offset'] }}"
                                    />
                                @endforeach
                            @else
                                <circle cx="50" cy="50" r="38" fill="transparent" stroke="#e2e8f0" stroke-width="14"/>
                            @endif
                        </svg>

                        <div class="weight-chart__center">
                            <span class="weight-chart__number">
                                {{ $kriterias->count() }}
                            </span>

                            <span class="weight-chart__label">
                                KRITERIA
                            </span>
                        </div>

                    </div>


                    <div class="weight-list">

                        @forelse ($weightItems as $wItem)
                            <div class="weight-item">
                                <span class="weight-item__name">
                                    <span class="weight-dot" style="background: {{ $wItem['color'] }};"></span>
                                    {{ $wItem['name'] }}
                                </span>

                                <strong>
                                    {{ $wItem['value'] }}
                                </strong>
                            </div>
                        @empty
                            <div style="font-size:12px; color:#94a3b8; text-align:center; padding:12px;">
                                Belum ada kriteria snapshot pada periode ini.
                            </div>
                        @endforelse

                    </div>

                </section>

            </div>

        </div>

    </div>

</main>

@endsection