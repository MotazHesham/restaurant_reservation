<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    { 

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        
        $this->call([
            MealSeeder::class,
            TableSeeder::class,
            CustomerSeeder::class,
            ReservationSeeder::class,
            OrderSeeder::class,
            OrderDetailSeeder::class,
        ]);
    }
}
