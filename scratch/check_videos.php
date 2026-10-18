<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

foreach (\App\Models\Product::orderBy('id')->get() as $p) {
    if ($p->images) {
        foreach ($p->images as $idx => $img) {
            if (strpos($img, '.mp4') !== false) {
                echo "ID: {$p->id} | {$p->title} | Video at index {$idx} of " . count($p->images) . " ($img)\n";
            }
        }
    }
}
