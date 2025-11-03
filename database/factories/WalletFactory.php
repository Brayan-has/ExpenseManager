<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            "name" => $this->faker->name,
            "origin" => $this->faker->sentence(),
            "quantity" => $this->faker->randomNumber(),
            "project_id" => Project::query()->inRandomOrder()->first()->id ?? Project::factory(), 
        ];
    }
}