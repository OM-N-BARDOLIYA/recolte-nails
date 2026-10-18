<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$keywords = ['metallic', 'mixing', 'polygel', 'reflective', 'rhinestone', 'rubber', 'spider', '6-in-1'];

foreach (\App\Models\Product::orderBy('id')->get() as $p) {
    $match = false;
    foreach ($keywords as $kw) {
        if (stripos($p->slug, $kw) !== false || stripos($p->title, $kw) !== false) {
            $match = true;
            break;
        }
    }
    if ($match) {
        echo "========================================\n";
        echo "ID: {$p->id} | Slug: {$p->slug}\n";
        echo "Title: {$p->title}\n";
        echo "Main Image: {$p->main_image}\n";
        echo "Images (" . count($p->images ?? []) . "): " . json_encode($p->images, JSON_PRETTY_PRINT) . "\n";
        echo "Shades: " . json_encode($p->shades) . "\n";
        echo "Sizes: " . json_encode($p->sizes) . "\n";
    }
}
