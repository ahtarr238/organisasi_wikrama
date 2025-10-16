<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ketua OSIS',
                'email' => 'osis@gmail.com',
                'email_verified_at' => now(),
                'role' => 'staff',
                'password' => Hash::make('osis123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
