<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentence(20),
            'deadline' => fake()->dateTimeBetween('+2 days', '+6 months'),
            'status' => fake()->randomElement(array_values(Config::get('constants.PROJECT_STATUS'))),
            'cost' => fake()->randomFloat(2, Config::get('constants.MIN_COST'), Config::get('constants.MAX_COST')),
            'client_id' => Client::factory()
        ];
    }
}
