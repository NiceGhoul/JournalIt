<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\User;
use App\Models\ToDoList;
use Illuminate\Support\Facades\Auth;

class UserAchievementController extends Controller
{

    public function giveToDoAchievements(User $user)
    {
        $completedTodo = $user->toDoLists()->where('status', 'completed')->count();

        if ($completedTodo >= 1) {
            $this->unlockAchievement($user, 'First Step');
        }
        if ($completedTodo >= 5) {
            $this->unlockAchievement($user, '5 Done, More to Go');
        }
        if ($completedTodo >= 10) {
            $this->unlockAchievement($user, '10 and Still Counting');
        }
    }
        
    public function giveProfilePicAchievements(User $user){
        if ($user->profile_picture == 'image/DefaultProfile.jpg') {
            // Berikan achievement "First Step in Profile"
            $this->unlockAchievement($user, 'New Face');
        }
    }

    private function unlockAchievement(User $user, $title)
    {
        // Cari achievement berdasarkan judul
        $achievement = Achievement::where('title', $title)->first();

        if ($achievement) {
            // Cek jika achievement sudah ada dan belum terkunci untuk user ini
            $userAchievement = $user->achievements()->where('achievement_id', $achievement->id)->first();

            if (!$userAchievement) {
                // Attach achievement ke user jika belum ada
                $user->achievements()->attach($achievement->id, ['status' => 'Unlocked']);
            }
        }
    }
}