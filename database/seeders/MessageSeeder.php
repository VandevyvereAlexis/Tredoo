<?php

namespace Database\Seeders;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conversations = Conversation::all();

        foreach ($conversations as $conversation)
        {
            $participants = [$conversation->buyer_id, $conversation->seller_id];
            $messageCount = rand(5, 15);

            for ($i = 0; $i < $messageCount; $i++)
            {
                $userId = $participants[$i % 2];
                Message::factory()->create([
                    'conversation_id' => $conversation->id,
                    'user_id' => $userId,
                ]);
            }
        }
    }
}
