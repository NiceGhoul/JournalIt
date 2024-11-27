
<nav class="navbar-custom w-full">
    <div class="container mx-auto flex flex-wrap items-center justify-between py-2">
        <a href="{{ route('homePage') }}" class="text-white text-lg font-bold">
            Jurnalit Logo
        </a>


        <button id="navbarToggle" class="lg:hidden text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        @auth
        <div id="navbarMenu" class="hidden w-full lg:flex lg:w-auto lg:items-center p-2">
            <ul class="flex flex-col lg:flex-row lg:space-x-6">
                <li>
                    <a href="{{ route('homePage') }}" class="nav-link">Home</a>
                </li>
                <li>
                    <a href="{{ route('meditationPage') }}" class="nav-link">Meditate</a>
                </li>
                <li>
                    <a href="{{ route('ToDoList') }}" class="nav-link">To-do List</a>
                </li>
                <li>
                    <a href="#" class="nav-link">Analytics</a>
                </li>
                <li>
                    <a href="#" class="nav-link">Achievements</a>
                </li>
            </ul>
        </div>

        
        <div class="profile-box">
            <div class="profile-img">
                <img src="{{ asset(auth()->user()->profile_picture) }}" alt="Profile">
            </div>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle text-black" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="{{ route('ProfilePage') }}">Profile Page</a></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
        @endauth

        @guest
        <div class="flex space-x-4 p-2 bg-blue-400 rounded-lg m-2 transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
            @if (Route::currentRouteName() == 'login')
            <a href="{{ route('showRegister') }}" class="nav-link text-white ">Register</a>
            @else
            <a href="{{ route('login') }}" class="nav-link text-white">Login</a>
            @endif
        </div>
        @endguest
    </div>
</nav>
<script>
    const navbarToggle = document.getElementById("navbarToggle");

    navbarToggle.addEventListener("click", () => {
        navbarMenu.classList.toggle("hidden");
    });
</script>
