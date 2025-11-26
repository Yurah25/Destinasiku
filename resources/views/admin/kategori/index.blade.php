<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - DestinasiKu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan style dasar yang sama */
        :root { --primary-blue: #1ba0e2; --dark-blue: #0770cd; --bg-gray: #f2f3f3; --text-dark: #35405a; --white: #ffffff; }
        body { font-family: 'Roboto', sans-serif; background-color: var(--bg-gray); margin: 0; display: flex; height: 100vh; }
        
        /* Sidebar (Kita copy style sidebar agar konsisten) */
        .sidebar { width: 250px; background-color: var(--dark-blue); color: var(--white); padding: 20px; display: flex; flex-direction: column; }
        .brand { font-size: 24px; font-weight: 700; margin-bottom: 40px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 20px; }
        .menu-item { padding: 12px 15px; color: rgba(255,255,255,0.8); text-decoration: none; border-radius: 6px; margin-bottom: 5px; display: block; }
        .menu-item:hover, .menu-item.active { background-color: rgba(255,255,255,0.1); color: var(--white); }
        
        /* Content */
        .content { flex: 1; padding: 30px; overflow-y: auto; }
        .card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 20px; }
        
        /* Form & Table */
        h2 { margin-top: 0; color: var(--text-dark); }
        .form-inline { display: flex; gap: 10px; margin-bottom: 20px; }
        input[type="text"] { flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; font-weight: 700; color: white; }
        .btn-add { background: var(--primary-blue); }
        .btn-del { background: #ff5e1f; font-size: 12px; padding: 5px 10px; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #eee; }
        th { background: #f9f9f9; }
        
        /* Alert */
        .alert { background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .error { color: red; font-size: 12px; margin-top: 5px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">DestinasiKu</div>
        <a href="{{ route('dashboard') }}" class="menu-item">Dashboard Wisata</a>
        <a href="{{ route('kategori.index') }}" class="menu-item active">Kelola Kategori</a>
        
        <form action="{{ route('logout') }}" method="POST" style="margin-top:auto;">
            @csrf
            <button type="submit" style="background:transparent; border:1px solid #fff; width:100%;">Logout</button>
        </form>
    </div>

    <div class="content">
        
        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <div class="card">
            <h2>Tambah Kategori Baru</h2>
            <form action="{{ route('kategori.store') }}" method="POST" class="form-inline">
                @csrf
                <input type="text" name="nama" placeholder="Masukkan nama kategori (Misal: Wisata Belanja)" required>
                <button type="submit" class="btn-add">Simpan</button>
            </form>
            @error('nama') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="card">
            <h2>Daftar Kategori</h2>
            <table>
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama Kategori</th>
                        <th>Slug (URL)</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategoris as $cat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <form action="{{ route('kategori.update', $cat->id) }}" method="POST" style="display:flex; gap:5px;">
                                @csrf @method('PUT')
                                <input type="text" name="nama" value="{{ $cat->nama }}" style="padding:5px; font-size:12px;">
                                <button type="submit" style="background:#f57f17; padding:5px 10px; font-size:10px;">Update</button>
                            </form>
                        </td>
                        <td>{{ $cat->slug }}</td>
                        <td>
                            <form action="{{ route('kategori.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini? Data wisata di dalamnya akan ikut terhapus!');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-del">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>