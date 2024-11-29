<?php

namespace Database\Seeders;

use App\Models\Analytic;
use App\Models\Meditation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

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

                $analytic = Analytic::create([
                    'user_id' => $user->id,
                    'type' => 'meditation',  
                ]);


                Meditation::create([
                    'user_id' => $user->id,
                    'name' => $faker->sentence,
                    'date_added' => $faker->date,
                    'status' => $faker->randomElement(['completed', 'ongoing']),
                    'logo' => $faker->imageUrl(),
                    'analytic_id' => $analytic->id,  
                ]);
            }
        });
    }
}
