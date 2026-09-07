<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Inquiry;
use App\Models\Product;
use App\Models\SiteSetting;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $activeProducts = Product::where('is_active', true)->count();
        $bestsellerCount = Product::where('is_bestseller', true)->count();
        $totalCategories = Category::count();
        $newInquiries = Inquiry::where('status', 'new')->count();

        $recentProducts = Product::latest()->take(6)->get();
        $recentInquiries = Inquiry::latest()->take(5)->get();

        $whatsappNumber = SiteSetting::get('whatsapp_number', '917016266727');

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'bestsellerCount',
            'totalCategories',
            'newInquiries',
            'recentProducts',
            'recentInquiries',
            'whatsappNumber'
        ));
    }
}
