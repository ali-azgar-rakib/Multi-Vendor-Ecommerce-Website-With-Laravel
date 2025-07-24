<?php

namespace App\View\Composers;

use App\Models\Category;
use Illuminate\View\View;


class HeaderComposer
{


    public function compose(View $view): void
    {
        $full_category = Category::all()->chunk(ceil(Category::all()->count() / 2));
        $categories_start = $full_category[0] ?? [];
        $categories_end = $full_category[1] ?? [];

        $mega_menus = Category::withCount('sub_categories')->with('sub_categories')->orderBy('sub_categories_count', 'desc')->limit(3)->get();


        $view->with([
            'categories_start' => $categories_start,
            'categories_end' => $categories_end,
            'mega_menus' => $mega_menus
        ]);
    }
}
