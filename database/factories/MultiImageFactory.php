<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MultiImage>
 */
class MultiImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->randomElement(Product::pluck('id')->toArray()),
            'image' => fake()->image('public/uploaded/product', 800, 800, null, false)
        ];
    }
}
