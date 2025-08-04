<?php

namespace Database\Factories\Master;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'venue_id' => 1,
            'lang_id' => fake()->numberBetween(1, 2), 
            'event_title' => fake()->sentence(),
            'event_slug' => fake()->slug(),
            'event_description' => fake()->paragraph(),
            'event_content' => fake()->text(),
            'event_start_date' => fake()->date(),
            'event_end_date' => fake()->date(),
            'event_status' => fake()->randomElement(['COMING_SOON', 'NEWS']),
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1,
            'is_active' => 1
        ];
    }
}
