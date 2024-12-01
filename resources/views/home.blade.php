@extends('components.layout')

@section('title', 'Home')

@section('content')
    
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('image/earth.jpg') }}" class="d-block w-100 h-[50%]" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('image/international.jpg') }}" class="d-block w-100 h-[50%]" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('image/nutrition.jpg') }}" class="d-block w-100 h-[50%]" alt="...">
            </div>
        </div>
    </div>

<div class="bg-customDark">

    <div>
        <h2>Today's To-Do List</h2>
        <div class="d-flex flex-column gap-3">
            @forelse ($todayToDos as $todo)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $todo->name }}</h5>
                        <p class="card-text">
                            Target: {{ $todo->target }} <br>
                            Status: {{ $todo->status }}
                        </p>
                    </div>
                </div>
            @empty
                <p>No to-dos for today.</p>
            @endforelse
        </div>

        <h2 class="mt-5">This Week's To-Do List</h2>
        <div class="d-flex flex-column gap-3">
            @forelse ($weekToDos as $todo)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $todo->name }}</h5>
                        <p class="card-text">
                            Target: {{ $todo->target }} <br>
                            Status: {{ $todo->status }}
                        </p>
                    </div>
                </div>
            @empty
                <p>No to-dos for this week.</p>
            @endforelse
        </div>

        <h2 class="mt-5">This Month's To-Do List</h2>
        <div class="d-flex flex-column gap-3">
            @forelse ($monthToDos as $todo)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $todo->name }}</h5>
                        <p class="card-text">
                            Target: {{ $todo->target }} <br>
                            Status: {{ $todo->status }}
                        </p>
                    </div>
                </div>
            @empty
                <p>No to-dos for this month.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
