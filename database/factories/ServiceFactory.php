<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'church_id' => \App\Models\Church::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'day_of_week' => $this->faker->numberBetween(1, 7),
            'service_time' => $this->faker->time(),
        ];
    }
}
