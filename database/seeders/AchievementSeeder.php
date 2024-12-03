<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $achievements = [
            [
                'title' => 'First Step',
                'description' => 'Finish Your First To-Do List',
                'logo' => '/assets/achievementPic/numberOne.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ], [
                'title' => '5 Done, More to Go',
                'description' => 'Finish 5 Task',
                'logo' => '/assets/achievementPic/numberFive.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ], [
                'title' => '10 and Still Counting',
                'description' => 'Finish 10 Task, Dont stop now',
                'logo' => '/assets/achievementPic/numberTen.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ], [
                'title' => 'New Face',
                'description' => 'Update Your Profile Pic',
                'logo' => '/assets/achievementPic/aiBerto.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ], [
                'title' => 'Discipline Enough',
                'description' => 'Finish Your First Meditation Session',
                'logo' => '/assets/achievementPic/meditate1.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ]  , [
                'title' => 'Great Discipline',
                'description' => 'Finish Your 5 Meditation Session',
                'logo' => '/assets/achievementPic/meditate2.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ] , [
                'title' => 'Hard Core Discipline',
                'description' => 'Finish Your 20 Meditation Session',
                'logo' => '/assets/achievementPic/meditate3.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ], [
                'title' => 'First Hour',
                'description' => 'You have Meditated for an Hour',
                'logo' => '/assets/achievementPic/clock.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ] , [
                'title' => 'Five Hour',
                'description' => 'You have Meditated for 5 Hour',
                'logo' => '/assets/achievementPic/clock5.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ] , [
                'title' => 'Ten Hour',
                'description' => 'You have Meditated for 10 Hour... Crazy',
                'logo' => '/assets/achievementPic/clock10.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ]
            ];
            DB::table('achievements')->insert($achievements);

    
    }
}
