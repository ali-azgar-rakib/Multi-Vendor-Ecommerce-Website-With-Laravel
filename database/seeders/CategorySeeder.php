<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Category::factory()
            ->count(10)
            ->create()
            ->each(function ($category) {
                // For each category, create 10 posts
                $category->products()->createMany(
                    \App\Models\Product::factory()->count(10)->make()->toArray()
                );
            });
    }
}
