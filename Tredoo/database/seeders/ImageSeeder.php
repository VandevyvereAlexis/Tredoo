<?php

namespace Database\Seeders;

use App\Models\Annonce;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $annonces = Annonce::all();

        foreach ($annonces as $annonce) {
            $positions = range(1, 10);
            shuffle($positions);

            foreach ($positions as $position) {
                Image::factory()->create([
                    'annonce_id' => $annonce->id,
                'position' => $position,
                ]);
            }
        }
    }
}
