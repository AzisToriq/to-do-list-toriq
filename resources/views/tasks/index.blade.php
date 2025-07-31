@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold">📋 Daftar Tugas Saya</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary shadow-sm">👤 Profil</a>
            <a href="{{ route('tasks.create') }}" class="btn btn-success shadow-sm">+ Tambah Tugas</a>
        </div>
    </div>

    {{-- Flash Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter, Search, Sort --}}
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="search" class="form-label">🔍 Cari Judul</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Cari judul tugas..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <label for="priority" class="form-label">⚡ Prioritas</label>
                    <select name="priority" id="priority" class="form-select">
                        <option value="">Semua</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Sedang</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Rendah</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="sort" class="form-label">🕒 Urutkan Deadline</label>
                    <select name="sort" id="sort" class="form-select">
                        <option value="">Default</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terdekat</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Terapkan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Table --}}
    @if ($tasks->isEmpty())
        <div class="alert alert-info text-center">
            Belum ada tugas. <a href="{{ route('tasks.create') }}">Tambah sekarang!</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-bordered shadow-sm align-middle text-center">
                <thead class="table-dark text-white">
                    <tr>
                        <th>Judul</th>
                        <th>Prioritas</th>
                        <th>Deadline</th>
                        <th>Sisa Waktu</th>
                        <th>Berkas</th>
                        <th>Status</th>
                        <th style="width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="text-start">{{ $task->title }}</td>
                            <td>
                                @php
                                    $badgeClass = match($task->priority) {
                                        'high' => 'danger',
                                        'medium' => 'warning',
                                        'low' => 'secondary',
                                        default => 'light'
                                    };
                                    $priorityText = match($task->priority) {
                                        'high' => 'Tinggi',
                                        'medium' => 'Sedang',
                                        'low' => 'Rendah',
                                        default => '-'
                                    };
                                @endphp
                                <span class="badge bg-{{ $badgeClass }} px-3 py-2">{{ $priorityText }}</span>
                            </td>
                            <td>
                                {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y H:i') : '-' }}
                            </td>
                            <td>
                                @if ($task->deadline)
                                    @php
                                        $now = now();
                                        $deadline = \Carbon\Carbon::parse($task->deadline);
                                        if ($now < $deadline) {
                                            $diff = $now->diff($deadline);
                                            $remaining = [];
                                            if ($diff->d > 0) $remaining[] = $diff->d . ' hari';
                                            if ($diff->h > 0) $remaining[] = $diff->h . ' jam';
                                            if ($diff->i > 0) $remaining[] = $diff->i . ' menit';
                                            $remainingTime = implode(', ', $remaining) . ' lagi';
                                        } else {
                                            $remainingTime = 'Kadaluarsa';
                                        }
                                    @endphp
                                    <span class="{{ $now < $deadline ? 'text-success' : 'text-danger' }}">
                                        {{ $remainingTime }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($task->upload_file)
                                    <a href="{{ asset('storage/' . $task->upload_file) }}" class="btn btn-sm btn-outline-primary" target="_blank">Lihat</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $task->is_completed ? 'success' : 'secondary' }}">
                                    {{ $task->is_completed ? 'Selesai' : 'Belum' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning mb-1 w-100">Edit</a>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100" onclick="return confirm('Yakin ingin menghapus tugas ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
