<?php

namespace Database\Factories;

use App\Models\Annonce;
use App\Models\Brand;
use App\Models\CarModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Annonce>
 */
class AnnonceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'brand_id' => Brand::inRandomOrder()->value('id'),

            'car_model_id' => CarModel::where('brand_id', function ($query) {
                $query->select('id')->from('brands')->inRandomOrder()->limit(1);
            })->inRandomOrder()->value('id'),

            'title' => $this->faker->sentence(6, true),
            'sold' => $this->faker->boolean(10),
            'visible' => $this->faker->boolean(90),
            'first_hand' => $this->faker->boolean(50),
            'price' => $this->faker->numberBetween(360, 9500) * 10,
            'mileage' => $this->faker->numberBetween(1000, 200000),
            'fiscal_power' => $this->faker->numberBetween(4, 30),
            'horsepower' => $this->faker->numberBetween(50, 700),
            'first_registration_date' => $this->faker->date,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->regexify('[0-9]{5}'), 
            'latitude' => $this->faker->latitude(48.8566 - 0.5, 48.8566 + 0.5),
            'longitude' => $this->faker->longitude(2.3522 - 0.5, 2.3522 + 0.5),
            'description' => $this->faker->paragraphs(3, true),
            'fuel' => $this->faker->randomElement(Annonce::FUELS),
            'transmission' => $this->faker->randomElement(Annonce::TRANSMISSIONS),
            'type' => $this->faker->randomElement(Annonce::TYPES),
            'doors' => $this->faker->randomElement(Annonce::DOORS),
            'seats' => $this->faker->randomElement(Annonce::SEATS),
            'color' => $this->faker->randomElement(Annonce::COLORS),
            'condition' => $this->faker->randomElement(Annonce::CONDITIONS),
            'crit_air' => $this->faker->randomElement(Annonce::CRITAIRS),
            'emission_class' => $this->faker->randomElement(Annonce::EMISSIONS),
        ];
    }
}
