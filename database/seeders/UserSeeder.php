<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN
        User::create([
            'last_name' => 'Admin',
            'first_name' => 'Admin',
            'username' => 'Admin',
            'profile_image' => 'defaultAdmin.jpg',
            'password' => Hash::make('Admin2025!'),
            'email' => 'admin@admin.fr',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 2,
        ]);

        // USER
        User::create([
            'last_name' => 'User',
            'first_name' => 'User',
            'username' => 'User',
            'profile_image' => 'defaultUser.jpg',
            'password' => Hash::make('User2025!'),
            'email' => 'user@user.fr',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role_id' => 1,
        ]);

        User::factory(300)->create();
    }
}
