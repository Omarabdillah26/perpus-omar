@extends('layouts.student')

@section('content')
<!-- Hero Greeting -->
<div class="row mb-5 align-items-center">
    <div class="col-lg-8">
        <h1 class="display-5 fw-bold mb-2">Halo, <span class="text-gradient">{{ explode(' ', Auth::user()->name)[0] }}</span>! 👋</h1>
        <p class="text-secondary lead">Waktunya menjelajahi dunia melalui buku hari ini.</p>
    </div>
    <div class="col-lg-4 text-lg-end">
        <a href="{{ route('student.borrow') }}" class="btn btn-premium px-4 py-3">
            <i class="bi bi-plus-lg me-2"></i> Pinjam Buku Baru
        </a>
    </div>
</div>

<!-- Stats Section -->
<div class="row g-4 mb-5">
    <div class="col-md-6 col-xl-3">
        <div class="glass-card mb-0">
            <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                <i class="bi bi-book"></i>
            </div>
            <h5 class="text-secondary small fw-bold text-uppercase mb-2">Pinjaman Aktif</h5>
            <h2 class="fw-bold mb-0">{{ $borrowedBooks->count() }} <span class="fs-6 text-secondary fw-normal">Buku</span></h2>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="glass-card mb-0">
            <div class="stat-icon bg-info bg-opacity-10 text-info">
                <i class="bi bi-check2-circle"></i>
            </div>
            <h5 class="text-secondary small fw-bold text-uppercase mb-2">Total Selesai</h5>
            <h2 class="fw-bold mb-0">{{ $history->count() }} <span class="fs-6 text-secondary fw-normal">Kali</span></h2>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="glass-card mb-0">
            <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                <i class="bi bi-clock-history"></i>
            </div>
            <h5 class="text-secondary small fw-bold text-uppercase mb-2">Jatuh Tempo</h5>
            <h2 class="fw-bold mb-0">{{ $borrowedBooks->where('due_at', '<', now())->count() }} <span class="fs-6 text-secondary fw-normal">Hari Ini</span></h2>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="glass-card mb-0">
            <div class="stat-icon bg-success bg-opacity-10 text-success">
                <i class="bi bi-calendar-check"></i>
            </div>
            <h5 class="text-secondary small fw-bold text-uppercase mb-2">Member Sejak</h5>
            <h2 class="fw-bold mb-0" style="font-size: 1.5rem;">{{ Auth::user()->created_at->format('M Y') }}</h2>
        </div>
    </div>
</div>

<div class="row g-5">
    <!-- Active Borrowings -->
    <div class="col-xl-8">
        <div class="glass-card p-0 overflow-hidden">
            <div class="p-4 d-flex justify-content-between align-items-center border-bottom border-white border-opacity-10">
                <h5 class="fw-bold mb-0"><i class="bi bi-bookmark-star text-primary me-2"></i> Pinjaman Yang Sedang Berjalan</h5>
                <a href="{{ route('student.return') }}" class="btn btn-sm btn-link text-primary text-decoration-none fw-bold">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Informasi Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Batas Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowedBooks->take(3) as $borrow)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 overflow-hidden bg-white bg-opacity-5" style="width: 40px; height: 54px;">
                                        <img src="{{ $borrow->book->cover_image ? asset($borrow->book->cover_image) : 'https://via.placeholder.com/40x54' }}" class="w-100 h-100 object-fit-cover">
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white small">{{ $borrow->book->title }}</div>
                                        <div class="text-secondary" style="font-size: 0.7rem;">{{ $borrow->book->author }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="small">{{ $borrow->borrowed_at->format('d M Y') }}</span></td>
                            <td>
                                <span class="small fw-bold {{ $borrow->due_at < now() ? 'text-danger' : 'text-warning' }}">
                                    {{ $borrow->due_at->format('d M Y') }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20 px-3 py-2 rounded-pill small">
                                    Dipinjam
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <i class="bi bi-journal-x fs-1 text-secondary opacity-20 d-block mb-3"></i>
                                <span class="text-secondary small">Belum ada buku yang dipinjam.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Quick Notification/History -->
    <div class="col-xl-4">
        <div class="glass-card p-4 h-100">
            <h5 class="fw-bold mb-4">Aktivitas Terakhir</h5>
            <div class="d-flex flex-column gap-4">
                @forelse($history->take(4) as $item)
                <div class="d-flex gap-3">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; flex-shrink: 0;">
                        <i class="bi bi-check-lg small"></i>
                    </div>
                    <div>
                        <p class="small text-white fw-bold mb-1">Berhasil mengembalikan buku</p>
                        <p class="text-secondary mb-0" style="font-size: 0.75rem;">{{ $item->book->title }}</p>
                        <p class="text-primary mt-1" style="font-size: 0.65rem;">{{ $item->returned_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <p class="text-secondary small">Belum ada aktivitas tercatat.</p>
                </div>
                @endforelse
            </div>
            
            @if($history->count() > 0)
            <div class="mt-5 pt-3 border-top border-white border-opacity-10">
                <a href="#" class="btn btn-dark w-100 rounded-4 py-2 small fw-bold border-white border-opacity-10">Lihat Full Log</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
