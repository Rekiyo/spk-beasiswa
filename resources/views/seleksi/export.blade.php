<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keputusan Penerima Beasiswa Siswa SMK - {{ $periode->nama }}</title>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; background: #fff; }
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #111;
            background: #f8fafc;
            padding: 30px;
            margin: 0;
            line-height: 1.5;
        }
        .paper {
            max-width: 860px;
            margin: 0 auto;
            background: #fff;
            padding: 48px;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 14px;
            margin-bottom: 24px;
        }
        .header h2 { margin: 0; font-size: 16px; text-transform: uppercase; letter-spacing: 0.5px; }
        .header h1 { margin: 3px 0; font-size: 19px; font-weight: bold; text-transform: uppercase; }
        .header h3 { margin: 2px 0; font-size: 14px; font-weight: normal; }
        .header p { margin: 2px 0; font-size: 11px; font-style: italic; color: #444; }
        .sk-title {
            text-align: center;
            margin: 24px 0 20px;
        }
        .sk-title strong {
            display: block;
            font-size: 15px;
            text-decoration: underline;
            text-transform: uppercase;
        }
        .sk-title span { font-size: 12px; }
        .content-text { font-size: 13px; text-align: justify; margin-bottom: 16px; text-indent: 30px; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            margin: 18px 0;
        }
        th, td {
            border: 1px solid #333;
            padding: 7px 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .signatures {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            font-size: 13px;
        }
        .sig-box {
            text-align: center;
            width: 260px;
        }
        .sig-space { height: 70px; }
        .btn-print {
            background: #be185d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 6px;
            font-family: sans-serif;
            font-size: 13px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="no-print" style="max-width: 860px; margin: 0 auto 20px; display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ route('periode.seleksi', $periode) }}" style="color: #be185d; font-family: sans-serif; text-decoration: none; font-weight: bold; font-size: 13px;">
            ← Kembali ke Kelola Seleksi
        </a>
        <button onclick="window.print()" class="btn-print">
            Cetak / Simpan PDF
        </button>
    </div>

    <div class="paper">
        <div class="header">
            <h2>PEMERINTAH DAERAH PROVINSI • DINAS PENDIDIKAN</h2>
            <h1>SMK NEGERI 1 PRESTASI</h1>
            <h3>PANITIA PENETAPAN BEASISWA PRESTASI SISWA</h3>
            <p>Jalan Pendidikan Kejuruan No. 45, Surel: kesiswaan@smk-prestasi.sch.id | Telp: (021) 87654321</p>
        </div>

        <div class="sk-title">
            <strong>SURAT KEPUTUSAN KEPALA SEKOLAH MENENGAH KEJURUAN</strong>
            <span>Nomor: 421.5/088/SMK-PRST/SK-BEASISWA/{{ $periode->tahun }}</span>
        </div>

        <p class="content-text">
            Berdasarkan hasil seleksi Sistem Pendukung Keputusan (SPK) menggunakan metode <em>Simple Additive Weighting</em> (SAW) berbobot <em>Analytical Hierarchy Process</em> (AHP) dengan rasio konsistensi CR = {{ number_format($periode->cr ?? 0.038, 3) }} (&lt; 0.10) yang telah divalidasi oleh Tim Kesiswaan, dengan ini Kepala Sekolah menetapkan daftar siswa berprestasi penerima Beasiswa Prestasi SMK untuk <strong>{{ $periode->nama }}</strong> dengan alokasi kuota sebanyak <strong>{{ $periode->kuota }} siswa</strong> sebagai berikut:
        </p>

        <table>
            <thead>
                <tr>
                    <th style="width: 40px;">No</th>
                    <th style="width: 100px;">NISN</th>
                    <th>Nama Siswa</th>
                    <th>Konsentrasi Keahlian / Jurusan</th>
                    <th>Kelas</th>
                    <th style="width: 70px;">Skor V_i</th>
                    <th style="width: 110px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lolosCalon as $c)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $c->nim }}</td>
                        <td><strong>{{ $c->nama }}</strong></td>
                        <td>{{ $c->program_studi }}</td>
                        <td class="text-center">{{ $c->semester }}</td>
                        <td class="text-center">{{ number_format($c->skor_saw, 3) }}</td>
                        <td class="text-center" style="font-weight: bold; color: #047857;">Lolos Penerima</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada siswa berstatus lolos seleksi kuota.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if ($cadanganCalon->isNotEmpty())
            <h4 style="margin: 20px 0 6px 0; font-size: 13px;">Daftar Siswa Cadangan Terpilih:</h4>
            <table>
                <thead>
                    <tr>
                        <th style="width: 40px;">No</th>
                        <th style="width: 100px;">NISN</th>
                        <th>Nama Siswa</th>
                        <th>Konsentrasi Keahlian / Jurusan</th>
                        <th>Kelas</th>
                        <th style="width: 70px;">Skor V_i</th>
                        <th style="width: 110px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cadanganCalon->take(5) as $cd)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $cd->nim }}</td>
                            <td>{{ $cd->nama }}</td>
                            <td>{{ $cd->program_studi }}</td>
                            <td class="text-center">{{ $cd->semester }}</td>
                            <td class="text-center">{{ number_format($cd->skor_saw, 3) }}</td>
                            <td class="text-center" style="color: #b45309;">Cadangan</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <p class="content-text" style="margin-top: 20px;">
            Surat Keputusan ini mulai berlaku sejak tanggal ditetapkan. Apabila terdapat siswa penerima yang mengundurkan diri atau tidak memenuhi ketentuan administrasi sekolah, alokasi beasiswa akan dialihkan kepada siswa peringkat cadangan sesuai urutan perangkingan.
        </p>

        <div class="signatures">
            <div class="sig-box">
                <p>Mengetahui,<br>Wakil Kepala Sekolah Bidang Kesiswaan,</p>
                <div class="sig-space"></div>
                <strong>Drs. H. Mulyadi, M.Pd.</strong>
                <p style="margin:0; font-size:11px;">NIP. 19720514 199803 1 004</p>
            </div>
            <div class="sig-box">
                <p>Ditetapkan di: Sekolah<br>Pada tanggal: {{ now()->translatedFormat('d F Y') }}<br>Kepala SMK Negeri 1 Prestasi,</p>
                <div class="sig-space"></div>
                <strong>Dr. Hj. Sri Wahyuni, M.Pd.</strong>
                <p style="margin:0; font-size:11px;">NIP. 19680320 199303 2 003</p>
            </div>
        </div>
    </div>

</body>
</html>
