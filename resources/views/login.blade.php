@extends('components.layout')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-customDark">
    <div class="w-full max-w-sm bg-customDark p-8 rounded-lg shadow-lg border border-white border-solid">
        <div class="text-center">
            <h1 class="text-2xl font-bold text-white mb-6">Account Login</h1>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('loginAccount') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-white">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full p-3 border bg-customDark text-white border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your email" required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-white">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full p-3 border bg-customDark text-white border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your password" required>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="remember" class="ml-2 text-sm text-white">Remember me</label>
            </div>

            <div>
                <button type="submit" class="w-full bg-theme text-white py-2 px-4 rounded-lg font-bold transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:bg-themeLight">
                    Login
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="text-white">Don't have an account? 
                <a href="{{ route('registerAccount') }}" class="text-theme font-bold hover:underline">Register here</a>.
            </p>
        </div>
    </div>
</div>
@endsection
