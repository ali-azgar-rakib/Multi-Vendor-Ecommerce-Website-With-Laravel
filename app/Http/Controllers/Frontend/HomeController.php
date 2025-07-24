<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $categories = Category::withCount('products')->orderBy('products_count', 'desc')->with('products')->get();
        $banners = Banner::limit(3)->get();
        $products = Product::inRandomOrder()->limit(15)->with('category')->with('vendor')->get();
        $feature_products = Product::where('featured', 1)->inRandomOrder()->limit(4)->with('category')->with('vendor')->get();
        $categories_with_products = $categories->splice(0, 3);
        $hot_offers = Product::where('hot_deals', 1)->inRandomOrder()->limit(3)->get();
        $special_offers = Product::where('special_offer', 1)->inRandomOrder()->limit(3)->get();
        $special_deals = Product::where('special_deal', 1)->inRandomOrder()->limit(3)->get();
        $recent_products = Product::latest()->limit(3)->get();
        $vendor_list = User::where('role', 'vendor')->withCount('products')->orderBy('products_count', 'desc')->limit(4)->get();
        $categories = $categories ? $categories : [];
        return view('frontend.index', compact('sliders', 'categories', 'banners', 'products', 'feature_products', 'categories_with_products', 'hot_offers', 'special_offers', 'special_deals', 'recent_products', 'vendor_list'));
    }

    public function vendor_details(User $vendor)
    {
        $products = $vendor->products;
        $categories = Category::withCount('products')->orderBy('products_count', 'desc')->limit(5)->get();
        return view('frontend.vendor_details', compact('vendor', 'products', 'categories'));
    }

    public function vendor_list()
    {
        $vendors = User::where('role', 'vendor')->withCount('products')->get();
        return view('frontend.vendor_list', compact('vendors'));
    }

    public function product_by_category(Category $category)
    {
        $products = $category->products;
        $side_categories = Category::withCount('products')->orderBy('products_count', 'desc')->limit(5)->get();
        $new_products = Product::latest()->limit(5)->get();
        return view('frontend.product_by_category', compact('products', 'category', 'side_categories', 'new_products'));
    }
}
