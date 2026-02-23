<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpus Omar - Digital Library</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6366f1;
            --secondary: #a855f7;
            --dark: #0f172a;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background: #fff;
            color: var(--dark);
        }
        .navbar {
            padding: 1.5rem 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }
        .hero-section {
            padding: 160px 0 100px;
            background: radial-gradient(circle at 0% 0%, rgba(99, 102, 241, 0.05) 0%, transparent 50%),
                        radial-gradient(circle at 100% 100%, rgba(168, 85, 247, 0.05) 0%, transparent 50%);
        }
        .btn-premium {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            padding: 12px 32px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.2);
            color: white;
        }
        .text-gradient {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .book-card {
            border: none;
            border-radius: 24px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .book-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .book-image {
            aspect-ratio: 3/4;
            object-fit: cover;
        }
        .badge-status {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">Perpus <span class="text-gradient">Omar</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item ps-lg-4">
                        @auth
                            <div class="dropdown">
                                <a class="btn btn-outline-primary rounded-pill px-4 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-3 rounded-4 mt-2">
                                    @if(Auth::user()->is_admin)
                                        <li><a class="dropdown-item rounded-3" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                                    @else
                                        <li><a class="dropdown-item rounded-3" href="{{ route('student.dashboard') }}">Dashboard Siswa</a></li>
                                    @endif
                                    <li><hr class="dropdown-divider opacity-10"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item rounded-3 text-danger">Keluar</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-premium px-5">Masuk Perpustakaan</a>
                        @endauth
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center">
        <div class="container px-4">
            <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 mb-4">Satu Langkah Menuju Pengetahuan</span>
            <h1 class="display-3 fw-bold mb-4">Akses Ribuan Buku Secara <br><span class="text-gradient">Mudah & Dinamis</span></h1>
            <p class="lead text-secondary mx-auto mb-5" style="max-width: 700px;">
                Tingkatkan literasi anda dengan sistem peminjaman yang dirancang khusus untuk kemudahan akses bagi seluruh siswa.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#katalog" class="btn btn-premium shadow-lg px-5 py-3">Jelajahi Koleksi</a>
            </div>
        </div>
    </header>

    <section id="katalog" class="py-5 bg-light">
        <div class="container py-5 text-center">
            <h2 class="fw-bold mb-5 fs-1">Koleksi <span class="text-gradient">Terbaru</span></h2>
            
            <div class="row g-4 text-start">
                @forelse($books as $book)
                    <div class="col-md-3">
                        <div class="card book-card">
                            <div class="position-relative">
                                <img src="{{ $book->cover_image ? asset($book->cover_image) : 'https://images.unsplash.com/photo-1543005124-8198f5955844?auto=format&fit=crop&q=80&w=1000' }}" class="card-img-top book-image" alt="{{ $book->title }}">
                                <span class="badge-status {{ $book->status == 'available' ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                                    {{ $book->status == 'available' ? 'Tersedia' : 'Dipinjam' }}
                                </span>
                            </div>
                            <div class="card-body p-4">
                                <p class="small text-primary fw-bold text-uppercase tracking-wider mb-2">{{ $book->category->name }}</p>
                                <h5 class="fw-bold mb-1">{{ $book->title }}</h5>
                                <p class="text-secondary small mb-4">{{ $book->author }}</p>
                                
                                @if($book->status == 'available')
                                    <a href="{{ route('student.borrow') }}" class="btn btn-outline-primary w-100 rounded-pill fw-bold">Pinjam Sekarang</a>
                                @else
                                    <button disabled class="btn btn-light w-100 rounded-pill fw-bold text-secondary">Tidak Tersedia</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-secondary">Belum ada koleksi buku.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="py-5 border-top bg-white">
        <div class="container text-center">
            <p class="text-secondary small mb-0">© 2026 Perpus <span class="fw-bold text-dark">Omar</span>. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
