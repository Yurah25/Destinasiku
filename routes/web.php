<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PublicController; // <--- PENTING: Import ini

// --- 1. HALAMAN PENGUNJUNG (PUBLIC) ---

Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/wisata/{slug}', [PublicController::class, 'show'])->name('detail');

// --- 2. ROUTE LOGIN & DASHBOARD (BIARKAN SEPERTI SEBELUMNYA) ---
// (Jangan ubah kode Login/Dashboard/Kategori yang ada di bawah ini)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Route Dashboard...
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/delete/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
    
    // Route Kategori...
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});
