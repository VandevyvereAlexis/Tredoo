<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\ConversationState;
use App\Models\User;
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
        return [
            'conversation_id' => Conversation::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
            'status' => $this->faker->randomElement(ConversationState::STATUS),
        ];
    }
}
