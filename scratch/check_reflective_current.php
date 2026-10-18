<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$p = \App\Models\Product::find(33);
echo "Main Image: " . $p->main_image . "\n";
echo "Images:\n";
foreach ($p->images as $i => $img) {
    echo "  [$i] $img\n";
}
