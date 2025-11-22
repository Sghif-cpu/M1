<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\KasirController;

Route::get('/', function () {
    return view('welcome');
});

// Tambah route dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Tambah route pendaftaran
Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');

// Tambah route laboratorium
Route::get('/laboratorium', [LaboratoriumController::class, 'index'])->name('laboratorium.index');
Route::get('/laboratorium/data', [LaboratoriumController::class, 'getData'])->name('laboratorium.data');
Route::get('/laboratorium/export', [LaboratoriumController::class, 'exportExcel'])->name('laboratorium.export');

// Tambah route kasir
Route::get('/kasir', [KasirController::class, 'index'])->name('kasir.index');
Route::post('/kasir', [KasirController::class, 'store'])->name('kasir.store');