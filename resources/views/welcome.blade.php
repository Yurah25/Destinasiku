<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DestinasiKu - Jelajahi Wisata Impian</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        /* CSS STYLE TRAVELOKA VIBES */
        :root { --primary-blue: #1ba0e2; --primary-hover: #108ccf; --bg-light: #f7f9fa; --text-dark: #35405a; }
        body { font-family: 'Roboto', sans-serif; background-color: var(--bg-light); margin: 0; color: var(--text-dark); }
        a { text-decoration: none; color: inherit; }      
        .link ul{display: flex; list-style-type: none; justify-content: space-between;}
        /* NAVBAR */
        .navbar { background: white; padding: 15px 50px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .logo { font-size: 24px; font-weight: 700; }
        .logo span { color: var(--primary-blue); }
        .btn-dash { border: 1px solid var(--primary-blue); color: var(--primary-blue); padding: 8px 15px; border-radius: 4px; font-weight: 700; transition: 0.3s; }
        .btn-dash:hover { background: var(--primary-blue); color: white; }

        /* HERO SECTION */
        .hero { background: linear-gradient(135deg, #1ba0e2 0%, #0077b6 100%); padding: 60px 20px; text-align: center; color: white; margin-bottom: 40px; }
        .hero h1 { margin: 0 0 10px; font-size: 32px; }
        .hero p { opacity: 0.9; margin-bottom: 30px; }
        
        /* SEARCH BOX */
        .search-box { background: white; max-width: 600px; margin: 0 auto; padding: 10px; border-radius: 8px; display: flex; gap: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        .search-input { flex: 1; border: none; padding: 10px; font-size: 16px; outline: none; }
        .search-btn { background: #ff5e1f; color: white; border: none; padding: 10px 30px; border-radius: 6px; font-weight: 700; cursor: pointer; }

        /* CONTAINER */
        .container { max-width: 1100px; margin: 0 auto; padding: 0 20px 40px; }

        /* FILTER KATEGORI */
        .categories { display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; margin-bottom: 30px; }
        .cat-pill { background: white; padding: 8px 20px; border-radius: 20px; font-size: 14px; border: 1px solid #ddd; color: #555; transition: 0.3s; }
        .cat-pill:hover, .cat-pill.active { border-color: var(--primary-blue); color: var(--primary-blue); background: #e1f5fe; }

        /* GRID WISATA */
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 25px; }
        .card { background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.06); transition: transform 0.2s; border: 1px solid #eee; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .card-img { width: 100%; height: 180px; object-fit: cover; background: #eee; }
        .card-body { padding: 15px; }
        .card-tag { font-size: 11px; background: #e1f5fe; color: var(--primary-blue); padding: 4px 8px; border-radius: 4px; font-weight: 700; }
        .card-title { font-size: 18px; font-weight: 700; margin: 10px 0 5px; }
        .card-loc { color: #777; font-size: 13px; margin-bottom: 15px; }
        .card-price { color: #ff5e1f; font-size: 18px; font-weight: 700; text-align: right; }

        /* PAGINATION */
        .pagination { margin-top: 40px; display: flex; justify-content: center; gap: 5px; }
        .pagination a, .pagination span { padding: 8px 12px; background: white; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        .pagination .active span { background: var(--primary-blue); color: white; border-color: var(--primary-blue); }
        .empty-state { text-align: center; padding: 50px; color: #777; }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">Destinasi<span>Ku</span></div>
        <div class="link">
        <ul>
            <li><a href="#" ></a>Home</li>
            <li><a href="#" ></a>About</li>
            <li><a href="#" ></a>Explore</li>
        </ul>
        </div>
        @auth
            <a href="{{ route('dashboard') }}" class="btn-dash">Dashboard Admin</a>
        @else
            <a href="{{ route('login') }}" class="btn-dash">Login Admin</a>
        @endauth
    </nav>

    <div class="hero">
        <h1>Jelajahi Wisata Impianmu</h1>
        <p>Temukan keindahan alam dan budaya terbaik di sekitar kita.</p>
        <form action="{{ route('home') }}" method="GET" class="search-box">
            <input type="text" name="cari" class="search-input" placeholder="Cari wisata (ex: Curug, Pantai)..." value="{{ request('cari') }}">
            <button type="submit" class="search-btn">Cari</button>
        </form>
    </div>

    <div class="container">
        <div class="categories">
            <a href="{{ route('home') }}" class="cat-pill {{ !request('kategori') ? 'active' : '' }}">Semua</a>
            @foreach($kategoris as $kat)
                <a href="{{ route('home', ['kategori' => $kat->slug]) }}" 
                   class="cat-pill {{ request('kategori') == $kat->slug ? 'active' : '' }}">
                   {{ $kat->nama }}
                </a>
            @endforeach
        </div>

        <div class="grid">
            @forelse($wisatas as $wisata)
            <a href="{{ route('detail', $wisata->slug) }}" class="card">
                @if($wisata->gambar)
                    <img src="{{ asset('storage/' . $wisata->gambar) }}" class="card-img">
                @else
                    <div class="card-img" style="display:flex;align-items:center;justify-content:center;color:#999;font-size:12px;">No Image</div>
                @endif
                <div class="card-body">
                    <span class="card-tag">{{ $wisata->kategori->nama }}</span>
                    <h3 class="card-title">{{ $wisata->nama }}</h3>
                    <div class="card-loc">📍 {{ $wisata->lokasi }}</div>
                    <div class="card-price">Rp {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</div>
                </div>
            </a>
            @empty
                </div>
                <div class="empty-state">
                    <h3>Yah, wisata tidak ditemukan 😔</h3>
                    <p>Coba kata kunci lain atau reset filter kategori.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination">
            {{ $wisatas->links('pagination::simple-default') }}
        </div>
    </div>

</body>
</html>