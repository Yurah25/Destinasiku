<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Models\Kategori;

class PublicController extends Controller
{
    // 1. HALAMAN UTAMA (HOME)
    public function index(Request $request)
    {
        // Ambil semua kategori untuk tombol filter
        $kategoris = Kategori::all();

        // Mulai Query Wisata
        $query = Wisata::with('kategori')->latest();

        // Logika PENCARIAN (Jika ada ketikan di kolom cari)
        if ($request->has('cari')) {
            $keyword = $request->cari;
            $query->where(function($q) use ($keyword) {
                $q->where('nama', 'like', '%' . $keyword . '%')
                  ->orWhere('lokasi', 'like', '%' . $keyword . '%');
            });
        }

        // Logika FILTER KATEGORI (Jika tombol kategori diklik)
        if ($request->has('kategori')) {
            $slugKategori = $request->kategori;
            $query->whereHas('kategori', function($q) use ($slugKategori) {
                $q->where('slug', $slugKategori);
            });
        }

        // Ambil data dengan Pagination (9 per halaman)
        $wisatas = $query->paginate(9)->withQueryString();

        return view('welcome', compact('wisatas', 'kategoris'));
    }

    // 2. HALAMAN DETAIL WISATA
    public function show($slug)
    {
        // Cari wisata berdasarkan SLUG
        $wisata = Wisata::with('kategori')->where('slug', $slug)->firstOrFail();
        
        return view('detail', compact('wisata'));
    }
}