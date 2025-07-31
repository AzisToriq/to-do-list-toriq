@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-info text-white text-center fw-bold fs-5">
                    <i class="bi bi-key-fill me-2"></i> Reset Your Password
                </div>

                <div class="card-body px-4 py-4">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input id="email" type="email" class="form-control shadow-sm @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input id="password" type="password" class="form-control shadow-sm @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Confirm New Password</label>
                            <input id="password-confirm" type="password" class="form-control shadow-sm" name="password_confirmation" required>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-info rounded-pill px-4 fw-semibold text-white">
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
