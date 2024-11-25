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

            <form action="{{ route('registerAccount') }}" method="POST">
                @csrf
                <h1 class="d-flex justify-content-center mb-3">Register Your Account</h1>
                {{-- input name --}}
                <div class="form-floating mb-3">
                    <input class="w-100" type="text" name="name" id="name" placeholder="John Doe" class="form-control" required>
                    <label for="name">Name</label>

                </div>

                {{-- input email --}}
                <div class="form-floating mb-3">
                    <input class="w-100" type="email" name="email" id="email" class="form-control"
                        placeholder="example@gmail.com" required>
                    <label for="email">Email</label>
                </div>

                {{-- column for age and gender --}}
                <div class="row mb-3">
                    {{-- input age --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" name="age" id="age" class="form-control" min="10"
                                max="100" required>
                            <label for="age">Age</label>
                        </div>

                    </div>

                    {{-- input gender --}}
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="gender" id="gender" class="form-select" required>
                                <option value="" disabled selected>Choose your gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="no-say">Prefer not to say</option>
                            </select>
                            <label for="gender">Gender</label>
                        </div>
                    </div>
                </div>

                {{-- input password --}}
                <div class="form-floating mb-3">
                    <input class="w-100" type="password" name="password" id="password" class="form-control" required>
                    <label for="password">Password</label>
                </div>
                {{-- conf_password --}}
                <div class="form-floating mb-3">
                    <input class="w-100" type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    <label for="password_confirmation">Confirm Password</label>
                </div>
                
                {{-- button --}}
                <div class="d-flex justify-content-center align-items-center">
                    <button class="w-50" type="submit">Register</button>
                </div>
            </form>

            <div class="d-flex justify-content-center align-items-center mt-3">
                <p> Already got an account? <a href="{{ route('login') }}">Login</a> here!</p>
            </div>
        </div>
    </div>
@endsection
