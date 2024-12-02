<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Meditation;

class MeditationController extends Controller
{
    //
    public function storeMeditate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'to_do_date' => 'required|date',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'target' => 'required|integer|min:1',
            'timer' => 'required|date_format:H:i',
            'target_time' => 'required|date_format:H:i'
        ]);
        $minutes=$request->input('target_timer');
        $seconds=$minutes*60;
        $time = gmdate('H:i:s', $seconds);

        Meditation::create([
           
            'name' => $request->input('name'),
            // 'to_do_date' => $request->input('to_do_date'),
            'logo' => $request->file('logo') ? $request->file('logo')->store('logos', 'public') : null,
            // 'target' => $request->input('target'),
            // 'progress' => 0,
            'target_timer'=>$time,
            'timer'=>$time,
            'status' => 'Pending',
            'user_id' => Auth::id(),
            'date_added' => now(),
        ]);

        return redirect()->back()->with('success', 'Meditation created successfully!');
    }
    public function showMeditationPage(){
        $user = Auth::user();
        $meditations = Meditation::where('user_id', $user->id)
            ->where('status', '!=', 'Finished')
            ->get();

        return view('meditation', compact('meditations'));    
    }

    
}
