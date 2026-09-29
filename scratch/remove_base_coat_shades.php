<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$baseCoat = \App\Models\Product::where('slug', 'recolte-excellent-base-coat')->first();
if ($baseCoat) {
    $baseCoat->shades = [];
    $baseCoat->save();
    echo "Removed color filter from Recolte Excellent Base Coat (ID: {$baseCoat->id}).\n";
} else {
    echo "Product not found.\n";
}
