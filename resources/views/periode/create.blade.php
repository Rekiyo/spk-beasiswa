@extends('layouts.app')

@php $pageCss = 'periode_create'; @endphp

@section('title', 'Tambah Periode Seleksi Baru - SPK Beasiswa Prestasi')

@section('content')
<main class="periode-create-main">

    {{-- Breadcrumb & Header --}}
    <div class="header-section">
        <div class="breadcrumb">
            <a href="{{ route('periode.index') }}" class="breadcrumb" style="text-decoration:none;">
                <svg class="breadcrumb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                <span>Kembali ke Manajemen Periode</span>
            </a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Tambah Periode Baru</span>
        </div>

        <div class="header-content">
            <div>
                <div class="title-wrapper">
                    <h1 class="page-title">Tambah Periode Seleksi Baru</h1>
                    <span class="method-badge">
                        <span class="dot pulse"></span>
                        Metode SPK: SAW Terbobot AHP (CR &lt; 0.10)
                    </span>
                </div>
                <p class="page-desc">
                    Konfigurasi identitas periode, kustomisasi kriteria seleksi, dan kalkulasi bobot otomatis dengan Matriks Perbandingan Berpasangan AHP (Skala Saaty 1–9).
                </p>
            </div>

            {{-- Stepper Progress --}}
            <div class="stepper-wrapper">
                <div class="stepper-item">
                    <div class="step-circle step-circle-active">1</div>
                    <span class="step-label text-current font-bold">Identitas</span>
                </div>
                <div class="step-line"></div>
                <div class="stepper-item">
                    <div class="step-circle step-circle-active">2</div>
                    <span class="step-label text-current font-bold">Kriteria</span>
                </div>
                <div class="step-line"></div>
                <div class="stepper-item">
                    <div class="step-circle step-circle-active ring-active">3</div>
                    <span class="step-label text-active font-bold">Bobot AHP</span>
                </div>
            </div>
        </div>
    </div>

    <form id="periodeForm" action="{{ route('periode.store') }}" method="POST">
        @csrf

        {{-- SECTION 1: DATA INFORMASI PERIODE --}}
        <section class="form-section">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div>
                        <h2>1. Data Informasi Periode</h2>
                        <p>Atur parameter umum dan kuota periode seleksi pendaftaran beasiswa.</p>
                    </div>
                </div>
                <span class="step-badge">Langkah 1 dari 3</span>
            </div>

            <div class="form-body">
                <div class="form-group">
                    <label>Nama Periode / Tahun Ajaran <span class="required">*</span></label>
                    <input type="text" name="nama" class="form-input" value="{{ old('nama', 'TA 2026/2027 – Semester Ganjil') }}" placeholder="Contoh: TA 2026/2027 – Semester Ganjil" required>
                    @error('nama') <span class="text-danger text-11">{{ $message }}</span> @enderror
                </div>

                <div class="grid-2-col">
                    <div class="form-group">
                        <label>Tahun <span class="required">*</span></label>
                        <input type="text" name="tahun" class="form-input" value="{{ old('tahun', '2026') }}" placeholder="2026" required pattern="\d{4}">
                        @error('tahun') <span class="text-danger text-11">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Kuota Penerima Beasiswa <span class="required">*</span></label>
                        <div class="input-suffix-wrapper">
                            <input type="number" name="kuota" class="form-input" value="{{ old('kuota', 15) }}" min="1" required>
                            <span class="input-suffix">Kursi</span>
                        </div>
                        @error('kuota') <span class="text-danger text-11">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid-2-col">
                    <div class="form-group">
                        <label>Tanggal Mulai Pendaftaran <span class="required">*</span></label>
                        <input type="date" name="tanggal_mulai" class="form-input" value="{{ old('tanggal_mulai', '2026-08-01') }}" required>
                        @error('tanggal_mulai') <span class="text-danger text-11">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Penutupan Pendaftaran (Deadline) <span class="required">*</span></label>
                        <input type="date" name="deadline" class="form-input" value="{{ old('deadline', '2026-10-30') }}" required>
                        @error('deadline') <span class="text-danger text-11">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="section-footer">
                <div class="footer-info">
                    <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>Data periode akan disimpan secara langsung ke draf sistem aktif.</span>
                </div>
                <button type="button" class="btn btn-primary" onclick="window.scrollTo({top: document.getElementById('sectionKriteria').offsetTop - 20, behavior: 'smooth'})">
                    Lanjut ke Kriteria →
                </button>
            </div>
        </section>

        {{-- SECTION 2: DATA KRITERIA SELEKSI --}}
        <section id="sectionKriteria" class="form-section" style="margin-top:24px;">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <h2>2. Data Kriteria Seleksi</h2>
                            <span class="status-badge status-success">5 Kriteria Terpasang</span>
                        </div>
                        <p>Kelola kriteria penilaian (kode, nama kriteria, sifat benefit/cost, rentang nilai acuan). Dapat disesuaikan kebutuhan seleksi.</p>
                    </div>
                </div>
                <span class="step-badge">Langkah 2 dari 3</span>
            </div>

            <div class="form-body" style="padding:0;">
                <div class="table-container">
                    <table class="criteria-table">
                        <thead>
                            <tr>
                                <th style="width:65px; text-align:center;">KODE</th>
                                <th style="width:220px;">NAMA KRITERIA</th>
                                <th style="width:170px;">SIFAT ATRIBUT</th>
                                <th style="width:160px;">TIPE INPUT</th>
                                <th>PENGATURAN RENTANG NILAI / PILIHAN OPSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($defaultKriterias as $k)
                            @php
                                $currentRentang = old('kriterias.' . $loop->index . '.rentang', $k['rentang']);
                                $currentTipe = old('kriterias.' . $loop->index . '.tipe_input', $k['tipe_input']);
                                $currentMin = old('kriterias.' . $loop->index . '.min_val', $k['min_val'] ?? 0);
                                $currentMax = old('kriterias.' . $loop->index . '.max_val', $k['max_val'] ?? 100);
                                $currentSatuan = old('kriterias.' . $loop->index . '.satuan', $k['satuan'] ?? '');
                                $pilihanList = $k['pilihan'] ?? [];
                            @endphp
                            <tr id="rowKriteria_{{ $loop->index }}">
                                <td class="font-bold text-brand" style="text-align:center;">
                                    {{ $k['kode'] }}
                                    <input type="hidden" name="kriterias[{{ $loop->index }}][kode]" value="{{ $k['kode'] }}">
                                </td>
                                <td>
                                    <input type="text" name="kriterias[{{ $loop->index }}][nama]" class="form-input-sm font-semibold" value="{{ old('kriterias.' . $loop->index . '.nama', $k['nama']) }}" placeholder="Nama kriteria..." required>
                                </td>
                                <td>
                                    <select name="kriterias[{{ $loop->index }}][atribut]" class="form-select-sm {{ $k['atribut'] === 'benefit' ? 'select-benefit' : 'select-cost' }}" onchange="this.className = 'form-select-sm ' + (this.value === 'benefit' ? 'select-benefit' : 'select-cost')">
                                        <option value="benefit" {{ $k['atribut'] === 'benefit' ? 'selected' : '' }}>Benefit (Maksimum)</option>
                                        <option value="cost" {{ $k['atribut'] === 'cost' ? 'selected' : '' }}>Cost (Minimum)</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="kriterias[{{ $loop->index }}][tipe_input]" id="selectTipe_{{ $loop->index }}" class="form-select-sm font-semibold" onchange="switchTipeKriteria({{ $loop->index }}, this.value)">
                                        <option value="angka" {{ $currentTipe === 'angka' ? 'selected' : '' }}>Angka (Numerik)</option>
                                        <option value="pilihan" {{ $currentTipe === 'pilihan' ? 'selected' : '' }}>Pilihan (Kategori)</option>
                                    </select>
                                </td>
                                <td class="config-range-cell">
                                    {{-- BOX 1: JIKA TIPE INPUT ANGKA (Tentukan Range Input) --}}
                                    <div id="boxAngka_{{ $loop->index }}" class="box-angka-wrap" style="{{ $currentTipe === 'angka' ? 'display:flex;' : 'display:none;' }}">
                                        <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                            <div class="range-field-item">
                                                <span class="range-lbl">Min:</span>
                                                <input type="number" step="any" name="kriterias[{{ $loop->index }}][min_val]" class="form-input-sm" style="width:85px;" value="{{ $currentMin }}" placeholder="0">
                                            </div>
                                            <span class="range-sep">s/d</span>
                                            <div class="range-field-item">
                                                <span class="range-lbl">Max:</span>
                                                <input type="number" step="any" name="kriterias[{{ $loop->index }}][max_val]" class="form-input-sm" style="width:105px;" value="{{ $currentMax }}" placeholder="100">
                                            </div>
                                            <div class="range-field-item">
                                                <span class="range-lbl">Satuan:</span>
                                                <input type="text" name="kriterias[{{ $loop->index }}][satuan]" class="form-input-sm" style="width:120px;" value="{{ $currentSatuan }}" placeholder="Contoh: / 100, Rp, Hari">
                                            </div>
                                            <span class="rentang-type-pill pill-angka">Input Angka</span>
                                        </div>
                                        <div>
                                            <input type="text" name="kriterias[{{ $loop->index }}][rentang]" id="inputRentang_{{ $loop->index }}" class="form-input-sm" value="{{ $currentRentang }}" placeholder="Keterangan rentang acuan (Contoh: Nilai Rapor Siswa SMK)...">
                                        </div>
                                    </div>

                                    {{-- BOX 2: JIKA TIPE INPUT PILIHAN (Tentukan Opsi & Skor) --}}
                                    <div id="boxPilihan_{{ $loop->index }}" class="box-pilihan-wrap" style="{{ $currentTipe === 'pilihan' ? 'display:flex;' : 'display:none;' }}">
                                        <div class="pilihan-header-hint">
                                            <span>Daftar Opsi Sub-Kriteria Pilihan</span>
                                            <span>Nilai SAW (1 s/d 5)</span>
                                        </div>
                                        <div class="pilihan-rows-box" id="pilihanRows_{{ $loop->index }}">
                                            @if(!empty($pilihanList))
                                                @foreach($pilihanList as $subIdx => $sub)
                                                    <div class="pilihan-row">
                                                        <span class="badge-num">{{ $loop->iteration }}.</span>
                                                        <input type="text" name="kriterias[{{ $loop->parent->index }}][pilihan][{{ $subIdx }}][label]" class="pilihan-label-input" value="{{ $sub['label'] }}" placeholder="Nama opsi pilihan..." required>
                                                        <div class="pilihan-nilai-wrap">
                                                            <span class="pilihan-val-lbl">Skor:</span>
                                                            <input type="number" name="kriterias[{{ $loop->parent->index }}][pilihan][{{ $subIdx }}][nilai]" style="width:50px;" value="{{ $sub['nilai'] }}" min="1" max="10" required>
                                                        </div>
                                                        <button type="button" class="btn-del-row" title="Hapus pilihan" onclick="hapusPilihanRow(this)">✕</button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="pilihan-row">
                                                    <span class="badge-num">1.</span>
                                                    <input type="text" name="kriterias[{{ $loop->index }}][pilihan][0][label]" class="pilihan-label-input" value="Kategori 1 (Dasar)" placeholder="Nama opsi pilihan..." required>
                                                    <div class="pilihan-nilai-wrap">
                                                        <span class="pilihan-val-lbl">Skor:</span>
                                                        <input type="number" name="kriterias[{{ $loop->index }}][pilihan][0][nilai]" style="width:50px;" value="1" min="1" max="10" required>
                                                    </div>
                                                    <button type="button" class="btn-del-row" title="Hapus pilihan" onclick="hapusPilihanRow(this)">✕</button>
                                                </div>
                                                <div class="pilihan-row">
                                                    <span class="badge-num">2.</span>
                                                    <input type="text" name="kriterias[{{ $loop->index }}][pilihan][1][label]" class="pilihan-label-input" value="Kategori 2 (Menengah)" placeholder="Nama opsi pilihan..." required>
                                                    <div class="pilihan-nilai-wrap">
                                                        <span class="pilihan-val-lbl">Skor:</span>
                                                        <input type="number" name="kriterias[{{ $loop->index }}][pilihan][1][nilai]" style="width:50px;" value="2" min="1" max="10" required>
                                                    </div>
                                                    <button type="button" class="btn-del-row" title="Hapus pilihan" onclick="hapusPilihanRow(this)">✕</button>
                                                </div>
                                                <div class="pilihan-row">
                                                    <span class="badge-num">3.</span>
                                                    <input type="text" name="kriterias[{{ $loop->index }}][pilihan][2][label]" class="pilihan-label-input" value="Kategori 3 (Utama)" placeholder="Nama opsi pilihan..." required>
                                                    <div class="pilihan-nilai-wrap">
                                                        <span class="pilihan-val-lbl">Skor:</span>
                                                        <input type="number" name="kriterias[{{ $loop->index }}][pilihan][2][nilai]" style="width:50px;" value="3" min="1" max="10" required>
                                                    </div>
                                                    <button type="button" class="btn-del-row" title="Hapus pilihan" onclick="hapusPilihanRow(this)">✕</button>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="pilihan-footer-action">
                                            <button type="button" class="btn-add-choice" onclick="tambahPilihanRow({{ $loop->index }})">
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                                + Tambah Pilihan Baru
                                            </button>
                                            <span class="pilihan-hint">*Nilai skor digunakan pada normalisasi SAW</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="section-footer">
                <div class="footer-info text-success">
                    <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>5 Kriteria aktif terdaftar untuk komputasi pembobotan AHP pada bagian berikutnya.</span>
                </div>
                <button type="button" class="btn btn-primary" onclick="window.scrollTo({top: document.getElementById('sectionAhp').offsetTop - 20, behavior: 'smooth'})">
                    Lanjut ke Bobot AHP →
                </button>
            </div>
        </section>

        {{-- SECTION 3: DATA PEMBOBOTAN KRITERIA (AHP) --}}
        <section id="sectionAhp" class="form-section" style="margin-top:24px;">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/><polyline points="2 12 12 17 22 12"/></svg>
                    </div>
                    <div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <h2>3. Data Pembobotan Kriteria (AHP – Analytic Hierarchy Process)</h2>
                            <span class="status-badge status-success">Kalkulator Otomatis</span>
                        </div>
                        <p>Lakukan perbandingan berpasangan antar kriteria menggunakan skala intensitas kepentingan Saaty (1–9). Sistem otomatis menghitung matriks normalisasi, eigen vektor (bobot W_i), dan rasio konsistensi (CR).</p>
                    </div>
                </div>
                <span class="step-badge">Langkah 3 dari 3</span>
            </div>

            <div class="form-body">
                {{-- Saaty Scale Guide Panel --}}
                <div class="saaty-guide-panel">
                    <div class="saaty-guide-header">
                        <div style="display:flex; align-items:center; gap:6px;">
                            <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                            <span class="font-bold text-gray text-11">Panduan Tingkat Skala Kepentingan Saaty (1 – 9)</span>
                        </div>
                        <span class="text-gray text-11 font-mono">Principle AHP: A(i, j) = 1 / A(j, i)</span>
                    </div>

                    <div class="saaty-grid">
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">1</span>
                                <span>Sama Penting</span>
                            </div>
                            <p>Kedua elemen kriteria menyumbang pengaruh seimbang/identik terhadap sasaran beasiswa.</p>
                        </div>
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">3</span>
                                <span>Sedikit Lebih</span>
                            </div>
                            <p>Pengalaman & kebijakan sedikit memfavoritkan satu kriteria di atas kriteria lain.</p>
                        </div>
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">5</span>
                                <span>Jelas Lebih Penting</span>
                            </div>
                            <p>Satu elemen kriteria sangat jelas dan tegas lebih diutamakan daripada elemen pembanding.</p>
                        </div>
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">7</span>
                                <span>Sangat Dominan</span>
                            </div>
                            <p>Dominasi kepentingan kriteria terbukti kuat secara substansial regulasi universitas.</p>
                        </div>
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">9</span>
                                <span>Mutlak Dominan</span>
                            </div>
                            <p>Bukti mutlak menyatakan satu elemen berada pada tingkat kepastian tertinggi yang mungkin.</p>
                        </div>
                    </div>

                    <p class="saaty-note">
                        <span class="dot-brand"></span>
                        Nilai genap (2, 4, 6, 8) merepresentasikan nilai antara bila terdapat keraguan kompromi. Nilai kebalikan (1/x) dihitung secara matematis otomatis oleh sistem.
                    </p>
                </div>

                {{-- Matriks Perbandingan Berpasangan [A] --}}
                <div class="matrix-section">
                    <div class="matrix-header">
                        <h3>Matriks Perbandingan Berpasangan [A]</h3>
                        <span>Ubah nilai segitiga atas, segitiga bawah akan terisi otomatis</span>
                    </div>

                    @php
                        $kLabels = [
                            'C1' => 'C1 (Nilai Akademik)',
                            'C2' => 'C2 (Penghasilan)',
                            'C3' => 'C3 (Tanggungan)',
                            'C4' => 'C4 (Ekstrakurikuler)',
                            'C5' => 'C5 (Ketidakhadiran)',
                        ];
                        $kKeys = ['C1', 'C2', 'C3', 'C4', 'C5'];
                    @endphp

                    <div class="table-container">
                        <table class="matrix-table" id="matrixTable">
                            <thead>
                                <tr>
                                    <th class="text-left" style="width:200px;">Kriteria Evaluasi</th>
                                    @foreach ($kKeys as $k)
                                        <th>{{ $kLabels[$k] }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kKeys as $i)
                                    <tr>
                                        <td class="text-left font-bold text-gray">
                                            {{ $kLabels[$i] }}
                                        </td>
                                        @foreach ($kKeys as $j)
                                            @if ($i === $j)
                                                <td class="bg-brand-light font-bold text-brand-dark">
                                                    1.00
                                                    <input type="hidden" name="matrix[{{ $i }}][{{ $j }}]" value="1.0">
                                                </td>
                                            @elseif ($loop->parent->index < $loop->index)
                                                {{-- Segitiga Atas: Dropdown --}}
                                                <td>
                                                    @php
                                                        $val = $defaultMatrix[$i][$j] ?? 1.0;
                                                    @endphp
                                                    <select name="matrix[{{ $i }}][{{ $j }}]" class="form-select-sm ahp-select" data-i="{{ $i }}" data-j="{{ $j }}">
                                                        @for ($v = 2; $v <= 9; $v++)
                                                            <option value="{{ $v }}" {{ round($val) == $v ? 'selected' : '' }}>{{ $v }}.00</option>
                                                        @endfor
                                                    </select>
                                                </td>
                                            @else
                                                {{-- Segitiga Bawah: Dihitung Otomatis 1/x --}}
                                                <td id="cell_{{ $i }}_{{ $j }}" class="font-mono text-gray">
                                                    {{ number_format(1 / ($defaultMatrix[$j][$i] ?? 1), 3) }}
                                                    <input type="hidden" name="matrix[{{ $i }}][{{ $j }}]" value="{{ 1 / ($defaultMatrix[$j][$i] ?? 1) }}">
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach

                                {{-- Baris Jumlah Kolom --}}
                                <tr class="matrix-total-row">
                                    <td class="text-left font-bold">Jumlah Kolom (∑ Kolom)</td>
                                    @foreach ($kKeys as $k)
                                        <td id="col_sum_{{ $k }}">{{ number_format($ahpResult['column_sums'][$k] ?? 1, 3) }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Hasil Rasio Konsistensi & Vektor Bobot SAW --}}
                <div class="result-grid">
                    {{-- UJI RASIO KONSISTENSI --}}
                    <div class="result-card">
                        <div>
                            <div class="result-card-header">
                                <h4>UJI RASIO KONSISTENSI (AHP)</h4>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-brand"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                            </div>
                            <p class="result-card-desc">Uji validitas matematis perbandingan pairwise matriks untuk ukuran matriks n = 5.</p>

                            <div class="cr-stats">
                                <div class="cr-stat-row">
                                    <span>Principal Eigenvalue (λ max)</span>
                                    <strong id="stat_lambda" class="font-mono">{{ number_format($ahpResult['lambda_max'] ?? 5.168, 3) }}</strong>
                                </div>
                                <div class="cr-stat-row">
                                    <span>Consistency Index (CI)</span>
                                    <strong id="stat_ci" class="font-mono">{{ number_format($ahpResult['ci'] ?? 0.042, 3) }}</strong>
                                </div>
                                <div class="cr-stat-row">
                                    <span>Random Index (RI n=5)</span>
                                    <strong class="font-mono">1.120</strong>
                                </div>
                                <div class="cr-stat-row cr-final">
                                    <span class="font-bold text-brand">Consistency Ratio (CR)</span>
                                    <strong id="stat_cr" class="font-bold text-brand font-mono">{{ number_format($ahpResult['cr'] ?? 0.038, 3) }}</strong>
                                </div>
                            </div>
                        </div>

                        <div id="crAlert" class="alert alert-success" style="margin-top:14px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                            <div>
                                <strong id="crAlertTitle">KONSISTEN (CR &lt; 0.10)</strong>
                                <p id="crAlertText">Rasio konsistensi memenuhi standar toleransi Saaty (&lt; 10%). Bobot valid untuk SAW.</p>
                            </div>
                        </div>
                    </div>

                    {{-- HASIL VEKTOR PRIORITAS BOBOT (Wi SAW) --}}
                    <div class="result-card">
                        <div>
                            <div class="result-card-header">
                                <h4>HASIL VEKTOR PRIORITAS BOBOT (Wi SAW)</h4>
                                <span class="tag-sm tag-success font-mono font-bold">∑ = 1.000 (100%)</span>
                            </div>
                            <p class="result-card-desc">Bobot ternormalisasi yang akan dipakai mengalikan matriks R pada SAW.</p>

                            <div class="weights-list">
                                @foreach ($kKeys as $k)
                                    @php
                                        $w = $ahpResult['weights'][$k] ?? 0.20;
                                        $pct = round($w * 100, 1);
                                    @endphp
                                    <div class="weight-item">
                                        <div class="weight-info">
                                            <span>{{ $kLabels[$k] }}</span>
                                            <span id="weight_label_{{ $k }}" class="font-mono">{{ number_format($w, 3) }} ({{ $pct }}%)</span>
                                        </div>
                                        <div class="progress-bar">
                                            <div id="weight_bar_{{ $k }}" class="progress-fill" style="width: {{ $pct }}%;"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="result-card-footer">
                            <p>Nilai bobot akan otomatis disinkronkan ke rumus SAW: V_i = ∑ (Rij * Wj)</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section-footer">
                <div class="footer-info">
                    <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
                    <span>Perhitungan eigen vektor dan normalisasi diperbarui secara real-time.</span>
                </div>
                <div style="display:flex; gap:8px;">
                    <button type="button" class="btn btn-outline" onclick="hitungUlangMatrixClient()">
                        Hitung Ulang Matriks
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Simpan & Terapkan Bobot AHP
                    </button>
                </div>
            </div>
        </section>

        {{-- FINAL ACTION PANEL --}}
        <section class="final-action-panel" style="margin-top:24px;">
            <div style="display:flex; align-items:center; gap:16px;">
                <div class="icon-circle bg-emerald-light text-emerald-dark border-emerald">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <strong style="font-size:15px; color:#111827;">Konfigurasi Periode Siap Difinalisasi</strong>
                        <span class="status-badge status-success">Lengkap (3/3)</span>
                    </div>
                    <p style="font-size:12px; color:#6b7280; margin:2px 0 0;">
                        Identitas periode, 5 kriteria aktif, dan perbandingan AHP konsisten siap dipublikasikan.
                    </p>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:10px;">
                <a href="{{ route('periode.index') }}" class="btn btn-outline">
                    Batal / Reset Formulir
                </a>
                <button type="submit" class="btn btn-primary" style="padding:10px 20px; font-size:13px;">
                    ✓ Finalisasi & Buka Periode Seleksi Ini
                </button>
            </div>
        </section>

    </form>

