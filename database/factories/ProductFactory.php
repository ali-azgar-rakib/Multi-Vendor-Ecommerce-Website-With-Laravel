<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
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

    public function category_id(): int
    {
        return fake()->randomElement(Category::pluck('id')->toArray());
    }
    public function definition(): array
    {
        return [
            'category_id' => $this->category_id(),
            'sub_category_id' => fake()->randomElement(Category::find($this->category_id())->sub_categories()->pluck('id')->toArray()),
            'brand_id' => fake()->randomElement(Brand::pluck('id')->toArray()),
            'vendor_id' => fake()->randomElement(User::pluck('id')->toArray()),
            'hot_deals' => fake()->randomElement([0, 1]),
            'featured' => fake()->randomElement([0, 1]),
            'special_offer' => fake()->randomElement([0, 1]),
            'special_deal' => fake()->randomElement([0, 1]),
            'product_name' => fake()->text(100),
            'product_slug' => fake()->slug(),
            'product_id' => fake()->bothify("????_###"),
            'product_tags' => serialize(fake()->randomElements(['new', 'hot', 'mixed', 'deal'], null)),
            'product_sizes' => serialize(fake()->randomElements(['sm', 'md', 'xl', 'xxl'], null)),
            'product_colors' => serialize(fake()->randomElements([fake()->safeColorName(), fake()->safeColorName(), fake()->safeColorName(), fake()->safeColorName(), fake()->safeColorName(), fake()->safeColorName()], null)),
            'product_quantity' => fake()->randomNumber(3),
            'selling_price' => fake()->randomNumber(5),
            'discount' => fake()->numberBetween(0, 50),
            'short_desc' => fake()->sentence(),
            'long_desc' => fake()->paragraph(5),
            'thumbnail' => fake()->image('public/uploaded/product', 800, 800, null, false)

        ];
    }
}
