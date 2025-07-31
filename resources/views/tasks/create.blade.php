@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Tambah Tugas Baru</h1>

    {{-- Validasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form Tugas --}}
    <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul Tugas</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Tugas</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3" style="max-width: 300px;">
            <label for="deadline" class="form-label">Batas Waktu</label>
            <input
                type="datetime-local"
                name="deadline"
                id="deadline"
                class="form-control"
                style="cursor: text;"
                value="{{ old('deadline') }}"
            >
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioritas</label>
            <select name="priority" id="priority" class="form-select">
                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Rendah</option>
                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Sedang</option>
                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="upload_file" class="form-label">Unggah Berkas (opsional)</label>
            <input type="file" name="upload_file" id="upload_file" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Simpan Tugas</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
