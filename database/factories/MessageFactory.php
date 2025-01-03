<?php

namespace Database\Factories;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Message>
 */
class MessageFactory extends Factory
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
            'content' => $this->faker->paragraph(),
            'read' => $this->faker->boolean(60),
        ];
    }
}
