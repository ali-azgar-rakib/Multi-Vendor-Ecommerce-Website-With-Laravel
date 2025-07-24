<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        return [
            //
            'name' => ucfirst($name),
            'slug' => Str::slug($name),       // slug generated from name
            'image' => fake()->image('public/uploaded/product', 800, 800, null, false)

        ];
    }
}
