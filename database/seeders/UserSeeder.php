<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $users = [
            [
                'name' => 'Nico Naicock',
                'email' => 'nico@gmail.com',
                'password' => Hash::make('nico123'),
                'age' => 25,
                'gender' => 'male',
                'profile_picture' => '/assets/profilePic/nico.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Dellon dlenz',
                'email' => 'dellon@gmail.com',
                'password' => bcrypt('dellon123'),
                'age' => 30,
                'gender' => 'male',
                'profile_picture' => '/assets/profilePic/dellon.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Harry Sebasastian',
                'email' => 'bas@gmail.com',
                'password' => bcrypt('bas123'),
                'age' => 27,
                'gender' => 'male',
                'profile_picture' => '/assets/profilePic/bas.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Wilsong Xianying',
                'email' => 'wilson@gmail.com',
                'password' => Hash::make('wilson123'),
                'age' => 22,
                'gender' => 'male',
                'profile_picture' => '/assets/profilePic/wilson.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Laserser',
                'email' => 'laser@gmail.com',
                'password' => Hash::make('laser123'),
                'age' => 28,
                'gender' => 'male',
                'profile_picture' => '/assets/profilePic/laser.jpg',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('users')->insert($users);
    }
}
