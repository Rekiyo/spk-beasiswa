@extends('layouts.app')

@php
    $pageCss = 'konfigurasi_form';
@endphp

@section('title', 'Buat Paket Konfigurasi Seleksi Baru - SPK Beasiswa Prestasi')

@section('content')
<main class="konfigurasi-form-main">

    {{-- Breadcrumb & Header --}}
    <div class="header-section">
        <div class="breadcrumb">
            <a href="{{ route('konfigurasi.index') }}" class="breadcrumb">
                <svg class="breadcrumb-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                <span>Kembali ke Daftar Konfigurasi</span>
            </a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">Buat Konfigurasi Seleksi Baru</span>
        </div>

        <div class="header-content">
            <div>
                <div class="title-wrapper">
                    <h1 class="page-title">Buat Paket Konfigurasi Seleksi Baru</h1>
                    <span class="method-badge">
                        <span class="dot pulse"></span>
                        AHP Terbobot: Skala Saaty 1–9 (Syarat Siap: CR &le; 0.10)
                    </span>
                </div>
                <p class="page-desc">
                    Tentukan parameter 5 kriteria penilaian seleksi beasiswa dan hitung pembobotan prioritas AHP secara berpasangan.
                    Paket ini akan dapat dipilih langsung saat pembuatan periode seleksi baru.
                </p>
            </div>

            {{-- Stepper Progress --}}
            <div class="stepper-wrapper">
                <div class="stepper-item" onclick="window.scrollTo({top: document.getElementById('sectionIdentitas').offsetTop - 20, behavior: 'smooth'})">
                    <div class="step-circle active">1</div>
                    <span class="step-label active">Identitas</span>
                </div>
                <div class="step-line"></div>
                <div class="stepper-item" onclick="window.scrollTo({top: document.getElementById('sectionKriteria').offsetTop - 20, behavior: 'smooth'})">
                    <div class="step-circle active">2</div>
                    <span class="step-label active">5 Kriteria</span>
                </div>
                <div class="step-line"></div>
                <div class="stepper-item" onclick="window.scrollTo({top: document.getElementById('sectionAhp').offsetTop - 20, behavior: 'smooth'})">
                    <div class="step-circle active">3</div>
                    <span class="step-label active">Matriks AHP</span>
                </div>
                <div class="step-line"></div>
                <div class="stepper-item" onclick="window.scrollTo({top: document.getElementById('sectionSimpan').offsetTop - 20, behavior: 'smooth'})">
                    <div class="step-circle active">4</div>
                    <span class="step-label active">Validasi</span>
                </div>
            </div>
        </div>
    </div>

    <form id="konfigurasiForm" action="{{ route('konfigurasi.store') }}" method="POST">
        @csrf

        <input type="hidden" name="is_draf" id="isDrafInput" value="0">

        {{-- LANGKAH 1: INFORMASI KONFIGURASI --}}
        <section id="sectionIdentitas" class="form-section">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div>
                        <h2>Langkah 1 — Informasi Konfigurasi</h2>
                        <p>Berikan identitas unik dan keterangan paket konfigurasi agar mudah diidentifikasi saat pemilihan periode.</p>
                    </div>
                </div>
                <span class="step-badge">Langkah 1 dari 4</span>
            </div>

            <div class="form-body">
                <div class="form-group">
                    <label>Nama Paket Konfigurasi Seleksi <span class="required">*</span></label>
                    <input type="text" name="nama" class="form-input" value="{{ old('nama', 'Standar Seleksi Siswa Prestasi SMK') }}" placeholder="Contoh: Standar Seleksi Siswa Prestasi SMK 2026" required>
                    @error('nama') <span class="text-danger text-11">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Deskripsi Konfigurasi (Opsional)</label>
                    <textarea name="deskripsi" class="form-textarea" rows="3" placeholder="Tuliskan tujuan atau karakteristik paket konfigurasi seleksi ini...">{{ old('deskripsi', 'Paket kriteria seleksi beasiswa prestasi dengan 5 kriteria akademik, sosio-ekonomi, dan kedisiplinan berbobot AHP.') }}</textarea>
                    @error('deskripsi') <span class="text-danger text-11">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="section-footer">
                <div style="font-size:12px; color:#6b7280; display:flex; align-items:center; gap:6px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#be185d" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>Identitas ini akan tampil pada daftar pilihan paket saat admin membuat periode seleksi baru.</span>
                </div>
                <button type="button" class="btn btn-primary" onclick="window.scrollTo({top: document.getElementById('sectionKriteria').offsetTop - 20, behavior: 'smooth'})">
                    Lanjut ke Pengaturan Kriteria →
                </button>
            </div>
        </section>

        {{-- LANGKAH 2: PENGATURAN LIMA KRITERIA SELEKSI --}}
        <section id="sectionKriteria" class="form-section" style="margin-top:24px;">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <h2>Langkah 2 — Pengaturan Lima Kriteria Seleksi</h2>
                            <span class="status-badge status-success">Tepat 5 Kriteria Baku</span>
                        </div>
                        <p>Kriteria penilaian baku berjumlah 5 kriteria (C1 s/d C5). Anda dapat menyesuaikan penamaan, sifat benefit/cost, serta tipe input angka atau opsi pilihan berbobot SAW.</p>
                    </div>
                </div>
                <span class="step-badge">Langkah 2 dari 4</span>
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
                                <th>PENGATURAN RENTANG NILAI / PILIHAN OPSI SUB-KRITERIA</th>
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
                                    {{-- BOX 1: JIKA TIPE INPUT ANGKA --}}
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

                                    {{-- BOX 2: JIKA TIPE INPUT PILIHAN --}}
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
                                            <span class="pilihan-hint">*Nilai skor digunakan pada normalisasi preferensi SAW</span>
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
                    <span>5 Kriteria siap dikomputasikan pada matriks perbandingan berpasangan AHP.</span>
                </div>
                <button type="button" class="btn btn-primary" onclick="window.scrollTo({top: document.getElementById('sectionAhp').offsetTop - 20, behavior: 'smooth'})">
                    Lanjut ke Matriks AHP →
                </button>
            </div>
        </section>

        {{-- LANGKAH 3: PEMBOBOTAN AHP --}}
        <section id="sectionAhp" class="form-section" style="margin-top:24px;">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                    </div>
                    <div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <h2>Langkah 3 — Pembobotan AHP (Perbandingan Berpasangan)</h2>
                            <span class="status-badge status-success">Kalkulator Otomatis</span>
                        </div>
                        <p>Atur tingkat kepentingan perbandingan antar kriteria menggunakan skala Saaty (2–9). Nilai diagonal bernilai 1.00 dan segitiga bawah otomatis dihitung sistem sebagai kebalikan (1/x).</p>
                    </div>
                </div>
                <span class="step-badge">Langkah 3 dari 4</span>
            </div>

            <div class="form-body">
                {{-- Saaty Scale Guide Panel --}}
                <div class="saaty-guide-panel">
                    <div class="saaty-guide-header">
                        <div style="display:flex; align-items:center; gap:6px;">
                            <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                            <span class="font-bold text-gray text-11">Panduan Skala Saaty Perbandingan Berpasangan (1 – 9)</span>
                        </div>
                        <span class="text-gray text-11 font-mono">Principle AHP: A(i, j) = 1 / A(j, i)</span>
                    </div>

                    <div class="saaty-grid">
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">1</span>
                                <span>Sama Penting</span>
                            </div>
                            <p>Kedua kriteria memiliki pengaruh seimbang terhadap sasaran seleksi beasiswa.</p>
                        </div>
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">3</span>
                                <span>Sedikit Lebih</span>
                            </div>
                            <p>Pengalaman & regulasi sedikit memprioritaskan kriteria baris dibanding kolom.</p>
                        </div>
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">5</span>
                                <span>Lebih Penting</span>
                            </div>
                            <p>Kriteria baris jelas dan tegas lebih diutamakan daripada kriteria pembanding.</p>
                        </div>
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">7</span>
                                <span>Sangat Dominan</span>
                            </div>
                            <p>Dominasi kepentingan kriteria terbukti sangat kuat secara substantif.</p>
                        </div>
                        <div class="saaty-card">
                            <div class="saaty-card-title">
                                <span class="saaty-circle">9</span>
                                <span>Mutlak Dominan</span>
                            </div>
                            <p>Tingkat prioritas kriteria berada pada kepastian tertinggi yang mungkin.</p>
                        </div>
                    </div>

                    <p class="saaty-note">
                        <span class="dot-brand"></span>
                        Ubah nilai segitiga atas dengan memilih nilai intensitas (1–9). Nilai kebalikan (1/x) pada segitiga bawah dihitung otomatis oleh sistem.
                    </p>
                </div>

                {{-- Matriks Perbandingan Berpasangan [A] --}}
                <div class="matrix-section">
                    <div class="matrix-header">
                        <h3>Matriks Perbandingan Berpasangan [A]</h3>
                        <span>Ubah nilai dropdown segitiga atas untuk memperbarui bobot</span>
                    </div>

                    @php
                        $kLabels = [
                            'C1' => 'C1 (Nilai Akademik)',
                            'C2' => 'C2 (Penghasilan Ortu)',
                            'C3' => 'C3 (Tanggungan Ortu)',
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
                                                        @for ($v = 1; $v <= 9; $v++)
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
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#be185d" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/></svg>
                            </div>
                            <p class="result-card-desc">Uji konsistensi matematis perbandingan berpasangan (n = 5 kriteria, RI = 1.120).</p>

                            <div class="cr-stats">
                                <div class="cr-stat-row">
                                    <span>Principal Eigenvalue (&lambda; max)</span>
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
                                <strong id="crAlertTitle">KONSISTEN (CR &le; 0.10)</strong>
                                <p id="crAlertText">Rasio konsistensi memenuhi standar toleransi Saaty (&lt; 10%). Paket konfigurasi memenuhi syarat untuk ditetapkan siap pakai.</p>
                            </div>
                        </div>
                    </div>

                    {{-- VEKTOR PRIORITAS BOBOT SAW (Wi) --}}
                    <div class="result-card">
                        <div>
                            <div class="result-card-header">
                                <h4>VEKTOR PRIORITAS BOBOT SAW (W_i)</h4>
                                <span class="tag-check font-mono font-bold">Total = 1.00 (100%)</span>
                            </div>
                            <p class="result-card-desc">Bobot prioritas kriteria yang akan digunakan pada perkalian matriks R metode SAW.</p>

                            <div class="weights-list">
                                @foreach ($kKeys as $k)
                                    @php
                                        $w = $ahpResult['weights'][$k] ?? 0.20;
                                        $pct = round($w * 100);
                                    @endphp
                                    <div class="weight-item">
                                        <div class="weight-info">
                                            <span>{{ $kLabels[$k] }}</span>
                                            <span id="weight_label_{{ $k }}" class="font-mono font-bold">{{ number_format($w, 2) }} ({{ $pct }}%)</span>
                                        </div>
                                        <div class="progress-bar">
                                            <div id="weight_bar_{{ $k }}" class="progress-fill" style="width: {{ $pct }}%;"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div style="padding-top:10px; border-top:1px solid #f1f5f9; font-size:11px; color:#64748b; font-style:italic;">
                            *Bobot dipastikan terdistribusi 100% dan terikat pada paket konfigurasi ini.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- LANGKAH 4: VALIDASI DAN PENYIMPANAN --}}
        <section id="sectionSimpan" class="final-action-panel" style="margin-top:24px;">
            <div style="display:flex; align-items:center; gap:16px;">
                <div class="icon-circle bg-emerald-light text-emerald-dark border-emerald">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <div>
                    <div style="display:flex; align-items:center; gap:8px;">
                        <strong style="font-size:15px; color:#111827;">Langkah 4 — Ringkasan & Validasi Penyimpanan</strong>
                        <span id="statusSiapBadge" class="status-badge status-success">Siap Dipublikasikan</span>
                    </div>
                    <p style="font-size:12px; color:#6b7280; margin:2px 0 0;">
                        Paket konfigurasi yang konsisten (CR &le; 0.10) dapat langsung dipilih saat membuat periode baru. Anda juga dapat menyimpannya sebagai draf.
                    </p>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                <a href="{{ route('konfigurasi.index') }}" class="btn btn-outline">
                    Batal
                </a>

                {{-- SIMPAN SEBAGAI DRAF --}}
                <button type="button" class="btn btn-draft" onclick="submitSebagaiDraf()">
                    Simpan Sebagai Draf
                </button>

                {{-- SIMPAN & TETAPKAN SIAP PAKAI --}}
                <button type="submit" id="btnSubmitSiap" class="btn btn-primary" style="padding:10px 22px;">
                    ✓ Simpan & Tetapkan Siap Digunakan
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

    let currentIsConsistent = true;

    function calculateAHP() {
        const n = kKeys.length;
        const A = {};

        // Inisialisasi Matriks A
        kKeys.forEach(i => {
            A[i] = {};
            kKeys.forEach(j => {
                A[i][j] = (i === j) ? 1.0 : 1.0;
            });
        });

        // Baca select segitiga atas
        document.querySelectorAll('.ahp-select').forEach(sel => {
            const i = sel.dataset.i;
            const j = sel.dataset.j;
            const val = parseFloat(sel.value) || 1.0;
            A[i][j] = val;
            A[j][i] = 1.0 / val;

            const lowerCell = document.getElementById(`cell_${j}_${i}`);
            if (lowerCell) {
                lowerCell.innerHTML = (1.0 / val).toFixed(3) + `<input type="hidden" name="matrix[${j}][${i}]" value="${(1.0 / val).toFixed(6)}">`;
            }
        });

        // Hitung Jumlah Kolom
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

        // Normalisasi & Bobot Wi
        const weights = {};
        kKeys.forEach(i => {
            let rowSum = 0.0;
            kKeys.forEach(j => {
                rowSum += A[i][j] / colSums[j];
            });
            weights[i] = rowSum / n;
        });

        // Lambda Max sesuai rumus referensi: Σ (Total Kolom_j × Bobot_j)
        let lambdaMax = 0.0;
        kKeys.forEach(j => {
            lambdaMax += colSums[j] * weights[j];
        });

        // CI & CR
        const ci = Math.max(0, (lambdaMax - n) / (n - 1));
        const ri = saatyRI[n] || 1.12;
        const cr = ci / ri;

        currentIsConsistent = (cr <= 0.10);

        // Update UI Statistik
        document.getElementById('stat_lambda').innerText = lambdaMax.toFixed(3);
        document.getElementById('stat_ci').innerText = ci.toFixed(3);
        document.getElementById('stat_cr').innerText = cr.toFixed(3);

        const crAlert = document.getElementById('crAlert');
        const crAlertTitle = document.getElementById('crAlertTitle');
        const crAlertText = document.getElementById('crAlertText');
        const statusSiapBadge = document.getElementById('statusSiapBadge');
        const btnSubmitSiap = document.getElementById('btnSubmitSiap');

        if (currentIsConsistent) {
            crAlert.className = 'alert alert-success';
            crAlertTitle.innerText = `KONSISTEN (CR = ${cr.toFixed(3)} \u2264 0.10)`;
            crAlertText.innerText = `Rasio konsistensi ${(cr * 100).toFixed(1)}% memenuhi standar toleransi Saaty (\u2264 10%). Paket konfigurasi memenuhi syarat untuk ditetapkan siap pakai.`;
            statusSiapBadge.className = 'status-badge status-success';
            statusSiapBadge.innerText = 'Siap Dipublikasikan';
            btnSubmitSiap.disabled = false;
            btnSubmitSiap.title = '';
        } else {
            crAlert.className = 'alert alert-warning';
            crAlertTitle.innerText = `TIDAK KONSISTEN (CR = ${cr.toFixed(3)} > 0.10)`;
            crAlertText.innerText = `Rasio konsistensi melebihi toleransi Saaty 10%. Paket ini HANYA dapat disimpan sebagai DRAF dan belum boleh dipilih untuk periode baru sampai diperbaiki.`;
            statusSiapBadge.className = 'status-badge';
            statusSiapBadge.style.background = '#fffbeb';
            statusSiapBadge.style.color = '#b45309';
            statusSiapBadge.style.borderColor = '#fde68a';
            statusSiapBadge.innerText = 'Belum Memenuhi Syarat Konsistensi (Draf)';
        }

        // Update Bobot Progress Bar
        kKeys.forEach(k => {
            const w = weights[k] || 0.20;
            const pct = Math.round(w * 100);
            const lbl = document.getElementById(`weight_label_${k}`);
            const bar = document.getElementById(`weight_bar_${k}`);
            if (lbl) lbl.innerText = `${w.toFixed(2)} (${pct}%)`;
            if (bar) bar.style.width = `${pct}%`;
        });
    }

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

    window.submitSebagaiDraf = function() {
        document.getElementById('isDrafInput').value = '1';
        document.getElementById('konfigurasiForm').submit();
    };

    // Form submit validation: jika CR > 0.10 dan bukan draf, tolak sesuai Ketentuan
    document.getElementById('konfigurasiForm').addEventListener('submit', function (e) {
        const isDraf = document.getElementById('isDrafInput').value === '1';
        if (!isDraf && !currentIsConsistent) {
            e.preventDefault();
            alert('Konfigurasi belum konsisten (CR > 0.10) sehingga tidak boleh ditetapkan sebagai konfigurasi siap pakai untuk periode baru. Silakan sesuaikan nilai perbandingan matriks AHP hingga konsisten atau pilih tombol "Simpan Sebagai Draf".');
        }
    });

    document.querySelectorAll('.ahp-select').forEach(sel => {
        sel.addEventListener('change', calculateAHP);
    });

    calculateAHP();
});
</script>
@endsection
