<?php

namespace Database\Seeders;

use App\Models\Annonce;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $annonces = Annonce::all();

        foreach ($annonces as $annonce)
        {
            $seller = $annonce->user_id;

            $buyers = User::where('id', '!=', $seller)
                ->inRandomOrder()
                ->take(rand(1, 3))
                ->get();

            foreach ($buyers as $buyer)
            {
                if (!Conversation::where('annonce_id', $annonce->id)->where('buyer_id', $buyer->id)->exists())
                {
                    Conversation::factory()->create([
                        'annonce_id' => $annonce->id,
                        'seller_id' => $seller,
                        'buyer_id' => $buyer->id,
                    ]);
                }
            }
        }
    }
}
