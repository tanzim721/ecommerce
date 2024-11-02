<?php

namespace Database\Factories;

use Faker\Core\Number;
use App\Enums\EmploymentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CareerJob>
 */
class CareerJobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realText(60),
            'company_name' => fake()->company(),
            'employment_type' => fake()->randomElement(EmploymentType::cases()),
            'role' => fake()->jobTitle(),
            'apply_url' => fake()->url(),
            'company_logo' => fake()->imageUrl(100, 100),
            'description' => fake()->realText(),
            'salary' => '$' . fake()->numberBetween(500, 10000) . '-' . '$' . fake()->numberBetween(500, 10000),
        ];
    }
}
