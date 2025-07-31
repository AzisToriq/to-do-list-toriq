@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="text-center fw-bold mb-4 text-primary">Selamat Datang Kembali</h2>
                    <p class="text-center text-muted mb-4">Silakan masuk untuk melanjutkan</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember"
                                   {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>

                        {{-- Submit --}}
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                Masuk
                            </button>
                        </div>

                        {{-- Forgot Password --}}
                        @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="text-decoration-none">
                                Lupa kata sandi?
                            </a>
                        </div>
                        @endif

                        {{-- Belum punya akun --}}
                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
                            </small>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
