<?php

namespace Database\Factories\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product\ProductItem>
 */
class ProductItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_name' => fake()->sentence(),
            'product_description' => fake()->paragraph(),
            'product_price' => fake()->numberBetween(100000, 10000000),
            'product_stock' => fake()->numberBetween(1, 100),
            'product_slug' => fake()->slug(),
            'product_category_id' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
