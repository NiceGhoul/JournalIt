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
    <div class="row flex flex-row gx-5 ml-3 mr-3">
        <div class="col-md-3 d-flex flex-column">
            <div class="card text-center bg-theme hover:bg-theme border-3 border-white transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg text-white h-100 border border-b-2">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="flex flex-col justify-center align-items-center mb-4 mt-10">
                        <img src="{{ asset($user->profile_picture) }}" 
                             class="rounded-circle mb-3 border-4" 
                             style="height: 200px; width: 200px;" 
                             alt="Profile Picture" 
                             id="profilePicture">
                             <form id="uploadForm" action="/upload-profile-picture" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" id="uploadPicture" name="profile_picture" accept="image/*" class="hidden" onchange="previewImage(event)">
                                <button type="button" class="bg-themeLighter hover:bg-blue-600 text-white py-1 px-3 rounded-full border-2 text-sm" onclick="document.getElementById('uploadPicture').click()">
                                    <i class="bi bi-pencil"></i> Edit Picture
                                </button>
                            </form>
                        <h4 class="mt-3 text-3xl font-bold">{{ $user->name }}</h4>
                    </div>

                    <div class="flex flex-col bg-themeLight text-white p-4 font-bold border-3 gap-3 text-left text-md rounded-lg w-100">
                        <span>Age: {{ $user->age }}</span>
                        <span>Email: {{ $user->email }}</span>
                        <span>Gender: {{ ucfirst($user->gender) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9 d-flex flex-column">
            <div class="card mb-4 bg-theme hover:scale-105 hover:shadow-lg text-white border-3 border-white transition d-flex" id="bioCard" style="height: 250px;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="text-3xl font-bold">Bio</h5>

                    <div class="overflow-auto flex-grow-1" style="max-height: 150px;">
                        <p id="bioText">{{ $user->bio }}</p>
                    </div>
                    <button class="btn btn-outline-light btn-sm mt-2 align-self-start bg-themeLighter hover:bg-blue-600 hover:text-white border-2" id="editBioButton">Edit Bio</button>

                    <form id="editBioForm" action="{{ route('update.bio') }}" method="POST" style="display: none;" class="mt-2">
                        @csrf
                        <textarea name="bio" class="form-control mb-2" rows="3" required>{{ $user->bio }}</textarea>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                        <button type="button" class="btn btn-outline-light btn-sm bg-red-500 border-0 hover:bg-red-700 hover:text-white" id="cancelEditBio">Cancel</button>
                    </form>
                </div>
            </div>

            <div class="card mb-4 bg-theme transition-transform duration-300 ease-in-out border-3 border-white hover:scale-105 hover:shadow-lg text-white border border-b-2">
                <div class="card-body">
                    <h5 class="text-3xl font-bold">Quotes for you</h5>
                    <p class="font-bold text-yellow-400 text-xl">Fortis Fortuna Adiuvat</p>
                </div>
            </div>

            <div class="card border-3 border-white bg-theme transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg text-white border border-b-2 flex-grow-1">
                <div class="card-body">
                    <h5 class="text-3xl font-bold mb-4">Latest Achievements</h5>

                    @if($latestAchievements->isEmpty())
                        <p><i class="bi bi-trophy"></i> No achievements unlocked yet.</p>
                    @else
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach($latestAchievements as $achievement)
                            <div class="col">
                                    <a href="{{ route('achievementPage') }}" class="d-block">
                                    <div class="card nav-link transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg bg-themeLight text-white shadow-lg border-1 border-white rounded">
                                        <div class="card-body d-flex flex-column align-items-center">
                                            @if($achievement->logo)
                                                
                                                    <img src="{{ asset($achievement->logo) }}" 
                                                         class="card-img-top mb-3" 
                                                         alt="Achievement Logo" 
                                                         style="height: 100px; width: 100px; object-fit: contain;">
                                                
                                            @endif
                                            <h6 class="card-title text-center text-yellow-400 text-lg font-bold">{{ $achievement->title }}</h6>
                                        </div>
                                    </div>
                                </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
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
    document.getElementById('editBioButton').addEventListener('click', function () {
        document.getElementById('bioText').style.display = 'none';
        document.getElementById('editBioButton').style.display = 'none';
        document.getElementById('editBioForm').style.display = 'block';
        document.getElementById('bioCard').classList.add('scale-105');
        document.getElementById('bioCard').classList.add('shadow-lg');
    });

    document.getElementById('cancelEditBio').addEventListener('click', function () {
        document.getElementById('bioText').style.display = 'block';
        document.getElementById('editBioButton').style.display = 'inline-block';
        document.getElementById('editBioForm').style.display = 'none';
        document.getElementById('bioCard').classList.remove('scale-105');
        document.getElementById('bioCard').classList.remove('shadow-lg');
    });
</script>
@endsection
