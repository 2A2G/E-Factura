<?php

namespace Database\Factories;

use App\Models\TypeProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type_products_id' => TypeProduct::inRandomOrder()->first()->id ?? 1,
            'code_product' => fake()->regexify('[A-Z]{3}-[0-9]{4}'),
            'name_product' => fake()->words(3, true),
            'price_product' => fake()->randomFloat(2, 10, 1000),
            'quantity_products' => fake()->numberBetween(1, 500),
        ];

    }
}
