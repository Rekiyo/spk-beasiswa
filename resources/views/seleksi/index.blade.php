@extends('layouts.app')

@php
    $pageCss = 'seleksi';
@endphp

@section('title', 'Kelola Seleksi & Perangkingan - ' . $periode->nama)

@section('content')
<main class="seleksi-page-main">

    {{-- Breadcrumb & Title Row --}}
    <div class="header-container">
        <div class="breadcrumb-row">
            <a href="{{ route('periode.index') }}" class="breadcrumb-back">
                <span>←</span> Kembali ke Manajemen Periode
            </a>
            <span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">Kelola Seleksi &amp; Perangkingan</span>
        </div>
        
        <div class="header-action-row">
            <div class="title-group">
                <div class="title-row">
                    <h1 class="page-title">Kelola Seleksi &amp; Perangkingan</h1>
                    <span class="method-badge">
                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Metode SPK: SAW Terbobot AHP
                    </span>
                </div>
                <p class="page-desc">Kelola data calon siswa penerima beasiswa prestasi SMK, input nilai kriteria, import data, dan pantau rekapitulasi hasil perangkingan SAW secara otomatis.</p>
            </div>
            
            <div class="header-btn-group">
                @if (!$periode->isTerkunci())
                    <button type="button" class="btn btn-primary" onclick="resetFormCalon(); scrollToForm();">
                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Siswa Baru
                    </button>
                    <button type="button" class="btn btn-outline" onclick="openImportModal()">
                        <svg class="icon-sm text-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Import CSV / Excel
                    </button>
                @endif
                <a href="{{ route('periode.seleksi.export', $periode) }}" class="btn btn-outline">
                    <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Export Laporan SK
                </a>
            </div>
        </div>
    </div>

    {{-- Info Panel: Periode Aktif --}}
    <section class="info-panel">
        <div class="info-grid">
            <div class="info-left">
                <div class="tags-row">
                    <span class="tag {{ $periode->isTerkunci() ? 'tag-gray' : 'tag-success' }}">
                        <span class="dot {{ $periode->isTerkunci() ? '' : 'pulse' }}"></span>
                        {{ $periode->isTerkunci() ? 'Periode Ditutup / Selesai' : 'Periode Seleksi Berjalan' }}
                    </span>
                    <span class="tag tag-gray">
                        <svg class="icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Metode: SAW Terbobot AHP (CR: {{ number_format($periode->cr ?? 0.038, 3) }})
                    </span>
                    <span class="tag tag-outline font-mono">Tahun Ajaran: {{ $periode->tahun }}/{{ $periode->tahun + 1 }}</span>
                </div>
                <h2>{{ $periode->nama }}</h2>
                <p>Panitia Seleksi Beasiswa SMK Prestasi — Seleksi kelayakan penerima beasiswa berdasarkan nilai akademik rapor, penghasilan orang tua, tanggungan keluarga, keaktifan ekstrakurikuler, dan kedisiplinan presensi sekolah.</p>
            </div>
            <div class="info-right">
                <div class="stat-box">
                    <div class="stat-content">
                        <span class="stat-label">STATUS PERIODE</span>
                        <strong class="stat-value">{{ $periode->tanggal_mulai->format('d M') }} – {{ $periode->deadline->format('d M Y') }}</strong>
                        <span class="stat-sub {{ $periode->isTerkunci() ? 'text-gray' : 'text-danger' }}">
                            {{ $periode->isTerkunci() ? 'Seleksi Telah Ditutup' : 'Pendaftaran Dibuka' }}
                        </span>
                    </div>
                    <div class="stat-icon bg-success-light text-success">
                        <svg class="icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                </div>
                <div class="stat-box">
                    <div class="stat-content">
                        <span class="stat-label">ALOKASI KUOTA</span>
                        <strong class="stat-value">{{ $periode->kuota }} Siswa Penerima</strong>
                        <span class="stat-sub" style="color:#6b7280;">Biro Kesiswaan SMK <span class="text-gray" style="font-weight:700;">(Total {{ $totalCalon }} Pendaftar)</span></span>
                    </div>
                    <div class="stat-icon bg-brand-light text-brand">
                        <svg class="icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Controls Bar & Weights Legend --}}
    <div class="controls-bar">
        <div class="tabs-group">
            <button type="button" class="tab-btn tab-active" onclick="scrollToForm()">
                <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Input &amp; Nilai Siswa
            </button>
            <a href="#rekapTable" class="tab-btn" style="text-decoration:none;">
                <svg class="icon-sm text-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Rekapitulasi Perangkingan
                <span class="badge-count">{{ $totalCalon }} Siswa</span>
            </a>
        </div>
        <div class="weight-note">
             <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
             <span>Bobot AHP:
                @foreach ($kriterias as $k)
                    <strong>{{ $k->kode }} ({{ round(floatval($k->bobot) * 100) }}%)</strong>{{ !$loop->last ? ' • ' : '' }}
                @endforeach
             </span>
        </div>
    </div>

    {{-- Form Penilaian Siswa Baru / Edit Nilai Kriteria SMK --}}
    @if (!$periode->isTerkunci())
    <section class="card-section" id="formCalonCard">
        <div class="card-header bg-gray-light">
             <div style="display:flex; align-items:center; gap:10px;">
                 <div class="icon-box bg-brand-light text-brand">
                     <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                 </div>
                 <div>
                     <h2 class="card-title" id="formCardTitle">Form Input Data Siswa &amp; Penilaian Kriteria SMK</h2>
                     <span style="font-size:11px; color:#6b7280;" id="formCardSub">Tambahkan data calon siswa dan nilai kriteria acuan seleksi</span>
                 </div>
             </div>
             <div style="display:flex; align-items:center; gap:8px;">
                 <button type="button" class="btn btn-outline btn-sm" id="btnModeBatal" style="display:none;" onclick="resetFormCalon()">
                     ✕ Batal Edit (Tambah Baru)
                 </button>
                 <span class="tag tag-success font-medium">*Seluruh 5 Kriteria Wajib Terisi</span>
             </div>
        </div>
        
        <form action="{{ route('periode.seleksi.store', $periode) }}" method="POST" id="formCalon">
            @csrf
            <input type="hidden" name="calon_id" id="inputCalonId" value="">

            <div class="card-body">
                <div class="form-grid-layout">
                    {{-- Left Column: Identitas Akademik Siswa SMK --}}
                    <div class="form-left-col">
                        <div class="section-sub-title">
                            <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <h3>1. IDENTITAS AKADEMIK SISWA</h3>
                        </div>
                        
                        <div class="form-group-spacing">
                            <div class="form-group">
                                <label>Nomor Induk Siswa Nasional (NISN) <span class="text-danger">*</span></label>
                                <input type="text" name="nim" id="inputNim" class="form-input font-mono" placeholder="Contoh: 0078123416" required>
                            </div>

                            <div class="form-group">
                                <label>Nama Lengkap Siswa <span class="text-danger">*</span></label>
                                <input type="text" name="nama" id="inputNama" class="form-input" placeholder="Masukkan nama siswa..." required>
                            </div>

                            <div class="form-group">
                                <label>Konsentrasi Keahlian / Jurusan SMK <span class="text-danger">*</span></label>
                                <input type="text" name="program_studi" id="inputProdi" class="form-input" placeholder="Contoh: Rekayasa Perangkat Lunak (RPL)" value="Rekayasa Perangkat Lunak" required>
                            </div>

                            <div class="form-group">
                                <label>Tingkat / Kelas Siswa <span class="text-danger">*</span></label>
                                <input type="text" name="semester" id="inputKelas" class="form-input" placeholder="Contoh: Kelas XII RPL 1" value="Kelas XII RPL 1" required>
                            </div>

                            <input type="hidden" name="jalur" id="inputJalur" value="Reguler Prestasi SMK">
                            
                            {{-- Live Profile Preview Badge --}}
                            <div class="profile-preview">
                                <div class="avatar" id="avatarPreview">SMK</div>
                                <div>
                                    <div class="profile-name" id="previewNama">Nama Calon Siswa</div>
                                    <div class="profile-sub" id="previewProdi">Kelas XII RPL 1 • Rekayasa Perangkat Lunak</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Right Column: Matriks Penilaian SAW (C1 - C5) Berjejer Simetris & Sejajar --}}
                    <div class="form-right-col">
                        <div class="section-sub-title" style="display:flex; justify-content:space-between; align-items:center;">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                <h3>2. NILAI KRITERIA SELEKSI (C1 – C5)</h3>
                            </div>
                            <span class="tag tag-success font-medium">Standar Nilai SMK Baku</span>
                        </div>
                        
                        <div class="criteria-list">
                            @foreach ($kriterias as $k)
                                @php
                                    $kode = $k->kode;
                                    $bobotPct = round(floatval($k->bobot) * 100);
                                @endphp

                                <div class="criterion-row-card">
                                    <div class="c-info-col">
                                        <div class="c-header-line">
                                            <span class="c-code-badge">{{ $k->kode }}</span>
                                            <span class="c-name-label">{{ $k->nama }}</span>
                                            <span class="tag-sm {{ $k->atribut === 'benefit' ? 'tag-success' : 'tag-danger' }}">
                                                {{ ucfirst($k->atribut) }} (W: {{ $bobotPct }}%)
                                            </span>
                                        </div>
                                        <p class="c-sub-desc">
                                            @if ($k->tipe_input === 'angka')
                                                {{ $k->rentang ?: 'Rentang: ' . ($k->min_val ?? 0) . ' s/d ' . ($k->max_val ?? 100) . ($k->satuan ? ' (' . $k->satuan . ')' : '') }}
                                            @else
                                                {{ $k->rentang ?: 'Pilihan Menu Paket / Opsi Sub-Kriteria Siswa' }}
                                            @endif
                                        </p>
                                    </div>

                                    <div class="c-input-col">
                                        @if ($k->tipe_input === 'pilihan')
                                            {{-- Dropdown Pilihan Kategori --}}
                                            <select name="nilai[{{ $k->id }}]" id="nilai_{{ $kode }}" class="form-select font-semibold" style="width:100%;">
                                                @if ($k->subKriterias->isNotEmpty())
                                                    @foreach ($k->subKriterias as $sub)
                                                        <option value="{{ $sub->nilai }}" {{ ($kode === 'C3' && $sub->nilai == 3) || ($kode === 'C4' && $sub->nilai == 4) ? 'selected' : '' }}>
                                                            {{ $sub->label }} (Nilai SAW: {{ $sub->nilai }})
                                                        </option>
                                                    @endforeach
                                                @elseif ($kode === 'C3')
                                                    <option value="1">1 Orang Tanggungan (Nilai SAW: 1)</option>
                                                    <option value="2">2 Orang Tanggungan (Nilai SAW: 2)</option>
                                                    <option value="3" selected>3 Orang Tanggungan (Nilai SAW: 3)</option>
                                                    <option value="4">4 Orang Tanggungan (Nilai SAW: 4)</option>
                                                    <option value="5">> 4 Orang Tanggungan (Nilai SAW: 5)</option>
                                                @elseif ($kode === 'C4')
                                                    <option value="1">Paket 1: Pramuka, Komputer, dan Paskibra (Nilai SAW: 1)</option>
                                                    <option value="2">Paket 2: Komputer dan Paskibra (Nilai SAW: 2)</option>
                                                    <option value="3">Paket 3: Pramuka dan Paskibra (Nilai SAW: 3)</option>
                                                    <option value="4" selected>Paket 4: Olahraga (Nilai SAW: 4)</option>
                                                    <option value="5">Paket 5: Pakata (Nilai SAW: 5)</option>
                                                @else
                                                    <option value="1">Opsi 1 (Nilai SAW: 1)</option>
                                                    <option value="2">Opsi 2 (Nilai SAW: 2)</option>
                                                    <option value="3" selected>Opsi 3 (Nilai SAW: 3)</option>
                                                @endif
                                            </select>
                                        @else
                                            {{-- Input Angka Numerik --}}
                                            @if ($kode === 'C2' || str_contains(strtolower($k->satuan ?? ''), 'rupiah') || str_starts_with(trim($k->satuan ?? ''), 'Rp'))
                                                <div class="input-prefix-wrapper">
                                                    <span class="input-prefix">Rp</span>
                                                    <input type="number" step="50000" min="{{ $k->min_val ?? 0 }}" max="{{ $k->max_val ?: '' }}" name="nilai[{{ $k->id }}]" id="nilai_{{ $kode }}" class="form-input font-bold font-mono" style="padding-left: 36px; width:100%;" placeholder="Contoh: 2500000" value="2500000" required>
                                                </div>
                                            @elseif ($kode === 'C1')
                                                <div class="input-suffix-wrapper">
                                                    <input type="number" step="0.01" min="{{ $k->min_val ?? 0 }}" max="{{ $k->max_val ?? 100 }}" name="nilai[{{ $k->id }}]" id="nilai_{{ $kode }}" class="form-input font-bold" placeholder="Contoh: 85.00" value="85.00" style="width:100%;" required>
                                                    <span class="input-suffix">{{ $k->satuan ?: '/ 100' }}</span>
                                                </div>
                                            @elseif ($kode === 'C3')
                                                <div class="input-suffix-wrapper">
                                                    <input type="number" min="{{ $k->min_val ?? 1 }}" max="{{ $k->max_val ?? 20 }}" name="nilai[{{ $k->id }}]" id="nilai_{{ $kode }}" class="form-input font-bold" placeholder="Contoh: 4" value="3" style="width:100%;" required>
                                                    <span class="input-suffix">{{ $k->satuan ?: 'Orang' }}</span>
                                                </div>
                                            @elseif ($kode === 'C5')
                                                <div class="input-suffix-wrapper">
                                                    <input type="number" min="{{ $k->min_val ?? 0 }}" max="{{ $k->max_val ?? 30 }}" name="nilai[{{ $k->id }}]" id="nilai_{{ $kode }}" class="form-input font-bold" placeholder="Contoh: 0" value="0" style="width:100%;" required>
                                                    <span class="input-suffix">{{ $k->satuan ?: 'Hari Alpa' }}</span>
                                                </div>
                                            @else
                                                @if (!empty($k->satuan))
                                                    <div class="input-suffix-wrapper">
                                                        <input type="number" step="any" min="{{ $k->min_val ?? 0 }}" max="{{ $k->max_val ?: '' }}" name="nilai[{{ $k->id }}]" id="nilai_{{ $kode }}" class="form-input font-bold" value="{{ $k->min_val ?? 0 }}" style="width:100%;" required>
                                                        <span class="input-suffix">{{ $k->satuan }}</span>
                                                    </div>
                                                @else
                                                    <input type="number" step="any" min="{{ $k->min_val ?? 0 }}" max="{{ $k->max_val ?: '' }}" name="nilai[{{ $k->id }}]" id="nilai_{{ $kode }}" class="form-input font-bold" value="{{ $k->min_val ?? 0 }}" style="width:100%;" required>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div style="display:flex; align-items:center; gap:8px;">
                    <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span style="font-size:11px; color:#4b5563;">
                        Setelah disimpan, sistem otomatis melakukan normalisasi matriks $R$ dan menghitung skor preferensi $V_i$ terbaru.
                    </span>
                </div>
                <div style="display:flex; gap:10px;">
                    <button type="button" class="btn btn-outline" onclick="resetFormCalon()">
                        Reset Form
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSubmitCalon" style="font-weight:700;">
                        Simpan Data Siswa &amp; Hitung SAW
                    </button>
                </div>
            </div>
        </form>
    </section>
    @endif

    {{-- REKAPITULASI HASIL PERANGKINGAN SAW --}}
    <section class="card-section" id="rekapTable">
        <div class="rekap-table-header">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">
                <div>
                    <h2 style="font-size:15px; font-weight:800; color:#111827; margin:0 0 4px 0;">Hasil Rekapitulasi Perangkingan SAW</h2>
                    <p style="font-size:12px; color:#6b7280; margin:0;">
                        Urutan preferensi siswa berdasarkan normalisasi matriks $R \times$ Bobot AHP $W$. Batas kuota: <strong>{{ $periode->kuota }} Siswa Penerima</strong>@if($periode->cutoff_kuota !== null) &bull; Cutoff Kuota Utama (Rank {{ min($totalLolos, $periode->kuota) }}): <strong>V &ge; {{ number_format($periode->cutoff_kuota, 3) }}</strong>@endif.
                    </p>
                </div>

                {{-- Status Pills Filter --}}
                <div class="filter-pills">
                    <a href="{{ route('periode.seleksi', array_merge(['periode' => $periode], request()->except('status'), ['status' => 'semua'])) }}" class="pill {{ !request('status') || request('status') === 'semua' ? 'active' : '' }}">
                        Semua Siswa ({{ $totalCalon }})
                    </a>
                    <a href="{{ route('periode.seleksi', array_merge(['periode' => $periode], request()->except('status'), ['status' => 'lolos'])) }}" class="pill {{ request('status') === 'lolos' ? 'active' : '' }}">
                        <span style="color:#059669;">●</span> Lolos Kuota ({{ $totalLolos }})
                    </a>
                    <a href="{{ route('periode.seleksi', array_merge(['periode' => $periode], request()->except('status'), ['status' => 'cadangan'])) }}" class="pill {{ request('status') === 'cadangan' ? 'active' : '' }}">
                        <span style="color:#d97706;">●</span> Cadangan ({{ $totalCadangan }})
                    </a>
                    <a href="{{ route('periode.seleksi', array_merge(['periode' => $periode], request()->except('status'), ['status' => 'tidak_lolos'])) }}" class="pill {{ request('status') === 'tidak_lolos' ? 'active' : '' }}">
                        <span style="color:#e11d48;">●</span> Tidak Lolos ({{ $totalTidakLolos }})
                    </a>
                </div>
            </div>
        </div>

        {{-- Search & Counter Bar --}}
        <div class="table-filter-bar">
            <form action="{{ route('periode.seleksi', $periode) }}" method="GET" style="display:flex; gap:8px; align-items:center; flex:1; max-width:440px;">
                @if (request('status'))
                    <input type="hidden" name="status" value="{{ request('status') }}">
                @endif
                <div style="position:relative; width:100%;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama siswa, NISN, atau jurusan..." class="form-input" style="padding-left:34px; font-size:12px; height:36px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute; left:12px; top:50%; transform:translateY(-50%);"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <button type="submit" class="btn btn-outline" style="height:36px; padding:0 14px; font-size:11px;">Cari</button>
                @if (request('search'))
                    <a href="{{ route('periode.seleksi', array_merge(['periode' => $periode], request()->except('search'))) }}" class="btn btn-outline" style="height:36px; padding:0 10px; font-size:11px;">Reset</a>
                @endif
            </form>

            <span style="font-size:12px; color:#6b7280;">
                Menampilkan <strong>{{ $calonPenerimas->count() }}</strong> dari <strong>{{ $totalCalon }}</strong> siswa terdaftar
            </span>
        </div>

        {{-- Bulk Action Bar (Hapus Beberapa Siswa Sekaligus) --}}
        <div id="bulkActionBar" style="display:none; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:10px; background:#fff1f2; border:1px solid #fecdd3; border-radius:10px; padding:10px 16px; margin-bottom:14px;">
            <div style="display:flex; align-items:center; gap:10px;">
                <span style="display:inline-flex; align-items:center; justify-content:center; min-width:24px; height:24px; padding:0 6px; border-radius:12px; background:#ef4444; color:#fff; font-size:11px; font-weight:800;" id="selectedCalonBadge">0</span>
                <div>
                    <span style="font-size:13px; font-weight:700; color:#9f1239;">
                        <span id="selectedCalonCount">0</span> Siswa Terpilih
                    </span>
                    <span style="font-size:11.5px; color:#be123c; margin-left:4px;">(dari halaman ini)</span>
                </div>
            </div>
            <div style="display:flex; align-items:center; gap:8px;">
                <button type="button" onclick="clearSelectedCalon()" class="btn btn-outline btn-sm" style="background:#fff; font-size:11.5px; padding:6px 12px; border-color:#fda4af; color:#9f1239;">
                    Batal Pilih
                </button>
                <button type="button" onclick="confirmBulkDelete()" class="btn btn-sm" style="background:#e11d48; color:#fff; border:none; font-size:12px; font-weight:700; padding:6px 16px; border-radius:7px; display:inline-flex; align-items:center; gap:6px; cursor:pointer; box-shadow:0 1px 2px rgba(225,29,72,0.2);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                    Hapus Siswa Terpilih
                </button>
            </div>
        </div>

        {{-- Hidden Form Bulk Delete --}}
        <form id="bulkDeleteForm" action="{{ route('periode.seleksi.bulk-destroy', $periode) }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
            <div id="bulkDeleteInputsContainer"></div>
        </form>

        {{-- Tabel Perangkingan Siswa --}}
        <div class="table-container">
            <table class="saw-table">
                <thead>
                    <tr>
                        <th style="width:40px; text-align:center;">
                            <input type="checkbox" id="selectAllCalon" title="Pilih Semua Siswa di Halaman Ini" style="cursor:pointer; width:15px; height:15px; accent-color:#e11d48;">
                        </th>
                        <th style="width:65px; text-align:center;">RANK</th>
                        <th style="width:260px;">SISWA &amp; JURUSAN SMK</th>
                        <th style="width:350px;">NILAI ASLI KRITERIA (C1 - C5)</th>
                        <th style="width:120px; text-align:center;">SKOR SAW (V_i)</th>
                        <th style="width:170px; text-align:center;">STATUS KELULUSAN</th>
                        <th style="width:90px; text-align:center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($calonPenerimas as $c)
                        @php
                            $rank = $c->ranking ?? ($loop->iteration + ($calonPenerimas->currentPage() - 1) * $calonPenerimas->perPage());
                            $status = $c->status_kelulusan;
                            $penilaiansMap = $c->penilaians->keyBy('kriteria_id');
                        @endphp
                        <tr>
                            {{-- CHECKBOX PILIH --}}
                            <td style="text-align:center;">
                                <input type="checkbox" class="calon-checkbox" value="{{ $c->id }}" data-nama="{{ $c->nama }}" style="cursor:pointer; width:15px; height:15px; accent-color:#e11d48;" onchange="updateBulkActionState()">
                            </td>

                            {{-- RANK BADGE --}}
                            <td style="text-align:center;">
                                <span class="rank-badge {{ $rank === 1 ? 'rank-1' : ($rank === 2 ? 'rank-2' : ($rank === 3 ? 'rank-3' : ($rank <= $periode->kuota ? 'rank-top' : 'rank-normal'))) }}">
                                    {{ $rank }}
                                </span>
                            </td>

                            {{-- SISWA & JURUSAN SMK --}}
                            <td>
                                <div>
                                    <strong style="color:#111827; font-size:13px; display:block;">{{ $c->nama }}</strong>
                                    <span style="color:#6b7280; font-size:11px;">
                                        NISN: {{ $c->nim }} • {{ $c->program_studi }} ({{ $c->semester }})
                                    </span>
                                </div>
                            </td>

                            {{-- MATRIKS NILAI ASLI (C1-C5) --}}
                            <td>
                                <div class="matrix-chips">
                                    @foreach ($kriterias as $k)
                                        @php
                                            $valObj = $penilaiansMap->get($k->id);
                                            $val = $valObj ? floatval($valObj->nilai) : 0;
                                        @endphp

                                        @if ($k->kode === 'C1')
                                            <span class="matrix-chip" title="C1: Nilai Rata-rata Rapor (0-100)">Rapor: {{ number_format($val, 1) }}</span>
                                        @elseif ($k->kode === 'C2')
                                            <span class="matrix-chip" title="C2: Penghasilan Orang Tua">Rp {{ round($val / 1000000, 1) }}Jt</span>
                                        @elseif ($k->kode === 'C3')
                                            <span class="matrix-chip" title="C3: Tanggungan Keluarga">{{ intval($val) }} Org</span>
                                        @elseif ($k->kode === 'C4')
                                            <span class="matrix-chip" title="C4: Menu Paket Ekstrakurikuler">Paket {{ intval($val) }}</span>
                                        @elseif ($k->kode === 'C5')
                                            <span class="matrix-chip" title="C5: Ketidakhadiran / Alpa">{{ intval($val) }} Hari</span>
                                        @else
                                            <span class="matrix-chip">{{ $k->kode }}: {{ $val }}</span>
                                        @endif
                                    @endforeach
                                </div>
                            </td>

                            {{-- SKOR Vi --}}
                            <td style="text-align:center;">
                                <span class="score-value {{ $status !== 'lolos' ? 'score-below' : '' }}">
                                    {{ number_format(floatval($c->skor_saw ?? 0), 3) }}
                                </span>
                            </td>

                            {{-- KEPUTUSAN KUOTA --}}
                            <td style="text-align:center;">
                                @if ($status === 'lolos')
                                    @if ($rank == $periode->kuota)
                                        <span class="status-pill-lolos" title="Batas Kuota Penerima" style="background:#d1fae5; border-color:#6ee7b7;">
                                            ✓ Lolos (Batas Kuota)
                                        </span>
                                    @else
                                        <span class="status-pill-lolos">
                                            ✓ Lolos Penerima
                                        </span>
                                    @endif
                                @elseif ($status === 'cadangan')
                                    <span class="status-pill-cadangan">
                                        Cadangan (Rank {{ $rank }})
                                    </span>
                                @else
                                    <span class="status-pill-gugur">
                                        ✕ Tidak Lolos
                                    </span>
                                @endif
                            </td>

                            {{-- AKSI --}}
                            <td style="text-align:center;">
                                <div class="table-actions">
                                    <button type="button" class="action-icon-btn" title="Edit Nilai Siswa" onclick="editCalonById({{ $c->id }})">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="pointer-events:none;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>

                                    <form id="delete-calon-form-{{ $c->id }}" action="{{ route('periode.seleksi.destroy', [$periode, $c]) }}" method="POST" style="margin:0; display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDeleteForm('delete-calon-form-{{ $c->id }}', '{{ addslashes($c->nama) }}', 'Data Siswa')" class="action-icon-btn danger" title="Hapus Siswa">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="pointer-events:none;"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align:center; padding:44px 20px; color:#6b7280;">
                                <div style="display:flex; flex-direction:column; align-items:center; gap:8px;">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.8"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="9" y1="9" x2="15" y2="9"/><line x1="9" y1="13" x2="15" y2="13"/><line x1="9" y1="17" x2="13" y2="17"/></svg>
                                    <strong style="color:#374151; font-size:13px;">Belum Ada Data Calon Siswa</strong>
                                    <span style="font-size:12px;">Gunakan formulir di atas untuk menginput calon siswa baru atau klik "Import CSV / Excel".</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="saw-pagination">
            <span>
                Menampilkan halaman {{ $calonPenerimas->currentPage() }} dari {{ $calonPenerimas->lastPage() }} (Total {{ $calonPenerimas->total() }} Data)
            </span>

            <div class="saw-page-btns">
                @if ($calonPenerimas->onFirstPage())
                    <span>&lt;</span>
                @else
                    <a href="{{ $calonPenerimas->previousPageUrl() }}">&lt;</a>
                @endif

                @foreach ($calonPenerimas->getUrlRange(1, $calonPenerimas->lastPage()) as $page => $url)
                    @if ($page == $calonPenerimas->currentPage())
                        <span class="active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach

                @if ($calonPenerimas->hasMorePages())
                    <a href="{{ $calonPenerimas->nextPageUrl() }}">&gt;</a>
                @else
                    <span>&gt;</span>
                @endif
            </div>
        </div>
    </section>

