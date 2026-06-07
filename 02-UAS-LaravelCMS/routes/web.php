<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\KategoriArtikelController;

use App\Http\Controllers\PublicController;

// Route Halaman Pengunjung Publik
Route::get('/', [PublicController::class, 'index'])->name('public.index');
Route::get('/artikel/kategori/{id}', [PublicController::class, 'kategori'])->name('public.kategori');
Route::get('/artikel/{id}', [PublicController::class, 'show'])->name('public.show')->where('id', '[0-9]+');

// Route untuk halaman login (hanya guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'proses'])->name('login.proses');
});

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

// Route yang dilindungi middleware auth
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Resource (tanpa show)
    Route::resource('artikel', ArtikelController::class)->except(['show']);
    Route::resource('penulis', PenulisController::class)->except(['show']);
    Route::resource('kategori', KategoriArtikelController::class)->except(['show']);
});
