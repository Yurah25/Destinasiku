<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DestinasiKu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* --- CSS RESET & VARIABLES (GAYA TRAVELOKA) --- */
        :root {
            --primary-blue: #1ba0e2;    /* Biru Utama */
            --dark-blue: #0770cd;       /* Biru Sidebar */
            --bg-gray: #f2f3f3;         /* Background Halaman */
            --text-dark: #35405a;
            --white: #ffffff;
            --success: #17a05d;         /* Warna Tombol Tambah */
            --danger: #ff5e1f;          /* Warna Tombol Hapus */
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-gray);
            margin: 0;
            display: flex; /* Layout Kiri (Sidebar) & Kanan (Konten) */
            height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 250px;
            background-color: var(--dark-blue);
            color: var(--white);
            display: flex;
            flex-direction: column;
            padding: 20px;
            flex-shrink: 0;
        }

        .brand {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
            padding-bottom: 20px;
        }

        .menu-item {
            padding: 12px 15px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 5px;
            transition: 0.3s;
            display: block;
        }

        .menu-item:hover, .menu-item.active {
            background-color: rgba(255,255,255,0.1);
            color: var(--white);
            font-weight: 500;
        }

        .logout-form {
            margin-top: auto; /* Dorong ke paling bawah */
        }

        .btn-logout {
            background: none;
            border: 1px solid rgba(255,255,255,0.3);
            color: var(--white);
            width: 100%;
            padding: 10px;
            cursor: pointer;
            border-radius: 6px;
        }

        .btn-logout:hover {
            background: rgba(255,0,0,0.5);
        }

        /* --- MAIN CONTENT --- */
        .content {
            flex: 1;
            padding: 30px;
            overflow-y: auto; /* Agar bisa discroll jika data banyak */
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .page-title {
            color: var(--text-dark);
            font-size: 24px;
            margin: 0;
        }

        .btn-add {
            background-color: var(--primary-blue);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(27, 160, 226, 0.4);
        }

        /* --- TABEL DATA --- */
        .card {
            background: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            text-align: left;
            padding: 15px;
            background-color: #f7f9fa;
            color: var(--text-dark);
            border-bottom: 2px solid #eee;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            color: #555;
        }

        /* Label Kategori */
        .badge {
            background: #e1f5fe;
            color: var(--primary-blue);
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        /* Tombol Aksi */
        .btn-action {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 12px;
            margin-right: 5px;
            display: inline-block;
        }

        .btn-edit { background: #fff3e0; color: #f57f17; }
        .btn-delete { background: #ffebee; color: #c62828; border: none; cursor: pointer; }

        /* Pesan Kosong */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand">DestinasiKu</div>
        
        <a href="#" class="menu-item active">Dashboard Wisata</a>
        <a href="{{ route('kategori.index') }}" class="menu-item">Kelola Kategori</a>

        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>

    <div class="content">
        <div class="header-content">
            <h1 class="page-title">Daftar Tempat Wisata</h1>
            <a href="{{ route('dashboard.create') }}" class="btn-add">+ Tambah Data</a>
        </div>

        <div class="card">
            @if(session('success'))
    <div style="background: #e3f2fd; color: #1565c0; padding: 15px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #bbdefb;">
        {{ session('success') }}
    </div>
@endif
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Gambar</th>
                        <th width="25%">Nama Wisata</th>
                        <th width="15%">Kategori</th>
                        <th width="20%">Lokasi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wisatas as $wisata)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if($wisata->gambar)
                                <img src="{{ asset('storage/'.$wisata->gambar) }}" width="80" style="border-radius:4px;">
                            @else
                                <span style="font-size:11px; color:#999;">No Image</span>
                            @endif
                        </td>
                        <td style="font-weight: 500; color: var(--text-dark);">
                            {{ $wisata->nama }}
                            <br>
                            <small style="color:#999;">Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</small>
                        </td>
                        <td><span class="badge">{{ $wisata->kategori->nama }}</span></td>
                        <td>{{ $wisata->lokasi }}</td>
                       <td>
    <a href="{{ route('dashboard.edit', $wisata->id) }}" class="btn-action btn-edit">Edit</a>
    
    <form action="{{ route('dashboard.destroy', $wisata->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-action btn-delete">Hapus</button>
    </form>
</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="empty-state">
                            Belum ada data wisata. Silakan tambah data baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>