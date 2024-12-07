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

        User::all()->each(function ($user) use ($faker) {
            for ($i = 0; $i < 30; $i++) {
    
                $status = $faker->randomElement(['completed', 'ongoing']);
                $doneDate = $status === 'completed' ? Carbon::now()->addDays(rand(0, 21)) : null;
                $dateAdded = Carbon::now()->subDays(rand(0, 7));
    
                ToDoList::create([
                    'user_id' => $user->id,
                    'name' => $faker->sentence,
                    'date_added' => $dateAdded->toDateString(),
                    'to_do_date' => $doneDate ? $doneDate->toDateString() : Carbon::now()->addDays(rand(1, 21))->toDateString(),
                    'done_date' => $doneDate?->toDateString(), 
                    'status' => $status,
                    'logo' => '/assets/todoLogo.jpg',
                    'target' => 5,
                    'progress' => $status === 'completed' ? 5 : $faker->numberBetween(0, 4),
                ]);
            }
        });
    }
}