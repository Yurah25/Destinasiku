<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // KITA HARUS MENAMBAHKAN INI
    // Ini memberi izin agar kolom 'nama' dan 'slug' bisa diisi otomatis
    protected $fillable = [
        'nama', 
        'slug'
    ];
}