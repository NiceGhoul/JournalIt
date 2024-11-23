@extends('components.layout')

@section('content')

<div class="d-flex justify-content-center align-items-center" style="height: 75vh;">
    <div class="col-lg-3">
            

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('loginAccount') }}" method="POST">
            @csrf
            <h1 class="d-flex justify-content-center mb-3">Account Login</h1>
            {{-- input name --}}
            <div class="form-floating mb-3">
                <input class="w-100" type="text" name="name" id="name" placeholder="John Doe" class="form-control" required>
                <label for="name">Name</label>

            </div>

            {{-- input password --}}
            <div class="form-floating mb-3">
                <input class="w-100" type="password" name="password" id="password" class="form-control" required>
                <label for="password">Password</label>
            </div>

            
            {{-- button --}}
            <div class="d-flex justify-content-center align-items-center">
                <button class="w-50" type="submit">Login</button>
            </div>
        </form>
        <div class="d-flex justify-content-center align-items-center mt-3">
            <p> Don't have an account? <a href="{{ route('registerAccount') }}">Register</a> here!</p>
        </div>
    </div>
</div>

@endsection