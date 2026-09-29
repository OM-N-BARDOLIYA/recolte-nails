<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$slugs = [
    'recolte-biab-liquid-builder-gel',
    'recolte-sculpting-master-builder-gel',
    'recolte-3d-sculpture-carving-gel',
    'recolte-208-colors-master-salon-gel-polish-suite',
    'recolte-150-shades-classic-gel-polish-luxury-collection',
    'recolte-96-shades-signature-gel-polish-set',
    'recolte-60-shades-prestige-gel-polish-kit-r2-series',
    'recolte-60-shades-essential-gel-polish-kit-r1-series',
    'recolte-velvet-matte-top-coat',
    'recolte-fine-art-nail-painting-gel',
    'recolte-platinum-foil-glitter-gel',
    'recolte-excellent-base-coat',
];

foreach ($slugs as $slug) {
    $p = \App\Models\Product::where('slug', $slug)->first();
    if (!$p) {
        echo "NOT FOUND: $slug\n";
        continue;
    }
    $html = view('products.show', ['product' => $p, 'relatedProducts' => collect()])->render();
    echo sprintf("OK: [%2d] %-40s | %-45s | %d bytes\n", $p->id, $slug, mb_strimwidth($p->title, 0, 42, '...'), strlen($html));
}

// Also test Home page render
$homeHtml = view('home', [
    'featuredProducts' => collect(),
    'popularNails' => collect(),
    'allNails' => collect(),
    'pressOnSets' => collect(),
    'nailCare' => collect(),
    'heroSlides' => \App\Models\PageContent::getSection('home', 'hero', [])['slides'] ?? [],
    'trust_strip' => \App\Models\PageContent::getSection('home', 'trust_strip', []),
    'categories_section' => \App\Models\PageContent::getSection('home', 'categories_section', []),
    'showcase' => \App\Models\PageContent::getSection('home', 'showcase', []),
    'instagram' => \App\Models\PageContent::getSection('home', 'instagram', []),
])->render();
echo "HOME OK: " . strlen($homeHtml) . " bytes\n";
if (str_contains($homeHtml, 'CATE EYES')) {
    echo "VERIFIED: 'CATE EYES' present on Home page!\n";
} else {
    echo "WARNING: 'CATE EYES' not found in Home HTML!\n";
}
