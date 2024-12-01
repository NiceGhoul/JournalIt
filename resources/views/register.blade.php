@extends('components.layout')

@section('title', 'Register')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-customDark sm:py-10 md:py-15 lg:py-20">
    <div class="w-10/12 max-w-6xl bg-customDark p-6 rounded-lg shadow-lg flex flex-col md:flex-row">
        <div class="w-full md:w-1/2 flex justify-center items-center border-b-2 md:border-b-0 md:border-r-2 mb-6 md:mb-0">
            <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="max-w-[80%] h-auto">
        </div>

        <div class="w-full md:w-1/2 px-4 sm:px-8">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h1 class="text-2xl font-bold text-white mb-6 text-center">Register Your Account</h1>
            
            <form action="{{ route('registerAccount') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-white">Name</label>
                    <input type="text" name="name" id="name" class="mt-1 bg-customDark text-white block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your name" required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-white">Email</label>
                    <input type="email" name="email" id="email" class="mt-1 bg-customDark text-white block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your email" required>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="w-full">
                        <label for="age" class="block text-sm font-medium text-white">Age</label>
                        <input type="number" name="age" id="age" 
                               class="mt-1 bg-customDark text-white block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                               placeholder="Age" min="10" max="100" required>
                    </div>
                
                    <div class="w-full">
                        <label for="gender" class="block text-sm font-medium text-white">Gender</label>
                        <select name="gender" id="gender" 
                                class="mt-1 bg-customDark text-white block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                required>
                            <option value="" disabled selected>Choose your gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="no-say">Prefer not to say</option>
                        </select>
                    </div>
                </div>
                

                <div>
                    <label for="password" class="block text-sm font-medium text-white">Password</label>
                    <input type="password" name="password" id="password" class="mt-1 bg-customDark text-white block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your password" required>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 bg-customDark text-white block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Confirm your password" required>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500" required>
                    <label for="terms" class="ml-2 text-sm text-white">I Accept The Terms & Conditions</label>
                </div>

                <div>
                    <button type="submit" class="w-full bg-theme text-white py-2 px-4 rounded-lg font-bold transition-transform duration-300 ease-in-out hover:scale-105 hover:shadow-lg hover:bg-themeLight">
                        Register
                    </button>
                </div>
            </form>

            <div class="text-center mt-4">
                <p class="text-white font-bold">Already have an account? 
                    <a href="{{ route('login') }}" class="text-theme font-bold hover:underline">Login here</a>.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
