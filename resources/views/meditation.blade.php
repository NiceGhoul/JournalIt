@extends('components.layout')

@section('title', 'Meditation')

@section('content')
<div class="container d-flex justify-content-end align-items-center gap-2 mt-3">
        <!-- Floating Plus Button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToDoModal">
            +
        </button>
    
        <!-- History Button
        <a href="{{ route('ToDoListHistory') }}" class="btn btn-secondary">
            History
        </a> -->
    </div>

        <div class="container">
            <div class="d-flex flex-column flex-wrap gap-3 mt-5">
                @forelse ($meditations as $todo)
                    <div class="card" style="width: 100%;">
                        <div class="d-flex flex-row align-items-center">
                            <!-- Image -->
                            @if ($todo->logo)
                                <img src="{{ asset($todo->logo) }}" class="card-img-left" alt="ToDo Logo"
                                    style="height: 100px; width: 100px; object-fit: cover; margin-right: 20px;">
                            @endif

                            <!-- Content -->
                            <div class="card-body">
                                <h5 class="card-title">{{ $todo->name }}</h5>
                                <p class="card-text">
                                    Target: {{ $todo->target_time }} <br>
                                    Status: {{ $todo->status }}
                                </p>

                                <!-- Progress Bar -->
                                @php
                                    $progressPercentage = $todo->timer ? ($todo->timer / $todo->target_time) * 100 : 0;
                                @endphp
                                <div class="progress mb-3" style="height: 20px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;"
                                        aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ round($progressPercentage) }}%
                                    </div>
                                </div>

                                <!-- Update Progress Button -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateProgressModal{{ $todo->id }}">
                                    Update Progress
                                </button>

                                <!-- Modal for Updating Progress -->
                                <div class="modal fade" id="updateProgressModal{{ $todo->id }}" tabindex="-1"
                                    aria-labelledby="updateProgressModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateProgressModalLabel">Update Progress</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('updateProgress', $todo->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mb-3">
                                                        <label for="progress" class="form-label">Add Progress</label>
                                                        <input type="number" class="form-control" id="progress"
                                                            name="progress" min="1"
                                                            max="{{ $todo->target - $todo->progress }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1 class="mx-auto">There is no to-do list. Click the plus button to add your to-do!</h1>
                @endforelse
            </div>

    </div>
<!-- Modal for Adding To-Do -->
<div class="modal fade" id="addToDoModal" tabindex="-1" aria-labelledby="addToDoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addToDoModalLabel">Add New Meditation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('AddMeditation') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="to_do_date" class="form-label">To-Do Date</label>
                            <input type="date" class="form-control" id="to_do_date" name="to_do_date" required>
                        </div> -->
                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <!-- <label for="target_timer" class="form-label">Target</label>
                            <input type="time" step="60" class="form-control" id="target" name="target" min="1"
                                required> -->
                            <label for="timer">Durasi Waktu (Minutes):</label>
                            <input type="number" id="target_timer" name="target_timer" placeholder="minutes" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Meditation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection