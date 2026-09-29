<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$p24 = \App\Models\Product::find(24);
if ($p24) {
    $p24->sizes = ['15ml', '8ml'];
    $p24->save();
}

$p25 = \App\Models\Product::find(25);
if ($p25) {
    $p25->sizes = ['15ml', '8ml'];
    $p25->save();
}

echo "Synced sizes for 24 & 25 to ['15ml', '8ml']\n";
