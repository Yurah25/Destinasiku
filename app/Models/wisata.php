<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    // 1. IZINKAN KOLOM INI DIISI (Agar tidak error saat CREATE nanti)
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'lokasi',
        'harga_tiket',
        'gambar',
        'kategori_id', // Penting: ID penghubung ke tabel kategori
        'user_id'      // Penting: Siapa admin yang input
    ];

    // 2. DEFINISI RELASI (Agar perintah 'with' di Controller berfungsi)
    // "Setiap Wisata DIMILIKI OLEH satu Kategori"
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // "Setiap Wisata DIINPUT OLEH satu User/Admin"
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}