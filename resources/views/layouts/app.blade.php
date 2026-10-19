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
                Periode
            </a>
        </nav>

        <div class="app-header__user" id="userDropdownToggle" style="cursor:pointer; position:relative;">
            <div>
                <strong>{{ Auth::user()->name }}</strong>
                <small>{{ Auth::user()->email }}</small>
            </div>

            <div class="app-header__avatar">
                <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>

            <span class="app-header__chevron">⌄</span>

            {{-- Dropdown Menu --}}
            <div id="userDropdownMenu" style="
                display: none;
                position: absolute;
                top: calc(100% + 10px);
                right: 0;
                min-width: 180px;
                background: #ffffff;
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.12);
                overflow: hidden;
                z-index: 999;
                animation: dropdownIn 0.15s ease;
            ">
                <div style="padding: 12px 14px; border-bottom: 1px solid #f3f4f6;">
                    <div style="font-size: 12px; font-weight: 700; color: #111827;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 10px; color: #667085; margin-top: 2px;">{{ Auth::user()->email }}</div>
                </div>
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" style="
                        width: 100%;
                        padding: 11px 14px;
                        display: flex;
                        align-items: center;
                        gap: 9px;
                        background: none;
                        border: none;
                        cursor: pointer;
                        font-size: 12px;
                        font-weight: 600;
                        color: #ef4444;
                        font-family: inherit;
                        transition: background 0.15s;
                        text-align: left;
                    " onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='none'">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>

        <style>
            @keyframes dropdownIn {
                from { opacity: 0; transform: translateY(-6px); }
                to   { opacity: 1; transform: translateY(0); }
            }
        </style>

        <script>
        (function () {
            const toggle = document.getElementById('userDropdownToggle');
            const menu   = document.getElementById('userDropdownMenu');
            if (!toggle || !menu) return;

            toggle.addEventListener('click', function (e) {
                e.stopPropagation();
                menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
            });

            document.addEventListener('click', function () {
                menu.style.display = 'none';
            });
        })();
        </script>
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
                <a href="#">Kebijakan Privasi</a>
                <span>•</span>
                <a href="#">Syarat & Ketentuan</a>
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