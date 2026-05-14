<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->featured()
            ->inStock()
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::active()
            ->withCount(['activeProducts'])
            ->orderBy('sort_order')
            ->get();

        $latestProducts = Product::with('category')
            ->active()
            ->latest()
            ->take(8)
            ->get();

        return view('public.home', compact('featuredProducts', 'categories', 'latestProducts'));
    }
}