</main>

{{-- Client-side Real-time AHP Calculator Script --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const kKeys = ['C1', 'C2', 'C3', 'C4', 'C5'];
    const saatyRI = { 1: 0.0, 2: 0.0, 3: 0.58, 4: 0.90, 5: 1.12, 6: 1.24, 7: 1.32, 8: 1.41, 9: 1.45, 10: 1.49 };

    function calculateAHP() {
        const n = kKeys.length;
        const A = {};

        // 1. Inisialisasi Matriks A
        kKeys.forEach(i => {
            A[i] = {};
            kKeys.forEach(j => {
                if (i === j) {
                    A[i][j] = 1.0;
                }
            });
        });

        // 2. Baca dropdown segitiga atas
        document.querySelectorAll('.ahp-select').forEach(sel => {
            const i = sel.dataset.i;
            const j = sel.dataset.j;
            const val = parseFloat(sel.value) || 1.0;
            A[i][j] = val;
            A[j][i] = 1.0 / val;

            // Perbarui cell segitiga bawah
            const lowerCell = document.getElementById(`cell_${j}_${i}`);
            if (lowerCell) {
                lowerCell.innerHTML = (1.0 / val).toFixed(3) + `<input type="hidden" name="matrix[${j}][${i}]" value="${(1.0 / val).toFixed(6)}">`;
            }
        });

        // 3. Hitung Jumlah Kolom
        const colSums = {};
        kKeys.forEach(j => {
            let sum = 0.0;
            kKeys.forEach(i => {
                sum += A[i][j];
            });
            colSums[j] = sum > 0 ? sum : 1.0;
            const elColSum = document.getElementById(`col_sum_${j}`);
            if (elColSum) {
                elColSum.innerText = colSums[j].toFixed(3);
            }
        });

        // 4. Normalisasi Matriks & Hitung Bobot Wi (Eigen Vektor)
        const weights = {};
        kKeys.forEach(i => {
            let rowSum = 0.0;
            kKeys.forEach(j => {
                rowSum += A[i][j] / colSums[j];
            });
            weights[i] = rowSum / n;
        });

        // 5. Hitung Lambda Max
        const lambdas = [];
        kKeys.forEach(i => {
            let wsv = 0.0;
            kKeys.forEach(j => {
                wsv += A[i][j] * weights[j];
            });
            lambdas.push(wsv / (weights[i] || 0.0001));
        });
        const lambdaMax = lambdas.reduce((a, b) => a + b, 0) / n;

        // 6. Hitung CI & CR
        const ci = Math.max(0, (lambdaMax - n) / (n - 1));
        const ri = saatyRI[n] || 1.12;
        const cr = ci / ri;

        // Update UI Statistik
        document.getElementById('stat_lambda').innerText = lambdaMax.toFixed(3);
        document.getElementById('stat_ci').innerText = ci.toFixed(3);
        document.getElementById('stat_cr').innerText = cr.toFixed(3);

        const crAlert = document.getElementById('crAlert');
        const crAlertTitle = document.getElementById('crAlertTitle');
        const crAlertText = document.getElementById('crAlertText');

        iif (cr <= 0.10) {
    crAlert.className = 'alert alert-success';
    crAlert.style.background = '';
    crAlert.style.border = '';
    crAlert.style.color = '';
    crAlertTitle.innerText = `KONSISTEN (CR = ${cr.toFixed(3)} < 0.10)`;
    crAlertText.innerText = `Rasio konsistensi ${(cr * 100).toFixed(1)}% memenuhi standar toleransi Saaty (< 10%). Bobot valid untuk SAW.`;
} else {
    crAlert.className = 'alert';
    crAlert.style.background = '#fffbeb';
    crAlert.style.border = '1px solid #fde68a';
    crAlert.style.color = '#92400e';
    crAlertTitle.innerText = `PERHATIAN (CR = ${cr.toFixed(3)} >= 0.10)`;
    crAlertText.innerText = `Rasio konsistensi melebihi 10%. Disarankan meninjau ulang perbandingan nilai antar kriteria.`;
}

        // Update Progress Bar Bobot Wi — Largest Remainder Method
        // agar total tampilan persentase selalu tepat 100%
        const rawPcts = {};
        kKeys.forEach(k => {
            rawPcts[k] = (weights[k] || 0.20) * 100;
        });

        // Bulatkan ke bawah semua, hitung sisa
        const floored = {};
        let sumFloored = 0;
        kKeys.forEach(k => {
            floored[k] = Math.floor(rawPcts[k] * 10) / 10; // 1 desimal
            sumFloored += floored[k];
        });

        // Sisa yang perlu didistribusikan (dalam satuan 0.1)
        let remainder = Math.round((100 - sumFloored) * 10);

        // Urutkan berdasarkan bagian desimal terbesar
        const sorted = [...kKeys].sort((a, b) =>
            (rawPcts[b] - floored[b]) - (rawPcts[a] - floored[a])
        );

        const finalPcts = { ...floored };
        for (let i = 0; i < remainder; i++) {
            finalPcts[sorted[i]] = Math.round((finalPcts[sorted[i]] + 0.1) * 10) / 10;
        }

        kKeys.forEach(k => {
            const w = weights[k] || 0.20;
            const pct = (finalPcts[k] / 100).toFixed(3);
            const lbl = document.getElementById(`weight_label_${k}`);
            const bar = document.getElementById(`weight_bar_${k}`);
            if (lbl) lbl.innerText = `${w.toFixed(3)} (${pct}%)`;
            if (bar) bar.style.width = `${pct}%`;
        });
    }

    window.hitungUlangMatrixClient = calculateAHP;

    window.switchTipeKriteria = function(idx, tipe) {
        const boxAngka = document.getElementById(`boxAngka_${idx}`);
        const boxPilihan = document.getElementById(`boxPilihan_${idx}`);
        if (!boxAngka || !boxPilihan) return;

        if (tipe === 'angka') {
            boxAngka.style.display = 'flex';
            boxPilihan.style.display = 'none';
        } else {
            boxAngka.style.display = 'none';
            boxPilihan.style.display = 'flex';
        }
    };

    window.tambahPilihanRow = function(idx) {
        const container = document.getElementById(`pilihanRows_${idx}`);
        if (!container) return;
        const currentRows = container.querySelectorAll('.pilihan-row');
        const nextNum = currentRows.length + 1;
        const nextKey = Date.now() + '_' + nextNum;

        const row = document.createElement('div');
        row.className = 'pilihan-row';
        row.innerHTML = `
            <span class="badge-num">${nextNum}.</span>
            <input type="text" name="kriterias[${idx}][pilihan][${nextKey}][label]" class="pilihan-label-input" placeholder="Nama opsi pilihan baru..." required>
            <div class="pilihan-nilai-wrap">
                <span class="pilihan-val-lbl">Skor:</span>
                <input type="number" name="kriterias[${idx}][pilihan][${nextKey}][nilai]" style="width:50px;" value="${nextNum}" min="1" max="10" required>
            </div>
            <button type="button" class="btn-del-row" title="Hapus pilihan" onclick="hapusPilihanRow(this)">✕</button>
        `;
        container.appendChild(row);
        const input = row.querySelector('.pilihan-label-input');
        if (input) input.focus();
    };

    window.hapusPilihanRow = function(btn) {
        const row = btn.closest('.pilihan-row');
        const container = row ? row.parentElement : null;
        if (container && container.querySelectorAll('.pilihan-row').length <= 1) {
            alert('Minimal harus ada 1 pilihan opsi sub-kriteria.');
            return;
        }
        if (row) {
            row.remove();
            if (container) {
                container.querySelectorAll('.pilihan-row').forEach((r, i) => {
                    const badge = r.querySelector('.badge-num');
                    if (badge) badge.innerText = `${i + 1}.`;
                });
            }
        }
    };

    document.querySelectorAll('.ahp-select').forEach(sel => {
        sel.addEventListener('change', calculateAHP);
    });

    calculateAHP();
});
</script>
@endsection