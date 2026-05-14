<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->active();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name':
                    $query->orderBy('name', 'asc');
                    break;
                case 'newest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->appends($request->query());
        $categories = Category::active()->withCount('activeProducts')->orderBy('sort_order')->get();

        $metaTitle = 'Katalog Sparepart Pelayaran - PT Mitra Sarana Technindo';
        $metaDescription = 'Temukan berbagai sparepart dan suku cadang kapal berkualitas. Komponen mesin kapal, peralatan navigasi, peralatan keselamatan, dan perlengkapan pelayaran lainnya.';

        if ($request->filled('category')) {
            $activeCategory = Category::where('slug', $request->category)->first();
            if ($activeCategory) {
                $metaTitle = $activeCategory->meta_title ?? $activeCategory->name . ' - PT Mitra Sarana Technindo';
                $metaDescription = $activeCategory->meta_description ?? 'Jual ' . $activeCategory->name . ' berkualitas untuk kebutuhan industri pelayaran.';
            }
        }

        return view('public.products.index', compact(
            'products', 'categories', 'metaTitle', 'metaDescription'
        ));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $product->incrementViews();
        $product->load('category');

        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inStock()
            ->take(4)
            ->get();

        return view('public.products.show', compact('product', 'relatedProducts'));
    }
}
