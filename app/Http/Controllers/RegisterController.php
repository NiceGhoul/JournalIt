<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterPage(){
        return view('register');
    }
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

        dd($validatedData);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'password' => Hash::make($validatedData['password'])
        ]);

        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'age' => $request->age,
        //     'gender' => $request->gender,
        //     'password' => Hash::make($request->password)
        // ]);

        return redirect()->route('login')->with('success','account succesfully created!');
    }
}
