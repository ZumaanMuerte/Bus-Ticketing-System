<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create or update the admin user
        User::updateOrCreate(
            ['email' => 'test@gmail.com'],
            [
                'name' => 'Administrator',
                'email' => 'test@gmail.com',
                'password' => Hash::make('12345678'), // Use a strong password in production
                'role' => 'admin',
            ],
        );
    }
}
