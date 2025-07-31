@extends('layouts.auth')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-primary text-white text-center fw-bold fs-5">
                    <i class="bi bi-shield-lock-fill me-2"></i> Confirm Your Password
                </div>

                <div class="card-body px-4 py-4">
                    <p class="text-muted text-center">Please confirm your password before continuing.</p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control shadow-sm @error('password') is-invalid @enderror" name="password" required autofocus>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button type="submit" class="btn btn-primary rounded-pill px-4">Confirm</button>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
