<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;

Route::get('/', [PageController::class, 'landing'])->name('landing');
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PageController::class, 'postKontak'])->name('kontak.post');
Route::get('/lihat', [PageController::class, 'lihat'])->name('lihat');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);
});

Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'processLogin']);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/lapor', [PageController::class, 'lapor'])->name('lapor');
    Route::post('/lapor', [PageController::class, 'postLapor']);
    
    Route::get('/pengaturan', [PageController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/pengaturan', [PageController::class, 'updatePengaturan']);
    
    Route::get('/riwayat', [PageController::class, 'riwayat'])->name('riwayat');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::post('/verifikasi', [AdminController::class, 'postVerifikasi']);
    Route::post('/jalan', [AdminController::class, 'postJalan']);
    Route::delete('/jalan', [AdminController::class, 'deleteJalan']);
    Route::delete('/laporan', [AdminController::class, 'deleteLaporan']);
    Route::delete('/contact', [AdminController::class, 'deleteContact']);
});
