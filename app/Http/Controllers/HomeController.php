<?php

namespace App\Http\Controllers;

use App\Models\PageContent;
use App\Models\Product;
use App\Models\SiteSetting;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_active', true)
            ->where('is_bestseller', true)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        if ($featuredProducts->isEmpty()) {
            $featuredProducts = Product::where('is_active', true)
                ->orderBy('sort_order', 'asc')
                ->take(6)
                ->get();
        }

        $popularNails = Product::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->take(6)
            ->get();

        $allNails = Product::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->take(8)
            ->get();

        $pressOnSets = Product::where('is_active', true)
            ->where('category', 'like', '%Press-On%')
            ->orderBy('sort_order', 'asc')
            ->get();

        $nailCare = Product::where('is_active', true)
            ->where(function ($q) {
                $q->where('category', 'like', '%Care%')
                  ->orWhere('category', 'like', '%Oil%')
                  ->orWhere('category', 'like', '%Elixir%');
            })
            ->orderBy('sort_order', 'asc')
            ->get();

        // Dynamic Page Contents matching live storefront sections
        $hero = PageContent::getSection('home', 'hero', [
            'bg_image' => asset('images/banners/recolte-hd-hero-bg.jpg'),
            'brand_title' => 'Recolte',
            'brand_trademark' => '®',
            'sub_descriptor' => 'NAILS • BEAUTY • YOU',
            'script_line' => 'Create • Express • Shine',
            'subtitle' => 'Premium Nail Products for Professionals & Enthusiasts',
            'cta_text' => 'SHOP NOW',
            'cta_url' => '/products',
        ]);

        $trust_strip = PageContent::getSection('home', 'trust_strip', [
            'items' => [
                ['title' => 'Premium Quality', 'sub' => 'Products', 'icon' => 'diamond'],
                ['title' => 'Safe & Skin Friendly', 'sub' => 'Formulas', 'icon' => 'shield'],
                ['title' => 'Fast & Reliable', 'sub' => 'Shipping', 'icon' => 'truck'],
                ['title' => 'Expert Support', 'sub' => 'Always', 'icon' => 'support'],
                ['title' => 'Trusted by', 'sub' => 'Professionals', 'icon' => 'star'],
            ]
        ]);

        $categories_section = PageContent::getSection('home', 'categories_section', [
            'title' => 'Shop by Category',
            'subtitle' => 'Everything you need for perfect nails',
            'categories' => [
                ['title' => 'Gel Polish', 'btn_text' => 'Shop Now', 'link' => '/products?category=Gel+Polishes', 'image' => asset('images/products/recolte-cat-gel-polish.jpg')],
                ['title' => 'Top Coat', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Care+%26+Elixirs', 'image' => asset('images/products/recolte-cat-top-coat.jpg')],
                ['title' => 'Painting Gel', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Art+%26+Accents', 'image' => asset('images/products/recolte-cat-painting-gel.jpg')],
                ['title' => 'Sets & Kits', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Tools+%26+Kits', 'image' => asset('images/products/recolte-cat-nail-kits.jpg')],
            ]
        ]);

        $showcase = PageContent::getSection('home', 'showcase', [
            'title_line1' => 'Colors that',
            'title_line2' => 'cultivate confidence',
            'description' => 'Dedicated to salon-grade perfection, Japanese gel formulas, and effortless everyday elegance.',
            'btn_text' => 'Find more',
            'btn_url' => '/products',
            'image' => asset('images/banners/recolte-colors-showcase.jpg'),
        ]);

        $instagram = PageContent::getSection('home', 'instagram', [
            'badge' => 'Atelier Community',
            'title' => 'Join Our Nail Community',
            'subtitle' => 'Follow @recolte_gelpolish for seasonal nail art tutorials, custom press-on launches, and salon-grade transformations.',
            'handle' => '@recolte_gelpolish',
            'profile_url' => 'https://www.instagram.com/recolte_gelpolish/',
            'btn_text' => 'Follow @recolte_gelpolish',
            'posts' => [
                ['image' => asset('images/products/recolte-cat-top-coat.jpg'), 'alt' => 'Récolte Rose Gold Finish', 'link' => 'https://www.instagram.com/recolte_gelpolish/'],
                ['image' => asset('images/products/recolte-cat-painting-gel.jpg'), 'alt' => 'Récolte Painting Gel Glitter', 'link' => 'https://www.instagram.com/recolte_gelpolish/'],
                ['image' => asset('images/products/recolte-cat-nail-kits.jpg'), 'alt' => 'Récolte Atelier Arch Sets', 'link' => 'https://www.instagram.com/recolte_gelpolish/'],
            ]
        ]);

        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('home', compact(
            'featuredProducts',
            'popularNails',
            'allNails',
            'pressOnSets',
            'nailCare',
            'hero',
            'trust_strip',
            'categories_section',
            'showcase',
            'instagram',
            'settings'
        ));
    }
}
