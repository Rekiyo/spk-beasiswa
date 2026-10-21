@php($pageCss = 'kriteria_index')

@extends('layouts.app')

@section('title', 'Kelola Seleksi & Perangkingan - SPK Beasiswa Prestasi')

@section('content')
<main class="saw-main">
    {{-- Breadcrumb & Header --}}
    <div class="header-section">
        <div class="breadcrumb-container">
            <a href="{{ route('periode.index') }}" class="breadcrumb-back">
                <span>←</span> Kembali ke Manajemen Periode
            </a>
            <span class="breadcrumb-sep">/</span>
            <span class="breadcrumb-current">Kelola Seleksi & Perangkingan</span>
        </div>
        
        <div class="header-action-row">
            <div class="title-group">
                <div class="title-row">
                    <h1 class="page-title">Kelola Seleksi & Perangkingan</h1>
                    <span class="method-badge">
                        <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Metode SPK: SAW Terbobot AHP
                    </span>
                </div>
                <p class="page-desc">Kelola data calon penerima beasiswa, input nilai kriteria, import data, dan pantau rekapitulasi hasil perankingan SAW.</p>
            </div>
            <button class="btn btn-primary">
                <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Export Laporan SK
            </button>
        </div>
    </div>

    {{-- Info Panel: Periode Aktif --}}
    <section class="info-panel">
        <div class="info-grid">
            <div class="info-left">
                <div class="tags-row">
                    <span class="tag tag-success"><span class="dot pulse"></span>Periode Seleksi Berjalan</span>
                    <span class="tag tag-gray"><svg class="icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>Metode: SAW Terbobot AHP</span>
                    <span class="tag tag-outline font-mono">Kode: PRD-2026-GANJIL</span>
                </div>
                <h2>TA 2026/2027 – Semester Ganjil (Beasiswa Prestasi)</h2>
                <p>Fakultas Teknologi Informasi & Komunikasi — Batas penetapan surat keputusan beasiswa jalur akademik berprestasi dan ekstrakurikuler unggulan.</p>
            </div>
            <div class="info-right">
                <div class="stat-box">
                    <div class="stat-content">
                        <span class="stat-label">PERIODE AKTIF</span>
                        <strong class="stat-value">01 Agt – 30 Okt 2026</strong>
                        <span class="stat-sub text-accent">18 Hari Tersisa <span class="text-gray-400 font-normal">(Durasi 90 Hari)</span></span>
                    </div>
                    <div class="stat-icon bg-success-light text-success"><svg class="icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                </div>
                <div class="stat-box">
                    <div class="stat-content">
                         <span class="stat-label">ALOKASI KUOTA</span>
                        <strong class="stat-value">15 Siswa Penerima</strong>
                        <span class="stat-sub">Alokasi Kuota Beasiswa Sekolah <span class="text-gray-600 font-medium">(Total 128 Pendaftar)</span></span>
                    </div>
                    <div class="stat-icon bg-brand-light text-brand"><svg class="icon-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tabs & Weights Note --}}
    <div class="controls-bar">
        <div class="tabs-group">
            <button class="tab-btn tab-active">
                <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Input Data Manual Siswa
            </button>
            <button class="tab-btn">
                <svg class="icon-sm text-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Import Data via CSV / Excel
            </button>
            <button class="tab-btn">
                <svg class="icon-sm text-gray" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                Daftar Calon
                <span class="badge-count">128</span>
            </button>
        </div>
        <div class="weight-note">
             <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
             <span>Pembobotan SAW: <strong>C1 (30%), C2 (20%), C3 (15%), C4 (20%), C5 (15%)</strong></span>
        </div>
    </div>

    {{-- Form Penilaian SAW --}}
    <section class="card-section">
        <div class="card-header bg-gray-light">
             <div class="flex items-center gap-2">
                 <div class="icon-box bg-brand-light text-brand"><svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></div>
                 <h2 class="card-title">Form Penilaian Siswa Baru / Edit Nilai Kriteria</h2>
             </div>
             <span class="text-xs italic text-gray"> *Semua parameter matriks wajib terisi</span>
        </div>
        
        <div class="card-body">
            <div class="form-grid-layout">
                {{-- Left: Identitas --}}
                <div class="form-left-col">
                    <div class="section-sub-title">
                        <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        <h3>IDENTITAS AKADEMIK</h3>
                    </div>
                    
                    <div class="form-group-spacing">
                        <div class="form-group">
                            <label>Nama Lengkap Siswa</label>
                            <input type="text" class="form-input" value="Ahmad Rizky Pratama">
                        </div>
                        <div class="form-group">
                            <label>Nomor Induk Siswa Nasional (NISN)</label>
                            <input type="text" class="form-input font-mono" value="0078123416">
                        </div>
                         <div class="form-group">
                            <label>Program Studi / Jurusan</label>
                            <select class="form-select">
                                <option selected>S1 - Teknik Informatika</option>
                                <option>S1 - Sistem Informasi</option>
                            </select>
                        </div>
                        
                        <div class="profile-preview">
                            <div class="avatar bg-brand-light text-brand font-bold">AR</div>
                            <div>
                                <div class="profile-name">Ahmad Rizky Pratama</div>
                                <div class="profile-sub">Semester 5 • Reguler Pagi</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Right: Matriks SAW --}}
                <div class="form-right-col">
                     <div class="section-sub-title flex justify-between items-center">
                         <div class="flex items-center gap-2">
                            <svg class="icon-sm text-brand" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                            <h3>MATRIKS PENILAIAN KRITERIA SAW (C1 – C5)</h3>
                         </div>
                         <span class="tag tag-success font-medium">Standardisasi Nilai Crisp Otomatis</span>
                    </div>
                    
                    <div class="criteria-grid">
                        <div class="criteria-box">
                            <div class="c-box-header">
                                <span class="c-title">C1 – Nilai Akademik</span>
                                <span class="tag-sm tag-success">Benefit (W: 30%)</span>
                            </div>
                            <p class="c-desc">Indeks Prestasi Kumulatif (IPK)</p>
                            <div class="input-suffix-wrapper">
                                <input type="text" class="form-input font-bold" value="3.85">
                                <span class="input-suffix">/ 4.00</span>
                            </div>
                        </div>
                        
                        <div class="criteria-box">
                            <div class="c-box-header">
                                <span class="c-title">C2 – Penghasilan Ortu</span>
                                <span class="tag-sm tag-danger">Cost (W: 20%)</span>
                            </div>
                            <p class="c-desc">Akumulasi Penghasilan Bulanan</p>
                            <div class="input-prefix-wrapper">
                                <span class="input-prefix">Rp</span>
                                <input type="text" class="form-input font-bold font-mono text-left" style="padding-left: 36px;" value="3.500.000">
                            </div>
                        </div>

                        <div class="criteria-box">
                            <div class="c-box-header">
                                <span class="c-title">C3 – Tanggungan Ortu</span>
                                <span class="tag-sm tag-success">Benefit (W: 15%)</span>
                            </div>
                            <p class="c-desc">Jumlah Anak dalam KK</p>
                             <select class="form-select font-semibold">
                                <option>1 Orang Tanggungan</option>
                                <option>2 Orang Tanggungan</option>
                                <option selected>3 Orang Tanggungan</option>
                                <option>> 4 Orang Tanggungan</option>
                            </select>
                        </div>
                        
                         <div class="criteria-box">
                            <div class="c-box-header">
                                <span class="c-title">C5 – Ketidakhadiran</span>
                                <span class="tag-sm tag-danger">Cost (W: 15%)</span>
                            </div>
                            <p class="c-desc">Jam Alpa / Presensi Bolos</p>
                            <div class="input-suffix-wrapper">
                                <input type="text" class="form-input font-bold" value="2">
                                <span class="input-suffix" style="right: 30px;">Jam Alpa</span>
                            </div>
                        </div>
                        
                        <div class="criteria-box col-span-2">
                             <div class="c-box-header">
                                <span class="c-title">C4 – Ekstrakurikuler & Organisasi</span>
                                <span class="tag-sm tag-success">Benefit (W: 20%)</span>
                            </div>
                            <p class="c-desc">Pilihan Paket Kegiatan Terdaftar Siswa</p>
                            <div class="flex flex-wrap gap-2">
                                <select class="form-select font-semibold flex-1">
                                     <option selected>Paket 4: Kegiatan Ilmiah & Penalaran Prestasi</option>
                                </select>
                                <span class="tag-large bg-accent-light text-accent-dark border-accent-light flex items-center gap-1 font-bold">
                                    <svg class="icon-xs" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    Bobot Maksimal (Skor: 1.00)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer">
             <div class="flex items-center gap-2 text-xs font-medium text-gray-600">
                <svg class="icon-sm text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                <span>Data otomatis diverifikasi dengan transkrip DAAK</span>
            </div>
            <div class="flex items-center gap-2">
                <button class="btn btn-outline">Reset Formulir</button>
                <button class="btn btn-primary">
                     <svg class="icon-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan & Masukkan ke Antrean SAW
                </button>
            </div>
        </div>
    </section>

    {{-- Tabel Rekapitulasi --}}
    <section class="card-section mt-6">
        <div class="p-6 border-b border-gray-200">
             <div class="flex justify-between items-start flex-wrap gap-4 mb-4">
                 <div>
                     <h2 class="text-lg font-extrabold text-gray-900 tracking-tight">Hasil Rekapitulasi Perangkingan Simple Additive Weighting (SAW)</h2>
                     <p class="text-xs text-gray-500 mt-1">Daftar peringkat dihitung berdasarkan normalisasi matriks <strong class="font-mono">R</strong> dikalikan bobot preferensi <strong class="font-mono">W</strong> menghasilkan nilai akhir <strong class="font-mono">V_i</strong>.</p>
                 </div>
                 
                 <div class="filter-pills bg-gray-light p-1 rounded-lg border border-gray-200 flex gap-1">
                     <button class="pill bg-white shadow-sm font-bold text-gray-800">Semua (128)</button>
                     <button class="pill text-success-dark hover-bg-white"><span class="dot bg-success"></span>15 Lolos Kuota</button>
                     <button class="pill text-gray-600 hover-bg-white"><span class="dot bg-gray-400"></span>113 Tidak Lolos</button>
                 </div>
             </div>
             
             <div class="filters-bar">
                 <div class="input-icon-wrapper flex-2 relative">
                     <svg class="icon-sm absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                     <input type="text" class="form-input pl-9" placeholder="Cari nama atau NIM siswa...">
                 </div>
                 <select class="form-select flex-1"><option>Semua Status Keputusan</option></select>
                 <select class="form-select flex-1 font-medium"><option>Ranking Tertinggi (V_i Descending)</option></select>
             </div>
        </div>

        <div class="table-responsive">
            <table class="saw-table">
                <thead>
                    <tr>
                        <th class="text-center w-16">RANK</th>
                        <th>SISWA / KONSENTRASI KEAHLIAN</th>
                        <th>MATRIKS NILAI ASLI (C1–C5)</th>
                        <th class="text-center w-24">SKOR V_I</th>
                        <th class="text-center w-40">KEPUTUSAN KUOTA</th>
                        <th class="text-center w-24">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Row 1 --}}
                    <tr>
                        <td class="text-center"><span class="rank-circle bg-accent text-white font-extrabold">1</span></td>
                        <td>
                            <div class="student-name">Ahmad Rizky Pratama</div>
                            <div class="student-info">NIM: 2023081045 • <span>S1 Teknik Informatika</span></div>
                        </td>
                        <td>
                            <div class="matrix-pills">
                                <span>3.85</span><span>3.5Jt</span><span>3</span><span>P4</span><span>2 Jam</span>
                            </div>
                        </td>
                        <td class="text-center"><span class="score-text">0.942</span></td>
                        <td class="text-center"><span class="decision-badge badge-success"><svg class="icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg> Lolos Penerima</span></td>
                        <td class="text-center">
                            <div class="action-buttons-sm">
                                <button title="Detail"><svg viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.257-5.064 7-9.542 7-4.477 0-8.268-2.5-9.542-7z"/></svg></button>
                                <button title="Edit"><svg viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                                <button title="Hapus" class="text-danger"><svg viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </div>
                        </td>
                    </tr>
                    {{-- Row 2 --}}
                     <tr>
                        <td class="text-center"><span class="rank-circle bg-brand-light text-brand border-brand-light">2</span></td>
                        <td>
                            <div class="student-name">Siti Nurhaliza Putri</div>
                            <div class="student-info">NIM: 2023081012 • <span>S1 Sistem Informasi</span></div>
                        </td>
                        <td>
                            <div class="matrix-pills">
                                <span>3.92</span><span>4.0Jt</span><span>4</span><span>P3</span><span>0 Jam</span>
                            </div>
                        </td>
                        <td class="text-center"><span class="score-text">0.915</span></td>
                        <td class="text-center"><span class="decision-badge badge-success"><svg class="icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg> Lolos Penerima</span></td>
                        <td class="text-center">
                            <div class="action-buttons-sm">
                                <button><svg viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.257-5.064 7-9.542 7-4.477 0-8.268-2.5-9.542-7z"/></svg></button>
                                <button><svg viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                                <button class="text-danger"><svg viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </div>
                        </td>
                    </tr>
                    {{-- Row 5 (Batas) --}}
                     <tr class="row-warning">
                        <td class="text-center"><span class="rank-circle bg-accent-light text-accent border-accent-light">15</span></td>
                        <td>
                            <div class="student-name">Fajar Maulana Sidiq</div>
                            <div class="student-info">NIM: 2023081079 • <span>S1 Teknik Elektro</span></div>
                        </td>
                        <td>
                            <div class="matrix-pills">
                                <span>3.60</span><span>4.2Jt</span><span>3</span><span>P2</span><span>1 Jam</span>
                            </div>
                        </td>
                        <td class="text-center"><span class="score-text">0.804</span></td>
                        <td class="text-center"><span class="decision-badge badge-warning"><svg class="icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg> Lolos Penerima (Batas)</span></td>
                        <td class="text-center">
                            <div class="action-buttons-sm">
                                <button><svg viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.257-5.064 7-9.542 7-4.477 0-8.268-2.5-9.542-7z"/></svg></button>
                                <button><svg viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                                <button class="text-danger"><svg viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </div>
                        </td>
                    </tr>
                    {{-- Row 16 (Gagal) --}}
                     <tr class="row-disabled">
                        <td class="text-center"><span class="rank-circle bg-gray-light text-gray-500">16</span></td>
                        <td>
                            <div class="student-name">Nabila Zahra Khairunnisa</div>
                            <div class="student-info">NIM: 2023081102 • <span>S1 Sistem Informasi</span></div>
                        </td>
                        <td>
                            <div class="matrix-pills">
                                <span>3.55</span><span>4.5Jt</span><span>2</span><span>P3</span><span>2 Jam</span>
                            </div>
                        </td>
                        <td class="text-center"><span class="score-text text-gray-600">0.792</span></td>
                        <td class="text-center"><span class="decision-badge badge-gray"><svg class="icon-xs" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> Tidak Lolos</span></td>
                        <td class="text-center">
                            <div class="action-buttons-sm">
                                <button><svg viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.257-5.064 7-9.542 7-4.477 0-8.268-2.5-9.542-7z"/></svg></button>
                                <button><svg viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg></button>
                                <button class="text-danger"><svg viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="pagination-footer">
            <div>Menampilkan <strong>1 – 6</strong> dari <strong>128</strong> total pendaftar</div>
            <div class="pagination-controls">
                <button class="page-btn text-gray-500" disabled>&lt;</button>
                <button class="page-btn page-active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <span>…</span>
                <button class="page-btn">13</button>
                <button class="page-btn text-gray-500">&gt;</button>
            </div>
        </div>
    </section>
</main>
@endsection