<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonfigurasiSeleksiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\SeleksiController;
use App\Http\Controllers\SubKriteriaController;
use Illuminate\Support\Facades\Route;

// Redirect root ke dashboard
Route::get('/', fn () => redirect()->route('dashboard'));

// Dashboard Utama
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Manajemen Paket Konfigurasi Seleksi
Route::resource('konfigurasi', KonfigurasiSeleksiController::class);
Route::post('konfigurasi/hitung-ahp', [KonfigurasiSeleksiController::class, 'hitungAhp'])
    ->name('konfigurasi.hitung-ahp');
Route::post('konfigurasi/{konfigurasi}/duplikat', [KonfigurasiSeleksiController::class, 'duplikat'])
    ->name('konfigurasi.duplikat');

// Manajemen Periode Seleksi
Route::resource('periode', PeriodeController::class)
    ->except(['show']);

// Finalisasi Periode
Route::post('periode/{periode}/finalisasi', [PeriodeController::class, 'finalisasi'])
    ->name('periode.finalisasi');

// API Perhitungan AHP Real-time (kompatibilitas)
Route::post('periode/hitung-ahp', [PeriodeController::class, 'hitungAhp'])
    ->name('periode.hitung-ahp');

// Kelola Seleksi & Perangkingan SAW
Route::get('periode/{periode}/seleksi', [SeleksiController::class, 'index'])
    ->name('periode.seleksi');

Route::post('periode/{periode}/seleksi', [SeleksiController::class, 'store'])
    ->name('periode.seleksi.store');

Route::post('periode/{periode}/seleksi/import', [SeleksiController::class, 'import'])
    ->name('periode.seleksi.import');

Route::get('periode/{periode}/seleksi/template-csv', [SeleksiController::class, 'templateCsv'])
    ->name('periode.seleksi.template');

Route::delete('periode/{periode}/seleksi/{calonPenerima}', [SeleksiController::class, 'destroy'])
    ->name('periode.seleksi.destroy');

Route::get('periode/{periode}/export-sk', [SeleksiController::class, 'exportSk'])
    ->name('periode.seleksi.export');

// Route Kriteria (kompatibilitas & pengelolaan kriteria)
Route::get('periode/{periode}/kriteria', [SeleksiController::class, 'index'])
    ->name('kriteria.index');

Route::get('periode/{periode}/kriteria/create', [KriteriaController::class, 'create'])
    ->name('kriteria.create');

Route::post('periode/{periode}/kriteria', [KriteriaController::class, 'store'])
    ->name('kriteria.store');

Route::delete('periode/{periode}/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])
    ->name('kriteria.destroy');

// Sub-kriteria
Route::get('periode/{periode}/kriteria/{kriteria}/sub-kriteria', [SubKriteriaController::class, 'index'])
    ->name('sub-kriteria.index');

Route::get('periode/{periode}/kriteria/{kriteria}/sub-kriteria/create', [SubKriteriaController::class, 'create'])
    ->name('sub-kriteria.create');

Route::post('periode/{periode}/kriteria/{kriteria}/sub-kriteria', [SubKriteriaController::class, 'store'])
    ->name('sub-kriteria.store');

Route::delete('periode/{periode}/kriteria/{kriteria}/sub-kriteria/{subKriteria}', [SubKriteriaController::class, 'destroy'])
    ->name('sub-kriteria.destroy');
