@extends('layouts.app')

@section('title', 'Dashboard Seleksi - SPK Beasiswa Prestasi')

@php
    $pageCss = 'dashboard';

    $namaPeriode = $periode?->nama ?? 'TA 2026/2027 Ganjil';
    $tahunPeriode = $periode?->tahun ?? 2026;
@endphp

@section('content')

<main class="dashboard-page">

    <div class="dashboard-stack">

        {{-- Hero Banner --}}
        <section class="dashboard-hero">

            <div class="dashboard-hero__content">

                <div class="dashboard-hero__badge">
                    <span class="dashboard-hero__badge-dot"></span>
                    Tahun Ajaran {{ $tahunPeriode }}/{{ $tahunPeriode + 1 }} Ganjil • Seleksi Terbuka
                </div>

                <h1>
                    Sistem Pendukung Keputusan Penentuan Penerima Beasiswa
                </h1>

                <p>
                    Penyelenggaraan seleksi objektif dan transparan menggunakan algoritma normalisasi multi-kriteria
                    Simple Additive Weighting (SAW) berbobot Analytical Hierarchy Process (AHP).
                </p>

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
                            {{ $totalPendaftar ?: 128 }}
                        </span>

                        <span class="stat-card__unit">
                            Siswa
                        </span>
                    </div>
                </div>

                <div class="stat-card__bottom">
                    <span class="stat-pill">
                        +12%
                    </span>

                    <span>
                        vs. periode sebelumnya
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
                            {{ $peluangPersen ?: '11.7' }}%
                        </div>
                    </div>

                    <div class="stat-card__value">
                        <span class="stat-card__number">
                            {{ $kuota ?: 15 }}
                        </span>

                        <span class="stat-card__unit">
                            Kursi Penerima
                        </span>
                    </div>
                </div>

                <div class="stat-card__bottom">
                    <span>
                        <span style="color:#be185d;">●</span>
                        {{ $tidakLolos ?: 113 }} Belum Terakomodasi
                    </span>

                    <strong style="color:#111827;">
                        {{ $peluangPersen ?: '11.7' }}% Rasio
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
                            {{ $rasioKeketatan ?: '1:8.5' }}
                        </span>

                        <span class="stat-pill" style="color:#be185d; background:#fdf2f8;">
                            {{ $peluangPersen ?: '11.7' }}% Peluang
                        </span>
                    </div>
                </div>

                <div>
                    <div class="stat-progress">
                        <div class="stat-progress__bar" style="width: {{ $peluangPersen ?: 11.7 }}%;"></div>
                    </div>

                    <div class="stat-card__bottom" style="border-top:0; padding-top:8px;">
                        <span>
                            ● {{ $kuota ?: 15 }} Kuota Lolos
                        </span>

                        <span>
                            • {{ $totalPendaftar ?: 128 }} Pendaftar Total
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
                            {{ $progressPersen ?: '81.2' }}% Terinput
                        </span>
                    </div>
                </div>

                <div class="stat-card__bottom">
                    <div>
                        <div style="font-size:9px; color:#94a3b8; text-transform:uppercase; font-weight:700;">
                            Status Kelengkapan
                        </div>

                        <strong style="color:#111827;">
                            {{ $berkasTerinput ?: 104 }} / {{ $totalPendaftar ?: 128 }} Berkas
                        </strong>
                    </div>

                    <span style="background:#f1f5f9; padding:4px 8px; border-radius:6px; font-weight:700; color:#475569;">
                        {{ $berkasPending ?: 24 }} Tersisa
                    </span>
                </div>
            </article>

        </section>


        {{-- Main Grid: Distribusi & Sidebar --}}
        <div class="dashboard-main-grid">

            {{-- Kolom Kiri: Distribusi Kriteria & Top Skor SAW --}}
            <section class="dashboard-card">

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
                        <span class="dashboard-badge">
                            Index V_i
                        </span>

                        <span class="dashboard-badge dashboard-badge--success">
                            ● Periode: {{ $namaPeriode }}
                        </span>

                        <div class="dashboard-tabs">
                            <button class="is-active">
                                Top 6 Skor
                            </button>

                            <button>
                                Kuota ({{ $kuota ?: 15 }})
                            </button>

                            <button>
                                Cadangan
                            </button>
                        </div>
                    </div>
                </div>


                {{-- Ambang Batas Alert --}}
                <div class="cutoff-banner">
                    <span style="display:flex; align-items:center; gap:6px;">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                        Ambang batas kelulusan kuota beasiswa adalah <strong>V ≥ 0.800</strong>
                    </span>

                    <span class="cutoff-valid">
                        {{ $totalLolos ?: 15 }} Lolos Valid
                    </span>
                </div>


                {{-- Ranking Bar Chart --}}
                <div class="ranking-list">

                    @php
                        // Jika kandidat dari database ada, gunakan data database; jika kosong gunakan data sampel visual
                        $displayCandidates = $topCandidates->isNotEmpty()
                            ? $topCandidates->map(function ($c) {
                                return [
                                    'name' => $c->nama,
                                    'major' => $c->program_studi,
                                    'score' => floatval($c->skor_saw ?? 0.85),
                                    'status' => $c->status_kelulusan === 'lolos' ? 'Lolos' : ($c->status_kelulusan === 'cadangan' ? 'Cadangan' : 'Gugur'),
                                ];
                            })->toArray()
                            : [
                                ['name' => 'Rizky Pratama Saputra', 'major' => 'Rekayasa Perangkat Lunak', 'score' => 0.942, 'status' => 'Lolos'],
                                ['name' => 'Siti Aisyah Nuraini', 'major' => 'Akuntansi & Keuangan Lembaga', 'score' => 0.915, 'status' => 'Lolos'],
                                ['name' => 'Muhammad Budi Santoso', 'major' => 'Teknik Komputer & Jaringan', 'score' => 0.898, 'status' => 'Lolos'],
                                ['name' => 'Dwi Lestari Handayani', 'major' => 'Desain Komunikasi Visual', 'score' => 0.874, 'status' => 'Lolos'],
                                ['name' => 'Fajar Nugroho Setiawan', 'major' => 'Teknik Kendaraan Ringan', 'score' => 0.825, 'status' => 'Lolos'],
                                ['name' => 'Anisa Rahmawati Putri', 'major' => 'Rekayasa Perangkat Lunak', 'score' => 0.791, 'status' => 'Cadangan'],
                            ];
                    @endphp

                    @foreach ($displayCandidates as $candidate)

                        <div class="ranking-row">

                            <span class="ranking-number">
                                {{ $loop->iteration }}
                            </span>

                            <div class="ranking-name">
                                <strong>
                                    {{ $candidate['name'] }}
                                </strong>

                                <span>
                                    {{ $candidate['major'] }}
                                </span>
                            </div>

                            <div class="ranking-bar-container">
                                @if ($loop->first)
                                    <div class="cutoff-header-badge">Cutoff: 0.800</div>
                                @endif
                                <div class="cutoff-guide-line"></div>

                                <div class="ranking-bar">
                                    <div
                                        class="ranking-bar__fill {{ $candidate['status'] === 'Cadangan' ? 'ranking-bar__fill--reserve' : '' }}"
                                        style="width: {{ min(100, max(20, $candidate['score'] * 100)) }}%;"
                                    >
                                        {{ number_format($candidate['score'], 3) }}
                                    </div>
                                </div>
                            </div>

                            <div class="ranking-status">
                                <span class="status-badge {{ $candidate['status'] === 'Cadangan' ? 'status-badge--reserve' : '' }}">
                                    {{ $candidate['status'] }}
                                </span>
                            </div>

                        </div>

                    @endforeach

                </div>


                {{-- Footer Chart --}}
                <div class="ranking-footer">

                    <div class="ranking-legend">
                        <span class="legend-item">
                            <span class="legend-dot"></span>
                            Lolos Kuota Penerima (Rank 1 - {{ $kuota ?: 15 }})
                        </span>

                        <span class="legend-item">
                            <span class="legend-dot legend-dot--amber"></span>
                            Batas Cadangan (Rank {{ ($kuota ?: 15) + 1 }} - {{ ($kuota ?: 15) * 2 }})
                        </span>
                    </div>

                    @if ($periode)
                        <a href="{{ route('periode.seleksi', $periode) }}" class="ranking-link">
                            Lihat Semua {{ $totalPendaftar ?: 128 }} Pendaftar →
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
                                Proporsi {{ $totalPendaftar ?: 128 }} pendaftar terdaftar
                            </p>
                        </div>

                        <div class="stat-card__icon" style="width:28px; height:28px;">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                        </div>
                    </div>

                    <div style="margin-top:16px;">

                        <div class="allocation-labels">
                            <span class="allocation-labels__success">
                                Lolos Seleksi: {{ $totalLolos ?: 5 }} Siswa ({{ $peluangPersen ?: '33.3' }}%)
                            </span>

                            <span class="allocation-labels__failed">
                                Tidak Lolos: {{ $tidakLolos ?: 10 }} Siswa ({{ number_format(100 - ($peluangPersen ?: 33.3), 1) }}%)
                            </span>
                        </div>

                        <div class="allocation-bar">
                            <div class="allocation-bar__success" style="width: {{ $peluangPersen ?: 33.3 }}%;"></div>
                            <div class="allocation-bar__failed" style="width: {{ 100 - ($peluangPersen ?: 33.3) }}%;"></div>
                        </div>

                    </div>


                    <div class="allocation-items">

                        <div class="allocation-item allocation-item--success">
                            <div>
                                <div class="allocation-item__title">
                                    Lolos Seleksi
                                </div>

                                <div class="allocation-item__description">
                                    Memenuhi ambang batas & kuota
                                </div>
                            </div>

                            <div class="allocation-item__value">
                                {{ $totalLolos ?: 5 }} Siswa
                                <br>
                                {{ $peluangPersen ?: '33.3' }}%
                            </div>
                        </div>


                        <div class="allocation-item allocation-item--failed">
                            <div>
                                <div class="allocation-item__title">
                                    Tidak Lolos Seleksi
                                </div>

                                <div class="allocation-item__description">
                                    Cadangan, gugur, belum lengkap
                                </div>
                            </div>

                            <div class="allocation-item__value">
                                {{ $tidakLolos ?: 10 }} Siswa
                                <br>
                                {{ number_format(100 - ($peluangPersen ?: 33.3), 1) }}%
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
                                Vektor Prioritas W (AHP)
                            </p>
                        </div>

                        <span class="dashboard-badge" style="color:#be185d; background:#fdf2f8; border:1px solid #fbcfe8;">
                            CR = {{ number_format($cr ?: 0.042, 3) }}
                        </span>
                    </div>


                    <div class="weight-chart">

                        <svg viewBox="0 0 100 100">
                            {{-- C1: 40% (stroke-dasharray 95.5 143.2) --}}
                            <circle cx="50" cy="50" r="38" fill="transparent" stroke="#be185d" stroke-width="14" stroke-dasharray="95.5 143.2"/>
                            {{-- C2: 24% (stroke-dasharray 57.3 181.4) --}}
                            <circle cx="50" cy="50" r="38" fill="transparent" stroke="#f59e0b" stroke-width="14" stroke-dasharray="57.3 181.4" stroke-dashoffset="-95.5"/>
                            {{-- C3: 16% (stroke-dasharray 38.2 200.5) --}}
                            <circle cx="50" cy="50" r="38" fill="transparent" stroke="#fb7185" stroke-width="14" stroke-dasharray="38.2 200.5" stroke-dashoffset="-152.8"/>
                            {{-- C4: 11% (stroke-dasharray 26.3 212.4) --}}
                            <circle cx="50" cy="50" r="38" fill="transparent" stroke="#818cf8" stroke-width="14" stroke-dasharray="26.3 212.4" stroke-dashoffset="-191"/>
                            {{-- C5: 9% (stroke-dasharray 21.5 217.2) --}}
                            <circle cx="50" cy="50" r="38" fill="transparent" stroke="#fcd34d" stroke-width="14" stroke-dasharray="21.5 217.2" stroke-dashoffset="-217.3"/>
                        </svg>

                        <div class="weight-chart__center">
                            <span class="weight-chart__number">
                                {{ $kriterias->isNotEmpty() ? $kriterias->count() : 5 }}
                            </span>

                            <span class="weight-chart__label">
                                KRITERIA
                            </span>
                        </div>

                    </div>


                    <div class="weight-list">

                        @php
                            $colorMap = ['#be185d', '#f59e0b', '#fb7185', '#818cf8', '#fcd34d'];
                            $weightItems = [];
                            if ($kriterias->isNotEmpty()) {
                                foreach ($kriterias as $idx => $k) {
                                    $pct = round(floatval($k->bobot ?? 0.20) * 100);
                                    $attrLabel = ucfirst($k->atribut);
                                    $weightItems[] = [
                                        'name' => "{$k->kode}: {$k->nama} ({$attrLabel})",
                                        'value' => "{$pct}%",
                                        'color' => $colorMap[$idx % count($colorMap)],
                                    ];
                                }
                            } else {
                                $weightItems = [
                                    ['name' => 'C1: Indeks Prestasi (Benefit)', 'value' => '40%', 'color' => '#be185d'],
                                    ['name' => 'C2: Penghasilan Ortu (Cost)', 'value' => '24%', 'color' => '#f59e0b'],
                                    ['name' => 'C3: Tanggungan Keluarga (Benefit)', 'value' => '16%', 'color' => '#fb7185'],
                                    ['name' => 'C4: Prestasi / Ekstrakurikuler', 'value' => '11%', 'color' => '#818cf8'],
                                    ['name' => 'C5: Tingkat Kehadiran/Disiplin', 'value' => '9%', 'color' => '#fcd34d'],
                                ];
                            }
                        @endphp

                        @foreach ($weightItems as $wItem)
                            <div class="weight-item">
                                <span class="weight-item__name">
                                    <span class="weight-dot" style="background: {{ $wItem['color'] }};"></span>
                                    {{ $wItem['name'] }}
                                </span>

                                <strong>
                                    {{ $wItem['value'] }}
                                </strong>
                            </div>
                        @endforeach

                    </div>

                </section>

            </div>

        </div>

    </div>

</main>

@endsection