<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          return [
            'user_id' =>  rand(1, 19),
            'photo' => rand(1, 15).'.jpg',
            'title' => fake()->sentence(3),
            'content' => fake()->paragraph(10),
            'description' => fake()->text(80),
            'delay' => fake()->dateTimeBetween('-1 week', '+1 week'),
            'draft' => fake()->randomElement([0,1],),
  
        ];
    }
}
