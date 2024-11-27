@extends('components.layout')
@section('content')
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

    <div class="container">
        <div class="d-flex flex-column flex-wrap gap-3 mt-5">
            @forelse ($toDoLists as $todo)
                <div class="card mb-3" style="width: 100%;">
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
                                Target: {{ $todo->target }} <br>
                                Status: {{ $todo->status }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <h1 class="mx-auto">There is to-do list history!</h1>
            @endforelse
        </div>

    </div>
@endsection
