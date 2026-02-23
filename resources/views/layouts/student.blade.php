<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Siswa - Perpus Omar' }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #6366f1;
            --primary-glow: rgba(99, 102, 241, 0.4);
            --secondary: #a855f7;
            --dark-sidebar: #020617;
            --dark-content: #0f172a;
            --glass: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
        }
        body {
            font-family: 'Outfit', sans-serif;
            background: var(--dark-content);
            color: #f8fafc;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Sidebar Styling */
        .sidebar {
            width: 280px;
            background: var(--dark-sidebar);
            border-right: 1px solid var(--glass-border);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 100;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .main-content {
            margin-left: 280px;
            padding: 2.5rem;
            transition: all 0.3s;
        }
        
        /* Logo Styling */
        .logo-container {
            padding: 2rem 1.5rem;
            margin-bottom: 1rem;
        }
        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 16px var(--primary-glow);
        }
        
        /* Nav Links */
        .nav-list {
            padding: 0 1rem;
        }
        .nav-link {
            color: #64748b;
            padding: 0.875rem 1.25rem;
            border-radius: 14px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }
        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.03);
        }
        .nav-link.active {
            color: white;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            box-shadow: 0 10px 20px -5px var(--primary-glow);
        }
        .nav-link i {
            font-size: 1.2rem;
        }
        
        /* Content Elements */
        .glass-card {
            background: var(--glass);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 28px;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: transform 0.3s;
        }
        .glass-card:hover {
            border-color: rgba(255, 255, 255, 0.15);
        }
        
        .stat-icon {
            width: 54px;
            height: 54px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }
        
        /* Gradient Text */
        .text-gradient {
            background: linear-gradient(135deg, #818cf8, #c084fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Premium Buttons */
        .btn-premium {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border: none;
            color: white;
            padding: 0.875rem 1.5rem;
            border-radius: 14px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 12px var(--primary-glow);
        }
        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px var(--primary-glow);
            color: white;
        }

        /* Table Aesthetics */
        .table {
            color: #cbd5e1;
            margin-bottom: 0;
        }
        .table thead th {
            border-bottom: 1px solid var(--glass-border);
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.01);
        }
        .table tbody td {
            border-bottom: 1px solid var(--glass-border);
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
        }
        .table tbody tr:last-child td {
            border-bottom: none;
        }
        .table tbody tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        /* Avatar */
        .user-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(45deg, #4f46e5, #ec4899);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: white;
        }

        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column" id="sidebar">
        <div class="logo-container d-flex align-items-center gap-3">
            <div class="logo-icon">
                <i class="bi bi-book-half text-white"></i>
            </div>
            <div>
                <h5 class="fw-bold mb-0">Perpus <span class="text-primary">Omar</span></h5>
                <p class="text-secondary small mb-0" style="font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase;">Student Portal</p>
            </div>
        </div>

        <div class="nav-list flex-grow-1">
            <a href="{{ route('student.dashboard') }}" class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <i class="bi bi-columns-gap"></i> Dashboard
            </a>
            <a href="{{ route('student.borrow') }}" class="nav-link {{ request()->routeIs('student.borrow') ? 'active' : '' }}">
                <i class="bi bi-journal-plus"></i> Pinjam Buku
            </a>
            <a href="{{ route('student.return') }}" class="nav-link {{ request()->routeIs('student.return') ? 'active' : '' }}">
                <i class="bi bi-arrow-repeat"></i> Pengembalian
            </a>
            <div class="my-3 mx-3 border-top border-white opacity-10"></div>
            <a href="{{ route('home') }}" class="nav-link">
                <i class="bi bi-globe"></i> Jelajah Katalog
            </a>
        </div>

        <div class="p-4 mt-auto">
            <div class="glass-card mb-0 p-3 rounded-4 d-flex align-items-center gap-3">
                <div class="user-avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="small fw-bold mb-0 text-truncate">{{ Auth::user()->name }}</p>
                    <p class="text-secondary mb-0" style="font-size: 0.7rem;">Student Account</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-link text-danger text-decoration-none w-100 text-start px-3 d-flex align-items-center gap-2">
                    <i class="bi bi-power"></i> Keluar Sesi
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-link text-white d-lg-none" onclick="toggleSidebar()">
                <i class="bi bi-list fs-3"></i>
            </button>
            <div class="d-none d-md-block">
                <h5 class="fw-bold mb-0 text-gradient">Member Area</h5>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="small text-secondary fw-medium">{{ date('l, d F Y') }}</div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 bg-success-subtle text-success rounded-4 p-3 shadow-sm mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger border-0 bg-danger-subtle text-danger rounded-4 p-3 shadow-sm mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }
    </script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
