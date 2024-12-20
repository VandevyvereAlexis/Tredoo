<?php

namespace Database\Factories;

use App\Models\Annonce;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'annonce_id' => Annonce::inRandomOrder()->value('id'),
            'url' => 'defaultUser.jpg',
            'position' => $this->faker->numberBetween(1, 10),
        ];
    }
}
