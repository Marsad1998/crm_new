<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeadItem>
 */
class LeadItemFactory extends Factory
{
    protected $model = LeadItem::class;

    public function definition()
    {
        return [
            'lead_id' => Lead::factory(),
            'price_id' => null,
            'type' => $this->faker->randomElement(['regular', 'flat_rate', 'option_based', 'custom_price']),
            'qty' => $this->faker->numberBetween(1, 10),
        ];
    }
}
