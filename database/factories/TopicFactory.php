<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $users = User::pluck('id')->toArray();
        $classrooms = Classroom::pluck('id')->toArray();
        return [
            'name' => fake()->word(),
            'classroom_id' => fake()->randomElement($classrooms),
            'user_id' => fake()->randomElement($users),
        ];
        //$users = User::pluck('id')->toArray();
// This line retrieves all the id values from the User model and converts them into an array. The pluck method fetches the id column values, and toArray converts the resulting collection into an array.

// $classrooms = Classroom::pluck('id')->toArray();
// Similarly, this line retrieves all the id values from the Classroom model and converts them into an array.

// 'name' => fake()->word(),
// Here, the 'name' key is assigned a random word generated by the fake()->word() method. This is likely used to generate a fake name for the data being seeded.

// 'classroom_id' => fake()->randomElement($classrooms),
// The 'classroom_id' key is assigned a random element from the $classrooms array. This means that a random classroom ID will be selected from the available classrooms.

// 'user_id' => fake()->randomElement($users),
// Similarly, the 'user_id' key is assigned a random element from the $users array. This ensures that a random user ID will be selected from the available users.

    }
}


