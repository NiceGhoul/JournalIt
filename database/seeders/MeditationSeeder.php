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
            for ($i = 0; $i < 10; $i++) {

                $doneDate = Carbon::now()->addDays(rand(0, 14));
                $dateAdded = $doneDate->copy()->subDay(); 

                Meditation::create([
                    'user_id' => $user->id,
                    'name' => $faker->sentence,
                    'date_added' => $dateAdded->toDateString(),
                    'done_date' => $doneDate->toDateString(),
                    'status' => $faker->randomElement(['completed', 'ongoing']),
                    'logo' => '/assets/meditateLogo.jpg',
                ]);
            }
        });
    }
}