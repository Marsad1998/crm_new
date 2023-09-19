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
            'name' => $this->faker->name(),
            'category' => $this->faker->randomElement(['Automotive', 'Buildings']), // Replace with your enum values
            'flat_charge' => $this->faker->numberBetween(1, 10), // Assuming it's a tinyInteger field with values between 1 and 10
            'type' => $this->faker->randomElement(['regular', 'flat_rate', 'option_based']), // Replace with your enum values
            'operator' => $this->faker->randomElement(['additive', 'multiplicative']), // Replace with your enum values
            'price' => $this->faker->randomFloat(2, 10, 100), // Random decimal with 2 decimal places between 10 and 100
            'choices' => $this->faker->randomElement(['key_type_id', 'pts', 'oem', 'akl']), // Replace with your enum values
            'order' => $this->faker->numberBetween(1, 100), // Assuming it's an integer field with values between 1 and 100
        ];
    }
}
