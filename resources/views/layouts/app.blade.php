<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-brand {
            font-size: 1.4rem;
            font-weight: 600;
            color: #0d6efd !important;
        }

        .user-info {
            font-weight: 500;
            font-size: 1rem;
        }

        .logout-btn {
            font-weight: 500;
        }
    </style>
</head>
<body>

    {{-- Navbar clean & elegan --}}
    <nav class="navbar navbar-light bg-white shadow-sm py-3 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="{{ route('tasks.index') }}">📝 To-Do List</a>

            @auth
                <div class="d-flex align-items-center gap-3">
                    <span class="user-info text-dark">Hi, {{ Auth::user()->name }}</span>

                    <form action="{{ route('logout') }}" method="POST" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm logout-btn">
                            Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="container">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
