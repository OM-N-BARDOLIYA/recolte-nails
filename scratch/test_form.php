<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
view()->share('errors', new \Illuminate\Support\ViewErrorBag);

$categories = App\Models\Category::all();
$product = new App\Models\Product();
$html = view('admin.products.form', compact('categories', 'product'))->render();

echo '=== CREATE PRODUCT TEST ===' . PHP_EOL;
echo 'Length: ' . strlen($html) . PHP_EOL;
echo 'Contains Create New Product: ' . (str_contains($html, 'Create New Product') ? 'YES' : 'NO') . PHP_EOL;
echo 'Contains Publish Product: ' . (str_contains($html, 'Publish Product to Live Website') ? 'YES' : 'NO') . PHP_EOL;
echo 'Contains PUT method: ' . (str_contains($html, 'value="PUT"') ? 'YES' : 'NO') . PHP_EOL;
echo 'Form Action contains admin/products (POST): ' . (str_contains($html, 'action="http://localhost:8000/admin/products"') ? 'YES' : 'NO') . PHP_EOL;

$existingProduct = App\Models\Product::first();
if ($existingProduct) {
    $editHtml = view('admin.products.form', ['categories' => $categories, 'product' => $existingProduct])->render();
    echo '=== EDIT PRODUCT TEST ===' . PHP_EOL;
    echo 'Contains Edit: ' . (str_contains($editHtml, 'Edit: ' . $existingProduct->title) ? 'YES' : 'NO') . PHP_EOL;
    echo 'Contains Save & Update: ' . (str_contains($editHtml, 'Save & Update Product') ? 'YES' : 'NO') . PHP_EOL;
    echo 'Contains PUT method: ' . (str_contains($editHtml, 'value="PUT"') ? 'YES' : 'NO') . PHP_EOL;
    echo 'Contains Live Page link: ' . (str_contains($editHtml, 'View Live Page') ? 'YES' : 'NO') . PHP_EOL;
}
