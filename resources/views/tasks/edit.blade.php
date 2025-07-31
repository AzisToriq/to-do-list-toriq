@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Tugas</h1>

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

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul Tugas</label>
            <input type="text" name="title" id="title" class="form-control"
                value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Tugas</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3" style="max-width: 300px;">
            <label for="deadline" class="form-label">Batas Waktu</label>
            <input
                type="datetime-local"
                name="deadline"
                id="deadline"
                class="form-control"
                style="cursor: text;"
                value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d\TH:i') : '') }}"
            >
        </div>

        <div class="mb-3">
            <label for="priority" class="form-label">Prioritas</label>
            <select name="priority" id="priority" class="form-select">
                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Rendah</option>
                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Sedang</option>
                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>Tinggi</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="upload_file" class="form-label">Unggah Berkas (opsional)</label>
            <input type="file" name="upload_file" id="upload_file" class="form-control">
            @if ($task->upload_file)
                <small class="text-muted">
                    Berkas saat ini: 
                    <a href="{{ asset('storage/uploads/' . $task->upload_file) }}" target="_blank">
                        {{ $task->upload_file }}
                    </a>
                </small>
            @endif
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_completed" id="is_completed" class="form-check-input"
                {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
            <label for="is_completed" class="form-check-label">Tandai sebagai Selesai</label>
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Tugas</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
