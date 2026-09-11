<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\PageContent;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('is_active', true);

        if ($request->filled('category') && $request->category !== 'all') {
            $catSlug = $request->category;
            $category = Category::where('slug', $catSlug)->orWhere('name', $catSlug)->first();
            if ($category) {
                $query->where(function ($q) use ($category) {
                    $q->where('category_id', $category->id)
                      ->orWhere('category', $category->name);
                });
            } else {
                $query->where('category', 'like', "%{$catSlug}%");
            }
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('tagline', 'like', "%{$search}%")
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
                $query->where('is_bestseller', true)->orderBy('sort_order', 'asc');
                break;
            default:
                $query->orderBy('sort_order', 'asc')->latest();
                break;
        }

        $products = $query->get();
        $categories = Category::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        $selectedCategory = $request->get('category', 'all');
        $searchQuery = $request->get('search', '');
        $currentSort = $sort;
        $catalog_hero = PageContent::getSection('catalog', 'hero', [
            'badge' => 'HAUTE NAIL COUTURE & CARE ARCHIVES',
            'title_prefix' => 'The Atelier',
            'title_highlight' => 'Catalog',
            'description' => 'Artisanal salon-quality press-on nails, salon-grade Japanese gel polishes, magnetic cat-eye glazes, and 24K gold cuticle elixirs designed for zero natural nail damage.',
        ]);

        $catalog_consultation = PageContent::getSection('catalog', 'consultation', [
            'is_enabled' => true,
            'tag' => 'Bespoke Sizing Consultation',
            'icon' => '📏',
            'description' => 'Send a quick photo of your natural nail bed for custom fit recommendations from our artists.',
            'btn_text' => 'Sizing Advice on WhatsApp',
            'whatsapp_msg' => 'Hello Récolte Nails! I need help measuring my nail sizes for press-ons.',
        ]);

        return view('products.index', compact('products', 'categories', 'selectedCategory', 'searchQuery', 'currentSort', 'catalog_hero', 'catalog_consultation'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where(function ($q) use ($product) {
                $q->where('category', $product->category)
                  ->orWhere('category_id', $product->category_id);
            })
            ->take(3)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::where('is_active', true)
                ->where('id', '!=', $product->id)
                ->take(3)
                ->get();
        }

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
