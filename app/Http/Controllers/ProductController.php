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
        // 1. Manage filter persistence in Session
        if ($request->has('reset') || $request->has('clear')) {
            session()->forget(['catalog_category', 'catalog_sort', 'catalog_search']);
            $selectedCategory = 'all';
            $currentSort = 'featured';
            $searchQuery = '';
        } else {
            // Category filter persistence
            if ($request->has('category')) {
                $selectedCategory = $request->get('category');
                if ($selectedCategory === 'all' || empty($selectedCategory)) {
                    session()->forget('catalog_category');
                    $selectedCategory = 'all';
                } else {
                    session(['catalog_category' => $selectedCategory]);
                }
            } elseif (session()->has('catalog_category') && session('catalog_category') !== 'all') {
                $selectedCategory = session('catalog_category');
            } else {
                $selectedCategory = 'all';
            }

            // Sort option persistence
            if ($request->has('sort')) {
                $currentSort = $request->get('sort');
                if ($currentSort === 'featured' || empty($currentSort)) {
                    session()->forget('catalog_sort');
                    $currentSort = 'featured';
                } else {
                    session(['catalog_sort' => $currentSort]);
                }
            } elseif (session()->has('catalog_sort')) {
                $currentSort = session('catalog_sort');
            } else {
                $currentSort = 'featured';
            }

            // Search query persistence
            if ($request->has('search')) {
                $searchQuery = $request->get('search', '');
                if (trim($searchQuery) === '') {
                    session()->forget('catalog_search');
                    $searchQuery = '';
                } else {
                    session(['catalog_search' => trim($searchQuery)]);
                }
            } elseif (session()->has('catalog_search') && !empty(session('catalog_search'))) {
                $searchQuery = session('catalog_search');
            } else {
                $searchQuery = '';
            }
        }

        $query = Product::where('is_active', true);

        if (!empty($selectedCategory) && $selectedCategory !== 'all') {
            $catSlug = $selectedCategory;
            $category = Category::where('slug', $catSlug)->orWhere('name', $catSlug)->first();
            if ($category) {
                $query->where(function ($q) use ($category) {
                    $q->where('category_id', $category->id)
                      ->orWhere('category', 'like', "%{$category->name}%");
                });
            } else {
                $query->where('category', 'like', "%{$catSlug}%");
            }
        }

        if (!empty($searchQuery)) {
            $search = $searchQuery;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('tagline', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        switch ($currentSort) {
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
