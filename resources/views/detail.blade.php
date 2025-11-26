<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $wisata->nama }} - DestinasiKu</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #1ba0e2; --bg-gray: #f2f3f3; }
        body { font-family: 'Roboto', sans-serif; background: var(--bg-gray); margin: 0; color: #333; }
        .container { max-width: 900px; margin: 40px auto; padding: 0 20px; }
        
        .btn-back { display: inline-block; margin-bottom: 20px; color: #666; text-decoration: none; font-weight: 500; }
        .btn-back:hover { color: var(--primary-blue); }

        .card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .hero-img { width: 100%; height: 400px; object-fit: cover; background: #ddd; }
        
        .content { padding: 40px; }
        .tag { background: #e1f5fe; color: var(--primary-blue); padding: 5px 12px; border-radius: 4px; font-weight: 700; font-size: 13px; }
        h1 { font-size: 32px; margin: 15px 0; color: #2b3950; }
        .meta { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px; }
        .loc { color: #666; font-size: 15px; }
        .price { color: #ff5e1f; font-size: 24px; font-weight: 700; }
        
        .desc { line-height: 1.8; color: #444; text-align: justify; font-size: 16px; }
    </style>
</head>
<body>

<div class="container">
    <a href="{{ route('home') }}" class="btn-back">← Kembali ke Halaman Utama</a>
    
    <div class="card">
        @if($wisata->gambar)
            <img src="{{ asset('storage/' . $wisata->gambar) }}" class="hero-img">
        @else
            <div class="hero-img" style="display:flex;align-items:center;justify-content:center;color:#999;">No Image Available</div>
        @endif
        
        <div class="content">
            <span class="tag">{{ $wisata->kategori->nama }}</span>
            <h1>{{ $wisata->nama }}</h1>
            
            <div class="meta">
                <div class="loc">📍 {{ $wisata->lokasi }}</div>
                <div class="price">Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</div>
            </div>
            
            <div class="desc">
                <h3>Deskripsi Wisata</h3>
                {!! nl2br(e($wisata->deskripsi)) !!}
            </div>
        </div>
    </div>
</div>

</body>
</html>