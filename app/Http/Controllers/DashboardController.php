<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage; 

class DashboardController extends Controller
{
    // 1. MENAMPILKAN DASHBOARD UTAMA
    public function index()
    {
        $wisatas = Wisata::with('kategori')->latest()->get();
        return view('admin.dashboard', compact('wisatas'));
    }

    // 2. MENAMPILKAN FORM TAMBAH DATA (CREATE)
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.create', compact('kategoris'));
    }

    // 3. MEMPROSES PENYIMPANAN DATA (STORE)
    public function store(Request $request)
    {
        // A. Validasi Input
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'harga_tiket' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // B. Proses Upload Gambar
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('wisata-images', 'public');
        }

        // C. Simpan ke Database
        Wisata::create([
            'nama' => $request->nama,
            'slug' => \Illuminate\Support\Str::slug($request->nama),
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'harga_tiket' => $request->harga_tiket,
            'gambar' => $gambarPath,
            // --- PERBAIKAN DI SINI (TANPA IMPORT) ---
            // Kita panggil alamat lengkapnya langsung:
            'user_id' => \Illuminate\Support\Facades\Auth::id(), 
        ]);

        // D. Kembali ke Dashboard
        return redirect()->route('dashboard')->with('success', 'Data Wisata berhasil ditambahkan!');
    }
}