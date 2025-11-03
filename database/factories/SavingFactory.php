<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Saving>
 */
class SavingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "project_name" => $this->faker->name(),
            "saving_value" => $this->faker->randomNumber(),
            "status" => $this->faker->randomElement(["on progress", "finished", "canceled"]),
            "user_id" => User::query()->inRandomOrder()->value("id") ?? User::factory()
        ];
    }
}
