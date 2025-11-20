<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Tambah route dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Tambah route pendaftaran
Route::get('/pendaftaran', function () {
    return view('pendaftaran');
})->name('pendaftaran');
