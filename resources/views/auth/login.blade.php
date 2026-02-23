@extends('layouts.auth')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="row w-100 justify-content-center">
        <div class="col-md-5">
            <div class="glass-card p-5 shadow-lg text-center">
                <div class="mb-4">
                    <div class="bg-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <svg class="text-white" width="30" height="30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                </div>
                
                <h2 class="fw-bold mb-2">Selamat Datang di <span class="text-gradient">Perpus Omar</span></h2>
                <p class="text-secondary mb-5 small">Silahkan masuk untuk melanjutkan aktivitas anda</p>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <div class="mb-4 text-start">
                        <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-5 text-start">
                        <label class="form-label small fw-bold text-secondary">Kata Sandi</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient w-100 mb-4">Masuk Sekarang</button>
                    
                    <div class="d-flex align-items-center mb-4">
                        <hr class="flex-grow-1 opacity-10">
                        <span class="px-3 small text-secondary">BELUM PUNYA AKUN?</span>
                        <hr class="flex-grow-1 opacity-10">
                    </div>

                    <p class="mb-0 small">
                        Punya kendala akses? <a href="{{ route('register') }}" class="text-gradient fw-bold text-decoration-none">Daftar Anggota Siswa</a>
                    </p>
                </form>
            </div>
            
            <p class="text-center mt-4 small text-secondary">
                Login Admin? Masukan kredensial admin anda di atas.
            </p>
        </div>
    </div>
</div>
@endsection
