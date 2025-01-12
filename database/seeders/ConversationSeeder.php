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
            $buyer = $annonce->user_id;

            $sellers = User::where('id', '!=', $buyer)
                ->inRandomOrder()
                ->take(rand(1, 3))
                ->get();

            foreach ($sellers as $seller)
            {
                if (!Conversation::where('annonce_id', $annonce->id)->where('seller_id', $seller->id)->exists())
                {
                    Conversation::factory()->create([
                        'annonce_id' => $annonce->id,
                        'buyer_id' => $buyer,
                        'seller_id' => $seller->id,
                    ]);
                }
            }
        }
    }
}
