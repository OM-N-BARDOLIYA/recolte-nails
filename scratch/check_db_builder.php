<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\Category;

echo "--- PRODUCTS ---\n";
foreach (Product::all() as $p) {
    echo "ID: {$p->id} | Title: {$p->title} | Slug: {$p->slug} | Category: {$p->category}\n";
}

echo "\n--- CATEGORIES ---\n";
foreach (Category::all() as $c) {
    echo "ID: {$c->id} | Name: {$c->name} | Slug: {$c->slug}\n";
}
