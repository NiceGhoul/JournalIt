@extends('components.layout')

@section('title', 'Meditation Counter')

@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>

        @yield('content')
    

    @php
        $timerParts = explode(':', $meditation->timer);
        $timerInSeconds = $timerParts[0] * 3600 + $timerParts[1] * 60 + $timerParts[2];

        $targetParts = explode(':', $meditation->target_timer);
        $targetTimeInSeconds = $targetParts[0] * 3600 + $targetParts[1] * 60 + $targetParts[2];

        $remainingTime = $targetTimeInSeconds - $timerInSeconds;
        // dd($meditation->timer, $meditation->target_timer, $timerInSeconds, $targetTimeInSeconds, $remainingTime);
    @endphp



    <div class="min-h-screen bg-gray-900 text-white flex items-center justify-center">

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

        <div class="text-center space-y-8">
            <button class="text-3xl font-bold">Meditation Counter</button>
            <div class="relative flex items-center justify-center w-64 h-64">

                <svg class="absolute w-full h-full transform ml-40 -rotate-90" viewBox="0 0 100 100">

                    <circle cx = "50" cy = "50" r="45" stroke="#2d3748" stroke-width="5" fill="none"></circle>

                    <circle id="progress-circle" cx="50" cy="50" r="45" stroke="#4a90e2" stroke-width="5"
                        fill="none" stroke-dasharray="282.6" stroke-dashoffset="282.6"></circle>
                </svg>
                <div id="circle-content" class="absolute text-center">
                    <button id="start-button" onclick="startMeditation()"
                        class="ml-40 px-4 py-2 rounded text-white font-bold">
                        Start Meditation
                    </button>
                    <div id="timer" class="ml-40 hidden text-5xl font-bold">{{ gmdate('H:i:s', $remainingTime) }}</div>
                </div>
            </div>


            <div class="flex items-center justify-center gap-4">
                <button onclick="adjustTime(-60)" class="text-4xl px-4 py-2 hover:bg-gray-800 rounded">
                    << </button>
                        <button onclick="adjustTime(-1)"
                            class="text-4xl px-4 py-2 hover:bg-gray-800 rounded align-middle">-</button>
                        <div id="timer" class="hidden text-5xl font-bold">{{ gmdate('H:i:s', $remainingTime) }}</div>
                        <button onclick="adjustTime(1)"
                            class="text-4xl px-4 py-2 hover:bg-gray-800 rounded align-middle">+</button>
                        <button onclick="adjustTime(60)" class="text-4xl px-4 py-2 hover:bg-gray-800 rounded">>></button>
            </div>
            <button onclick="stopMeditations()" class="px-6 py-3 hover:bg-gray-800 rounded text-white font-bold">
                Stop Meditation
            </button>

        </div>
    </div>

    </div>
    </div>

</body>

    <script>

        let duration = @json($remainingTime);
        let initialDuration = duration;
        let timer = null;

        function adjustTime(value) {
            duration += value;
            if (duration < 0) duration = 0;

            const minutes = String(Math.floor(duration / 60)).padStart(2, '0');
            const seconds = String(duration % 60).padStart(2, '0');
            document.getElementById('timer').innerText = `${minutes}:${seconds}`;

            updateProgressCircle();
        }

        function startMeditation() {

            document.getElementById('timer').classList.remove('hidden');
            document.getElementById('start-button').classList.add('hidden');

            timer = setInterval(() => {
                if (duration > 0) {
                    duration--;
                    adjustTime(0);
                } else {
                    clearInterval(timer);
                    stopMeditation();
                }
            }, 1000);

            fetch(`/meditation/{{ $meditation->id }}/start`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });
        }

        function stopMeditations() {
    clearInterval(timer);

    document.getElementById('timer').classList.add('hidden');
    document.getElementById('start-button').classList.remove('hidden');

    const status = duration === 0 ? 'completed' : 'ongoing';

    fetch(`/meditation/{{ $meditation->id }}/stop`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            status: status,
            time_remaining: duration,
        }),
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error('Failed to stop meditation');
            }
            return response.json();
        })
        .then((data) => {
            console.log(data.message);
        })
        .catch((error) => {
            console.error('Error in stopMeditations:', error);
        });
}


        function updateProgressCircle() {
            const progressCircle = document.getElementById('progress-circle');
            const circumference = 2 * Math.PI * 45;
            const progress = duration / initialDuration;

            // Calculate stroke-dashoffset for progress
            const offset = circumference * (1 - progress);
            progressCircle.style.strokeDashoffset = offset;
        }
    </script>

@endsection
