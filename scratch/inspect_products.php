<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

foreach (\App\Models\Product::orderBy('id')->get() as $p) {
    $shadeNames = array_map(fn($s) => is_array($s) ? ($s['name'] ?? '') : $s, $p->shades ?? []);
    echo sprintf(
        "[%2d] %-40s | %-45s | Shades: %-30s | Sizes: %s\n",
        $p->id,
        $p->slug,
        mb_strimwidth($p->title, 0, 43, '...'),
        mb_strimwidth(implode(', ', $shadeNames), 0, 28, '...'),
        implode(', ', $p->sizes ?? [])
    );
}
