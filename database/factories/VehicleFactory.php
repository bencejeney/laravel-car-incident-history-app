<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicle;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'license_plate' => fake()->unique()->regexify('^[A-Z]{3}[0-9]{3}$'),
            'brand' => fake()->word,
            'type' => fake()->word,
            'manufacture_year' => fake()->numberBetween(1990, 2023),
            'image' => fake()->imageUrl(),
        ];
    }
}
