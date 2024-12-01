@extends('components.layout')

@section('title', 'Profile')

@section('content')
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

<div class="container-fluid py-5 bg-customDark text-white min-vh-100 d-flex flex-column">
    <div class="row flex-grow-1">

        <div class="col-md-3 d-flex flex-column">
            <div class="card text-center bg-theme text-white h-100 border border-b-2" >
                <div class="card-body d-flex flex-column align-items-center">

                    <div class="flex flex-col justify-center align-items-center mb-4">
                        <img src="{{ asset($user->profile_picture) }}" 
                             class="rounded-circle mb-3" 
                             style="height: 150px; width: 150px;" 
                             alt="Profile Picture" 
                             id="profilePicture">
                        <form id="uploadForm" action="/upload-profile-picture" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" id="uploadPicture" name="profile_picture" accept="image/*" style="display: none;" onchange="previewImage(event)">
                            <button type="button" class="btn btn-light btn-sm rounded-pill" onclick="document.getElementById('uploadPicture').click()">
                                <i class="bi bi-pencil"></i> Edit Picture
                            </button>
                        </form>
                        <h4 class="mt-3 text-3xl font-bold">{{ $user->name }}</h4>
                    </div>
        
                    <div class="flex flex-col text-white p-4 border border-b-2 gap-3 text-left text-md rounded-lg w-100">
                        <span>Age: {{ $user->age }}</span>
                        <span>Email: {{ $user->email }}</span>
                        <span>Gender: {{ ucfirst($user->gender) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-9 d-flex flex-column ">
            <div class="d-flex flex-grow-1">
                <div class="card bg-theme text-white flex-grow-1 me-2 max-w-[50%] border border-b-2">
                    <div class="card-body">
                        <h5 class="text-3xl font-bold">Bio</h5>
                        <p>{{ $user->bio }}</p>
                    </div>
                </div>

                <div class="card bg-theme text-white flex-grow-1 ms-2 max-w-[50%] border border-b-2">
                    <div class="card-body">
                        <h5 class="text-3xl font-bold">Random Quote</h5>
                        <p>Fortis Fortuna Adiuvat</p>
                    </div>
                </div>
            </div>

            <div class="card bg-theme text-white flex-grow-1 mt-4">
                <div class="card-body border border-b-2">
                    <h5 class="text-3xl font-bold">Achievement</h5>
                    <p><i class="bi bi-trophy"></i> Special achievement details can go here.</p>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const form = document.getElementById('uploadForm');
        const fileInput = event.target;
        const file = fileInput.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profilePicture').src = e.target.result;
            };
            reader.readAsDataURL(file);

            form.submit();
        }
    }
</script>
@endsection
