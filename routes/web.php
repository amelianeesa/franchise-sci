<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\LacakController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');

Route::get('/lacak', [LacakController::class, 'index'])->name('lacak.index');
Route::post('/lacak', [LacakController::class, 'search'])->name('lacak.search');

Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/order/buat', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
});

Route::middleware(['auth', 'role:admin_pusat,admin_cabang'])->prefix('admin')->group(function () {
});

Route::middleware(['auth', 'role:tenaga_ahli'])->prefix('mitra')->group(function () {
});