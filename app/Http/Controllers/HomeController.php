<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('is_bestseller', true)->take(4)->get();
        $popularNails = Product::take(4)->get();
        $pressOnSets = Product::where('category', 'Press-On Nails')->get();
        $nailCare = Product::where('category', 'Nail Care & Elixirs')->get();

        return view('home', compact('featuredProducts', 'popularNails', 'pressOnSets', 'nailCare'));
    }
}
