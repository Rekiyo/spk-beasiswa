<?php

use App\Http\Controllers\PeriodeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;

Route::get('/', fn () => redirect()->route('periode.index'));
Route::resource('periode', PeriodeController::class)->except(['show']);
Route::get('periode/{periode}/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
Route::get('periode/{periode}/kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
Route::post('periode/{periode}/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
Route::delete('periode/{periode}/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');

