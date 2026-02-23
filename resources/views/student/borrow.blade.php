@extends('layouts.student')

@section('content')
<div class="mb-5">
    <h1 class="fw-bold mb-2">Katalog Buku 📚</h1>
    <p class="text-secondary lead">Temukan buku yang ingin kamu pelajari hari ini.</p>
</div>

<div class="row g-4">
    @forelse($books as $book)
    <div class="col-sm-6 col-md-4 col-xl-3">
        <div class="glass-card p-3 h-100 d-flex flex-column border-0" style="background: rgba(255,255,255,0.02);">
            <div class="position-relative mb-3 overflow-hidden rounded-4 aspect-ratio-3-4 group">
                <img src="{{ $book->cover_image ? asset($book->cover_image) : 'https://images.unsplash.com/photo-1543005124-8198f5955844?auto=format&fit=crop&q=80&w=1000' }}" 
                     alt="{{ $book->title }}" 
                     class="w-100 h-100 object-fit-cover transition-all" style="filter: brightness(0.9);">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center opacity-0 group-hover-opacity-100 transition-all" style="background: rgba(0,0,0,0.4); backdrop-filter: blur(4px);">
                    <i class="bi bi-search text-white fs-3"></i>
                </div>
            </div>
            
            <div class="px-2 flex-grow-1">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-primary bg-opacity-10 text-primary border-primary border-opacity-20 py-1 px-3 rounded-pill" style="font-size: 0.6rem;">{{ $book->category->name }}</span>
                </div>
                <h6 class="fw-bold text-white mb-1 line-clamp-2" title="{{ $book->title }}">{{ $book->title }}</h6>
                <p class="small text-secondary mb-4">{{ $book->author }}</p>
            </div>

            <div class="px-2 pb-2 mt-auto">
                <form action="{{ route('borrow.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="hidden" name="borrower_name" value="{{ Auth::user()->name }}">
                    <input type="hidden" name="borrower_phone" value="N/A">
                    <button type="submit" class="btn btn-premium w-100 rounded-4 py-2 small">
                        Pinjam Buku
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="glass-card text-center py-5">
            <i class="bi bi-emoji-frown fs-1 text-secondary opacity-20 d-block mb-3"></i>
            <h5 class="text-white fw-bold">Koleksi Sedang Kosong</h5>
            <p class="text-secondary small">Maaf, saat ini belum ada buku yang tersedia untuk dipinjam.</p>
        </div>
    </div>
    @endforelse
</div>
@endsection

@section('styles')
<style>
    .aspect-ratio-3-4 {
        aspect-ratio: 3/4;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .group:hover img {
        transform: scale(1.1);
    }
    .group-hover-opacity-100 {
        transition: opacity 0.3s;
    }
    .group:hover .group-hover-opacity-100 {
        opacity: 1 !important;
    }
</style>
@endsection
