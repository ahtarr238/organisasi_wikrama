<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Memanggil seeder lain jika ada
        // $this->call([
        //     UserSeeder::class,
        // ]);

        // Membuat user langsung
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Membuat 10 user acak
        // User::factory(10)->create();
    }
}