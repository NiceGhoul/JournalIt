@extends('components.layout')

@section('title', 'Analytics')

@section('css')

@endsection

@section('content')
<div class="min-h-screen bg-customDark text-white p-4">

    <div class="flex space-x-4 pb-4 border-b-4 border-gray-600">
        <button class="category-btn px-4 py-2 bg-themeLight hover:bg-theme rounded-lg" data-category="meditation">
            Meditation
        </button>
        <button class="category-btn px-4 py-2 bg-themeLight hover:bg-theme rounded-lg" data-category="to_do_list">
            To-Do List
        </button>
    </div>
    <div class="flex justify-between items-center py-4">
        <h1 class="text-2xl font-bold">Analytics</h1>
    </div>

    <div class="bg-analytic text-white p-6 rounded-lg mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
        <div class="flex flex-col items-center">
            <p class="text-4xl font-bold" id="completion-rate">0%</p>
            <p class="text-3xl font-bold">Completion Rate</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-3xl font-bold">Total</p>
            <p class="text-xl font-bold py-1 px-3 mt-2 rounded-sm border" id="total">0</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-3xl font-bold">Completed</p>
            <p class="text-xl font-bold py-1 px-3 mt-2 rounded-sm border" id="completed">0</p>
        </div>
        <div class="flex flex-col items-center">
            <p class="text-3xl font-bold">Ongoing</p>
            <p class="text-xl font-bold py-1 px-3 mt-2 rounded-sm border" id="ongoing">0</p>
        </div>
    </div>

    <div class="mt-6 space-y-8">
        <div class="p-6">
            <h2 class="text-3xl font-bold mb-4 m">History</h2>
            <canvas id="bar-chart" class="w-full max-w-5xl mx-auto"></canvas>
        </div>
        <div class="p-6">
            <h2 class="text-3xl font-bold mb-4">Daily Completion</h2>
            <canvas id="line-chart" class="w-full max-w-5xl mx-auto"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/analytic.js') }}"></script>
@endsection