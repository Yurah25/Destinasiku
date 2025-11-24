<?php

namespace Database\Seeders;

use App\Models\User;     // Wajib import Model User
use App\Models\Kategori; // Wajib import Model Kategori
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Untuk enkripsi password
use Illuminate\Support\Str; // Untuk membuat slug

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN (Otomatis)
        User::create([
            'name' => 'MinDes',
            'email' => 'mindes2025@destinasiku.com',
            'password' => Hash::make('mindes24112025'), // Password aman (terenkripsi)
        ]);

        // 2. BUAT KATEGORI WISATA (Revisi)
        // Kita hapus Religi, ganti dengan yang lebih "Liburan" banget
        $categories = [
            'Wisata Alam',      // (Gunung, Air Terjun)
            'Wisata Bahari',    // (Pantai, Laut) - Pengganti yang cocok
            'Wisata Kuliner',   // (Makanan Khas)
            'Wisata Edukasi',   // (Museum, Taman Pintar)
            'Taman Hiburan',    // (Waterpark, Dufan-nya Purbalingga)
            'Spot Foto'         // (Tempat Instagramable)
        ];
        
        foreach ($categories as $cat) {
            Kategori::create([
                'nama' => $cat,
                'slug' => Str::slug($cat) // Contoh: "Wisata Bahari" -> "wisata-bahari"
            ]);
        }
    }
}