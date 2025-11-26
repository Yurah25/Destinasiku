<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// --- PERUBAHAN UTAMA DISINI ---
// Karena 'welcome.blade.php' sudah dihapus, 
// kita arahkan halaman utama ('/') langsung ke halaman login.
Route::redirect('/', '/login');

// --- ROUTE LOGIN ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- ROUTE DASHBOARD ---
Route::middleware(['auth'])->group(function () {

    // 1. Halaman Utama Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // 2. Menampilkan Form Tambah (Baru)
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    
    // 3. Proses Simpan Data (Baru)
    Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('dashboard.store');

    // ... dalam group middleware auth ...
    // --- TAMBAHAN BARU UNTUK EDIT & DELETE ---
    Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/delete/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
});

