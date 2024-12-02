@extends('components.layout')

@section('title', 'Meditation')

@section('content')
    <div class="min-h-screen bg-customDark p-4">

        <!-- Success Alert -->
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Error Alert -->
        @if (session()->has('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="flex space-x-4">
            <h1 class="text-3xl font-bold text-white ">Session</h1>
            <div class="container flex justify-end items-center gap-4">
                <!-- add sessions -->
                <button type="button"
                    class="flex items-center bg-blue-600 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-700 hover:shadow-lg transition duration-200"
                    data-bs-toggle="modal" data-bs-target="#addToDoModal">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z" />
                    </svg>
                    Add
                </button>

                <!-- History Button -->
                <a href="{{ route('ToDoListHistory') }}"
                    class="flex items-center bg-gray-600 text-white py-2 px-4 rounded-lg shadow hover:bg-gray-700 hover:shadow-lg transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V7h2v2z" />
                    </svg>
                    History
                </a>
            </div>
        </div>
        <br>
        <div class="container mx-auto mt-3 mb-4">
            <div class="flex flex-col gap-3">
                @forelse ($meditations as $todo)
                    <div class="card" style="width: 100%;">
                        <div
                            class="bg-white shadow-md rounded-lg p-4 flex flex-row items-center transition-shadow duration-300 hover:shadow-lg">
                            <!-- Image -->
                            @if ($todo->logo)
                                <img src="{{ asset($todo->logo) }}" class="h-24 w-24 object-cover rounded-md mr-4"
                                    alt="Meditate Logo">
                            @endif

                            <!-- Content -->
                            <div class="flex-1">
                                <h5 class="text-lg font-semibold">{{ $todo->name }}</h5>
                                <p class="text-gray-600">
                                    Target: {{ $todo->target_timer }} <br>
                                    Status: {{ $todo->status }}
                                </p>

                                <!-- Progress Bar -->
                                @php
                                    $timerParts = explode(':', $todo->timer);
                                    $timerInSeconds = $timerParts[0] * 3600 + $timerParts[1] * 60 + $timerParts[2];

                                    $targetParts = explode(':', $todo->target_timer);
                                    $targetTimeInSeconds =
                                        $targetParts[0] * 3600 + $targetParts[1] * 60 + $targetParts[2];

                                    $progressPercentage = $targetTimeInSeconds
                                        ? ($timerInSeconds / $targetTimeInSeconds) * 100
                                        : 0;
                                @endphp

                                <div class="progress mb-3" style="height: 20px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;"
                                        aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ round($progressPercentage) }}%
                                    </div>
                                </div>

                                <!-- Update Progress Button -->
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#updateProgressModal{{ $todo->id }}" onclick="{{ route('meditationPage.counter') }}">
                                    Update Progress
                                </button> --}}

                                <form action="{{ route('meditation.counter', $todo->id) }}" method="GET">

                                    <button type="submit" class="btn btn-primary">
                                        Start
                                    </button>


                                </form>


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
                    <h1 class="mx-auto">There is no Meditation session. Click the plus button to add your session!</h1>
                @endforelse
            </div>

        </div>
    </div>
    <div>
        {{ $meditations->links('vendor.pagination.custom') }}
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
