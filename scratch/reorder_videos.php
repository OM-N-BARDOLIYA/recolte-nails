<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

echo "1. UPDATING REFLECTIVE POLISH (ID 33):\n";
$p33 = Product::find(33);
if ($p33) {
    // Current images:
    // [0] REFLECTIVE_POLISH_Recolte-24_Flash_3_.jpg
    // [1] REFLECTIVE_POLISH_Recolte-24_Flash_1_.jpg (TO BE REMOVED)
    // [2] REFLECTIVE_POLISH_Recolte-24_Flash_4_.jpg
    // [3] REFLECTIVE_POLISH_Recolte-24_Flash_5_.jpg
    // [4] REFLECTIVE_POLISH_Recolte-24_Flash_6_.jpg
    // [5] REFLECTIVE_POLISH_Recolte-24_Flash_7_.jpg
    // [6] REFLECTIVE_POLISH_bottle_2_.jpg
    // [7] REFLECTIVE_POLISH_Recolte-24_Flash.mp4
    $current = $p33->images;
    // Remove 2nd image (index 1)
    if (isset($current[1]) && str_contains($current[1], 'Recolte-24_Flash_1_')) {
        array_splice($current, 1, 1);
        echo "Removed 2nd image (Recolte-24_Flash_1_)\n";
    }
    $p33->images = array_values($current);
    $p33->save();
}

echo "\n2. REARRANGING VIDEOS FOR ALL PRODUCTS (FROM LAST TO BETWEEN INDEX 1 AND SECOND-TO-LAST):\n";

// Target positions for products with videos (randomly/varied between index 1 and second-to-last)
// Notice: index 0 is always main photo.
$targetIndices = [
    15 => 2, // BIAB: total 7 -> index 2
    16 => 2, // Blooming Gel: total 6 -> index 2
    17 => [2, 5], // Builder Gel: total 14, 2 videos -> index 2 & index 5
    18 => 3, // Carving Gel: total 10 -> index 3
    19 => 1, // Cat Eye A-series: total 6 -> index 1
    20 => 4, // Cat Eye E-series: total 15 -> index 4
    21 => [2, 6], // 208 Gel Polish: total 20, 2 videos -> index 2 & index 6
    22 => 3, // 150 Gel Polish: total 12 -> index 3
    23 => 2, // 96 Gel Polish: total 6 -> index 2
    24 => 1, // 60 Gel Polish R2: total 10 -> index 1
    25 => 1, // 60 Gel Polish R1: total 3 -> index 1
    26 => 3, // Matte Top Coat: total 6 -> index 3
    27 => 2, // Metallic Gel: total 6 -> index 2
    28 => 1, // Mixing Gel: total 4 -> index 1
    29 => 3, // Painting Gel: total 6 -> index 3
    30 => 2, // Platinum Gel: total 11 -> index 2
    33 => 2, // Reflective Polish: total 7 -> index 2
    34 => 1, // Rhinestone Gel: total 10 -> index 1 (already at 1)
    35 => 2, // Rubber Base: total 5 -> index 2
    36 => 1, // Solid Glue Gel: total 4 -> index 1
    37 => 2, // Spider Gel: total 5 -> index 2
    39 => 3, // 6 in 1 Top Coat: total 11 -> index 3
    40 => 2, // Base Coat: total 6 -> index 2
    42 => 3, // Long Wear Top Coat: total 6 -> index 3
];

foreach (Product::orderBy('id')->get() as $p) {
    if (!$p->images) continue;
    
    // Separate non-videos and videos
    $nonVideos = [];
    $videos = [];
    foreach ($p->images as $item) {
        if (str_ends_with($item, '.mp4')) {
            $videos[] = $item;
        } else {
            $nonVideos[] = $item;
        }
    }
    
    if (empty($videos)) continue;
    
    // Get target positions
    $targets = $targetIndices[$p->id] ?? 1;
    if (!is_array($targets)) {
        $targets = [$targets];
    }
    
    // Build new array starting with non-videos
    $newImages = $nonVideos;
    foreach ($videos as $vIdx => $vItem) {
        $insertAt = $targets[$vIdx] ?? 1;
        // Ensure within range [1, count($newImages) - 1] (or count($newImages) if only 1 item)
        $maxIdx = max(1, count($newImages) - 1);
        $insertAt = min($maxIdx, max(1, $insertAt));
        array_splice($newImages, $insertAt, 0, [$vItem]);
    }
    
    $p->images = array_values($newImages);
    $p->save();
    
    // Verify
    $vPos = [];
    foreach ($p->images as $i => $item) {
        if (str_ends_with($item, '.mp4')) {
            $vPos[] = $i;
        }
    }
    echo "ID: {$p->id} | {$p->title} | Total: " . count($p->images) . " | Video at: [" . implode(', ', $vPos) . "]\n";
}
