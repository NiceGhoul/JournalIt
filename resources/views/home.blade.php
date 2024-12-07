@extends('components.layout')

@section('title', 'Home')

@section('css')
    <style>
        .carousel-image {
            height: 30vh;
            object-fit: cover;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="bg-customDark text-white min-h-screen">
        <div id="carouselExampleSlidesOnly" class="carousel slide relative" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('image/earth.jpg') }}" class="d-block w-full carousel-image" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/international.jpg') }}" class="d-block w-full carousel-image" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('image/nutrition.jpg') }}" class="d-block w-full carousel-image" alt="...">
                </div>
            </div>

        </div>


        <div class="container mx-auto px-4 py-8">

            <h2 class="text-xl font-bold mb-4">Complete Now!</h2>
            <div class="flex flex-wrap gap-4">
                @forelse ($todayToDos as $todo)
                    <div class="bg-customDark border border-gray-700 rounded-lg p-3 w-full h-auto min-h-72 lg:w-60 relative transition-all duration-200 ease-in-out hover:shadow-custom hover:-translate-x-1 hover:-translate-y-1 hover:cursor-pointer"
                        style="box-shadow: none;">
                        <a href="{{ route('ToDoList') }}">
                            <div class="flex justify-between">
                                <span class="text-2xl font-bold mb-2">To do List</span>
                                <img src="{{ $todo->logo }}" alt=""
                                    style="width:40px; height:40px; border-radius:100%">
                            </div>
                            <p class="font-bold text-cardHome mt-2">{{ $todo->name }}</p>
                            <p class="font-bold mt-2"> {{ $todo->progress }}/{{ $todo->target }} done</p>
                            @php
                                $progressPercentage = $todo->progress ? ($todo->progress / $todo->target) * 100 : 0;
                            @endphp
                            <div class="progress mb-3 bg-customDark mt-2 border border-b-2" style="height: 20px;">
                                <div class="progress-bar bg-cardHome" role="progressbar"
                                    style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <span class="text-cardHomeText font-semibold">{{ round($progressPercentage) }}%</span>
                                </div>
                            </div>
                            <p class="font-bold text-cardHome mt-2">Due date: {{ $todo->to_do_date }}</p>

                            <button
                                class="bg-cardHome hover:bg-pink-600 hover:text-white text-cardHomeText text-sm font-semibold py-1 px-4 rounded absolute bottom-2 right-2">
                                Get done
                            </button>
                        </a>
                    </div>

                @empty
                    {{-- <p class="text-gray-400">No to-dos for today.</p> --}}
                @endforelse

                @forelse ($ongoingSession as $meditation)
                    <div class="bg-customDark border border-gray-700 rounded-lg p-3 w-full h-auto min-h-72 lg:w-60 relative transition-all duration-200 ease-in-out hover:shadow-custom hover:-translate-x-1 hover:-translate-y-1 hover:cursor-pointer"
                        style="box-shadow: none;">
                        <div class="flex justify-between">
                            <span class="text-2xl font-bold mb-2">Meditation</span>
                            <img src="{{ $meditation->logo }}" alt=""
                                style="width:40px; height:40px; border-radius:100%">
                        </div>
                        <p class="font-bold text-cardHome mt-2">{{ \Illuminate\Support\Str::limit($meditation->name, 35, '...') }}</p>
                        <p class="font-bold mt-2"> Target: {{ $meditation->target_timer }}</p>

                        @php
                            $timerParts = explode(':', $meditation->timer);
                            $timerInSeconds = $timerParts[0] * 3600 + $timerParts[1] * 60 + $timerParts[2];

                            $targetParts = explode(':', $meditation->target_timer);
                            $targetTimeInSeconds = $targetParts[0] * 3600 + $targetParts[1] * 60 + $targetParts[2];

                            $timeDifference = $targetTimeInSeconds - $timerInSeconds;

                            $progressPercentage = $targetTimeInSeconds
                                ? ($timerInSeconds / $targetTimeInSeconds) * 100
                                : 0;
                        @endphp

                        <div class="progress mb-3 bg-customDark mt-2 border border-b-2" style="height: 20px;">
                            <div class="progress-bar bg-cardHome" role="progressbar"
                                style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}"
                                aria-valuemin="0" aria-valuemax="100">
                                <span class="text-cardHomeText font-semibold">{{ round($progressPercentage) }}%</span>
                            </div>
                        </div>
                        <p class="font-bold text-cardHome mt-2">Remaining Time: {{ gmdate('H:i:s',$timeDifference)}}</p>
                        <form action="{{ route('meditation.counter', $meditation->id) }}" method="GET">
                            <button
                                class="bg-cardHome hover:bg-pink-600 hover:text-white text-cardHomeText text-sm font-semibold py-1 px-4 rounded absolute bottom-2 right-2">
                                continue
                            </button>
                        </form>
                    </div>

                @empty
                    {{-- <p class="text-gray-400">No to-dos for today.</p> --}}
                @endforelse

            </div>


            <h2 class="text-xl font-bold mt-10 mb-4">This Week</h2>
            <div class="flex flex-wrap gap-4">
                @forelse ($weekToDos as $todo)
                    <div class="bg-customDark border border-gray-700 rounded-lg p-3 w-full h-auto min-h-72 lg:w-60 relative transition-all duration-200 ease-in-out hover:shadow-custom hover:-translate-x-1 hover:-translate-y-1 hover:cursor-pointer"
                        style="box-shadow: none;">
                        <a href="{{ route('ToDoList') }}">
                            <div class="flex justify-between">
                                <span class="text-2xl font-bold mb-2">To do List</span>
                                <img src="{{ $todo->logo }}" alt=""
                                    style="width:40px; height:40px; border-radius:100%">
                            </div>
                            <p class="font-bold text-cardHome mt-2">{{ \Illuminate\Support\Str::limit($todo->name, 35, '...') }}</p>
                            <p class="font-bold mt-2"> {{ $todo->progress }}/{{ $todo->target }} done</p>
                            @php
                                $progressPercentage = $todo->progress ? ($todo->progress / $todo->target) * 100 : 0;
                            @endphp
                            <div class="progress mb-3 bg-customDark mt-2 border border-b-2" style="height: 20px;">
                                <div class="progress-bar bg-cardHome" role="progressbar"
                                    style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <span class="text-cardHomeText font-semibold">{{ round($progressPercentage) }}%</span>
                                </div>
                            </div>
                            <p class="font-bold text-cardHome mt-2">Due date: {{ $todo->to_do_date }}</p>

                            <button
                                class="bg-cardHome hover:bg-pink-600 hover:text-white text-cardHomeText text-sm font-semibold py-1 px-4 rounded absolute bottom-2 right-2">
                                Get done
                            </button>
                        </a>
                    </div>
                @empty
                    {{-- <p class="text-gray-400">No to-dos for this week.</p> --}}
                @endforelse
            </div>


            <h2 class="text-xl font-bold mt-10 mb-4">This Month</h2>
            <div class="flex flex-wrap gap-4">
                @forelse ($monthToDos as $todo)
                    <div class="bg-customDark border border-gray-700 rounded-lg p-3 w-full h-auto min-h-72 lg:w-60 relative transition-all duration-200 ease-in-out hover:shadow-custom hover:-translate-x-1 hover:-translate-y-1 hover:cursor-pointer"
                        style="box-shadow: none;">
                        <a href="{{ route('ToDoList') }}">
                            <div class="flex justify-between">
                                <span class="text-2xl font-bold mb-2">To do List</span>
                                <img src="{{ $todo->logo }}" alt=""
                                    style="width:40px; height:40px; border-radius:100%">
                            </div>
                            <p class="font-bold text-cardHome mt-2">{{ \Illuminate\Support\Str::limit($todo->name, 35, '...') }}</p>
                            <p class="font-bold mt-2"> {{ $todo->progress }}/{{ $todo->target }} done</p>
                            @php
                                $progressPercentage = $todo->progress ? ($todo->progress / $todo->target) * 100 : 0;
                            @endphp
                            <div class="progress mb-3 bg-customDark mt-2 border border-b-2" style="height: 20px;">
                                <div class="progress-bar bg-cardHome" role="progressbar"
                                    style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}"
                                    aria-valuemin="0" aria-valuemax="100">
                                    <span class="text-cardHomeText font-semibold">{{ round($progressPercentage) }}%</span>
                                </div>
                            </div>
                            <p class="font-bold text-cardHome mt-2">Due date: {{ $todo->to_do_date }}</p>

                            <button
                                class="bg-cardHome hover:bg-pink-600 hover:text-white text-cardHomeText text-sm font-semibold py-1 px-4 rounded absolute bottom-2 right-2">
                                Get done
                            </button>
                        </a>
                    </div>
                @empty
                    {{-- <p class="text-gray-400">No to-dos for this month.</p> --}}
                @endforelse
            </div>
        </div>
    </div>
@endsection
