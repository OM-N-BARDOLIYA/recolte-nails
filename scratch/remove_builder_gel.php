<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\Category;
use App\Models\PageContent;

// 1. Delete Product
$deletedProducts = Product::where('slug', 'like', '%builder%')
    ->orWhere('title', 'like', '%builder%')
    ->orWhere('category', 'like', '%builder%')
    ->delete();
echo "Deleted {$deletedProducts} products matching builder.\n";

// 2. Delete Category
$deletedCategories = Category::where('slug', 'like', '%builder%')
    ->orWhere('name', 'like', '%builder%')
    ->delete();
echo "Deleted {$deletedCategories} categories matching builder.\n";

// 3. Update Home PageContent categories_section to 4 categories
$homeCats = [
    [
        'title' => 'Gel Polish',
        'btn_text' => 'Shop Now',
        'link' => '/products?category=Gel+Polishes',
        'image' => asset('images/products/recolte-cat-gel-polish.jpg'),
    ],
    [
        'title' => 'Top Coat',
        'btn_text' => 'Shop Now',
        'link' => '/products?category=Nail+Care+%26+Elixirs',
        'image' => asset('images/products/recolte-cat-top-coat.jpg'),
    ],
    [
        'title' => 'Painting Gel',
        'btn_text' => 'Shop Now',
        'link' => '/products?category=Nail+Art+%26+Accents',
        'image' => asset('images/products/recolte-cat-painting-gel.jpg'),
    ],
    [
        'title' => 'Sets & Kits',
        'btn_text' => 'Shop Now',
        'link' => '/products?category=Nail+Tools+%26+Kits',
        'image' => asset('images/products/recolte-cat-nail-kits.jpg'),
    ],
];

PageContent::setSection('home', 'categories_section', [
    'title' => 'Shop by Category',
    'subtitle' => 'Everything you need for perfect nails',
    'categories' => $homeCats,
]);
echo "Updated home categories_section to 4 clean categories.\n";

// 4. Update Home PageContent instagram
$homeInsta = PageContent::getSection('home', 'instagram', []);
if (!empty($homeInsta['posts'])) {
    foreach ($homeInsta['posts'] as &$post) {
        if (str_contains($post['image'], 'builder-gel')) {
            $post['image'] = asset('images/products/recolte-cat-gel-polish.jpg');
            $post['alt'] = 'Récolte Luxury Gel Polish';
        }
    }
    PageContent::setSection('home', 'instagram', $homeInsta);
    echo "Updated home instagram posts.\n";
}

// 5. Update About PageContent concierge and instagram
$aboutConcierge = PageContent::getSection('about', 'concierge', []);
if (!empty($aboutConcierge['img1']) && str_contains($aboutConcierge['img1'], 'builder-gel')) {
    $aboutConcierge['img1'] = asset('images/products/recolte-cat-gel-polish.jpg');
    PageContent::setSection('about', 'concierge', $aboutConcierge);
    echo "Updated about concierge img1.\n";
}

$aboutInsta = PageContent::getSection('about', 'instagram', []);
if (!empty($aboutInsta['img2']) && str_contains($aboutInsta['img2'], 'builder-gel')) {
    $aboutInsta['img2'] = asset('images/products/recolte-cat-gel-polish.jpg');
    PageContent::setSection('about', 'instagram', $aboutInsta);
    echo "Updated about instagram img2.\n";
}

echo "Database cleaned of Builder Gel!\n";
