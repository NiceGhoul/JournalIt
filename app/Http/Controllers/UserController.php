<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // page logic
    public function getLoginPage(){
        return view('login');
    }

    public function showRegisterPage(){
        return view('register');
    }

    // user register logic
    public function store(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'age' => 'required|integer|between:5,100',
            'gender'=>'required|in:male,female,no-say',
            'password' => 'required|min:5|max:255|confirmed',
        ],[
            'password.confirmed' => 'Password Does not match!'
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'password' => Hash::make($validatedData['password'])
        ]);

        return redirect()->route('login')->with('success','account succesfully created!');
    }
    // User Login logic
    public function accountLogin(Request $request){

        $input = $request->validate([
            'name' => 'required',
            'password' =>  'required'
        ]);

        $user = User::where('name', $input['name'])->first();

        if(Hash::check($input['password'], $user->password)){
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/');
        }else{
            return back()->withErrors('name or password is incorrect!');
        }
    }

    public function accountLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
