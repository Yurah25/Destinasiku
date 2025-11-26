<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Wisata - DestinasiKu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan style yang sama dengan create.blade.php */
        :root { --primary-blue: #1ba0e2; --bg-gray: #f2f3f3; --text-dark: #35405a; --border-color: #e0e0e0; }
        body { font-family: 'Roboto', sans-serif; background-color: var(--bg-gray); margin: 0; padding: 40px; color: var(--text-dark); }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
        .header-title { margin-top: 0; margin-bottom: 20px; font-size: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 500; font-size: 14px; color: #687176; }
        input[type="text"], input[type="number"], textarea, select { width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 4px; font-size: 14px; box-sizing: border-box; }
        .btn-group { margin-top: 30px; display: flex; gap: 10px; }
        .btn-save { background-color: #f57f17; color: white; padding: 10px 25px; border: none; border-radius: 4px; font-weight: 700; cursor: pointer; } /* Warna Oranye untuk Edit */
        .btn-back { background-color: #fff; color: #687176; border: 1px solid var(--border-color); padding: 10px 25px; text-decoration: none; border-radius: 4px; font-weight: 500; }
        .img-preview { margin-top: 10px; max-width: 150px; border-radius: 4px; border: 1px solid #ddd; padding: 3px; }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2 class="header-title">Edit Data Wisata: {{ $wisata->nama }}</h2>

        <form action="{{ route('dashboard.update', $wisata->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <div class="form-group">
                <label>Nama Tempat Wisata</label>
                <input type="text" name="nama" value="{{ old('nama', $wisata->nama) }}" required>
            </div>

            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori_id" required>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ $wisata->kategori_id == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Lokasi / Alamat</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $wisata->lokasi) }}" required>
            </div>

            <div class="form-group">
                <label>Harga Tiket (Rp)</label>
                <input type="number" name="harga_tiket" value="{{ old('harga_tiket', $wisata->harga_tiket) }}" required>
            </div>

            <div class="form-group">
                <label>Deskripsi Lengkap</label>
                <textarea name="deskripsi" rows="5" required>{{ old('deskripsi', $wisata->deskripsi) }}</textarea>
            </div>

            <div class="form-group">
                <label>Ganti Foto (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="file" name="gambar" accept="image/*">
                @if($wisata->gambar)
                    <br>
                    <label style="font-size:12px; margin-top:5px;">Foto Saat Ini:</label>
                    <img src="{{ asset('storage/' . $wisata->gambar) }}" class="img-preview">
                @endif
            </div>

            <div class="btn-group">
                <a href="{{ route('dashboard') }}" class="btn-back">Batal</a>
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>