<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sec = App\Models\PageContent::where('page', 'home')->where('section_key', 'categories_section')->first();
if ($sec) {
    echo "DB content:\n";
    print_r($sec->content);
} else {
    echo "No DB content for categories_section\n";
}
