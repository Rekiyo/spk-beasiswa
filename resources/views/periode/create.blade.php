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
                        Metode SPK: SAW Terbobot AHP (Paket Konfigurasi Terintegrasi)
                    </span>
                </div>
                <p class="page-desc">
                    Tentukan parameter identitas periode pendaftaran beasiswa dan pilih paket konfigurasi seleksi terverifikasi (5 kriteria & bobot prioritas AHP yang konsisten).
                </p>
            </div>

            {{-- Stepper Progress --}}
            <div class="stepper-wrapper">
                <div class="stepper-item">
                    <div class="step-circle step-circle-active">1</div>
                    <span class="step-label text-current font-bold">Identitas Periode</span>
                </div>
                <div class="step-line"></div>
                <div class="stepper-item">
                    <div class="step-circle step-circle-active ring-active">2</div>
                    <span class="step-label text-active font-bold">Pilih Konfigurasi</span>
                </div>
            </div>
        </div>
    </div>

    @if (session('gagal'))
        <div class="alert alert-danger" style="background:#fef2f2; border:1px solid #fecaca; color:#991b1b; padding:14px 18px; border-radius:10px; margin-bottom:16px;">
            <strong>Gagal Menyimpan Periode:</strong> {{ session('gagal') }}
        </div>
    @endif

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
                        <p>Atur nama tahun ajaran, kuota penerima beasiswa, target jumlah total siswa pendaftar, dan rentang tanggal pendaftaran SMK.</p>
                    </div>
                </div>
                <span class="step-badge">Langkah 1 dari 2</span>
            </div>

            <div class="form-body">
                <div class="form-group">
                    <label>Nama Periode / Tahun Ajaran <span class="required">*</span></label>
                    <input type="text" name="nama" class="form-input" value="{{ old('nama', 'TA 2026/2027 – Semester Ganjil') }}" placeholder="Contoh: TA 2026/2027 – Semester Ganjil" required>
                    @error('nama') <span class="text-danger text-11">{{ $message }}</span> @enderror
                </div>

                <div class="grid-3-col">
                    <div class="form-group">
                        <label>Tahun Ajaran <span class="required">*</span></label>
                        <input type="text" name="tahun" class="form-input" value="{{ old('tahun', date('Y')) }}" placeholder="{{ date('Y') }}" required pattern="\d{4}">
                        <span style="font-size:11px; color:#6b7280; margin-top:3px; display:block;">Format 4 digit tahun (contoh: {{ date('Y') }}).</span>
                        @error('tahun') <span class="text-danger text-11">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Kuota Penerima Beasiswa <span class="required">*</span></label>
                        <div class="input-suffix-wrapper">
                            <input type="number" name="kuota" class="form-input" value="{{ old('kuota', 15) }}" min="1" required>
                            <span class="input-suffix">Siswa</span>
                        </div>
                        <span style="font-size:11px; color:#6b7280; margin-top:3px; display:block;">Jumlah siswa yang ditetapkan lolos menerima beasiswa.</span>
                        @error('kuota') <span class="text-danger text-11">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Jumlah Total Siswa yang Ditetapkan <span class="required">*</span></label>
                        <div class="input-suffix-wrapper">
                            <input type="number" name="total_siswa" class="form-input" value="{{ old('total_siswa', 300) }}" min="1" placeholder="Contoh: 300" required>
                            <span class="input-suffix">Siswa</span>
                        </div>
                        <span style="font-size:11px; color:#6b7280; margin-top:3px; display:block;">Target cakupan pendaftaran siswa SMK pada periode seleksi ini.</span>
                        @error('total_siswa') <span class="text-danger text-11">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid-2-col">
                    <div class="form-group">
                        <label>Tanggal Mulai Pendaftaran <span class="required">*</span></label>
                        <input type="date" name="tanggal_mulai" class="form-input" value="{{ old('tanggal_mulai', date('Y-m-d')) }}" required>
                        @error('tanggal_mulai') <span class="text-danger text-11">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Tanggal Penutupan Pendaftaran (Deadline) <span class="required">*</span></label>
                        <input type="date" name="deadline" class="form-input" value="{{ old('deadline', date('Y-m-d', strtotime('+30 days'))) }}" required>
                        @error('deadline') <span class="text-danger text-11">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="section-footer">
                <div class="footer-info">
                    <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>Informasi periode dapat diperbarui sebelum periode melewati batas deadline.</span>
                </div>
                <button type="button" class="btn btn-primary" onclick="window.scrollTo({top: document.getElementById('sectionKonfigurasi').offsetTop - 20, behavior: 'smooth'})">
                    Lanjut ke Pilih Konfigurasi →
                </button>
            </div>
        </section>

        {{-- SECTION 2: PILIH KONFIGURASI SELEKSI --}}
        <section id="sectionKonfigurasi" class="form-section" style="margin-top:24px;">
            <div class="section-header">
                <div class="section-title-wrapper">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    </div>
                    <div>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <h2>2. Pilih Konfigurasi Seleksi</h2>
                            <span class="status-badge status-success">Paket Kriteria & AHP Terpadu</span>
                        </div>
                        <p>Pilih satu paket konfigurasi seleksi yang valid dan terverifikasi konsisten (CR &lt; 0.10). Paket ini memuat 5 kriteria beserta pembobotan AHP yang siap diterapkan.</p>
                    </div>
                </div>
                <span class="step-badge">Langkah 2 dari 2</span>
            </div>

            <div class="form-body">
                @if ($konfigurasis->isEmpty())
                    {{-- Alert jika tidak ada konfigurasi siap pakai --}}
                    <div class="empty-config-banner">
                        <div class="empty-config-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        </div>
                        <div class="empty-config-content">
                            <h3>Belum Ada Paket Konfigurasi Seleksi yang Siap Digunakan</h3>
                            <p>
                                Untuk membuat periode seleksi baru, Anda harus memiliki minimal satu paket konfigurasi seleksi yang berstatus lengkap dan memenuhi syarat konsistensi AHP (Consistency Ratio / CR &lt; 0.10).
                                Silakan buat atau lengkapi konfigurasi seleksi terlebih dahulu.
                            </p>
                            <a href="{{ route('konfigurasi.create') }}" class="btn btn-primary" style="background:#d97706; border-color:#b45309;">
                                + Buat Konfigurasi Seleksi Baru Sekarang
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Hidden input for selected configuration --}}
                    @php
                        $selectedId = old('konfigurasi_seleksi_id', $konfigurasis->first()->id);
                    @endphp
                    <input type="hidden" name="konfigurasi_seleksi_id" id="selectedKonfigurasiId" value="{{ $selectedId }}" required>

                    <label style="font-size:12px; font-weight:700; color:#374151; margin-bottom:10px; display:block;">
                        Daftar Paket Konfigurasi Tersedia (Pilih Salah Satu): <span class="required">*</span>
                    </label>

                    {{-- Cards Grid --}}
                    <div class="konfigurasi-picker-grid">
                        @foreach ($konfigurasis as $konf)
                            @php
                                $isSelected = ((string)$konf->id === (string)$selectedId);
                            @endphp
                            <div class="konfigurasi-choice-card {{ $isSelected ? 'selected' : '' }}"
                                 id="configCard_{{ $konf->id }}"
                                 onclick="selectConfiguration({{ $konf->id }})">
                                <div class="card-choice-header">
                                    <div>
                                        <h4 class="card-choice-title">{{ $konf->nama }}</h4>
                                        <p class="card-choice-desc">
                                            {{ Str::limit($konf->deskripsi ?: 'Paket konfigurasi seleksi beasiswa prestasi standar terverifikasi AHP.', 90) }}
                                        </p>
                                    </div>
                                    <div class="card-choice-radio">
                                        <div class="card-choice-radio-dot"></div>
                                    </div>
                                </div>

                                <div class="card-choice-meta">
                                    <span class="tag-badge tag-version">v{{ $konf->versi }}</span>
                                    <span class="tag-badge tag-cr">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                        CR: {{ number_format($konf->cr, 3) }} (Konsisten)
                                    </span>
                                    <span class="tag-badge tag-count">{{ $konf->kriterias->count() }} Kriteria</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Dynamic Detailed Preview Panels --}}
                    @foreach ($konfigurasis as $konf)
                        @php
                            $isPanelActive = ((string)$konf->id === (string)$selectedId);
                        @endphp
                        <div class="config-preview-panel" id="previewPanel_{{ $konf->id }}" style="{{ $isPanelActive ? 'display:block;' : 'display:none;' }}">
                            <div class="config-preview-header">
                                <div>
                                    <h3>
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-brand"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                        Ringkasan Paket: {{ $konf->nama }}
                                        <span class="tag-badge tag-version">v{{ $konf->versi }}</span>
                                    </h3>
                                    <p style="font-size:12px; color:#6b7280; margin:4px 0 0;">
                                        Paket ini akan disalin (snapshot) ke periode baru. Data periode lama tidak akan terpengaruh jika konfigurasi ini diubah nantinya.
                                    </p>
                                </div>
                                <div style="display:flex; gap:8px;">
                                    <a href="{{ route('konfigurasi.show', $konf) }}" target="_blank" class="btn btn-outline" style="font-size:11px; padding:6px 12px;">
                                        Lihat Detail Lengkap ↗
                                    </a>
                                </div>
                            </div>

                            {{-- AHP Stats Grid --}}
                            <div class="preview-summary-grid">
                                <div class="preview-stat-card">
                                    <div class="preview-stat-label">Principal Eigen (λ max)</div>
                                    <div class="preview-stat-val text-brand">{{ number_format($konf->lambda_max, 3) }}</div>
                                </div>
                                <div class="preview-stat-card">
                                    <div class="preview-stat-label">Consistency Index (CI)</div>
                                    <div class="preview-stat-val">{{ number_format($konf->ci, 3) }}</div>
                                </div>
                                <div class="preview-stat-card">
                                    <div class="preview-stat-label">Consistency Ratio (CR)</div>
                                    <div class="preview-stat-val text-emerald-dark">{{ number_format($konf->cr, 3) }}</div>
                                </div>
                                <div class="preview-stat-card">
                                    <div class="preview-stat-label">Status AHP</div>
                                    <div class="preview-stat-val" style="color:#059669; font-size:12px;">KONSISTEN (&lt; 0.10)</div>
                                </div>
                            </div>

                            {{-- 5 Kriteria Table --}}
                            <div class="table-container" style="border-radius:8px; border:1px solid #e5e7eb;">
                                <table class="preview-criteria-table">
                                    <thead>
                                        <tr>
                                            <th style="width:65px; text-align:center;">KODE</th>
                                            <th style="width:220px;">NAMA KRITERIA</th>
                                            <th style="width:140px;">SIFAT ATRIBUT</th>
                                            <th style="width:160px;">TIPE INPUT</th>
                                            <th style="width:180px;">RENTANG / PILIHAN</th>
                                            <th style="width:200px;">BOBOT AHP (Wi SAW)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($konf->kriterias as $k)
                                            @php
                                                $pct = round(($k->bobot ?? 0) * 100);
                                            @endphp
                                            <tr>
                                                <td class="font-bold text-brand" style="text-align:center;">{{ $k->kode }}</td>
                                                <td>
                                                    <span class="font-bold text-gray">{{ $k->nama }}</span>
                                                </td>
                                                <td>
                                                    @if ($k->atribut === 'benefit')
                                                        <span class="status-badge status-success" style="font-size:10px;">Benefit (Maks)</span>
                                                    @else
                                                        <span class="status-badge" style="background:#fff1f2; color:#be123c; border-color:#fda4af; font-size:10px;">Cost (Min)</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($k->tipe_input === 'angka')
                                                        <span class="tag-badge" style="background:#eff6ff; color:#1d4ed8; border:1px solid #bfdbfe;">Numerik (Angka)</span>
                                                    @else
                                                        <span class="tag-badge" style="background:#fdf2f8; color:#be185d; border:1px solid #fbcfe8;">Pilihan (Kategori)</span>
                                                    @endif
                                                </td>
                                                <td style="font-size:11px; color:#4b5563;">
                                                    @if ($k->tipe_input === 'angka')
                                                        <div>Min: {{ $k->min_val ?? 0 }} s/d Max: {{ $k->max_val ?? 100 }} {{ $k->satuan }}</div>
                                                        @if ($k->rentang)
                                                             <div style="font-size:10px; color:#9ca3af;">{{ $k->rentang }}</div>
                                                        @endif
                                                    @else
                                                        <div style="font-weight:600;">{{ $k->subKriterias->count() }} Pilihan Kategori:</div>
                                                        <div style="font-size:10px; color:#6b7280;">
                                                            {{ $k->subKriterias->pluck('label')->take(3)->implode(', ') }}
                                                            @if($k->subKriterias->count() > 3)...@endif
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div style="display:flex; justify-content:space-between; font-size:11px; font-weight:700; margin-bottom:4px;">
                                                        <span class="font-mono"><strong>{{ number_format($k->bobot, 2) }}</strong> ({{ $pct }}%)</span>
                                                    </div>
                                                    <div class="progress-bar" style="height:6px;">
                                                        <div class="progress-fill" style="width: {{ $pct }}%;"></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    @endforeach

                @endif
            </div>

            <div class="section-footer">
                <div class="footer-info text-success">
                    <svg class="info-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>Paket konfigurasi dan matriks AHP dipilih sebagai satu kesatuan utuh.</span>
                </div>
                <div style="display:flex; align-items:center; gap:8px;">
                    <a href="{{ route('konfigurasi.index') }}" class="btn btn-outline" style="font-size:12px;">
                        Kelola Konfigurasi Seleksi
                    </a>
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
                        <strong style="font-size:15px; color:#111827;">Periode Siap Difinalisasi</strong>
                        <span class="status-badge status-success">Siap Dibuka</span>
                    </div>
                    <p style="font-size:12px; color:#6b7280; margin:2px 0 0;">
                        Identitas periode dan paket konfigurasi seleksi yang dipilih akan segera diaktifkan.
                    </p>
                </div>
            </div>

            <div style="display:flex; align-items:center; gap:10px;">
                <a href="{{ route('periode.index') }}" class="btn btn-outline">
                    Batal
                </a>
                <button type="submit" class="btn btn-primary" style="padding:10px 22px; font-size:13px;" {{ $konfigurasis->isEmpty() ? 'disabled' : '' }}>
                    ✓ Buat & Buka Periode Seleksi Ini
                </button>
            </div>
        </section>

    </form>

</main>

{{-- Client-side Configuration Selector Script --}}
<script>
function selectConfiguration(id) {
    document.getElementById('selectedKonfigurasiId').value = id;

    // Toggle card selection state
    document.querySelectorAll('.konfigurasi-choice-card').forEach(card => {
        card.classList.remove('selected');
    });
    const targetCard = document.getElementById('configCard_' + id);
    if (targetCard) {
        targetCard.classList.add('selected');
    }

    // Toggle preview panel
    document.querySelectorAll('.config-preview-panel').forEach(panel => {
        panel.style.display = 'none';
    });
    const targetPanel = document.getElementById('previewPanel_' + id);
    if (targetPanel) {
        targetPanel.style.display = 'block';
    }
}
</script>
@endsection