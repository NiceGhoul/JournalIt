@extends('components.layout')

@section('title', 'Meditation')

@section('content')
    <div class="min-h-screen bg-customDark p-4">

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="flex justify-between items-center pb-4 border-b border-gray-600">
            <h1 class="text-3xl font-bold text-white">Session</h1>

            <div class="container flex justify-end items-center gap-4">
                <button type="button"
                    class="flex items-center bg-themeLighter text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 hover:shadow-lg transition duration-200"
                    data-bs-toggle="modal" data-bs-target="#addToDoModal">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z" />
                    </svg>
                    Add
                </button>

     
                <button type="button"
                    class="flex items-center bg-red-400 text-white py-2 px-4 rounded-lg shadow hover:bg-red-600 hover:shadow-lg transition duration-200"
                    onclick="showCancelButton()" id="delete-btn">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="currentColor">
                        <path
                            d="M3 6h18M9 6v12m6-12v12M4 6V4h16v2H4zm1 4h14c.55 0 1 .45 1 1v10c0 .55-.45 1-1 1H5c-.55 0-1-.45-1-1V11c0-.55.45-1 1-1z" />
                    </svg>
                    Delete
                </button>


                <button type="button"
                    class="hidden flex items-center bg-red-500 text-white py-2 px-4 rounded-lg shadow hover:bg-red-600 hover:shadow-lg transition duration-200"
                    onclick="showDeleteButton()" id="cancel-btn">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 8.586L14.657 4 16 5.343 11.343 10l4.657 4.657-1.343 1.343L10 11.343l-4.657 4.657-1.343-1.343L8.657 10 4 5.343 5.343 4 10 8.586z"
                            clip-rule="evenodd" />
                    </svg>
                    Cancel
                </button>


                <a href="{{ route('meditationPage.history') }}"
                    class="flex items-center bg-gray-600 text-white py-2 px-4 rounded-lg shadow hover:bg-gray-700 hover:shadow-lg transition duration-200">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="currentColor">
                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V7h2v2z" />
                    </svg>
                    History
                </a>
            </div>
        </div>
        <br>
        <div class="container mx-auto mt-3 mb-4">
            <div class="flex flex-col gap-3">
                @forelse ($meditations as $meditation)
                    <div style="width: 100%;">
                        <div
                            class="bg-customBlue shadow-md rounded-lg p-4 flex flex-row items-center transition-shadow transition-transform ease-in-out  duration-300 hover:shadow-lg hover:-translate-y-1 border-2 border-black">

                            @if ($meditation->logo)
                                <img src="{{ asset($meditation->logo) }}" class="h-24 w-24 object-cover rounded-md mr-4"
                                    alt="Meditate Logo">
                            @endif

                            <div class="meditation-container w-full">

                                <h5 class="text-white text-lg font-semibold">{{ $meditation->name }}</h5>

                                <div class="flex justify-between text-gblack mt-4 w-full mb-4">
                                    <div>
                                        <p class="text-white font-semibold">
                                            Target: {{ $meditation->target_timer }}
                                        </p>
                                    </div>
                                    <div class="flex-1 mx-4 mt-1.5 relative w-full">
                                        
                                        @php
                                            $timerParts = explode(':', $meditation->timer);
                                            $timerInSeconds = $timerParts[0] * 3600 + $timerParts[1] * 60 + $timerParts[2];
    
                                            $targetParts = explode(':', $meditation->target_timer);
                                            $targetTimeInSeconds =
                                                $targetParts[0] * 3600 + $targetParts[1] * 60 + $targetParts[2];
    
                                            $progressPercentage = $targetTimeInSeconds
                                                ? ($timerInSeconds / $targetTimeInSeconds) * 100
                                                : 0;
                                        @endphp
        
                                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-md">
       
                                            <div class="h-4 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full transition-all duration-300 ease-out"
                                                style="width: {{ $progressPercentage }}%;">
                 
                                                <span style="top: -2px;"
                                                    class="text-xs text-black absolute right-0 pr-2">{{ round($progressPercentage) }}%</span>
                                            </div>
                                        </div>                              
                                    </div>
                                    <div>
                                        <p class="text-white font-semibold">Status: {{ $meditation->status }}</p>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                {{-- <div class="progress mb-3" style="height: 20px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $progressPercentage }}%;"
                                        aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ round($progressPercentage) }}%
                                    </div>
                                </div> --}}

                                <div class="container flex justify-center items-center gap-4">
                                    <form action="{{ route('meditation.counter', $meditation->id) }}" method="GET">
                                        <button type="submit"
                                            class="font-semibold flex items-center bg-themeLighter text-white py-2 px-4 rounded-lg shadow hover:bg-blue-700 hover:shadow-lg transition duration-200 border-black border-1">
                                            Start
                                        </button>
                                    </form>

                                    <button type="submit" data-bs-toggle="modal"
                                        data-bs-target="#confirmDeleteModal{{ $meditation->id }}"
                                        class="font-semibold hidden flex items-center bg-red-400 text-white py-2 px-4 rounded-lg shadow hover:bg-red-600 hover:shadow-lg transition duration-200 border-black border-1"
                                        id="del-session-{{ $meditation->id }}">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                        
     
                                <div class="modal fade" id="confirmDeleteModal{{ $meditation->id }}" tabindex="-1"
                                    aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this Meditation Session?
                                            </div>
                                            <div class="modal-footer">
               
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>

        
                                                <form action="{{ route('meditation.delete', $meditation->id) }}"
                                                    method="GET" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="updateProgressModal{{ $meditation->id }}" tabindex="-1"
                                    aria-labelledby="updateProgressModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateProgressModalLabel">Update Progress</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('updateProgress', $meditation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="mb-3">
                                                        <label for="progress" class="form-label">Add Progress</label>
                                                        <input type="number" class="form-control" id="progress"
                                                            name="progress" min="1"
                                                            max="{{ $meditation->target - $meditation->progress }}"
                                                            required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>
                @empty
                    <h1 class="mx-auto font-bold text-xl text-white">There is no Meditation session. Click the plus button
                        to add your session!</h1>
                @endforelse
            </div>

        </div>
    </div>
    <div>
        {{ $meditations->links('vendor.pagination.custom') }}
    </div>


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

                        {{-- <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
                        </div> --}}

                        <div class="mb-3">
                            <label for="timer">Durasi Waktu (Minutes):</label>
                            <input type="number" id="target_timer" name="target_timer" placeholder="minutes" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Meditation</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showCancelButton() {
            document.getElementById('cancel-btn').classList.remove('hidden');
            document.getElementById('delete-btn').classList.add('hidden');
            let deleteButtons = document.querySelectorAll('[id^="del-session-"]');
            deleteButtons.forEach(button => button.classList.remove('hidden'));
        }

        function showDeleteButton() {
            document.getElementById('cancel-btn').classList.add('hidden');
            document.getElementById('delete-btn').classList.remove('hidden');
            let deleteButtons = document.querySelectorAll('[id^="del-session-"]');
            deleteButtons.forEach(button => button.classList.add('hidden'));
        }
    </script>


@endsection
