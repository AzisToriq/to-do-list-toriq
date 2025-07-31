@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h2 class="fw-bold mb-4 text-center">👤 Pengaturan Profil</h2>

            {{-- Flash message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row g-4">
                {{-- Form Ubah Nama --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-lg h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3 text-primary">✏️ Ubah Nama</h5>
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', auth()->user()->name) }}" required autocomplete="off">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary w-100">💾 Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Form Ubah Email & Password --}}
                <div class="col-md-6">
                    <div class="card border-0 shadow-lg h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3 text-warning">🔐 Email & Password</h5>
                            <form method="POST" action="{{ route('profile.password') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Baru</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', auth()->user()->email) }}" required autocomplete="off">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Password Saat Ini</label>
                                    <input type="password" name="current_password" id="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        required autocomplete="current-password">
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Baru</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" required autocomplete="new-password">
                                </div>

                                <button type="submit" class="btn btn-warning w-100">🔄 Update Email & Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Optional: link kembali ke dashboard --}}
            <div class="text-center mt-4">
                <a href="{{ route('dashboard') }}" class="text-decoration-none text-muted">
                    ← Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
