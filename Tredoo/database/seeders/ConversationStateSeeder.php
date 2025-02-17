<?php

namespace Database\Seeders;

use App\Models\Conversation;
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
        $conversations = Conversation::all();

        foreach ($conversations as $conversation)
        {
            ConversationState::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $conversation->buyer_id,
            ]);

            ConversationState::factory()->create([
                'conversation_id' => $conversation->id,
                'user_id' => $conversation->seller_id,
            ]);
        }
    }
}
