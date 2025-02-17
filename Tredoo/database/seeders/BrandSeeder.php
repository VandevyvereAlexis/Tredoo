<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'abarth'],
            ['name' => 'alfa_romeo'],
            ['name' => 'aston_martin'],
            ['name' => 'audi'],
            ['name' => 'bentley'],
            ['name' => 'bmw'],
            ['name' => 'bugatti'],
            ['name' => 'cadillac'],
            ['name' => 'chevrolet'],
            ['name' => 'chrysler'],
            ['name' => 'citroën'],
            ['name' => 'dacia'],
            ['name' => 'daewoo'],
            ['name' => 'daihatsu'],
            ['name' => 'dodge'],
            ['name' => 'ferrari'],
            ['name' => 'fiat'],
            ['name' => 'ford'],
            ['name' => 'honda'],
            ['name' => 'hyundai'],
            ['name' => 'infiniti'],
            ['name' => 'jaguar'],
            ['name' => 'jeep'],
            ['name' => 'kia'],
            ['name' => 'lamborghini'],
            ['name' => 'lancia'],
            ['name' => 'land_rover'],
            ['name' => 'lexus'],
            ['name' => 'lotus'],
            ['name' => 'maserati'],
            ['name' => 'mazda'],
            ['name' => 'mclaren'],
            ['name' => 'mercedes_benz'],
            ['name' => 'mini'],
            ['name' => 'mitsubishi'],
            ['name' => 'nissan'],
            ['name' => 'opel'],
            ['name' => 'peugeot'],
            ['name' => 'porsche'],
            ['name' => 'renault'],
            ['name' => 'rolls_royce'],
            ['name' => 'saab'],
            ['name' => 'seat'],
            ['name' => 'skoda'],
            ['name' => 'smart'],
            ['name' => 'subaru'],
            ['name' => 'suzuki'],
            ['name' => 'tesla'],
            ['name' => 'toyota'],
            ['name' => 'volkswagen'],
            ['name' => 'volvo'],
        ];

        Brand::insert($brands); 
    }
}
