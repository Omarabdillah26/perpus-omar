@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-5">
    <div>
        <h2 class="fw-bold">Manajemen Koleksi Buku</h2>
        <p class="text-secondary">Kelola data buku, stok, dan kategori perpustakaan.</p>
    </div>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i class="bi bi-plus-lg"></i> Tambah Buku Baru
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Buku</th>
                        <th>Penulis</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-light rounded-3 overflow-hidden" style="width: 48px; height: 64px;">
                                        <img src="{{ $book->cover_image ? asset($book->cover_image) : 'https://via.placeholder.com/48x64?text=No+Image' }}" class="w-100 h-100 object-fit-cover shadow-sm">
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $book->title }}</div>
                                        <div class="small text-secondary fw-mono">{{ $book->isbn }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $book->author }}</td>
                            <td>
                                <span class="badge bg-light text-primary py-2 px-3 border border-primary-subtle rounded-3">
                                    {{ $book->category->name }}
                                </span>
                            </td>
                            <td>
                                @if($book->status == 'available')
                                    <span class="text-success small fw-bold d-flex align-items-center gap-1">
                                        <i class="bi bi-check-circle-fill"></i> Tersedia
                                    </span>
                                @else
                                    <span class="text-warning small fw-bold d-flex align-items-center gap-1">
                                        <i class="bi bi-clock-fill"></i> Dipinjam
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-outline-secondary border-0">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger border-0">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-secondary">Belum ada koleksi buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
