<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Church>
 */
class ChurchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->company(),
            //'address' => $this->faker->address(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'religion_id' => \App\Models\Religion::factory(),
            'description' => $this->faker->paragraph(),
            'contact_info' => $this->faker->phoneNumber(),
            'website' => $this->faker->url(),
            'phone_number' => $this->faker->phoneNumber(),
            'is_featured' => $this->faker->boolean(),
            'featured_until' => $this->faker->dateTimeBetween('+1 month', '+1 year'),
            'congregation_size' => $this->faker->numberBetween(50,100),
        ];
    }
}
