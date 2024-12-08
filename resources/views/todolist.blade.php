@extends('components.layout')

@section('title', 'To Do List')

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
            <h1 class="text-2xl font-bold text-white">To Do List</h1>
            <div class="flex space-x-4">
                <div class="container flex justify-end items-center gap-4 "> 


                    <button type="button"
                        class="flex items-center bg-themeLighter text-white py-2 px-4 rounded-lg shadow hover:bg-blue-600 hover:shadow-lg transition duration-200"
                        data-bs-toggle="modal" data-bs-target="#addToDoModal">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 2a1 1 0 011 1v6h6a1 1 0 110 2h-6v6a1 1 0 11-2 0v-6H3a1 1 0 110-2h6V3a1 1 0 011-1z" />
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
                        class="bg-customBlue shadow-md rounded-lg p-4 flex flex-row items-start transition-all duration-300 ease-in-out hover:shadow-lg hover:-translate-y-1 border-2 border-black">

                        @if ($todo->logo)
                            <img src="{{ asset($todo->logo) }}"
                                class="h-24 w-24 object-cover rounded-md mr-4 border-3 border-black" alt="ToDo Logo">
                        @endif

   
                        <div class="todo-container w-full">
    
                            <h5 class="text-lg font-semibold text-white">{{ $todo->name }}</h5>

                            <p class="text-white font-semibold">
                                To Do Date: {{ \Carbon\Carbon::parse($todo->to_do_date)->format('F j, Y') }}
                            </p>

                            <div class="flex justify-between text-gblack mt-2 w-full">
     
                                <div class="mr-4 text-white font-semibold">
                                    <p>Target: {{ $todo->target }}</p>
                                </div>

           
                                @php
                                    $progressPercentage = $todo->progress ? ($todo->progress / $todo->target) * 100 : 0;
                                @endphp
                                <div class="flex-1 mx-4 mt-1.5 relative w-full">

                                    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden shadow-md">
    
                                        <div class="h-4 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full transition-all duration-300 ease-out"
                                            style="width: {{ $progressPercentage }}%;">
  
                                            <span style="top: -2px;"
                                                class="text-xs text-black absolute right-0 pr-2">{{ round($progressPercentage) }}%</span>
                                        </div>
                                    </div>
                                </div>


                                <div>
                                    <p class="font-semibold text-white">Status: {{ $todo->status }}</p>
                                </div>
                            </div>

                            <div class="container flex justify-center items-center gap-2 mt-4">

                                <button type="button" class="font-semibold flex items-center bg-themeLighter text-white py-2 px-2 rounded-lg shadow hover:bg-blue-600 hover:shadow-lg transition duration-200 border-black border-1"
                                    data-bs-toggle="modal" data-bs-target="#updateProgressModal{{ $todo->id }}">
                                    Update Progress
                                </button>
      
                                <button type="button"
                                    class="font-semibold hidden flex items-center bg-red-400 text-white py-2 px-2 rounded-lg shadow hover:bg-red-600 hover:shadow-lg transition duration-200 border-black border-1"
                                    id="del-todo-{{ $todo->id }}" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $todo->id }}">
                                    Delete Todo List
                                </button>
                            </div>

                            
                        </div>

                    </div>

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
                                    Are you sure you want to delete this TodoList?
                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

        
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
                                            <input type="number" class="form-control" id="progress" name="progress"
                                                min="1" max="{{ $todo->target - $todo->progress }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
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
                            {{-- <div class="mb-4">
                                <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                                <input type="file"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2"
                                    id="logo" name="logo" accept="image/*">
                            </div> --}}
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
    <div>
        {{ $toDoLists->links('vendor.pagination.custom') }}
    </div>

    <script>
        function showCancelButton() {
            document.getElementById('cancel-btn').classList.remove('hidden');
            document.getElementById('delete-btn').classList.add('hidden');
            let deleteButtons = document.querySelectorAll('[id^="del-todo-"]');
            deleteButtons.forEach(button => button.classList.remove('hidden'));
        }

        function showDeleteButton() {
            document.getElementById('cancel-btn').classList.add('hidden');
            document.getElementById('delete-btn').classList.remove('hidden');
            let deleteButtons = document.querySelectorAll('[id^="del-todo-"]');
            deleteButtons.forEach(button => button.classList.add('hidden'));
        }

        function showBackButton(){
            
        }
    </script>

@endsection
