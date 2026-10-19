<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login ke Sistem Pendukung Keputusan Beasiswa Prestasi Siswa SMK.">
    <title>Masuk — SPK Beasiswa Prestasi</title>
    @vite(['resources/css/app.css', 'resources/css/login.css'])
</head>
<body>

    <div class="login-bg">
        <div class="login-bg__orb login-bg__orb--1"></div>
        <div class="login-bg__orb login-bg__orb--2"></div>
        <div class="login-bg__orb login-bg__orb--3"></div>
    </div>

    <div class="login-wrapper">
        <div class="login-card">

            {{-- Header --}}
            <div class="login-header">
                <div class="login-logo">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 10v6M2 10l10-5 10 5-10 5z"/>
                        <path d="M6 12v5c3 3 9 3 12 0v-5"/>
                    </svg>
                </div>
                <h1 class="login-title">SPK Beasiswa Prestasi</h1>
                <p class="login-subtitle">Sistem Pendukung Keputusan Seleksi Beasiswa Siswa SMK<br>Masuk untuk melanjutkan</p>
            </div>

            {{-- Error alert --}}
            @if ($errors->any())
                <div class="login-alert" style="margin-bottom: 16px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="12"/>
                        <line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    {{ $errors->first('email') }}
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('login.post') }}" class="login-form" id="loginForm">
                @csrf

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="form-input-wrap">
                        <span class="form-input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </span>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            value="{{ old('email') }}"
                            placeholder="admin@spk.test"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="form-input-wrap">
                        <span class="form-input-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </span>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            placeholder="••••••••"
                            required
                            autocomplete="current-password"
                        >
                    </div>
                </div>

                {{-- Remember --}}
                <div class="login-remember">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat sesi login saya</label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-login" id="btnLogin">
                    Masuk ke Sistem
                </button>
            </form>

            {{-- Footer --}}
            <p class="login-footer">
                SPK Beasiswa Prestasi Siswa SMK &copy; {{ date('Y') }}<br>
                Hanya untuk Panitia Beasiswa &amp; Administrator
            </p>

        </div>
    </div>

    <script>
        // Disable tombol saat submit untuk mencegah double-click
        document.getElementById('loginForm').addEventListener('submit', function () {
            const btn = document.getElementById('btnLogin');
            btn.disabled = true;
            btn.textContent = 'Memproses...';
        });
    </script>

</body>
</html>
