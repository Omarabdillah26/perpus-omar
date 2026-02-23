@extends('layouts.student')

@section('content')
<div class="mb-5">
    <h1 class="fw-bold mb-2">Pengembalian 🔄</h1>
    <p class="text-secondary lead">Daftar buku yang perlu kamu kembalikan ke perpustakaan.</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="glass-card p-0 overflow-hidden">
            <div class="p-4 border-bottom border-white border-opacity-10 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Tanggungan Peminjaman</h5>
                <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill small">
                    {{ $borrowedBooks->count() }} Menunggu
                </span>
            </div>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th>Jatuh Tempo</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($borrowedBooks as $borrow)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-3 overflow-hidden bg-white bg-opacity-5" style="width: 40px; height: 54px;">
                                        <img src="{{ $borrow->book->cover_image ? asset($borrow->book->cover_image) : 'https://via.placeholder.com/40x54' }}" class="w-100 h-100 object-fit-cover">
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white small">{{ $borrow->book->title }}</div>
                                        <div class="text-secondary" style="font-size: 0.7rem;">ISBN: {{ $borrow->book->isbn }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="small fw-bold {{ $borrow->due_at < now() ? 'text-danger' : 'text-warning' }}">
                                    {{ $borrow->due_at->format('d M Y') }}
                                </div>
                                <div class="text-secondary" style="font-size: 0.65rem;">Pinjam: {{ $borrow->borrowed_at->format('d M Y') }}</div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light bg-opacity-5 text-secondary border border-white border-opacity-10 py-2 px-3 rounded-pill" style="font-size: 0.65rem;">
                                    Tunggu Verifikasi Admin
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <i class="bi bi-patch-check fs-1 text-success opacity-20 d-block mb-3"></i>
                                <span class="text-secondary small">Semua buku sudah dikembalikan! Kamu hebat.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="glass-card p-4">
            <div class="d-flex align-items-center gap-3 mb-4">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                    <i class="bi bi-info-circle"></i>
                </div>
                <h6 class="fw-bold mb-0">Cara Mengembalikan</h6>
            </div>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex gap-3">
                    <div class="text-primary fw-bold">1.</div>
                    <p class="small text-secondary mb-0">Pastikan buku dalam keadaan baik dan tidak ada halaman yang rusak.</p>
                </div>
                <div class="d-flex gap-3">
                    <div class="text-primary fw-bold">2.</div>
                    <p class="small text-secondary mb-0">Bawa buku fisik ke meja petugas perpustakaan di area SMK Telkom.</p>
                </div>
                <div class="d-flex gap-3">
                    <div class="text-primary fw-bold">3.</div>
                    <p class="small text-secondary mb-0">Petugas akan memverifikasi buku dan memperbarui status di sistem.</p>
                </div>
                <div class="d-flex gap-3">
                    <div class="text-primary fw-bold">4.</div>
                    <p class="small text-secondary mb-0">Setelah diverifikasi, status buku akan berpindah ke Histori Peminjaman.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
