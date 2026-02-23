<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard - Perpus Omar' }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #3730a3;
            --dark: #1e1b4b;
            --light-bg: #f8fafc;
        }
        body {
            font-family: 'Outfit', sans-serif;
            background: var(--light-bg);
            color: #1e293b;
            min-height: 100vh;
        }
        .sidebar {
            width: 280px;
            background: var(--dark);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            padding: 2rem;
            color: white;
        }
        .main-content {
            margin-left: 280px;
            padding: 3rem;
        }
        .nav-link {
            color: #94a3b8;
            padding: 0.875rem 1.25rem;
            border-radius: 0.75rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-weight: 500;
            text-decoration: none;
        }
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: white;
        }
        .nav-link.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }
        .card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }
        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: var(--primary-dark);
        }
        .table thead th {
            background: #f1f5f9;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
            color: #64748b;
            border: none;
            padding: 1rem;
        }
        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            border-color: #f1f5f9;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="sidebar">
        <div class="mb-5">
            <h4 class="fw-bold mb-0">Perpus <span class="text-primary-light">Omar</span></h4>
            <p class="small text-secondary mb-0">Admin Console</p>
        </div>

        <nav>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.books.index') }}" class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}">
                <i class="bi bi-book"></i> Kelola Buku
            </a>
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Kategori
            </a>
            <a href="{{ route('admin.borrowings.index') }}" class="nav-link {{ request()->routeIs('admin.borrowings.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> Peminjaman
            </a>
            <a href="{{ route('admin.members.index') }}" class="nav-link {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Kelola Siswa
            </a>
        </nav>

        <div class="position-absolute bottom-0 start-0 w-100 p-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 border-0 text-start d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </div>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
