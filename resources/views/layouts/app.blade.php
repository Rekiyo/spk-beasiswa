<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'SPK Beasiswa Prestasi')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/css/' . ($pageCss ?? 'dashboard') . '.css',
        'resources/js/app.js'
    ])
</head>

<body>

    {{-- HEADER --}}
    <header class="app-header">
        <a href="{{ route('dashboard') }}" class="app-header__brand">
            <div class="app-header__logo">
                <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                    <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
            </div>

            <span>
                SPK BEASISWA PRESTASI
            </span>
        </a>

        <nav class="app-header__nav">
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('periode.index') }}"
               class="{{ request()->routeIs('periode.*', 'kriteria.*', 'sub-kriteria.*') ? 'active' : '' }}">
                Periode Seleksi
            </a>

            <a href="{{ route('konfigurasi.index') }}"
               class="{{ request()->routeIs('konfigurasi.*') ? 'active' : '' }}">
                Konfigurasi Seleksi
            </a>
        </nav>

        <div class="app-header__user">
            <div>
                <strong>Panitia Beasiswa</strong>
                <small>Administrator Pusat</small>
            </div>

            <div class="app-header__avatar">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>

            <span class="app-header__chevron">⌄</span>
        </div>
    </header>


    {{-- FLASH MESSAGE --}}
    @if (session('sukses'))
        <div style="max-width: 1280px; margin: 16px auto 0; padding: 0 24px;">
            <div class="flash flash--success" style="display:flex; align-items:center; gap:8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                <span>{{ session('sukses') }}</span>
            </div>
        </div>
    @endif

    @if (session('gagal'))
        <div style="max-width: 1280px; margin: 16px auto 0; padding: 0 24px;">
            <div class="flash flash--error" style="display:flex; align-items:center; gap:8px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                <span>{{ session('gagal') }}</span>
            </div>
        </div>
    @endif


    {{-- CONTENT --}}
    <main class="app-main">
        @yield('content')
    </main>


    {{-- FOOTER --}}
    <footer class="app-footer">

        <div class="app-footer__main">

            {{-- BRAND --}}
            <div class="app-footer__brand">

                <div class="app-footer__brand-title">
                    <div class="app-footer__logo">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                        </svg>
                    </div>

                    <div>
                        <strong>SPK Beasiswa Prestasi SMK</strong>
                        <span>Panitia Beasiswa & Kesiswaan</span>
                    </div>
                </div>

                <p>
                    Sistem pendukung keputusan terintegrasi untuk penentuan
                    kelayakan penerima beasiswa prestasi siswa SMK berbasis algoritma
                    Simple Additive Weighting (SAW) berbobot Analytical
                    Hierarchy Process (AHP).
                </p>

                <span class="app-footer__status">
                    <i></i>
                    Sistem Aktif • Seleksi Beasiswa Siswa SMK
                </span>

            </div>


            {{-- QUICK LINKS --}}
            <div class="app-footer__column">

                <h3>TAUTAN CEPAT</h3>

                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                    Dashboard Seleksi
                </a>

                @php
                    $latestPeriode = rescue(fn () => \App\Models\Periode::latest('id')->first(), null);
                @endphp
                <a href="{{ $latestPeriode ? route('periode.seleksi', $latestPeriode) : '#' }}">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20V10M18 20V4M6 20v-4"/></svg>
                    Kriteria & Perangkingan
                </a>

                <a href="{{ route('periode.index') }}" class="{{ request()->routeIs('periode.*') ? 'active' : '' }}">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Periode Seleksi
                </a>

                <a href="{{ route('konfigurasi.index') }}" class="{{ request()->routeIs('konfigurasi.*') ? 'active' : '' }}">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                    Konfigurasi Seleksi
                </a>

                <a href="{{ $latestPeriode ? route('periode.seleksi', $latestPeriode) : '#' }}">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    Panduan Algoritma SAW
                </a>

            </div>


            {{-- CONTACT --}}
            <div class="app-footer__column">

                <h3>KONTAK & LAYANAN PANITIA</h3>

                <div>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
                    Gedung Administrasi SMK, Ruang Pelayanan Kesiswaan
                </div>

                <div>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    kesiswaan@smk-prestasi.sch.id
                </div>

                <div>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    Senin - Jumat: 07.30 - 15.30 WIB
                </div>

            </div>

        </div>


        <div class="app-footer__bottom">

            <span>
                Hak Cipta © 2026 SPK Beasiswa Prestasi Siswa SMK. Kesiswaan SMK Negeri 1 Prestasi. Seluruh hak cipta dilindungi undang-undang.
            </span>

            <div>
                <a href="javascript:void(0)" onclick="openLegalModal('privacy')">Kebijakan Privasi</a>
                <span>•</span>
                <a href="javascript:void(0)" onclick="openLegalModal('terms')">Syarat &amp; Ketentuan</a>
            </div>

        </div>

    </footer>

    {{-- Global Toast Notification Shelf --}}
    <div class="toast-shelf" id="appGlobalToastShelf"></div>

    {{-- Global Confirmation Modal --}}
    <div id="appGlobalConfirmModal" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(17,24,39,0.55); backdrop-filter:blur(3px); align-items:center; justify-content:center; padding:16px;">
        <div style="background:#fff; border-radius:14px; max-width:440px; width:100%; box-shadow:0 25px 50px -12px rgba(0,0,0,0.25); overflow:hidden; border:1px solid #f3f4f6;">
            <div style="padding:22px 24px 16px; display:flex; gap:16px;">
                <div style="width:44px; height:44px; border-radius:12px; background:#fee2e2; color:#ef4444; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                </div>
                <div>
                    <h3 id="appConfirmTitle" style="margin:0 0 6px 0; font-size:16px; font-weight:800; color:#111827;">Konfirmasi Hapus</h3>
                    <p id="appConfirmMessage" style="margin:0; font-size:13px; color:#4b5563; line-height:1.5;">Apakah Anda yakin ingin menghapus data ini?</p>
                </div>
            </div>
            <div style="padding:14px 24px; background:#f9fafb; border-top:1px solid #f3f4f6; display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" id="appConfirmBtnCancel" style="padding:8px 16px; font-size:13px; font-weight:600; color:#374151; background:#fff; border:1px solid #d1d5db; border-radius:8px; cursor:pointer;">
                    Batal
                </button>
                <button type="button" id="appConfirmBtnOk" style="padding:8px 18px; font-size:13px; font-weight:700; color:#fff; background:#ef4444; border:none; border-radius:8px; cursor:pointer;">
                    Ya, Hapus Data
                </button>
            </div>
        </div>
    </div>

    {{-- Global Modal: Syarat & Ketentuan dan Kebijakan Privasi --}}
    <div id="appLegalModal" style="display:none; position:fixed; inset:0; z-index:99999; background:rgba(17,24,39,0.6); backdrop-filter:blur(4px); align-items:center; justify-content:center; padding:16px;">
        <div style="background:#fff; border-radius:18px; max-width:680px; width:100%; box-shadow:0 25px 50px -12px rgba(0,0,0,0.3); overflow:hidden; border:1px solid #e5e7eb; display:flex; flex-direction:column; max-height:90vh;">
            
            {{-- Modal Header --}}
            <div style="padding:20px 24px 14px; border-bottom:1px solid #f1f5f9; display:flex; justify-content:space-between; align-items:center;">
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="width:40px; height:40px; border-radius:10px; background:#fdf2f8; color:#be185d; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </div>
                    <div>
                        <h3 id="legalModalTitle" style="margin:0; font-size:16px; font-weight:800; color:#111827;">Informasi Legalitas &amp; Ketentuan</h3>
                        <span style="font-size:12px; color:#6b7280;">SPK Beasiswa Prestasi Siswa SMK Negeri 1 Prestasi</span>
                    </div>
                </div>
                <button type="button" onclick="closeLegalModal()" style="background:#f3f4f6; border:none; width:32px; height:32px; border-radius:8px; font-size:16px; color:#4b5563; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:background 0.2s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">✕</button>
            </div>

            {{-- Tab Switcher --}}
            <div style="display:flex; padding:0 24px; background:#f8fafc; border-bottom:1px solid #e2e8f0; gap:8px;">
                <button type="button" id="tabBtnTerms" onclick="switchLegalTab('terms')" style="padding:12px 18px; font-size:13px; font-weight:700; color:#be185d; background:none; border:none; border-bottom:2px solid #be185d; cursor:pointer; display:inline-flex; align-items:center; gap:6px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"/><rect x="8" y="2" width="8" height="4" rx="1" ry="1"/></svg>
                    Syarat &amp; Ketentuan
                </button>
                <button type="button" id="tabBtnPrivacy" onclick="switchLegalTab('privacy')" style="padding:12px 18px; font-size:13px; font-weight:600; color:#64748b; background:none; border:none; border-bottom:2px solid transparent; cursor:pointer; display:inline-flex; align-items:center; gap:6px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Kebijakan Privasi
                </button>
            </div>

            {{-- Modal Body (Scrollable) --}}
            <div style="padding:22px 24px; overflow-y:auto; flex:1; font-size:12.5px; line-height:1.65; color:#374151;">
                
                {{-- KONTEN SYARAT & KETENTUAN --}}
                <div id="legalContentTerms">
                    <div style="background:#fdf2f8; border:1px solid #fbcfe8; border-radius:10px; padding:12px 16px; margin-bottom:18px;">
                        <strong style="color:#9d174d; display:block; font-size:13px; margin-bottom:2px;">Ketentuan Umum Program Beasiswa Prestasi</strong>
                        <span style="color:#831843; font-size:11.5px;">Sistem ini mengimplementasikan metode <strong>Analytical Hierarchy Process (AHP)</strong> untuk pembobotan kriteria dan <strong>Simple Additive Weighting (SAW)</strong> untuk perankingan preferensi calon penerima beasiswa.</span>
                    </div>

                    <h4 style="font-size:13px; font-weight:800; color:#111827; margin:0 0 8px;">1. Kriteria &amp; Bobot Penilaian (5 Kriteria Standar)</h4>
                    <p style="margin:0 0 12px; color:#4b5563;">Setiap calon penerima dinilai secara komprehensif berdasarkan 5 kriteria acuan seleksi:</p>
                    <div style="display:flex; flex-direction:column; gap:8px; margin-bottom:18px;">
                        <div style="display:flex; gap:10px; padding:8px 12px; background:#f9fafb; border-radius:8px; border:1px solid #f3f4f6;">
                            <span style="font-weight:700; color:#be185d; min-width:28px;">C1</span>
                            <div><strong>Prestasi Akademik (Benefit, W: 40%)</strong>: Nilai rata-rata rapor semester siswa (skala 0–100). Makin tinggi nilai, makin besar peluang kelulusan.</div>
                        </div>
                        <div style="display:flex; gap:10px; padding:8px 12px; background:#f9fafb; border-radius:8px; border:1px solid #f3f4f6;">
                            <span style="font-weight:700; color:#be185d; min-width:28px;">C2</span>
                            <div><strong>Penghasilan Orang Tua (Cost, W: 24%)</strong>: Total pendapatan kotor orang tua per bulan. Siswa dari keluarga dengan kondisi ekonomi lebih membutuhkan mendapatkan prioritas lebih tinggi.</div>
                        </div>
                        <div style="display:flex; gap:10px; padding:8px 12px; background:#f9fafb; border-radius:8px; border:1px solid #f3f4f6;">
                            <span style="font-weight:700; color:#be185d; min-width:28px;">C3</span>
                            <div><strong>Tanggungan Orang Tua (Benefit, W: 16%)</strong>: Jumlah anak/anggota keluarga yang menjadi tanggungan hidup orang tua. Makin banyak tanggungan, makin diprioritaskan.</div>
                        </div>
                        <div style="display:flex; gap:10px; padding:8px 12px; background:#f9fafb; border-radius:8px; border:1px solid #f3f4f6;">
                            <span style="font-weight:700; color:#be185d; min-width:28px;">C4</span>
                            <div><strong>Ekstrakurikuler (Cost, W: 11%)</strong>: Partisipasi siswa pada kegiatan organisasi/ekskul sekolah. Kategori paket ekskul aktif (Paket 1: Pramuka, Komputer, Paskibra) merupakan prioritas utama.</div>
                        </div>
                        <div style="display:flex; gap:10px; padding:8px 12px; background:#f9fafb; border-radius:8px; border:1px solid #f3f4f6;">
                            <span style="font-weight:700; color:#be185d; min-width:28px;">C5</span>
                            <div><strong>Kedisiplinan &amp; Ketidakhadiran (Cost, W: 9%)</strong>: Rekapitulasi jumlah hari alpa/tanpa keterangan. Siswa dengan tingkat absensi 0 hari (sangat disiplin) mendapatkan nilai normalisasi maksimal.</div>
                        </div>
                    </div>

                    <h4 style="font-size:13px; font-weight:800; color:#111827; margin:0 0 8px;">2. Mekanisme Kuota &amp; Status Kelulusan</h4>
                    <ul style="margin:0 0 16px; padding-left:20px; color:#4b5563;">
                        <li style="margin-bottom:6px;"><strong>Lolos Kuota</strong>: Siswa dengan nilai preferensi $V_i$ tertinggi dari peringkat 1 hingga batas kuota penerima yang ditetapkan pada periode berjalan.</li>
                        <li style="margin-bottom:6px;"><strong>Cadangan</strong>: Siswa pada peringkat berikutnya (alokasi cadangan sama dengan jumlah kuota utama) yang berpeluang naik apabila siswa lolos utama berhalangan atau mengundurkan diri.</li>
                        <li style="margin-bottom:6px;"><strong>Tidak Lolos</strong>: Siswa yang berada di luar batas kuota penerima dan cadangan.</li>
                        <li style="margin-bottom:6px;"><strong>Aturan Nilai Kembar (*Tie-Breaker*)</strong>: Apabila terdapat skor akhir $V_i$ yang persis sama, penentuan peringkat diprioritaskan secara berjenjang: (1) Nilai Rapor C1 tertinggi, (2) Penghasilan C2 terendah, (3) Alpa C5 terendah, dan (4) Nomor urut pendaftaran.</li>
                    </ul>

                    <h4 style="font-size:13px; font-weight:800; color:#111827; margin:0 0 8px;">3. Keputusan Akhir &amp; Pengesahan</h4>
                    <p style="margin:0; color:#4b5563;">Hasil perangkingan yang dihitung oleh sistem SPK berfungsi sebagai instrumen pendukung keputusan (*decision support*) yang objektif dan transparan. Penetapan akhir penerima beasiswa tetap disahkan secara hukum melalui <strong>Surat Keputusan (SK) Resmi Kepala Sekolah</strong>.</p>
                </div>

                {{-- KONTEN KEBIJAKAN PRIVASI --}}
                <div id="legalContentPrivacy" style="display:none;">
                    <div style="background:#eff6ff; border:1px solid #bfdbfe; border-radius:10px; padding:12px 16px; margin-bottom:18px;">
                        <strong style="color:#1e40af; display:block; font-size:13px; margin-bottom:2px;">Komitmen Perlindungan Data Siswa</strong>
                        <span style="color:#1e3a8a; font-size:11.5px;">Kesiswaan SMK Negeri 1 Prestasi berkomitmen menjaga kerahasiaan seluruh data pribadi, akademik, dan ekonomi calon penerima beasiswa.</span>
                    </div>

                    <h4 style="font-size:13px; font-weight:800; color:#111827; margin:0 0 8px;">1. Ruang Lingkup Data yang Diproses</h4>
                    <p style="margin:0 0 10px; color:#4b5563;">Sistem ini menghimpun dan memproses data calon siswa berupa:</p>
                    <ul style="margin:0 0 16px; padding-left:20px; color:#4b5563;">
                        <li style="margin-bottom:4px;"><strong>Identitas Akademik</strong>: Nama Lengkap Siswa, Nomor Induk Siswa Nasional (NISN), Program Studi/Jurusan SMK, dan Kelas.</li>
                        <li style="margin-bottom:4px;"><strong>Parameter Kriteria Seleksi</strong>: Nilai rapor siswa, slip penghasilan orang tua/wali, data kartu keluarga (jumlah tanggungan), rekap partisipasi ekskul, dan catatan presensi alpa.</li>
                    </ul>

                    <h4 style="font-size:13px; font-weight:800; color:#111827; margin:0 0 8px;">2. Tujuan Penggunaan Data</h4>
                    <p style="margin:0 0 16px; color:#4b5563;">Data yang diinputkan hanya digunakan untuk keperluan kalkulasi normalisasi matriks SAW, penentuan perankingan kelayakan beasiswa, pembuatan arsip keputusan beasiswa, dan penerbitan berkas lampiran SK resmi sekolah.</p>

                    <h4 style="font-size:13px; font-weight:800; color:#111827; margin:0 0 8px;">3. Batasan Akses &amp; Keamanan Data</h4>
                    <ul style="margin:0 0 16px; padding-left:20px; color:#4b5563;">
                        <li style="margin-bottom:4px;">Data tersimpan secara aman di dalam infrastruktur basis data sistem SPK sekolah.</li>
                        <li style="margin-bottom:4px;">Hak akses pengelolaan data dibatasi hanya untuk Panitia Seleksi Beasiswa, Tim Kesiswaan, dan Administrator Sekolah yang terotorisasi.</li>
                        <li style="margin-bottom:4px;">Data siswa tidak akan pernah diperjualbelikan, disebarluaskan, atau diserahkan kepada pihak ketiga tanpa izin resmi dari sekolah dan orang tua/wali murid.</li>
                    </ul>

                    <h4 style="font-size:13px; font-weight:800; color:#111827; margin:0 0 8px;">4. Hak Perbaikan Data</h4>
                    <p style="margin:0; color:#4b5563;">Siswa dan orang tua/wali murid berhak mengonfirmasi dan meminta perbaikan data apabila ditemukan ketidaksesuaian input nilai atau berkas selama periode pendaftaran seleksi beasiswa masih dalam status berlangsung (belum ditutup/difinalisasi).</p>
                </div>

            </div>

            {{-- Modal Footer --}}
            <div style="padding:14px 24px; background:#f8fafc; border-top:1px solid #e2e8f0; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px;">
                <span style="font-size:11.5px; color:#64748b;">
                    Terakhir diperbarui: <strong>Tahun Ajaran 2026/2027</strong> • SMK Negeri 1 Prestasi
                </span>
                <button type="button" onclick="closeLegalModal()" style="padding:8px 20px; font-size:13px; font-weight:700; color:#fff; background:#be185d; border:none; border-radius:8px; cursor:pointer; box-shadow:0 1px 2px rgba(190,24,93,0.2);">
                    Tutup
                </button>
            </div>

        </div>
    </div>

    <script>
    (function() {
        window.openConfirmModal = function({ title, message, confirmText, onConfirm }) {
            const modal = document.getElementById('appGlobalConfirmModal');
            if (!modal) {
                if (window.confirm(message)) onConfirm();
                return;
            }
            document.getElementById('appConfirmTitle').textContent = title || 'Konfirmasi Hapus';
            document.getElementById('appConfirmMessage').textContent = message || 'Apakah Anda yakin ingin menghapus data ini?';
            const okBtn = document.getElementById('appConfirmBtnOk');
            const cancelBtn = document.getElementById('appConfirmBtnCancel');
            okBtn.textContent = confirmText || 'Ya, Hapus Data';

            modal.style.display = 'flex';

            const cleanup = () => {
                modal.style.display = 'none';
                okBtn.onclick = null;
                cancelBtn.onclick = null;
            };

            cancelBtn.onclick = cleanup;
            okBtn.onclick = () => {
                cleanup();
                if (typeof onConfirm === 'function') onConfirm();
            };
        };

        window.confirmDeleteForm = function(formId, itemName, itemType = 'data') {
            window.openConfirmModal({
                title: `Hapus ${itemType}?`,
                message: `Apakah Anda yakin ingin menghapus "${itemName}"? Tindakan ini akan menghapus data terkait secara permanen.`,
                confirmText: 'Ya, Hapus Sekarang',
                onConfirm: () => {
                    const form = document.getElementById(formId);
                    if (form) form.submit();
                }
            });
        };

        window.openLegalModal = function(tab = 'terms') {
            const modal = document.getElementById('appLegalModal');
            if (!modal) return;
            switchLegalTab(tab);
            modal.style.display = 'flex';
        };

        window.closeLegalModal = function() {
            const modal = document.getElementById('appLegalModal');
            if (modal) modal.style.display = 'none';
        };

        window.switchLegalTab = function(tabName) {
            const tabBtnTerms = document.getElementById('tabBtnTerms');
            const tabBtnPrivacy = document.getElementById('tabBtnPrivacy');
            const contentTerms = document.getElementById('legalContentTerms');
            const contentPrivacy = document.getElementById('legalContentPrivacy');
            const modalTitle = document.getElementById('legalModalTitle');

            if (tabName === 'privacy') {
                if (tabBtnPrivacy) {
                    tabBtnPrivacy.style.color = '#be185d';
                    tabBtnPrivacy.style.borderBottomColor = '#be185d';
                    tabBtnPrivacy.style.fontWeight = '700';
                }
                if (tabBtnTerms) {
                    tabBtnTerms.style.color = '#64748b';
                    tabBtnTerms.style.borderBottomColor = 'transparent';
                    tabBtnTerms.style.fontWeight = '600';
                }
                if (contentTerms) contentTerms.style.display = 'none';
                if (contentPrivacy) contentPrivacy.style.display = 'block';
                if (modalTitle) modalTitle.textContent = 'Kebijakan Privasi Siswa';
            } else {
                if (tabBtnTerms) {
                    tabBtnTerms.style.color = '#be185d';
                    tabBtnTerms.style.borderBottomColor = '#be185d';
                    tabBtnTerms.style.fontWeight = '700';
                }
                if (tabBtnPrivacy) {
                    tabBtnPrivacy.style.color = '#64748b';
                    tabBtnPrivacy.style.borderBottomColor = 'transparent';
                    tabBtnPrivacy.style.fontWeight = '600';
                }
                if (contentTerms) contentTerms.style.display = 'block';
                if (contentPrivacy) contentPrivacy.style.display = 'none';
                if (modalTitle) modalTitle.textContent = 'Syarat & Ketentuan Seleksi Beasiswa';
            }
        };

        document.getElementById('appLegalModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeLegalModal();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeLegalModal();
        });

        window.showGlobalToast = function(message, type = 'success') {
            const shelf = document.getElementById('appGlobalToastShelf');
            if (!shelf) return;

            const toast = document.createElement('div');
            toast.className = `toast-msg toast-${type}`;

            let iconSvg = '';
            if (type === 'success') {
                iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>`;
            } else if (type === 'error') {
                iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`;
            } else {
                iconSvg = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#be185d" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>`;
            }

            toast.innerHTML = `
                ${iconSvg}
                <div style="flex:1;">
                    <strong style="font-size:12px; color:#111827; display:block;">${type === 'success' ? 'Sukses' : (type === 'error' ? 'Pemberitahuan' : 'Informasi')}</strong>
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

        @if (session('sukses'))
            window.showGlobalToast("{{ session('sukses') }}", 'success');
        @endif
        @if (session('gagal'))
            window.showGlobalToast("{{ session('gagal') }}", 'error');
        @endif
    })();
    </script>

</body>
</html>