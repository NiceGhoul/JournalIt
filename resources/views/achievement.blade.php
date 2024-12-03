@extends('components.layout')
@section('title', 'Achievement')

@section('content')

<div class="min-h-screen bg-customDark text-white p-4">
    <h1 class="text-3xl font-bold text-center mb-6">Achievements</h1>

    <!-- Tabs for Unlocked and Locked Achievements -->
    <div class="flex justify-center mb-6">
        <button 
            id="unlocked-tab" 
            class="px-6 py-2 mx-2 text-lg font-medium text-white bg-themeLight hover:bg-theme rounded-lg focus:outline-none"
            onclick="toggleTab('unlocked')">
            Unlocked Achievements
        </button>
        <button 
            id="locked-tab" 
            class="px-6 py-2 mx-2 text-lg font-medium text-white bg-themeLight hover:bg-theme rounded-lg focus:outline-none"
            onclick="toggleTab('locked')">
            All Achievements
        </button>
    </div>

    <!-- Unlocked Achievements Grid -->
    <div id="unlocked-achievements" class="grid grid-cols-1 sm:grid-cols-3 gap-6 hidden">
        @if($unlockedAchievements->isEmpty()) 
            <div class="col-span-full text-center text-gray-500">
                <p class="text-8xl">WOW SO EMPTY</p>
            </div>
        @else
            @foreach ($unlockedAchievements as $achievement)
                <div class="bg-themeLight hover:bg-theme shadow-lg rounded-lg p-3 flex flex-col justify-between h-full nav-link transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg">
                    @if ($achievement->logo)
                        <img src="{{ asset($achievement->logo) }}" alt="Achievement Logo" class="w-16 h-16 object-cover mb-4 mx-auto">
                    @endif
                    <h2 class="text-lg font-semibold text-gray-800 text-center">{{ $achievement->title }}</h2>
                    <p class="text-gray-600 mt-2 text-center">{{ $achievement->description }}</p>
                    <p class="text-gray-500 text-xs text-center mt-2">
                        Unlocked at: {{ $achievement->updated_at ? \Carbon\Carbon::parse($achievement->updated_at)->format('d-m-Y') : 'N/A' }}
                    </p>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Locked Achievements Grid -->
    <div id="locked-achievements" class="grid grid-cols-1 sm:grid-cols-3 gap-6 hidden">
        @foreach ($allAchievements as $achievement)
            <div class="relative bg-themeLight hover:bg-theme shadow-lg rounded-lg p-3 flex flex-col justify-between h-full">
                <!-- Cek apakah achievement sudah diunlock oleh user -->
                @if ($achievement->users->where('id', Auth::id())->first() === null || 
                    $achievement->users->where('id', Auth::id())->first()->pivot->status !== 'Unlocked')
                    <!-- Jika achievement belum diunlock oleh user, tampilkan overlay -->
                    <div class="absolute inset-0 bg-gray-700 opacity-50 rounded-lg"></div>
                    <div class="absolute inset-0 flex justify-center items-center">
                        <p class="text-white text-lg font-semibold">Locked</p>
                    </div>
                @endif

                @if ($achievement->logo)
                    <img src="{{ asset($achievement->logo) }}" alt="Achievement Logo" class="w-16 h-16 object-cover mb-4 mx-auto">
                @endif

                <h2 class="text-lg font-semibold text-gray-800 text-center">{{ $achievement->title }}</h2>
                <p class="text-gray-600 mt-2 text-center">{{ $achievement->description }}</p>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Function to toggle between unlocked and locked achievements
    function toggleTab(tab) {
        // Hide both tabs
        document.getElementById('unlocked-achievements').classList.add('hidden');
        document.getElementById('locked-achievements').classList.add('hidden');
        
        // Show the selected tab
        if (tab === 'unlocked') {
            document.getElementById('unlocked-achievements').classList.remove('hidden');
            document.getElementById('unlocked-tab').classList.add('bg-themeLight');
            document.getElementById('unlocked-tab').classList.remove('bg-gray-600');
            document.getElementById('locked-tab').classList.add('bg-gray-600');
            document.getElementById('locked-tab').classList.remove('bg-themeLight');
        } else if (tab === 'locked') {
            document.getElementById('locked-achievements').classList.remove('hidden');
            document.getElementById('locked-tab').classList.add('bg-themeLight');
            document.getElementById('locked-tab').classList.remove('bg-gray-600');
            document.getElementById('unlocked-tab').classList.add('bg-gray-600');
            document.getElementById('unlocked-tab').classList.remove('bg-themeLight');
        }
    }

    // Default to show unlocked achievements
    document.addEventListener('DOMContentLoaded', function () {
        toggleTab('unlocked');
    });
</script>

@endsection
