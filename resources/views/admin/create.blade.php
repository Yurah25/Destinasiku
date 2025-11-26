<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wisata - DestinasiKu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        /* CSS GAYA TRAVELOKA */
        :root {
            --primary-blue: #1ba0e2;
            --bg-gray: #f2f3f3;
            --text-dark: #35405a;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--bg-gray);
            margin: 0;
            padding: 40px;
            color: var(--text-dark);
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .header-title {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 20px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: #687176;
        }

        input[type="text"], 
        input[type="number"], 
        textarea, 
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box; /* Agar padding tidak melebarkan elemen */
            font-family: inherit;
        }

        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary-blue);
        }

        .btn-group {
            margin-top: 30px;
            display: flex;
            gap: 10px;
        }

        .btn-save {
            background-color: var(--primary-blue);
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-back {
            background-color: #fff;
            color: #687176;
            border: 1px solid var(--border-color);
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            display: inline-block;
        }

        .error-text {
            color: #d63031;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="header-title">Tambah Data Wisata Baru</h2>

        <form action="{{ route('dashboard.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Nama Tempat Wisata</label>
                <input type="text" name="nama" placeholder="Contoh: Curug Bayan" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Lokasi / Alamat</label>
                <input type="text" name="lokasi" placeholder="Contoh: Desa Ketenger, Baturraden" required>
            </div>

            <div class="form-group">
                <label>Harga Tiket (Rp)</label>
                <input type="number" name="harga_tiket" placeholder="Contoh: 15000" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Lengkap</label>
                <textarea name="deskripsi" rows="5" placeholder="Jelaskan detail wisata..." required></textarea>
            </div>

            <div class="form-group">
                <label>Foto Utama (Opsional)</label>
                <input type="file" name="gambar" accept="image/*">
                <p style="font-size:12px; color:#999; margin-top:5px;">Format: JPG, PNG. Maks: 2MB.</p>
            </div>

            <div class="btn-group">
                <a href="{{ route('dashboard') }}" class="btn-back">Batal</a>
                <button type="submit" class="btn-save">Sismpan Data</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>