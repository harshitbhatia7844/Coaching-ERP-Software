<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'password' => fake()->password(),
            'mobile_no' => fake()->unique()->numberBetween(9800000000,9999999999),
            'gender' => fake()->name(),
            'city' => fake()->city(),
            'state' => 'Uttar Pradesh',
            'centre_id' => 'CINDUP1000001',
            'branch_id' => 721
        ];
    }
}
