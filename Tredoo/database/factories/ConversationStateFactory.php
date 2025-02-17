<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\ConversationState;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConversationState>
 */
class ConversationStateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conversation = Conversation::inRandomOrder()->first();

        return [
            'conversation_id' => $conversation->id,
            'user_id' => $this->faker->randomElement([
                $conversation->buyer_id,
                $conversation->seller_id,
            ]),
            'status' => $this->faker->randomElement(ConversationState::STATUS),
        ];
    }
}
