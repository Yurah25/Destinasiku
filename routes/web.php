<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// --- PERUBAHAN UTAMA DISINI ---
// Karena 'welcome.blade.php' sudah dihapus, 
// kita arahkan halaman utama ('/') langsung ke halaman login.
Route::redirect('/', '/login');

// --- ROUTE LOGIN ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- ROUTE DASHBOARD ---
use App\Http\Controllers\DashboardController; // <--- Tambahkan Baris Ini di paling atas file

Route::middleware(['auth'])->group(function () {
    // Arahkan ke DashboardController class index
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
