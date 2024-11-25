<style>
    /* Override Bootstrap Navbar Styles */
    .navbar {
        background-color: #0674B4 !important; /* Bootstrap primary blue */
        color: white;
    }
    .navbar .navbar-nav .nav-link {
        color: white; /* Ensures nav links are visible against the blue background */
    }
    .navbar .navbar-brand {
        color: white;
    }
    .navbar .btn-outline-success {
        color: white;
        border-color: white;
    }
    .navbar .btn-outline-success:hover {
        background-color: white;
        color: #007bff;
    }
    .navbar .navbar-toggler {
        border-color: white;
    }
    .navbar .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(255, 255, 255, 1)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
    .profile-btn {
        display: inline-flex;
        align-items: center;
        background-color: #0674B4;
        border-radius: 25px;
        padding: 5px 15px;
        color: white;
        text-decoration: none;
    }
    .profile-img {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        margin: 0.5rem;
    }
    .profile-img img {
        height: 100%;
        width: auto;
        min-width: 100%;
        object-fit: cover;
    }
</style>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('homePage')}}">(Logo Disini)</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('homePage')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('meditationPage')}}">Meditate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">To-Do List</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Analytics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Achievements</a>
                </li>
            </ul>
            <div class="ms-auto">
                <div class="profile-box bg-success rounded-pill d-inline-flex">
                    <div class="profile-img">
                        <img src="{{asset('image/DefaultProfile.jpg')}}" alt="Profile Image" class="rounded-circle">
                    </div>
                    <ul class="navbar-nav align-self-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Profile
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('ProfilePage') }}">Profile Page</a></li>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                           Logout
                                        </a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endauth
                                @guest
                                    <li><a class="dropdown-item" href="{{ route('showRegister') }}">Register</a></li>
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                @endguest
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>