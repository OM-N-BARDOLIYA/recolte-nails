<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

$seederPath = __DIR__ . '/../database/seeders/DatabaseSeeder.php';
$content = file_get_contents($seederPath);

foreach (Product::orderBy('id')->get() as $p) {
    if (!$p->images) continue;
    
    // Find the product block by slug
    $slugPattern = "/'slug'\s*=>\s*'" . preg_quote($p->slug, '/') . "'.*?'images'\s*=>\s*\[(.*?)\]/s";
    
    // Format new images php code
    $formattedImages = "\n";
    foreach ($p->images as $img) {
        $formattedImages .= "                    '" . $img . "',\n";
    }
    $formattedImages .= "                ";
    
    if (preg_match($slugPattern, $content, $m)) {
        $replacement = "'images' => [" . $formattedImages . "]";
        $content = preg_replace(
            "/'slug'\s*=>\s*'" . preg_quote($p->slug, '/') . "'.*?'images'\s*=>\s*\[.*?\]/s",
            preg_replace("/'images'\s*=>\s*\[.*?\]/s", $replacement, $m[0]),
            $content,
            1
        );
        echo "Updated seeder for {$p->slug} (ID: {$p->id})\n";
    }
}

file_put_contents($seederPath, $content);
echo "\nDatabaseSeeder.php successfully synchronized with all current product image orders!\n";
