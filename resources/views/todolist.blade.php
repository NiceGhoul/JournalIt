@extends('components.layout')

@section('title', 'To Do List')

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

        <div class="flex justify-between items-center pb-4 border-b border-gray-600">
            <h1 class="text-2xl font-bold text-white ">To Do List</h1>
            <div class="flex space-x-4">
                <div class="container flex justify-end items-center gap-4 "> <!-- Set margin to 0 -->
                    <!-- Add Button with Icon -->
                    <button type="button"
                        class="flex items-center bg-blue-600 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-700 hover:shadow-lg transition duration-200"
                        data-bs-toggle="modal" data-bs-target="#addToDoModal">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z" />
                        </svg>
                        Add
                    </button>

                    <!-- History Button with Icon -->
                    <a href="{{ route('ToDoListHistory') }}"
                        class="flex items-center bg-gray-600 text-white py-2 px-4 rounded-lg shadow hover:bg-gray-700 hover:shadow-lg transition duration-200">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zm1 11H9v-2h2v2zm0-4H9V7h2v2z" />
                        </svg>
                        History
                    </a>
                </div>
            </div>
        </div>
        <div class="container mx-auto mt-3 mb-4 ">
            <div class="flex flex-col gap-3">
                @forelse ($toDoLists as $todo)
                    <div
                        class="bg-customBlue shadow-md rounded-lg p-4 flex flex-row items-start transition-shadow duration-300 hover:shadow-lg border-3 border-black">
                        <!-- Image -->
                        @if ($todo->logo)
                            <img src="{{ asset($todo->logo) }}"
                                class="h-24 w-24 object-cover rounded-md mr-4 border-3 border-black" alt="ToDo Logo">
                        @endif

                        <!-- Content -->
                        <div class="todo-container w-full">
                            <!-- Todo Name -->
                            <h5 class="text-lg font-semibold">{{ $todo->name }}</h5>

                            <!-- To-Do Date (Below the Name) -->
                            <p class="text-black">
                                To Do Date: {{ \Carbon\Carbon::parse($todo->to_do_date)->format('F j, Y') }}
                            </p>

                            <!-- Flex Row for Target, Progress, and Status -->
                            <div class="flex justify-between text-gblack mt-2 w-full">
                                <!-- Target -->
                                <div class="mr-4">
                                    <p>Target: {{ $todo->target }}</p>
                                </div>

                                <!-- Progress Bar -->
                                @php
                                    $progressPercentage = $todo->progress ? ($todo->progress / $todo->target) * 100 : 0;
                                @endphp
                                <div class="flex-1 mx-4 mt-1.5 relative w-full">
                                    <!-- Outer container for the progress bar -->
                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden shadow-md">
                                        <!-- Inner progress bar with gradient, smooth transition, and rounded corners -->
                                        <div class="h-3 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full transition-all duration-300 ease-out"
                                            style="width: {{ $progressPercentage }}%;">
                                            <!-- Percentage text inside the progress bar -->
                                            <span style="top: -2px;"class="text-xs text-black absolute right-0 pr-2">{{ round($progressPercentage) }}%</span>
                                        </div>
                                    </div>
                                </div>


                                <!-- Status -->
                                <div>
                                    <p>Status: {{ $todo->status }}</p>
                                </div>
                            </div>

                            <!-- Update Progress Button -->
                            <button type="button" class="btn btn-primary mt-2  border-3 border-black"
                                data-bs-toggle="modal" data-bs-target="#updateProgressModal{{ $todo->id }}">
                                Update Progress
                            </button>
                            <!-- Delete Todo Button (Trigger Modal) -->
                            <button type="button" class="btn btn-danger mt-2 ml-4 border-3 border-black"
                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $todo->id }}">
                                Delete Todo List
                            </button>

                            <!-- Modal for Delete Confirmation -->
                            <div class="modal fade" id="confirmDeleteModal{{ $todo->id }}" tabindex="-1"
                                aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this Todo list?
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Cancel Button -->
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>

                                            <!-- Delete Confirmation Button -->
                                            <form action="{{ route('DeleteToDoList', $todo->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


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
                @empty
                    <h1 class="text-center text-gray-700">There is no to-do list. Click the plus button to add your to-do!
                    </h1>
                @endforelse
            </div>
        </div>
        <div>
            {{ $toDoLists->links('vendor.pagination.custom') }}
        </div>

        <!-- Modal for Adding To-Do -->
        <div class="modal fade" id="addToDoModal" tabindex="-1" aria-labelledby="addToDoModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-lg shadow-lg">
                    <div class="modal-header border-b-2 border-gray-200">
                        <h5 class="modal-title text-lg font-semibold" id="addToDoModalLabel">Add New To-Do</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-6">
                        <form action="{{ route('AddToDoList') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                    id="name" name="name" required>
                            </div>
                            <div class="mb-4">
                                <label for="to_do_date" class="block text-sm font-medium text-gray-700">To-Do Date</label>
                                <input type="date"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                    id="to_do_date" name="to_do_date" required>
                            </div>
                            <div class="mb-4">
                                <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                                <input type="file"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                    id="logo" name="logo" accept="image/*">
                            </div>
                            <div class="mb-4">
                                <label for="target" class="block text-sm font-medium text-gray-700">Target</label>
                                <input type="number"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                    id="target" name="target" min="1" required>
                            </div>
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-2 rounded-md shadow hover:bg-blue-700 transition duration-200">Add
                                To-Do</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
