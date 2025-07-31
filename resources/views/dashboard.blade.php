@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Card utama --}}
            <div class="card border-0 shadow-lg rounded-4 mb-4">
                <div class="card-header bg-gradient bg-primary text-white py-3 rounded-top-4">
                    <h4 class="mb-0"><i class="bi bi-house-door-fill me-2"></i>Dashboard</h4>
                </div>

                <div class="card-body text-center p-5">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i>{{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <p class="lead mb-4 text-muted">🎉 Kamu berhasil login!</p>

                    <a href="{{ route('tasks.index') }}" class="btn btn-success btn-lg px-4 py-2 shadow-sm">
                        <i class="bi bi-list-task me-2"></i> Lihat To-Do List
                    </a>
                </div>
            </div>

            {{-- Card Tugas Terdekat --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-light py-3 rounded-top-4">
                    <h5 class="mb-0 text-primary"><i class="bi bi-clock-history me-2"></i>Tugas Terdekat</h5>
                </div>

                <div class="card-body">
                    @if ($tasks->isEmpty())
                        <p class="text-muted">Belum ada tugas yang mendekat 📭</p>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach ($tasks as $task)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $task->title }}</strong>
                                        <br>
                                        <small class="text-muted"><i class="bi bi-calendar-event me-1"></i>
                                            Deadline: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y, H:i') }}
                                        </small>
                                    </div>
                                    <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-primary">
                                        Detail
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
