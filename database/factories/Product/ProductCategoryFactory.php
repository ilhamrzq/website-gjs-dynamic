<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master\Product\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_category_name' => fake()->unique()->randomElement(['table', 'cue', 'glove', 'jersey', 'cap', 'ball', 'accessories']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
