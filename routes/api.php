<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\LaporanApiController;
use App\Http\Controllers\Api\ProfileApiController;

// Tidak perlu login
Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/register', [AuthApiController::class, 'register']);

// Daftar jalan juga bisa diakses tanpa login
Route::get('/jalan', [LaporanApiController::class, 'jalan']);

// Harus login
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthApiController::class, 'logout']);

    Route::get('/laporan', [LaporanApiController::class, 'index']);
    Route::post('/laporan', [LaporanApiController::class, 'store']);
    Route::get('/riwayat', [LaporanApiController::class, 'riwayat']);

    Route::get('/profile', [ProfileApiController::class, 'profile']);
    Route::put('/profile', [ProfileApiController::class, 'update']);

});