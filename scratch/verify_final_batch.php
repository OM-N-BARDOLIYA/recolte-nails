<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$productIds = [27, 28, 31, 33, 34, 35, 37, 39];

echo "VERIFYING 8 PRODUCTS:\n";
echo "====================================================\n";

foreach ($productIds as $id) {
    $p = Product::find($id);
    if (!$p) {
        echo "❌ Product ID $id NOT FOUND!\n";
        continue;
    }

    echo "ID: {$p->id} | Slug: {$p->slug}\n";
    echo "  Title: {$p->title}\n";
    echo "  Main Image: {$p->main_image}\n";
    echo "  Images Count: " . count($p->images ?? []) . "\n";
    if ($p->images) {
        foreach ($p->images as $i => $img) {
            $isVid = str_ends_with($img, '.mp4') ? ' [VIDEO]' : '';
            echo "    [$i] $img$isVid\n";
        }
    }
    echo "  Shades: " . json_encode($p->shades) . "\n";
    echo "  Sizes: " . json_encode($p->sizes) . "\n";

    // Test blade render
    try {
        $view = view('products.show', [
            'product' => $p,
            'relatedProducts' => Product::where('id', '!=', $p->id)->take(4)->get(),
        ])->render();
        echo "  ✓ Blade Render: SUCCESS (" . strlen($view) . " bytes)\n";
    } catch (\Throwable $e) {
        echo "  ❌ Blade Render FAILED: " . $e->getMessage() . "\n";
    }
    echo "----------------------------------------------------\n";
}
