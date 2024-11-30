@extends('components.layout')

@section('title', 'Analytics')

@section('css')

@endsection

@section('content')
<div class="min-h-screen bg-customDark text-white p-4">

    <div class="flex justify-between items-center pb-4 border-b border-gray-600">
        <h1 class="text-2xl font-bold">Analytics</h1>
        <div class="flex space-x-4">
            <button class="category-btn px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg" data-category="meditation">
                Meditation
            </button>
            <button class="category-btn px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-lg" data-category="to_do_list">
                To-Do List
            </button>
        </div>
    </div>

    <div class="bg-customLight text-white p-6 rounded-lg mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="flex flex-col items-center">
            <p class="text-4xl font-bold" id="completion-rate">0%</p>
            <p class="text-lg">Completion Rate</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-4xl font-bold" id="total">0</p>
            <p class="text-lg">Total</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-4xl font-bold" id="completed">0</p>
            <p class="text-lg">Completed</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-4xl font-bold" id="ongoing">0</p>
            <p class="text-lg">Ongoing</p>
        </div>
    </div>

    <div class="mt-6 space-y-8">
        <div>
            <h2 class="text-xl font-semibold mb-4">History (Bar Chart)</h2>
            <canvas id="bar-chart" class="w-full max-w-5xl mx-auto"></canvas>
        </div>
        <div>
            <h2 class="text-xl font-semibold mb-4">Daily Completion (Line Chart)</h2>
            <canvas id="line-chart" class="w-full max-w-5xl mx-auto"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/analytic.js') }}"></script>
@endsection