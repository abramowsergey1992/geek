<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  
    public function definition(): array
    {
$gender = fake()->randomElement(['male', 'female']);
$male =[1,3,4,5,6,8,9,12,13,14,15,16,21,27,28,29,30,31,36,39];
$female =[2,5,10,11,17,18,19,20,22,23,24,25,16,21,26,31,33,34,36,37,38];
if($gender=='male'){
  $img=  fake()->randomElement($male);
}else{
     $img=  fake()->randomElement($female);
}
        return [
            'login' =>  fake()->unique()->username(),
            'avatar' => rand(1, 19).'.jpeg',
            'first_name' =>  fake()->firstname($gender),
            'last_name' =>  fake()->lastname($gender),
            'birthday' => fake()->date(),
            'role' => fake()->randomElement(['student'],),
            'phone' => '+7 9'.rand(0, 9).rand(0, 9).' '.rand(0, 9).rand(0, 9).rand(0, 9).' '.rand(0, 9).rand(0, 9).' '.rand(0, 9).rand(0, 9),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
