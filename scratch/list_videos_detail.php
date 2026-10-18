<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

echo "PRODUCTS WITH VIDEOS:\n";
foreach (Product::orderBy('id')->get() as $p) {
    if (!$p->images) continue;
    $videoIndices = [];
    foreach ($p->images as $idx => $item) {
        if (str_ends_with($item, '.mp4')) {
            $videoIndices[] = $idx;
        }
    }
    if (!empty($videoIndices)) {
        echo "ID: {$p->id} | {$p->title} | Total images: " . count($p->images) . " | Video at indices: " . implode(', ', $videoIndices) . "\n";
    }
}
