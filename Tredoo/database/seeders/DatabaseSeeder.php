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
        $this->call([
            RoleSeeder::class,
            BrandSeeder::class,
            CarModelSeeder::class,
            UserSeeder::class,
            AnnonceSeeder::class,
            ImageSeeder::class,
            ConversationSeeder::class,
            FavoriteSeeder::class,
            MessageSeeder::class,
            ConversationStateSeeder::class,
        ]);
    }
}
