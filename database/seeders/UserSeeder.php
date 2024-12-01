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
                'bio' => 'Just a 20-year-old figuring it out 🤷‍♂️ | Full of dreams, coffee, and bad jokes ☕ | Living for adventure, good vibes, and making memories ✨ | Catch me at the beach or binge-watching Netflix 🎬 | Self-love, positivity, and growth are my goals 🌱 | Trying to live life with no regrets and a whole lot of laughs 😄 | Follow along for my random thoughts, inspo, and moments of pure chaos 😜 | DM me if you want to share a laugh or a good playlist 🎶 | Lets vibe ✌️',
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
                'bio' => 'Just a 20-year-old figuring it out 🤷‍♂️ | Full of dreams, coffee, and bad jokes ☕ | Living for adventure, good vibes, and making memories ✨ | Catch me at the beach or binge-watching Netflix 🎬 | Self-love, positivity, and growth are my goals 🌱 | Trying to live life with no regrets and a whole lot of laughs 😄 | Follow along for my random thoughts, inspo, and moments of pure chaos 😜 | DM me if you want to share a laugh or a good playlist 🎶 | Lets vibe ✌️',
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
                'bio' => 'Just a 20-year-old figuring it out 🤷‍♂️ | Full of dreams, coffee, and bad jokes ☕ | Living for adventure, good vibes, and making memories ✨ | Catch me at the beach or binge-watching Netflix 🎬 | Self-love, positivity, and growth are my goals 🌱 | Trying to live life with no regrets and a whole lot of laughs 😄 | Follow along for my random thoughts, inspo, and moments of pure chaos 😜 | DM me if you want to share a laugh or a good playlist 🎶 | Lets vibe ✌️',
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
                'bio' => 'Just a 20-year-old figuring it out 🤷‍♂️ | Full of dreams, coffee, and bad jokes ☕ | Living for adventure, good vibes, and making memories ✨ | Catch me at the beach or binge-watching Netflix 🎬 | Self-love, positivity, and growth are my goals 🌱 | Trying to live life with no regrets and a whole lot of laughs 😄 | Follow along for my random thoughts, inspo, and moments of pure chaos 😜 | DM me if you want to share a laugh or a good playlist 🎶 | Lets vibe ✌️',
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
                'bio' => 'Just a 20-year-old figuring it out 🤷‍♂️ | Full of dreams, coffee, and bad jokes ☕ | Living for adventure, good vibes, and making memories ✨ | Catch me at the beach or binge-watching Netflix 🎬 | Self-love, positivity, and growth are my goals 🌱 | Trying to live life with no regrets and a whole lot of laughs 😄 | Follow along for my random thoughts, inspo, and moments of pure chaos 😜 | DM me if you want to share a laugh or a good playlist 🎶 | Lets vibe ✌️',
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
