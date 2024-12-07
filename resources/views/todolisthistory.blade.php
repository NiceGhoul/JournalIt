@extends('components.layout')

@section('title', 'To Do List History')

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
            <h1 class="text-2xl font-bold text-white ">To Do List History</h1>
            <div class="flex space-x-4">
                <div class="container flex justify-end items-center gap-4 ">
                    <button type="button" onclick="window.location.href='/todolist';"
                        class="flex items-center bg-gray-600 text-white py-2 px-4 rounded-lg shadow hover:bg-gray-700 hover:shadow-lg transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm-1 11H7v-2h2v2zm0-4H7V7h2v2z" />
                            <path d="M9 10l-4-4 4 4-4 4 4-4z" />
                        </svg>
                        Back
                    </button>
                </div>
            </div>
        </div>
        <div class="container mx-auto">
            <div class="flex flex-col gap-4 mt-5">
                @forelse ($toDoLists as $todo)
                    <div
                        class="bg-customBlue shadow-md rounded-lg p-4 flex flex-row items-center transition-shadow transition-transform ease-in-out  duration-300 hover:shadow-lg hover:-translate-y-1 border-3 border-black">
                        <!-- Image -->
                        @if ($todo->logo)
                            <img src="{{ asset($todo->logo) }}" class="h-24 w-24 object-cover rounded-md mr-4"
                                alt="ToDo Logo">
                        @endif

                        <!-- Content -->
                        <div class="flex-1">
                            <h5 class="text-lg text-white font-bold">{{ $todo->name }}</h5>
                            <p class="text-white">
                                Target: {{ $todo->target }} <br>
                                Status: {{ $todo->status }}
                            </p>
                        </div>
                    </div>
                @empty
                    <h1 class="text-center text-lg font-semibold text-gray-700">There is no to-do list history!</h1>
                @endforelse
            </div>
        </div>
       
    </div>
    <div>
        {{ $toDoLists->links('vendor.pagination.custom') }}
    </div>
@endsection
