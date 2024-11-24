@extends('components.layout')
@section('content')
    <div class="d-flex flex-column mb-2 mt-4 align-items-center">
        <div class="card" style="width: 25rem; height: 28rem;">
            <div class="card-body d-flex flex-column align-items-center position-relative">
                <!-- Profile Picture -->
                <img src="{{ asset($user->profile_picture) }}" class="card-img-top rounded-circle mb-3" style="height: 15rem; width:15rem" alt="Profile Picture" id="profilePicture">
                <!-- Pen Icon Button -->
                <button class="btn btn-light rounded-circle position-absolute" style="top: 10px; right: 10px;"
                    onclick="document.getElementById('uploadPicture').click()">
                    <i class="bi bi-pencil-fill" style="color: black;"></i>
                </button>

                <!-- Hidden File Input -->
                <form id="uploadForm" action="/upload-profile-picture" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="uploadPicture" name="profile_picture" accept="image/*" style="display: none;"
                        onchange="previewImage(event)">
                </form>

                <!-- User Name -->
                <h5 class="card-title text-center">{{ $user->name }}</h5>
            </div>

            <!-- List Group -->
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Age: {{ $user->age }}</li>
                <li class="list-group-item">Email: {{ $user->email }}</li>
                <li class="list-group-item">Gender: {{ ucfirst($user->gender) }}</li>
            </ul>
        </div>
        <div class="card mt-4">
            <div class="card-header" style="width: 92rem;">
                Achievement
            </div>
            <div class="card-body" style="height: 10rem;">
                <h5 class="card-title">Special title treatment</h5>
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

                // Automatically submit the form after selecting a file
                form.submit();
            }
        }
    </script>
@endsection
