<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // <--- PERBAIKAN 1: Wajib Import ini

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
            'user_id' => Auth::id(), // <--- PERBAIKAN 2: Gunakan Auth::id()
        ]);

        // D. Kembali ke Dashboard
        return redirect()->route('dashboard')->with('success', 'Data Wisata berhasil ditambahkan!');
    }
    // 4. MENAMPILKAN FORM EDIT
    public function edit($id)
    {
        $wisata = Wisata::findOrFail($id); // Cari data, error jika tidak ketemu
        $kategoris = Kategori::all();      // Ambil kategori untuk dropdown
        return view('admin.edit', compact('wisata', 'kategoris'));
    }

    // 5. PROSES UPDATE DATA
    public function update(Request $request, $id)
    {
        // Validasi (Gambar boleh kosong saat edit)
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required',
            'lokasi' => 'required',
            'harga_tiket' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $wisata = Wisata::findOrFail($id);

        // Cek jika ada gambar baru diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($wisata->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($wisata->gambar)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($wisata->gambar);
            }
            // Simpan gambar baru
            $gambarPath = $request->file('gambar')->store('wisata-images', 'public');
            $wisata->gambar = $gambarPath; // Update path gambar
        }

        // Update data text
        $wisata->update([
            'nama' => $request->nama,
            'slug' => \Illuminate\Support\Str::slug($request->nama),
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'lokasi' => $request->lokasi,
            'harga_tiket' => $request->harga_tiket,
            // Gambar otomatis tersimpan jika ada perubahan di atas
        ]);

        return redirect()->route('dashboard')->with('success', 'Data Wisata berhasil diperbarui!');
    }

    // 6. PROSES HAPUS DATA
    public function destroy($id)
    {
        $wisata = Wisata::findOrFail($id);

        // Hapus gambar fisik di penyimpanan
        if ($wisata->gambar && \Illuminate\Support\Facades\Storage::disk('public')->exists($wisata->gambar)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($wisata->gambar);
        }

        // Hapus data di database
        $wisata->delete();

        return redirect()->route('dashboard')->with('success', 'Data Wisata berhasil dihapus!');
    }
}