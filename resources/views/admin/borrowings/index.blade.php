@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold">Riwayat Peminjaman</h2>
        <p class="text-secondary">Daftar semua transaksi peminjaman dan pengembalian buku.</p>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Peminjam</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $borrowing)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-primary">{{ $borrowing->borrower_name }}</div>
                                <div class="small text-secondary">{{ $borrowing->borrower_phone }}</div>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $borrowing->book->title }}</div>
                                <div class="small text-secondary fw-mono">ISBN: {{ $borrowing->book->isbn }}</div>
                            </td>
                            <td>
                                {{ $borrowing->borrowed_at->format('d M Y') }}
                                <div class="small text-danger fw-bold">Jatuh Tempo: {{ $borrowing->due_at->format('d M Y') }}</div>
                            </td>
                            <td>
                                @if($borrowing->returned_at)
                                    <span class="badge bg-success py-2 px-3 rounded-pill">Dikembalikan</span>
                                    <div class="small text-secondary mt-1">Selesai: {{ $borrowing->returned_at->format('d M Y') }}</div>
                                @else
                                    <span class="badge bg-warning text-dark py-2 px-3 rounded-pill">Masih Dipinjam</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(!$borrowing->returned_at)
                                    <form action="{{ route('admin.borrowings.return', $borrowing) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary py-2 px-3 rounded-3" onclick="return confirm('Konfirmasi pengembalian buku ini?')">
                                            Konfirmasi Kembali
                                        </button>
                                    </form>
                                @else
                                    <span class="text-secondary opacity-50"><i class="bi bi-check2-all"></i> Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-secondary">Belum ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
