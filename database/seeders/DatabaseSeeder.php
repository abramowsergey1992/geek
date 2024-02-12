<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        \App\Models\User::factory()->create([
            'login' => 'admin',
            'avatar' => 'admin.jpg',
            'first_name' => 'Administrator',
            'last_name' => 'Admin',
            'birthday' => fake()->date(),
            'role' => 'administrator',
            'phone' => '+7 9'.rand(0, 9).rand(0, 9).' '.rand(0, 9).rand(0, 9).rand(0, 9).' '.rand(0, 9).rand(0, 9).' '.rand(0, 9).rand(0, 9),
            'email' => 'admin@admin.ru',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::factory(20)->create();
        \App\Models\Post::factory(150)->create();

    
    }
}
