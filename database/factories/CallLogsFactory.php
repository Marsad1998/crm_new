<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CallLogsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CallLog::class;

    public function definition(): array
    {
        return [
            'lead_id' => Lead::factory(),
            'user_id' => $this->faker->randomNumber(),
            'status' => $this->faker->randomElement(['Active', 'Booked', 'Failed', 'Invalid', 'Warning']),
            'incoming' => $this->faker->numberBetween(0, 1),
            'timestamp' => $this->faker->dateTime(),
            'notes' => $this->faker->text,
        ];
    }
}
