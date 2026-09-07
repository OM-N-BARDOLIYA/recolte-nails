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

        // Dynamic Page Contents
        $hero = PageContent::getSection('home', 'hero', []);
        $pillars = PageContent::getSection('home', 'pillars', []);
        $rituals = PageContent::getSection('home', 'rituals', []);
        $philosophy = PageContent::getSection('home', 'philosophy', []);
        $instagram = PageContent::getSection('home', 'instagram', []);

        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('home', compact(
            'featuredProducts',
            'popularNails',
            'allNails',
            'pressOnSets',
            'nailCare',
            'hero',
            'pillars',
            'rituals',
            'philosophy',
            'instagram',
            'settings'
        ));
    }
}
