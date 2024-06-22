<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SearchHistory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SearchHistory>
 */
class SearchHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'searched_license_plate' => fake()->regexify('[^[A-Z]{3}[0-9]{3}$'),
            'search_time' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
