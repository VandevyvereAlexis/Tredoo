<?php

namespace Database\Factories;

use App\Models\Annonce;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation>
 */
class ConversationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $annonce = Annonce::inRandomOrder()->first();
        $seller = $annonce->user_id; // récupère le vendeur associé à cette annonce
        $buyer = User::where('id', '!=', $seller)->inRandomOrder()->value('id'); // sélectionne un acheteur différent du vendeur

        return [
            'annonce_id' => $annonce->id,
            'buyer_id' => $buyer,
            'seller_id' => $seller,
            'status' => $this->faker->randomElement(Conversation::STATUS),
        ];
    }
}
