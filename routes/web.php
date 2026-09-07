<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminInquiryController;

// ── PUBLIC FRONTEND STOREFRONT ROUTES ──
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/franchise', [PageController::class, 'franchise'])->name('franchise');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'submitInquiry'])->name('contact.submit');

// ── ADMIN CMS AUTHENTICATION ROUTES ──
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // ── PROTECTED ADMIN CMS DASHBOARD & MODULES ──
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Products Management
        Route::resource('products', AdminProductController::class);
        Route::post('products/{product}/toggle-status', [AdminProductController::class, 'toggleStatus'])->name('products.toggle-status');
        Route::post('products/{product}/toggle-bestseller', [AdminProductController::class, 'toggleBestseller'])->name('products.toggle-bestseller');

        // Categories Management
        Route::resource('categories', AdminCategoryController::class)->except(['create', 'show', 'edit']);

        // Dynamic Page Editors
        Route::get('pages/home', [AdminPageController::class, 'home'])->name('pages.home');
        Route::post('pages/home', [AdminPageController::class, 'updateHome'])->name('pages.home.update');
        Route::get('pages/about', [AdminPageController::class, 'about'])->name('pages.about');
        Route::post('pages/about', [AdminPageController::class, 'updateAbout'])->name('pages.about.update');

        // Studio & WhatsApp Settings
        Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [AdminSettingController::class, 'update'])->name('settings.update');

        // Customer Inquiries
        Route::get('inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
        Route::post('inquiries/{inquiry}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.update-status');
        Route::delete('inquiries/{inquiry}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');
    });
});