</main>

{{-- MODAL IMPORT CSV / EXCEL SISWA --}}
@if (!$periode->isTerkunci())
<div class="modal-overlay" id="modalImport" onclick="if(event.target === this) closeImportModal()">
    <div class="modal-dialog">
        <div class="modal-header">
            <div style="display:flex; align-items:center; gap:8px;">
                <div class="icon-box bg-brand-light text-brand">
                    <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                </div>
                <h3>Import Data Calon Siswa via CSV / Excel</h3>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeImportModal()">✕</button>
        </div>

        <form action="{{ route('periode.seleksi.import', $periode) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <p style="font-size:12px; color:#4b5563; margin:0; line-height:1.5;">
                    Unggah berkas CSV calon siswa lengkap dengan identitas akademik dan nilai kriteria C1 s/d C5. Sistem akan otomatis memproses data dan menghitung perangkingan SAW.
                </p>

                <div style="background:#f9fafb; border:1px solid #e5e7eb; border-radius:10px; padding:14px; display:flex; justify-content:space-between; align-items:center;">
                    <div>
                        <strong style="font-size:12px; color:#111827; display:block;">Unduh Format Contoh CSV</strong>
                        <span style="font-size:11px; color:#6b7280;">Format kolom: NISN, Nama, Jurusan, Kelas, C1, C2, C3, C4, C5</span>
                    </div>
                    <a href="{{ route('periode.seleksi.template', $periode) }}" class="btn btn-outline btn-sm">
                        <svg class="icon-xs text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Unduh Template (.csv)
                    </a>
                </div>

                <div class="form-group">
                    <label>Pilih File CSV (.csv atau .txt) <span class="text-danger">*</span></label>
                    <input type="file" name="file_csv" accept=".csv,.txt" class="form-input" style="padding-top:6px;">
                </div>

                <div class="form-group">
                    <label>Atau Tempelkan Baris Teks CSV Langsung (Opsional)</label>
                    <textarea name="raw_csv" rows="4" class="form-input font-mono" style="height:auto; font-size:11px; padding:10px;" placeholder="0081234561,Budi Santoso,Rekayasa Perangkat Lunak,XII RPL 1,89.5,2000000,3,4,0"></textarea>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline" onclick="closeImportModal()">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Unggah &amp; Hitung Perangkingan SAW
                </button>
            </div>
        </form>
    </div>
