<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $sort = $request->get('sort', 'featured');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'bestsellers':
                $query->where('is_bestseller', true);
                break;
            default:
                $query->orderBy('id', 'asc');
                break;
        }

        $products = $query->get();
        $categories = ['Skincare', 'Makeup', 'Haircare', 'Fragrance', 'Body Care', 'Nails'];
        $selectedCategory = $request->get('category', 'all');
        $searchQuery = $request->get('search', '');
        $currentSort = $sort;

        return view('products.index', compact('products', 'categories', 'selectedCategory', 'searchQuery', 'currentSort'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
