<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber,
            'name' => $this->faker->name,
            'last_quoted' => $this->faker->randomFloat(2, 0, 1000),
            'notes' => $this->faker->text,
        ];
    }
}
