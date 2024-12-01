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
                'logo' => '/assets/profilePic/nico.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ], [
                'title' => '5 Done, More to Go',
                'description' => 'Finish 5 Task',
                'logo' => '/assets/profilePic/nico.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ], [
                'title' => '10 and Still Counting',
                'description' => 'Finish 10 Task, Dont stop now',
                'logo' => '/assets/profilePic/nico.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ], [
                'title' => 'Achievement 4',
                'description' => 'Desc 4',
                'logo' => '/assets/profilePic/nico.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ], [
                'title' => 'Achievement 5',
                'description' => 'Desc 5',
                'logo' => '/assets/profilePic/nico.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ] , [
                'title' => 'Achievement 6',
                'description' => 'Desc 6',
                'logo' => '/assets/profilePic/nico.jpg',
                'created_at' => $now,
                'updated_at' => $now

            ] 
            ];
            DB::table('achievements')->insert($achievements);

    
    }
}
