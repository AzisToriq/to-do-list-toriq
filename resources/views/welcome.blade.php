<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>To-Do List | Laravel App</title>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #f0f4ff, #e0ecff);
            color: #333;
            min-height: 100vh;
        }
        .hero-section {
            padding: 100px 0;
        }
        .btn-custom {
            background-color: #4f46e5;
            color: white;
            transition: all 0.3s ease-in-out;
        }
        .btn-custom:hover {
            background-color: #3730a3;
            color: white;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="#">📝 To-Do App</a>
            <div class="d-flex">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Kelola Tugas Harianmu Dengan Mudah</h1>
            <p class="lead mb-5">Aplikasi to-do list modern berbasis Laravel. Fokus, atur prioritas, dan capai tujuanmu!</p>
            
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-lg btn-custom">Buka Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-lg btn-custom me-2">Mulai Sekarang</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-lg btn-outline-dark">Daftar Gratis</a>
                    @endif
                    <!-- ✅ Catatan Registrasi -->
                    <div class="mt-4 text-muted">
                        <small>
                            Belum punya akun? Silakan <a href="{{ route('register') }}">registrasi terlebih dahulu</a> untuk mulai menggunakan aplikasi ini.
                        </small>
                    </div>
                @endauth
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-4 text-muted small">
        &copy; {{ date('Y') }} To-Do App | Dibuat oleh Toriq
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
