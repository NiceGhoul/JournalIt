@extends('components.layout')

@section('content')

<div class="min-h-screen bg-customDark text-white p-4">
    <h1 class="text-3xl font-bold text-center mb-6">Achievements</h1>

    <!-- Tabs for Unlocked and Locked Achievements -->
    <div class="flex justify-center mb-6">
        <button 
            id="unlocked-tab" 
            class="px-6 py-2 mx-2 text-lg font-medium text-white bg-blue-600 rounded-lg focus:outline-none"
            onclick="toggleTab('unlocked')">
            Unlocked Achievements
        </button>
        <button 
            id="locked-tab" 
            class="px-6 py-2 mx-2 text-lg font-medium text-white bg-gray-600 rounded-lg focus:outline-none"
            onclick="toggleTab('locked')">
            All Achievements
        </button>
    </div>

    <!-- Unlocked Achievements Grid -->
    <div id="unlocked-achievements" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-12 hidden">
        @if($unlockedAchievements->isEmpty()) 
            <div class="col-span-full text-center text-gray-500">
                <p class="text-8xl">WOW SO EMPTY</p>
            </div>
        @else
            @foreach ($unlockedAchievements as $achievement)
                <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col justify-between">
                    @if ($achievement->logo)
                        <img src="{{ asset($achievement->logo) }}" alt="Achievement Logo" class="w-24 h-24 object-cover mb-4">
                    @endif
                    <h2 class="text-xl font-semibold text-gray-800">{{ $achievement->title }}</h2>
                    <p class="text-gray-600 mt-2">{{ $achievement->description }}</p>
                    <p>{{$achievement->updated_at}}</p>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Locked Achievements Grid -->
    <div id="locked-achievements" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-12 hidden">
            @foreach ($allAchievements as $achievement)
                <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col justify-between">
                    @if ($achievement->logo)
                        <img src="{{ asset($achievement->logo) }}" alt="Achievement Logo" class="w-24 h-24 object-cover mb-4">
                    @endif
                    <h2 class="text-xl font-semibold text-gray-800">{{ $achievement->title }}</h2>
                    <p class="text-gray-600 mt-2">{{ $achievement->description }}</p>
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
            document.getElementById('unlocked-tab').classList.add('bg-blue-600');
            document.getElementById('unlocked-tab').classList.remove('bg-gray-600');
            document.getElementById('locked-tab').classList.add('bg-gray-600');
            document.getElementById('locked-tab').classList.remove('bg-blue-600');
        } else if (tab === 'locked') {
            document.getElementById('locked-achievements').classList.remove('hidden');
            document.getElementById('locked-tab').classList.add('bg-blue-600');
            document.getElementById('locked-tab').classList.remove('bg-gray-600');
            document.getElementById('unlocked-tab').classList.add('bg-gray-600');
            document.getElementById('unlocked-tab').classList.remove('bg-blue-600');
        }
    }

    // Default to show unlocked achievements
    document.addEventListener('DOMContentLoaded', function () {
        toggleTab('unlocked');
    });
</script>

@endsection
