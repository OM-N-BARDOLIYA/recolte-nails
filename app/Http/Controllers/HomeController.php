<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_bestseller', true)->take(8)->get();
        $skincareSpotlight = Product::where('category', 'Skincare')->take(4)->get();
        $newArrivals = Product::latest()->take(4)->get();
        
        return view('home', compact('featuredProducts', 'skincareSpotlight', 'newArrivals'));
    }
}
