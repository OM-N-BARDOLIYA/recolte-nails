<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$sec = \App\Models\PageContent::getSection('home', 'categories_section');
if ($sec && isset($sec['categories'][3])) {
    $sec['categories'][3]['title'] = 'CATE EYES';
    $sec['categories'][3]['link'] = '/products?category=Cat+Eye+Gels';
    \App\Models\PageContent::setSection('home', 'categories_section', $sec);
    echo "Updated categories_section successfully!\n";
} else {
    echo "Section not found or category 3 missing\n";
}
