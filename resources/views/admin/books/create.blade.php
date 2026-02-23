@extends('layouts.admin')

@section('content')
<div class="mb-5">
    <h2 class="fw-bold">Daftarkan Buku Baru</h2>
    <p class="text-secondary">Isi detail buku untuk ditambahkan ke katalog perpustakaan.</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-5">
                <form action="{{ route('admin.books.store') }}" method="POST">
                    @csrf
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-uppercase tracking-wider">Judul Buku</label>
                            <input type="text" name="title" class="form-control bg-light border-0 py-3 rounded-3" placeholder="Masukan judul lengkap" value="{{ old('title') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-uppercase tracking-wider">Penulis</label>
                            <input type="text" name="author" class="form-control bg-light border-0 py-3 rounded-3" placeholder="Nama penulis" value="{{ old('author') }}" required>
                        </div>
                    </div>

                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-uppercase tracking-wider">ISBN</label>
                            <input type="text" name="isbn" class="form-control bg-light border-0 py-3 rounded-3" placeholder="978-XXXXXXXXXX" value="{{ old('isbn') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-uppercase tracking-wider">Kategori</label>
                            <select name="category_id" class="form-select bg-light border-0 py-3 rounded-3" required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase tracking-wider">Deskripsi / Sinopsis</label>
                        <textarea name="description" class="form-control bg-light border-0 py-3 rounded-3" rows="4" placeholder="Tuliskan gambaran singkat buku ini..." required>{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-5">
                        <label class="form-label small fw-bold text-uppercase tracking-wider mb-3">Status Awal</label>
                        <div class="d-flex gap-3">
                            <div class="flex-grow-1">
                                <input type="radio" name="status" value="available" id="status1" class="btn-check" checked>
                                <label class="btn btn-outline-success w-100 py-3 rounded-3 fw-bold" for="status1">Tersedia</label>
                            </div>
                            <div class="flex-grow-1">
                                <input type="radio" name="status" value="borrowed" id="status2" class="btn-check">
                                <label class="btn btn-outline-warning w-100 py-3 rounded-3 fw-bold" for="status2">Dipinjam</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('admin.books.index') }}" class="btn btn-light py-3 px-4 fw-bold flex-grow-1 rounded-3">Batal</a>
                        <button type="submit" class="btn btn-primary py-3 px-4 fw-bold flex-grow-1 rounded-3">Daftarkan Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
