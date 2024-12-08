<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserAchievementController;

class UserController extends Controller
{

    public function getLoginPage()
    {
        return view('login');
    }

    public function showRegisterPage()
    {
        return view('register');
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|min:5|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'age' => 'required|integer|between:5,100',
            'gender' => 'required|in:male,female,no-say',
            'password' => 'required|min:5|max:255|confirmed',
        ], [
            'password.confirmed' => 'Password Does not match!'
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'age' => $validatedData['age'],
            'gender' => $validatedData['gender'],
            'password' => Hash::make($validatedData['password']),
            'profile_picture' => 'image/DefaultProfile.jpg'
        ]);

        return redirect()->route('login')->with('success', 'account succesfully created!');
    }

    public function accountLogin(Request $request)
    {

        $input = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    
        $user = User::where('email', $input['email'])->first();
    
        if (!$user) {
            return back()->withErrors('Email is not valid!');
        }
    
        if (Hash::check($input['password'], $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return back()->withErrors('Email or password is incorrect!');
        }
    }

    public function accountLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function profile()
    {

        $user = Auth::user();
        $latestAchievements = $user->achievements()->wherePivot('status', 'Unlocked')->orderBy('pivot_updated_at', 'desc')->limit(3)->get();
        return view('profile', compact('user', 'latestAchievements'));
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        $destinationPath = public_path('assets/profilePic');

        // Debugging the directory path and permissions
        if (!file_exists($destinationPath)) {
            return back()->with('fail', 'Directory does not exist: ' . $destinationPath);
        }

        if (!is_writable($destinationPath)) {
            return back()->with('fail', 'Directory is not writable: ' . $destinationPath);
        }

        $filename = $user->name . '.' . $request->file('profile_picture')->getClientOriginalExtension();

        try {
            $request->file('profile_picture')->move($destinationPath, $filename);
        } catch (\Exception $e) {
            return back()->with('fail', 'Error moving the file: ' . $e->getMessage());
        }

        $user->update([
            'profile_picture' => 'assets/profilePic/' . $filename,
        ]);

        return back()->with('success', 'Profile picture updated successfully!');
    }

    public function updateBio(Request $request)
    {
        $request->validate([
            'bio' => 'required|string|max:500',
        ]);

        $user = Auth::user();
        $user->bio = $request->input('bio');
        $user->save();

        return redirect()->back()->with('success', 'Bio updated successfully!');
    }




}
