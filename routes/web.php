<?php

// Bagian ini memanggil controller aktivitas untuk setiap alamat halaman.
// Alamat utama membuka daftar aktivitas, sedangkan alamat latihan memilih aktivitas lewat slug.
use App\Http\Controllers\AktivitasController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AktivitasController::class, 'index'])->name('home');
Route::get('/latihan/{slug}', [AktivitasController::class, 'show'])->name('latihan');
