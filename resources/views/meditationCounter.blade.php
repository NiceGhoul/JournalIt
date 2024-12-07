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
            // H : M : S 01:58:47
            $timerParts = explode(':', $meditation->timer);
            $timerInSeconds = $timerParts[0] * 3600 + $timerParts[1] * 60 + $timerParts[2];

            $targetParts = explode(':', $meditation->target_timer);
            $targetTimeInSeconds = $targetParts[0] * 3600 + $targetParts[1] * 60 + $targetParts[2];

            $remainingTime = $targetTimeInSeconds - $timerInSeconds;
            // dd($meditation->timer, $meditation->target_timer, $timerInSeconds, $targetTimeInSeconds, $remainingTime);
        @endphp



        <div class="min-h-screen bg-gray-900 text-white flex items-center justify-center">


            <div class="text-center space-y-8">
                <label class="text-3xl font-bold" for="title">Current Session:</label>
                <br>
                <label class="text-2xl font-bold" for="title">{{ $meditation->name }}</label>
                <div class="relative flex items-center justify-center w-full h-96">

                    <svg class="absolute w-96 h-full transform -rotate-90" viewBox="0 0 150 150">

                        <circle cx = "75" cy = "75" r="60" stroke="#2d3748" stroke-width="10" fill="none">
                        </circle>

                        <circle id="progress-circle" cx="75" cy="75" r="60" stroke="#4a90e2" stroke-width="10"
                            fill="none" stroke-dasharray="376.99" stroke-dashoffset="376.99"></circle>
                    </svg>
                    <div id="circle-content" class="absolute text-center">
                        <div id="timer" class="text-5xl font-bold">{{ gmdate('i:s', $remainingTime) }}
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-center gap-4">
                    <label id="stop-label" for="text" class="hidden text-2xl font-bold text-red-600">Stopped</label>
                </div>

                <div class="flex items-center justify-center gap-4">
                    <button id="start-button" onclick="startMeditation()"
                        class="text-2xl px-6 py-3 hover:bg-gray-800 rounded text-white font-bold border-solid border-white rounded-xl border-2 border-opacity-50">
                        Start Meditation
                    </button>

                    <button onclick="stopMeditations(), showStopLabel()"
                        class="text-2xl px-6 py-3 hover:bg-gray-800 rounded text-white font-bold border-solid border-white rounded-xl border-2 border-opacity-50">
                        Stop Meditation
                    </button>
                </div>


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
            document.getElementById('start-button').classList.add('hidden');
            document.getElementById('stop-label').classList.add('hidden');
            console.log('calling startMeditation');
            timer = setInterval(() => {
                if (duration > 0) {
                    duration--;
                    adjustTime(0);
                } else {
                    clearInterval(timer);
                    const timerContent = document.getElementById('circle-content');
                    timerContent.innerHTML = "<div class='text-3xl font-bold text-green-500'>Completed</div>";
                    console.log('calling stopMeditations');
                    stopMeditations();
                    console.log('stopMeditations called');
                }
            }, 1000);

            fetch(`/meditation/{{ $meditation->id }}/start`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
            });
        }

        function showStopLabel() {
            document.getElementById('stop-label').classList.remove('hidden');
        }

        function stopMeditations() {
            document.getElementById('start-button').classList.remove('hidden');
            console.log('calling stopMeditation');
            clearInterval(timer);

            console.log('calling fetch');
            fetch(`/meditation/{{ $meditation->id }}/stop`, {
                method: 'POST',
                headers: {

                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    // status: Status,
                    time_remaining: duration,
                }),

            });
        }

        function updateProgressCircle() {
            const progressCircle = document.getElementById('progress-circle');
            const circumference = 2 * Math.PI * 60;
            const progress = duration / initialDuration;

            const offset = circumference * (1 - progress);
            progressCircle.style.strokeDashoffset = offset;
        }
    </script>

@endsection
