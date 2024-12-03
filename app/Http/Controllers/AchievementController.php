<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Achievement;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function showAchievementPage(){
        $user = Auth::user();
        $achievementController = new UserAchievementController();
        $achievementController->giveAllAchievements($user);
        $allAchievements = Achievement::all();

        $unlockedAchievements = $user->achievements()->wherePivot('status', 'Unlocked')->get();
        // dd($unlockedAchievements, $lockedAchievements);
        return view('achievement', compact('allAchievements', 'unlockedAchievements'));
    }

    
}
