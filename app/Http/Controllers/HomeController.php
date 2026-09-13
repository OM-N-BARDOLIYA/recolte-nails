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
            'bg_image' => asset('images/banners/hero-slide-main-recolte.png'),
            'brand_title' => 'Recolte',
            'brand_trademark' => '®',
            'sub_descriptor' => 'NAILS • BEAUTY • YOU',
            'script_line' => 'Create • Express • Shine',
            'subtitle' => 'Premium Nail Products for Professionals & Enthusiasts',
            'cta_text' => 'SHOP NOW',
            'cta_url' => '/products',
            'slides' => [
                [
                    'bg_image' => asset('images/banners/hero-slide-main-recolte.png'),
                    'sub_descriptor' => 'NAILS • BEAUTY • YOU',
                    'script_line' => 'Create • Express • Shine',
                    'subtitle' => 'Premium Nail Products for Professionals & Enthusiasts',
                    'cta_text' => 'SHOP NOW',
                    'cta_url' => '/products',
                ],
                [
                    'bg_image' => asset('images/banners/hero-slide-spotlight-96.png'),
                    'sub_descriptor' => 'SPOTLIGHT ATELIER • 96 SALON SHADES',
                    'script_line' => 'Curated Color Harmony',
                    'subtitle' => '96 Master Palette Gel Polish Shades Engineered for Runway Manicures & Salon Artists',
                    'cta_text' => 'EXPLORE 96 PALETTES',
                    'cta_url' => '/products?category=Gel+Polishes',
                ],
                [
                    'bg_image' => asset('images/banners/hero-slide-dust-collector.png'),
                    'sub_descriptor' => 'PROFESSIONAL SALON TECH • AIR PURITY',
                    'script_line' => 'Pure Salon Comfort',
                    'subtitle' => 'High-Powered Turbo Ventilation & Micro-Filtration for a Clean, Dust-Free Atelier Environment',
                    'cta_text' => 'DISCOVER EQUIPMENT',
                    'cta_url' => '/products?category=Nail+Tools+%26+Kits',
                ],
                [
                    'bg_image' => asset('images/banners/hero-slide-uv-led-lamp.png'),
                    'sub_descriptor' => 'ADVANCED UV/LED TECH • DUAL OPTICS',
                    'script_line' => 'Fast & Flawless Curing',
                    'subtitle' => 'Salon-Grade Smart Timing & 120s Sensor Curing for Mirror-Shine Durability and Zero Heat Spikes',
                    'cta_text' => 'SHOP UV/LED LAMPS',
                    'cta_url' => '/products?category=Nail+Tools+%26+Kits',
                ],
                [
                    'bg_image' => asset('images/banners/hero-slide-cat-eye-60.png'),
                    'sub_descriptor' => 'VELVET MAGNETIC COUTURE • 60 SHADES',
                    'script_line' => 'Chameleon Magnetic Depth',
                    'subtitle' => '60 Dimensional Cat-Eye Magnetic Gels with Pearlescent Beams & Multi-Angle Velvet Reflections',
                    'cta_text' => 'SHOP CAT EYE GELS',
                    'cta_url' => '/products?category=Nail+Art+%26+Accents',
                ],
            ]
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
                ['title' => 'Shades', 'btn_text' => 'Shop Now', 'link' => '/products?category=Gel+Polishes', 'image' => asset('images/products/recolte-cat-nail-kits.jpg')],
                ['title' => 'UV Lamps', 'btn_text' => 'Shop Now', 'link' => '/products?category=Nail+Tools+%26+Kits', 'image' => asset('images/products/recolte-cat-uv-lamps.jpg')],
                ['title' => 'Builder Gel', 'btn_text' => 'Shop Now', 'link' => '/products?category=Builder+Gel', 'image' => asset('images/products/recolte-cat-builder-gel.jpg')],
                ['title' => 'Tips', 'btn_text' => 'Shop Now', 'link' => '/products?category=Press-On+Sets', 'image' => asset('images/products/recolte-cat-tips.jpg')],
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
                [
                    'video' => asset('videos/community/community-reel-1.mp4'),
                    'poster' => asset('videos/community/community-reel-1-poster.jpg'),
                    'image' => asset('videos/community/community-reel-1-poster.jpg'),
                    'alt' => 'Récolte Salon Gel Application',
                    'link' => 'https://www.instagram.com/recolte_gelpolish/'
                ],
                [
                    'video' => asset('videos/community/community-reel-2.mp4'),
                    'poster' => asset('videos/community/community-reel-2-poster.jpg'),
                    'image' => asset('videos/community/community-reel-2-poster.jpg'),
                    'alt' => 'Crimson & Gold Atelier Waves',
                    'link' => 'https://www.instagram.com/recolte_gelpolish/'
                ],
                [
                    'video' => asset('videos/community/community-reel-3.mp4'),
                    'poster' => asset('videos/community/community-reel-3-poster.jpg'),
                    'image' => asset('videos/community/community-reel-3-poster.jpg'),
                    'alt' => 'Rose Gold Leopard Couture Art',
                    'link' => 'https://www.instagram.com/recolte_gelpolish/'
                ],
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
