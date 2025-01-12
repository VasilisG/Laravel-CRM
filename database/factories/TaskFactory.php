<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Config;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
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
            'description' => fake()->sentence(10),
            'deadline' => fake()->dateTimeBetween('+2 days', '+6 months'),
            'status' => fake()->randomElement(array_values(Config::get('constants.TASK_STATUS'))),
            'cost' => fake()->randomFloat(2, Config::get('constants.MIN_COST'), Config::get('constants.MAX_COST')),
            'project_id' => Project::factory()
        ];
    }
}
