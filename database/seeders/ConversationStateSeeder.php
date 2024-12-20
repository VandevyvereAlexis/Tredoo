<?php

namespace Database\Seeders;

use App\Models\ConversationState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConversationState::factory(50)->create();
    }
}
