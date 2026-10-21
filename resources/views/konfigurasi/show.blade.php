@extends('layouts.app')

@php
    $pageCss = 'konfigurasi';
    $isUsed = $konfigurasi->isDigunakan();
    $periodesCount = $konfigurasi->periodes->count();
@endphp

@section('title', 'Detail Paket Konfigurasi Seleksi - ' . $konfigurasi->nama)

@section('content')
<div class="konfigurasi-page">

    {{-- Breadcrumb & Header --}}
    <div style="margin-bottom: 24px;">
        <div style="display:flex; align-items:center; gap:6px; font-size:12px; font-weight:600; color:#be185d; margin-bottom:12px;">
            <a href="{{ route('konfigurasi.index') }}" style="color:#be185d; text-decoration:none;">
                &larr; Kembali ke Daftar Konfigurasi
            </a>
            <span style="color:#9ca3af;">/</span>
            <span style="color:#6b7280; font-weight:500;">Detail Paket #{{ $konfigurasi->id }}</span>
        </div>

        <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; flex-wrap:wrap;">
            <div>
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap; margin-bottom:6px;">
                    <h1 style="font-size:24px; font-weight:800; color:#111827; margin:0;">
                        {{ $konfigurasi->nama }}
                    </h1>
                    <span class="pill-version">Versi {{ $konfigurasi->versi }}</span>
                    @if ($konfigurasi->is_konsisten)
                        <span class="pill-consistent">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            Konsisten (CR = {{ number_format($konfigurasi->cr, 3) }})
                        </span>
                    @else
                        <span class="pill-inconsistent">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            Tidak Konsisten (CR = {{ number_format($konfigurasi->cr, 3) }})
                        </span>
                    @endif

                    @if ($konfigurasi->is_siap)
                        <span class="pill-ready">● Siap Digunakan</span>
                    @else
                        <span class="pill-draft">○ Draf</span>
                    @endif
                </div>

                <p style="font-size:13px; color:#6b7280; margin:0; max-width:800px; line-height:1.5;">
                    {{ $konfigurasi->deskripsi ?: 'Paket konfigurasi kriteria penilaian beasiswa dan pembobotan AHP konsisten.' }}
                </p>
            </div>

            <div style="display:flex; align-items:center; gap:8px;">
                <form action="{{ route('konfigurasi.duplikat', $konfigurasi) }}" method="POST" style="margin:0;">
                    @csrf
                    <button type="submit" class="konfigurasi-btn konfigurasi-btn--secondary">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                        Duplikat
                    </button>
                </form>

                <a href="{{ route('konfigurasi.edit', $konfigurasi) }}" class="konfigurasi-btn konfigurasi-btn--primary">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Paket Ini
                </a>
            </div>
        </div>
    </div>

    {{-- DETAIL GRID --}}
    <div style="display:flex; flex-direction:column; gap:24px;">

        {{-- SECTION 1: 5 KRITERIA SELEKSI --}}
        <div class="konfigurasi-box">
            <div style="padding:18px 24px; border-bottom:1px solid #e5e7eb; display:flex; justify-content:space-between; align-items:center; background:#fafafa;">
                <div>
                    <h2 style="font-size:15px; font-weight:700; color:#111827; margin:0 0 2px;">1. Parameter 5 Kriteria Seleksi</h2>
                    <span style="font-size:12px; color:#64748b;">Karakteristik atribut kriteria dan pembagian bobot SAW</span>
                </div>
                <span style="font-size:11px; font-weight:700; background:#fdf2f8; color:#be185d; padding:3px 10px; border-radius:999px; border:1px solid #fbcfe8;">
                    5 Kriteria Terpasang
                </span>
            </div>

            <div class="konfigurasi-table-wrapper">
                <table class="konfigurasi-table">
                    <thead>
                        <tr>
                            <th style="width:70px; text-align:center;">KODE</th>
                            <th style="width:240px;">NAMA KRITERIA</th>
                            <th style="width:140px;">SIFAT ATRIBUT</th>
                            <th style="width:130px;">TIPE INPUT</th>
                            <th style="width:120px;">BOBOT AHP (W_i)</th>
                            <th>RENTANG NILAI / OPSI SUB-KRITERIA (SKOR SAW 1–5)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($konfigurasi->kriterias as $k)
                        @php
                            $pct = round(floatval($k->bobot) * 100);
                        @endphp
                        <tr>
                            <td style="text-align:center; font-weight:800; color:#be185d;">
                                {{ $k->kode }}
                            </td>
                            <td>
                                <strong style="color:#111827; font-size:13px;">{{ $k->nama }}</strong>
                            </td>
                            <td>
                                @if ($k->atribut === 'benefit')
                                    <span style="display:inline-block; padding:3px 9px; font-size:11px; font-weight:700; border-radius:6px; background:#ecfdf5; color:#047857; border:1px solid #a7f3d0;">
                                        Benefit (Maksimum)
                                    </span>
                                @else
                                    <span style="display:inline-block; padding:3px 9px; font-size:11px; font-weight:700; border-radius:6px; background:#fff1f2; color:#be123c; border:1px solid #fecdd3;">
                                        Cost (Minimum)
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($k->tipe_input === 'angka')
                                    <span class="rentang-type-pill pill-angka">Angka (Numerik)</span>
                                @else
                                    <span class="rentang-type-pill pill-pilihan">Pilihan (Kategori)</span>
                                @endif
                            </td>
                            <td>
                                <strong style="font-family:monospace; font-size:13px; color:#be185d;">
                                    {{ number_format($k->bobot, 2) }} ({{ $pct }}%)
                                </strong>
                            </td>
                            <td>
                                @if ($k->tipe_input === 'angka')
                                    <div style="font-size:12px; color:#374151;">
                                        <span>{{ $k->rentang ?: "Rentang: {$k->min_val} s/d {$k->max_val}" . ($k->satuan ? " ({$k->satuan})" : '') }}</span>
                                        <div style="font-size:10px; color:#9ca3af; margin-top:2px;">
                                            Nilai Min: {{ $k->min_val }} &bull; Nilai Max: {{ $k->max_val }} &bull; Satuan: {{ $k->satuan ?: '-' }}
                                        </div>
                                    </div>
                                @else
                                    <div style="display:flex; flex-direction:column; gap:4px;">
                                        @foreach ($k->subKriterias as $sub)
                                            <div style="display:flex; align-items:center; gap:6px; font-size:11px;">
                                                <span style="font-weight:700; color:#be185d; background:#fdf2f8; padding:1px 6px; border-radius:4px; font-family:monospace;">
                                                    Skor {{ $sub->nilai }}
                                                </span>
                                                <span style="color:#374151;">{{ $sub->label }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- SECTION 2: MATRIKS PERBANDINGAN BERPASANGAN AHP --}}
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">
            {{-- MATRIKS AHP TABLE --}}
            <div class="konfigurasi-box">
                <div style="padding:16px 20px; border-bottom:1px solid #e5e7eb; background:#fafafa;">
                    <h2 style="font-size:14px; font-weight:700; color:#111827; margin:0 0 2px;">2. Matriks Perbandingan Berpasangan [A]</h2>
                    <span style="font-size:11px; color:#64748b;">Intensitas kepentingan antar kriteria (Skala Saaty)</span>
                </div>
                <div style="padding:16px; overflow-x:auto;">
                    @php
                        $kKeys = ['C1', 'C2', 'C3', 'C4', 'C5'];
                        $matrix = $konfigurasi->matriks_ahp ?? [];
                    @endphp
                    <table style="width:100%; border-collapse:collapse; text-align:center; font-size:12px; border:1px solid #e5e7eb; border-radius:8px;">
                        <thead>
                            <tr style="background:#f8fafc;">
                                <th style="padding:8px; border-bottom:1px solid #e5e7eb; text-align:left;">Kriteria</th>
                                @foreach ($kKeys as $k)
                                    <th style="padding:8px; border-bottom:1px solid #e5e7eb; font-family:monospace; color:#be185d;">{{ $k }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kKeys as $i)
                                <tr>
                                    <td style="padding:8px; border-bottom:1px solid #f1f5f9; text-align:left; font-weight:700; color:#374151;">{{ $i }}</td>
                                    @foreach ($kKeys as $j)
                                        @php
                                            $val = $matrix[$i][$j] ?? ($i === $j ? 1.0 : 1.0);
                                        @endphp
                                        <td style="padding:8px; border-bottom:1px solid #f1f5f9; font-family:monospace; font-size:11px; background:{{ $i === $j ? '#fdf2f8' : '#fff' }}; font-weight:{{ $i === $j ? '700' : '500' }}; color:{{ $i === $j ? '#be185d' : '#334155' }};">
                                            {{ number_format(floatval($val), 3) }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- UJI RASIO KONSISTENSI & BOBOT SAW --}}
            <div class="konfigurasi-box">
                <div style="padding:16px 20px; border-bottom:1px solid #e5e7eb; background:#fafafa; display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <h2 style="font-size:14px; font-weight:700; color:#111827; margin:0 0 2px;">3. Statistik Konsistensi & Bobot SAW</h2>
                        <span style="font-size:11px; color:#64748b;">Hasil kalkulasi eigen vektor dan validitas matematis</span>
                    </div>
                    <span style="font-size:11px; font-weight:700; background:#fdf2f8; color:#be185d; padding:3px 10px; border-radius:999px; border:1px solid #fbcfe8; font-family:monospace;">
                        Total = 1.00 (100%)
                    </span>
                </div>
                <div style="padding:16px; display:flex; flex-direction:column; gap:16px;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; font-size:12px;">
                        <div style="padding:10px; border:1px solid #e5e7eb; border-radius:8px; background:#f9fafb;">
                            <span style="color:#64748b; font-size:11px; display:block;">Principal Eigenvalue (&lambda; max)</span>
                            <strong style="font-size:15px; font-family:monospace; color:#111827;">{{ number_format($konfigurasi->lambda_max ?? 0, 3) }}</strong>
                        </div>
                        <div style="padding:10px; border:1px solid #e5e7eb; border-radius:8px; background:#f9fafb;">
                            <span style="color:#64748b; font-size:11px; display:block;">Consistency Index (CI)</span>
                            <strong style="font-size:15px; font-family:monospace; color:#111827;">{{ number_format($konfigurasi->ci ?? 0, 3) }}</strong>
                        </div>
                        <div style="padding:10px; border:1px solid #e5e7eb; border-radius:8px; background:#f9fafb;">
                            <span style="color:#64748b; font-size:11px; display:block;">Random Index (RI n=5)</span>
                            <strong style="font-size:15px; font-family:monospace; color:#111827;">1.120</strong>
                        </div>
                        <div style="padding:10px; border:1px solid {{ $konfigurasi->is_konsisten ? '#a7f3d0' : '#fde68a' }}; border-radius:8px; background:{{ $konfigurasi->is_konsisten ? '#ecfdf5' : '#fffbeb' }};">
                            <span style="color:{{ $konfigurasi->is_konsisten ? '#047857' : '#92400e' }}; font-size:11px; display:block; font-weight:700;">Consistency Ratio (CR)</span>
                            <strong style="font-size:15px; font-family:monospace; color:{{ $konfigurasi->is_konsisten ? '#047857' : '#92400e' }};">
                                {{ number_format($konfigurasi->cr ?? 0, 3) }}
                            </strong>
                        </div>
                    </div>

                    {{-- PROGRESS BARS --}}
                    <div style="display:flex; flex-direction:column; gap:8px;">
                        @foreach ($konfigurasi->kriterias as $k)
                        @php
                            $pct = round(floatval($k->bobot) * 100);
                        @endphp
                        <div>
                            <div style="display:flex; justify-content:space-between; font-size:11px; font-weight:600; color:#374151; margin-bottom:2px;">
                                <span>{{ $k->kode }} - {{ $k->nama }}</span>
                                <span style="font-family:monospace; font-weight:700;">{{ number_format($k->bobot, 2) }} ({{ $pct }}%)</span>
                            </div>
                            <div style="width:100%; height:8px; background:#f1f5f9; border-radius:999px; overflow:hidden;">
                                <div style="width:{{ $pct }}%; height:100%; background:#be185d; border-radius:999px;"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- SECTION 3: DAFTAR PERIODE YANG MENGGUNAKAN KONFIGURASI INI --}}
        <div class="konfigurasi-box">
            <div style="padding:16px 20px; border-bottom:1px solid #e5e7eb; background:#fafafa; display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h2 style="font-size:14px; font-weight:700; color:#111827; margin:0 0 2px;">4. Penggunaan Paket oleh Periode Seleksi</h2>
                    <span style="font-size:11px; color:#64748b;">Daftar periode aktif maupun historis yang mengadopsi konfigurasi ini</span>
                </div>
                <span class="badge-used">
                    {{ $periodesCount }} Periode Terhubung
                </span>
            </div>

            <div style="padding:20px;">
                @if ($konfigurasi->periodes->isNotEmpty())
                    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:12px;">
                        @foreach ($konfigurasi->periodes as $p)
                            <div style="padding:14px 16px; border:1px solid #e5e7eb; border-radius:10px; background:#fff; display:flex; justify-content:space-between; align-items:center;">
                                <div>
                                    <strong style="color:#111827; font-size:13px; display:block;">{{ $p->nama }}</strong>
                                    <span style="font-size:11px; color:#64748b;">
                                        Tahun {{ $p->tahun }} &bull; Kuota: {{ $p->kuota }} Siswa &bull; {{ $p->status }}
                                    </span>
                                </div>
                                <a href="{{ route('periode.seleksi', $p) }}" class="konfigurasi-btn konfigurasi-btn--secondary" style="padding:4px 10px; font-size:11px;">
                                    Buka Seleksi &rarr;
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="font-size:13px; color:#64748b; margin:0; text-align:center; padding:16px;">
                        Belum ada periode seleksi yang menggunakan paket konfigurasi ini. Paket ini siap dipilih saat Anda membuat periode seleksi baru.
                    </p>
                @endif
            </div>
        </div>

    </div>

</div>
@endsection
