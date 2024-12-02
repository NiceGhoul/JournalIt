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
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'timer' => 'required|date_format:H:i:s',
        //     'target_timer' => 'required|date_format:H:i:s'
        // ]);

        
        $minutes=$request->input('target_timer');
        $seconds=$minutes*60;
        $time = gmdate('H:i:s', $seconds);
        
        Meditation::create([
           
            'name' => $request->input('name'),
            'logo' => $request->file('logo') ? $request->file('logo')->store('logos', 'public') : null,
            'target_timer'=>$time,
            'timer'=>gmdate('H:i:s', 0),
            'status' => 'not-started',
            'user_id' => Auth::id(),
            'date_added' => now(),
        ]);
       
        return redirect()->back()->with('success', 'Meditation created successfully!');

    }

    public function showMeditationPage(){
        $user = Auth::user();
        $meditations = Meditation::where('user_id', $user->id)
            ->where('status', '!=', 'completed')
            ->orderBy('done_date', 'desc')
            ->paginate(3);

        return view('meditation', compact('meditations'));    
    }

    public function showCounter($id){
        $meditation = Meditation::findOrFail($id);
        return view('meditationCounter', compact('meditation'));
    }

    public function startMeditation($id)
{
    $meditation = Meditation::findOrFail($id);
    $meditation->status = 'ongoing';
    $meditation->save();

    return response()->json(['message' => 'starting meditation session.']);
}

public function stopMeditation(Request $request, $id)
{

    $meditation = Meditation::findOrFail($id);

    $timeRemaining = (int) $request->input('time_remaining');
    $targetParts = explode(':', $meditation->target_timer);
    $targetTimeInSeconds = $targetParts[0] * 3600 + $targetParts[1] * 60 + $targetParts[2];

    $elapsedTime = $targetTimeInSeconds - $timeRemaining;

    $meditation->timer = gmdate('H:i:s', $elapsedTime);
    $meditation->status = $timeRemaining === 0 ? 'completed' : 'not-started';
    $meditation->save();

    return response()->json(['message' => 'session stopped.']);
}

}