</div>
@endif

{{-- TOAST NOTIFICATION CONTAINER --}}
<div class="toast-shelf" id="toastShelf"></div>

{{-- SCRIPT: INTERAKTIF INPUT IDENTITAS, PREVIEW AVATAR, EDIT CALON & TOAST --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const inputNama = document.getElementById('inputNama');
    const inputNim = document.getElementById('inputNim');
    const inputProdi = document.getElementById('inputProdi');
    const inputKelas = document.getElementById('inputKelas');
    const avatarPreview = document.getElementById('avatarPreview');
    const previewNama = document.getElementById('previewNama');
    const previewProdi = document.getElementById('previewProdi');
    const inputCalonId = document.getElementById('inputCalonId');
    const formCardTitle = document.getElementById('formCardTitle');
    const formCardSub = document.getElementById('formCardSub');
    const btnSubmitCalon = document.getElementById('btnSubmitCalon');
    const btnModeBatal = document.getElementById('btnModeBatal');

    // Toast Notification Utility
    window.showToast = function(message, type = 'success') {
        const shelf = document.getElementById('toastShelf');
        if (!shelf) return;

        const toast = document.createElement('div');
        toast.className = `toast-msg toast-${type}`;
        
        let iconSvg = '';
        if (type === 'success') {
            iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>`;
        } else if (type === 'error') {
            iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`;
        } else {
            iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#be185d" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>`;
        }

        toast.innerHTML = `
            ${iconSvg}
            <div style="flex:1;">
                <strong style="font-size:12px; color:#111827; display:block;">${type === 'success' ? 'Berhasil' : (type === 'error' ? 'Pemberitahuan' : 'Informasi')}</strong>
                <span style="font-size:11px; color:#4b5563;">${message}</span>
            </div>
            <button type="button" style="background:none; border:none; font-size:16px; color:#9ca3af; cursor:pointer;" onclick="this.parentElement.remove()">✕</button>
        `;

        shelf.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    };

    // Auto-show Laravel session flash message via toast if present
    @if (session('sukses'))
        window.showToast("{{ session('sukses') }}", 'success');
    @endif
    @if (session('gagal'))
        window.showToast("{{ session('gagal') }}", 'error');
    @endif

    window.scrollToForm = function() {
        const formCard = document.getElementById('formCalonCard');
        if (formCard) formCard.scrollIntoView({ behavior: 'smooth' });
    };

    function updatePreview() {
        if (!inputNama || !previewNama) return;
        const nama = inputNama.value.trim() || 'Nama Calon Siswa';
        const prodi = inputProdi ? inputProdi.value.trim() || 'Rekayasa Perangkat Lunak' : 'SMK';
        const kelas = inputKelas ? inputKelas.value.trim() || 'Kelas XII RPL 1' : 'Kelas XII';

        previewNama.innerText = nama;
        previewProdi.innerText = `${kelas} • ${prodi}`;

        const parts = nama.split(/\s+/);
        let initials = '';
        if (parts.length > 0 && parts[0]) initials += parts[0][0].toUpperCase();
        if (parts.length > 1 && parts[1]) initials += parts[1][0].toUpperCase();
        if (avatarPreview) avatarPreview.innerText = initials || 'SMK';
    }

    if (inputNama) inputNama.addEventListener('input', updatePreview);
    if (inputProdi) inputProdi.addEventListener('input', updatePreview);
    if (inputKelas) inputKelas.addEventListener('input', updatePreview);
    updatePreview();

    window.calonDataset = {
        @foreach ($calonPenerimas as $c)
            "{{ $c->id }}": {
                data: @json($c),
                penilaians: @json($c->penilaians)
            },
        @endforeach
    };

    window.editCalonById = function(id) {
        const item = window.calonDataset && window.calonDataset[id];
        if (item && window.editCalon) {
            window.editCalon(item.data, item.penilaians);
        }
    };

    window.editCalon = function(calon, penilaians) {
        if (!inputNama) return;

        inputCalonId.value = calon.id;
        inputNama.value = calon.nama;
        inputNim.value = calon.nim;
        if (inputProdi) inputProdi.value = calon.program_studi || '';
        if (inputKelas) inputKelas.value = calon.semester || '';

        formCardTitle.innerText = `Edit Data Siswa: ${calon.nama} (NISN: ${calon.nim})`;
        formCardSub.innerText = 'Ubah data akademik siswa dan perbarui nilai per kriteria di bawah ini';
        btnSubmitCalon.innerText = 'Perbarui Data Siswa & Hitung SAW';
        btnSubmitCalon.className = 'btn btn-accent';
        if (btnModeBatal) btnModeBatal.style.display = 'inline-flex';

        updatePreview();

        // Isi nilai kriteria
        if (Array.isArray(penilaians)) {
            penilaians.forEach(p => {
                const elNilai = document.querySelector(`[name="nilai[${p.kriteria_id}]"]`);
                if (elNilai) {
                    elNilai.value = p.nilai;
                }
            });
        }

        scrollToForm();
        window.showToast(`Mode edit diaktifkan untuk siswa: ${calon.nama}`, 'info');
    };

    window.resetFormCalon = function() {
        if (!inputNama) return;

        inputCalonId.value = '';
        inputNama.value = '';
        inputNim.value = '';
        if (inputProdi) inputProdi.value = 'Rekayasa Perangkat Lunak';
        if (inputKelas) inputKelas.value = 'Kelas XII RPL 1';

        formCardTitle.innerText = 'Form Input Data Siswa & Penilaian Kriteria SMK';
        formCardSub.innerText = 'Tambahkan data calon siswa dan nilai kriteria acuan seleksi';
        btnSubmitCalon.innerText = 'Simpan Data Siswa & Hitung SAW';
        btnSubmitCalon.className = 'btn btn-primary';
        if (btnModeBatal) btnModeBatal.style.display = 'none';

        // Nilai default
        const c1 = document.getElementById('nilai_C1'); if (c1) c1.value = '85.00';
        const c2 = document.getElementById('nilai_C2'); if (c2) c2.value = '2500000';
        const c3 = document.getElementById('nilai_C3'); if (c3) c3.value = '3';
        const c4 = document.getElementById('nilai_C4'); if (c4) c4.value = '4';
        const c5 = document.getElementById('nilai_C5'); if (c5) c5.value = '0';

        updatePreview();
        window.showToast('Form telah dikembalikan ke mode tambah siswa baru.', 'info');
    };

    window.openImportModal = function() {
        const modal = document.getElementById('modalImport');
        if (modal) modal.classList.add('active');
    };

    window.closeImportModal = function() {
        const modal = document.getElementById('modalImport');
        if (modal) modal.classList.remove('active');
    };

    // Bulk Select & Delete Siswa
    const selectAllCalon = document.getElementById('selectAllCalon');
    const bulkActionBar = document.getElementById('bulkActionBar');
    const selectedCalonCount = document.getElementById('selectedCalonCount');
    const selectedCalonBadge = document.getElementById('selectedCalonBadge');

    window.updateBulkActionState = function() {
        const checkboxes = document.querySelectorAll('.calon-checkbox');
        const checked = document.querySelectorAll('.calon-checkbox:checked');
        const count = checked.length;

        if (selectedCalonCount) selectedCalonCount.innerText = count;
        if (selectedCalonBadge) selectedCalonBadge.innerText = count;

        if (bulkActionBar) {
            bulkActionBar.style.display = count > 0 ? 'flex' : 'none';
        }

        if (selectAllCalon) {
            selectAllCalon.checked = checkboxes.length > 0 && count === checkboxes.length;
            selectAllCalon.indeterminate = count > 0 && count < checkboxes.length;
        }
    };

    if (selectAllCalon) {
        selectAllCalon.addEventListener('change', function() {
            const isChecked = this.checked;
            document.querySelectorAll('.calon-checkbox').forEach(cb => {
                cb.checked = isChecked;
            });
            updateBulkActionState();
        });
    }

    window.clearSelectedCalon = function() {
        document.querySelectorAll('.calon-checkbox').forEach(cb => {
            cb.checked = false;
        });
        if (selectAllCalon) {
            selectAllCalon.checked = false;
            selectAllCalon.indeterminate = false;
        }
        updateBulkActionState();
    };

    window.confirmBulkDelete = function() {
        const checked = document.querySelectorAll('.calon-checkbox:checked');
        const count = checked.length;
        if (count === 0) {
            alert('Silakan pilih minimal 1 siswa yang ingin dihapus.');
            return;
        }

        window.openConfirmModal({
            title: `Hapus ${count} Siswa Terpilih?`,
            message: `Apakah Anda yakin ingin menghapus ${count} data siswa yang dipilih? Nilai penilaian dan perangkingan SAW akan diperbarui otomatis. Tindakan ini tidak dapat dibatalkan.`,
            confirmText: `Ya, Hapus ${count} Siswa`,
            onConfirm: () => {
                const container = document.getElementById('bulkDeleteInputsContainer');
                if (!container) return;
                container.innerHTML = '';
                checked.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'ids[]';
                    input.value = cb.value;
                    container.appendChild(input);
                });
                document.getElementById('bulkDeleteForm').submit();
            }
        });
    };
});
</script>
@endsection
