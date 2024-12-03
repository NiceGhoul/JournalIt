<?php

namespace App\Http\Controllers;
use App\Models\Meditation;
use App\Models\Achievement;
use App\Models\User;
use App\Models\ToDoList;
use Illuminate\Support\Facades\Auth;

class UserAchievementController extends Controller
{
    public function giveAllAchievements(User $user){
        $this->checkToDo($user);
        $this->checkMeditate($user);
        $this->checkProfilePic($user);
    }

    public function checkToDo(User $user)
    {
        $completedTodo = $user->toDoLists()->where('status', 'completed')->count();      
        //Achievement ToDo
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

    public function checkMeditate(User $user){
        $completedMeditate = $user->meditations()->where('status', 'completed')->count();
        if ($completedMeditate >= 1) {
            $this->unlockAchievement($user, 'Discipline Enough');
        }
        if ($completedMeditate >= 5) {
            $this->unlockAchievement($user, 'Discipline Enough');
        }
        if ($completedMeditate >= 20) {
            $this->unlockAchievement($user, 'Discipline Enough');
        }

        $meditation = Meditation::where('user_id', $user->id)->get();
        $totalTime = 0;
        foreach($meditation as $med){
            $timerParts = explode(':', $med->timer);
            $timerInSeconds = $timerParts[0] * 3600 + $timerParts[1] * 60 + $timerParts[2];
            $totalTime += $timerInSeconds;
        }
        if($totalTime >= 3600){
            $this->unlockAchievement($user, 'First Hour');
        }
        if($totalTime >= 18000){
            $this->unlockAchievement($user, 'Five Hour');
        }

        if($totalTime >= 36000){
            $this->unlockAchievement($user, 'Ten Hour');
        }
    }


    public function checkProfilePic(User $user){
        //Achievement Profile Pic
        if ($user->profile_picture != 'image/DefaultProfile.jpg') {
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