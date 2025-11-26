<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // 1. TAMPILKAN DAFTAR KATEGORI
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    // 2. SIMPAN KATEGORI BARU
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50|unique:kategoris,nama'
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'slug' => \Illuminate\Support\Str::slug($request->nama)
        ]);

        return back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    // 3. UPDATE KATEGORI
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:50|unique:kategoris,nama,'.$id
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama' => $request->nama,
            'slug' => \Illuminate\Support\Str::slug($request->nama)
        ]);

        return back()->with('success', 'Kategori berhasil diperbarui!');
    }

    // 4. HAPUS KATEGORI
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}