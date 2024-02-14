<?php

namespace Database\Factories;

use App\Models\Church;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('en_GB');

        $ukCoordinates = [
            ['latitude' => 51.509865, 'longitude' => -0.118092], // Londres
            ['latitude' => 53.483959, 'longitude' => -2.244644], // Manchester
            ['latitude' => 55.953251, 'longitude' => -3.188267], // Edimburgo
            ['latitude' => 52.486243, 'longitude' => -1.890401], // Birmingham
            ['latitude' => 54.978252, 'longitude' => -1.617439], // Newcastle
            ['latitude' => 53.799692, 'longitude' => -1.549103], // Leeds
            ['latitude' => 53.408371, 'longitude' => -2.991573], // Liverpool
            ['latitude' => 52.630886, 'longitude' => 1.297355], // Norwich
            ['latitude' => 51.454514, 'longitude' => -2.587910], // Bristol
            ['latitude' => 50.718412, 'longitude' => -3.533899], // Exeter
            ['latitude' => 51.752022, 'longitude' => -1.257677], // Oxford
            ['latitude' => 52.922530, 'longitude' => -1.474619], // Derby
            ['latitude' => 53.230688, 'longitude' => -0.540579], // Lincoln
            ['latitude' => 51.375801, 'longitude' => -2.359904], // Bath
            ['latitude' => 57.149717, 'longitude' => -2.094278], // Aberdeen
            ['latitude' => 54.597285, 'longitude' => -5.930120], // Belfast
        ];

        // Seleciona um par de coordenadas aleatório do array
        $randomCoordinates = $faker->randomElement($ukCoordinates);

        return [
            'church_id' => Church::factory(),
            'address_line1' => $faker->streetAddress,
            'address_line2' => $faker->secondaryAddress,
            'town' => $faker->city,
            'county' => $faker->citySuffix,
            'post_code' => $faker->postcode,
            'latitude' => $randomCoordinates['latitude'], // Usa a latitude do par selecionado
            'longitude' => $randomCoordinates['longitude'], // Usa a longitude do par selecionado
        ];
    }
}
