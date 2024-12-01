<?php

namespace Database\Seeders;

use App\Models\Analytic;
use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ToDoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        User::all()->each(function($user) use ($faker) {
            for ($i = 0; $i < 30; $i++) {

                $doneDate = Carbon::now()->addDays(rand(0, 21));
                $dateAdded = $doneDate->copy()->subDay(); 

                ToDoList::create([
                    'user_id' => $user->id,
                    'name' => $faker->sentence,
                    'date_added' => $dateAdded->toDateString(),
                    'to_do_date' => $doneDate->toDateString(), 
                    'done_date' => $doneDate->toDateString(),
                    'status' => $faker->randomElement(['completed', 'ongoing']),
                    'logo' => '/assets/todoLogo.jpg',
                    'target' => 5,
                    'progress' => $faker->numberBetween(0, 4),
                ]);
            }
        });
    }
}