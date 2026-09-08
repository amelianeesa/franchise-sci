<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\PusatController;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');

// Role: Pelanggan (punya kamu)
Route::middleware(['auth', 'role:pelanggan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/order/buat', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.show');
});

// Role: Admin (dikerjakan Anggota 2) — sengaja disiapkan di sini biar
// tidak bentrok saat tim gabungkan branch nanti
Route::middleware(['auth', 'role:admin_pusat,admin_cabang'])->prefix('admin')->group(function () {
    Route::get('/order-masuk', [PusatController::class, 'orderMasuk'])->name('admin.order-masuk');
    Route::post('/orders/{id}/approve', [PusatController::class, 'approve'])->name('admin.orders.approve');
    Route::post('/orders/{id}/reject', [PusatController::class, 'reject'])->name('admin.orders.reject');
});

// Role: Tenaga Ahli (dikerjakan Anggota 3)
Route::middleware(['auth', 'role:tenaga_ahli'])->prefix('mitra')->group(function () {
});