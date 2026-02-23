@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h2 class="fw-bold">Ringkasan Statistik</h2>
    <p class="text-secondary">Selamat datang kembali, {{ Auth::user()->name }}.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="card p-4 text-center">
            <p class="small text-secondary fw-bold text-uppercase mb-1">Total Buku</p>
            <h3 class="fw-bold mb-0 text-primary">{{ \App\Models\Book::count() }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center">
            <p class="small text-secondary fw-bold text-uppercase mb-1">Peminjaman Aktif</p>
            <h3 class="fw-bold mb-0 text-violet">{{ \App\Models\Borrowing::whereNull('returned_at')->count() }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center">
            <p class="small text-secondary fw-bold text-uppercase mb-1">Total Anggota</p>
            <h3 class="fw-bold mb-0 text-success">{{ \App\Models\User::where('is_admin', false)->count() }}</h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-4 text-center">
            <p class="small text-secondary fw-bold text-uppercase mb-1">Total Kategori</p>
            <h3 class="fw-bold mb-0 text-info">{{ \App\Models\Category::count() }}</h3>
        </div>
    </div>
</div>

<div class="card shadow-sm mb-5">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4">Peminjaman Terbaru</h5>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Estimasi Kembali</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse(\App\Models\Borrowing::with('book')->latest()->take(5)->get() as $borrowing)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $borrowing->borrower_name }}</div>
                                <div class="small text-secondary">{{ $borrowing->borrower_phone }}</div>
                            </td>
                            <td>{{ $borrowing->book->title }}</td>
                            <td>{{ $borrowing->borrowed_at->format('d M Y') }}</td>
                            <td class="text-primary fw-bold">{{ $borrowing->due_at ? $borrowing->due_at->format('d M Y') : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-secondary">Belum ada peminjaman tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4">Akses Cepat</h5>
        <div class="d-flex gap-3">
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="bi bi-plus-circle"></i> Tambah Buku
            </a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary d-flex align-items-center gap-2 rounded-3" style="border-radius: 0.75rem !important;">
                <i class="bi bi-tag"></i> Tambah Kategori
            </a>
        </div>
    </div>
</div>
@endsection
