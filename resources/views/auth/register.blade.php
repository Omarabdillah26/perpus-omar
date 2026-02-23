@extends('layouts.auth')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-md-5">
            <div class="glass-card p-5 shadow-lg">
                <div class="text-center mb-5">
                    <h2 class="fw-bold mb-2">Daftar <span class="text-gradient">Anggota Siswa</span></h2>
                    <p class="text-secondary small">Lengkapi data diri untuk menjadi anggota perpustakaan</p>
                </div>

                <form method="POST" action="{{ route('register.post') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Masukan nama lengkap" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase tracking-wider">Alamat Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email@sekolah.sch.id" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-secondary text-uppercase tracking-wider">Kata Sandi</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="form-label small fw-bold text-secondary text-uppercase tracking-wider">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                    </div>

                    <button type="submit" class="btn btn-gradient w-100 mb-4">Daftar Sekarang</button>

                    <p class="text-center mb-0 small">
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-gradient fw-bold text-decoration-none">Masuk di sini</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
