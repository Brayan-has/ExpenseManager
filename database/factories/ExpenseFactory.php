<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\user;
use App\Models\wallet;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
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
            "name" => $this->faker->name(),
            "description" => $this->faker->sentence(),
            "value" => $this->faker->randomFloat(2, 10,0),
            "date" => $this->faker->date(),
            "status" => $this->faker->randomElement(['pending', 'paid', 'overdue']),
            "daily" => $this->faker->boolean(),
            "by_week" => $this->faker->boolean(),
            "by_month" => $this->faker->boolean(),
            "annual" => $this->faker->boolean(),
            "user_id" => user::query()->inRandomOrder()->value("id") ?? User::factory(), 
            "wallet_id" => wallet::query()->inRandomOrder()->value("id") ?? User::factory(), 
        ];
    }
}
