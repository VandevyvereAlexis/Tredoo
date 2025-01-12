<?php

namespace Database\Factories;

use App\Models\Annonce;
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
        $buyer = $annonce->user_id;

        $seller = User::where('id', '!=', $buyer)
            ->whereDoesntHave('conversationsAsSeller', function ($query) use ($annonce) {
                $query->where('annonce_id', $annonce->id);
            })
            ->inRandomOrder()
            ->first();

        return [
            'annonce_id' => $annonce->id,
            'buyer_id' => $buyer,
            'seller_id' => $seller->id,
        ];
    }
}
