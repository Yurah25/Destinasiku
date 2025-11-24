<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata; // Import Model Wisata agar bisa ambil data

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil semua data wisata dari database
        // 'with' digunakan untuk mengambil nama kategori sekaligus (optimasi query)
        $wisatas = Wisata::with('kategori')->latest()->get();

        // 2. Kirim data tersebut ke View 'admin.dashboard'
        return view('admin.dashboard', compact('wisatas'));
    }
}