<?php

namespace Database\Seeders;

use App\Models\Analytic;
use App\Models\Meditation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MeditationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::all()->each(function($user) use ($faker) {
            for ($i = 0; $i < 1; $i++) {

                $doneDate = Carbon::now()->addDays(rand(0, 14));
                $dateAdded = $doneDate->copy()->subDay(); 

                Meditation::create([
                    'user_id' => $user->id,
                    'name' => $faker->sentence,
                    'date_added' => $dateAdded->toDateString(),
                    'done_date' => $doneDate->toDateString(),
                    'status' => $faker->randomElement(['completed', 'ongoing', 'not-started']),
                    'timer' => $faker->time('H:i:s',  rand(60, 600)),
                    'target_timer' => $faker->time('H:i:s',  rand(600, 1800)),
                    'logo' => '/assets/meditateLogo.jpg',
                ]);
            }
        });
    }
}