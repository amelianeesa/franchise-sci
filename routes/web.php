<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\PusatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LacakController;
use App\Http\Controllers\KelolaTenagaAhliController;
use App\Http\Controllers\KeuanganController;

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
    Route::get('/dashboard', [PusatController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/order_masuk', [PusatController::class, 'orderMasuk'])->name('admin.order_masuk');
    Route::post('/orders/{id}/approve', [PusatController::class, 'approve'])->name('admin.orders.approve');
    Route::post('/orders/{id}/reject', [PusatController::class, 'reject'])->name('admin.orders.reject');

    // CRUD Manajemen Layanan / Produk oleh Admin
    Route::get('/products', [ProductController::class, 'index'])->name('admin.product_index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.product_create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.product_store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.product_edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.product_update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.product_destroy');

    // Kelola Kategori
    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.category_index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.category_create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.category_store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category_edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.category_update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.category_destroy');

    // tenaga ahli
    Route::get('/tenaga-ahli', [KelolaTenagaAhliController::class, 'index'])->name('admin.ta_index');
    Route::post('/tenaga-ahli', [KelolaTenagaAhliController::class, 'store'])->name('admin.ta_store');
    Route::put('/tenaga-ahli/{user}', [KelolaTenagaAhliController::class, 'update'])->name('admin.ta_update');
    Route::put('/tenaga-ahli/{user}/reset-password', [KelolaTenagaAhliController::class, 'resetPassword'])->name('admin.ta_reset_password');

    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('admin.keuangan_index');
    Route::post('/keuangan/va', [KeuanganController::class, 'storeVA'])->name('admin.va_store');
    Route::put('/keuangan/va/{id}', [KeuanganController::class, 'updateVA'])->name('admin.va_update');
    Route::delete('/keuangan/va/{id}', [KeuanganController::class, 'destroyVA'])->name('admin.va_destroy');
});

Route::middleware(['auth', 'role:tenaga_ahli'])->prefix('mitra')->group(function () {
});