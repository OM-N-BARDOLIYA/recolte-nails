<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;

echo "Applying updates to 8 products...\n\n";

// 1. Metallic Gel (ID 27)
$p27 = Product::find(27);
if ($p27) {
    $p27->title = 'Recolte Metallic Gel';
    $p27->shades = [];
    $p27->save();
    echo "✓ ID 27 Metallic Gel updated: Title='{$p27->title}', Shades count=" . count($p27->shades) . "\n";
}

// 2. Mixing Gel (ID 28)
$p28 = Product::find(28);
if ($p28) {
    $p28->sizes = ['15ml'];
    $p28->save();
    echo "✓ ID 28 Mixing Gel updated: Sizes=" . json_encode($p28->sizes) . "\n";
}

// 3. Polygel (ID 31)
$p31 = Product::find(31);
if ($p31) {
    $p31->title = 'Recolte Polygel';
    $p31->sizes = ['30gm'];
    $p31->images = ['/uploads/products/catalog/POLYGEL_poly_gel_1_.jpg'];
    $p31->main_image = '/uploads/products/catalog/POLYGEL_poly_gel_1_.jpg';
    $p31->save();
    echo "✓ ID 31 Polygel updated: Title='{$p31->title}', Sizes=" . json_encode($p31->sizes) . ", Images count=" . count($p31->images) . "\n";
}

// 4. Reflective Polish (ID 33)
$p33 = Product::find(33);
if ($p33) {
    $mainImg = '/uploads/products/catalog/REFLECTIVE_POLISH_Recolte-24_Flash_3_.jpg';
    $images = [
        '/uploads/products/catalog/REFLECTIVE_POLISH_Recolte-24_Flash_3_.jpg',
        '/uploads/products/catalog/REFLECTIVE_POLISH_Recolte-24_Flash_1_.jpg',
        '/uploads/products/catalog/REFLECTIVE_POLISH_Recolte-24_Flash_4_.jpg',
        '/uploads/products/catalog/REFLECTIVE_POLISH_Recolte-24_Flash_5_.jpg',
        '/uploads/products/catalog/REFLECTIVE_POLISH_Recolte-24_Flash_6_.jpg',
        '/uploads/products/catalog/REFLECTIVE_POLISH_Recolte-24_Flash_7_.jpg',
        '/uploads/products/catalog/REFLECTIVE_POLISH_bottle_2_.jpg',
        '/uploads/products/catalog/REFLECTIVE_POLISH_Recolte-24_Flash.mp4',
    ];
    $p33->main_image = $mainImg;
    $p33->images = $images;
    $p33->shades = [];
    $p33->sizes = ['8ml'];
    $p33->save();
    echo "✓ ID 33 Reflective Polish updated: MainImage='{$p33->main_image}', Shades count=" . count($p33->shades) . ", Sizes=" . json_encode($p33->sizes) . "\n";
}

// 5. Rhinestone Gel (ID 34)
$p34 = Product::find(34);
if ($p34) {
    $p34->title = 'Recolte No-Wipe Precision Gel';
    $p34->sizes = ['15gm'];
    $p34->images = [
        '/uploads/products/catalog/RHINESTONE_GEL_Rhinestone_Gel-No_Wipe.jpg',
        '/uploads/products/catalog/RHINESTONE_GEL_Rhinestone_Gel-No_Wipe_1_.mp4',
        '/uploads/products/catalog/RHINESTONE_GEL_Rhinestone_Gel-No_Wipe_2_.jpg',
        '/uploads/products/catalog/RHINESTONE_GEL_Rhinestone_Gel-No_Wipe_3_.jpg',
        '/uploads/products/catalog/RHINESTONE_GEL_Rhinestone_Gel-No_Wipe_4_.jpg',
        '/uploads/products/catalog/RHINESTONE_GEL_Rhinestone_Gel-No_Wipe_5_.jpg',
        '/uploads/products/catalog/RHINESTONE_GEL_Rhinestone_Gel-No_Wipe_6_.jpg',
        '/uploads/products/catalog/RHINESTONE_GEL_Rhinestone_Gel-No_Wipe_7_.jpg',
        '/uploads/products/catalog/RHINESTONE_GEL_Rhinestone_Gel-No_Wipe_8_.jpg',
        '/uploads/products/catalog/RHINESTONE_GEL_soft_tube_rhinestone_gel.jpg',
    ];
    $p34->save();
    echo "✓ ID 34 Rhinestone Gel updated: Title='{$p34->title}', Sizes=" . json_encode($p34->sizes) . ", Video at index 1\n";
}

// 6. Rubber Base Coat (ID 35)
$p35 = Product::find(35);
if ($p35) {
    $p35->title = 'Recolte 5-in-1 Rubber Base Coat';
    $p35->shades = [
        ['name' => 'Clear', 'hex' => '#ECE5DF'],
        ['name' => 'Milky White', 'hex' => '#F8F4F0'],
        ['name' => 'Peach', 'hex' => '#F5C2A5'],
        ['name' => 'Pink', 'hex' => '#F0B2BA'],
    ];
    $p35->sizes = ['15ml'];
    $p35->save();
    echo "✓ ID 35 Rubber Base Coat updated: Title='{$p35->title}', Shades count=" . count($p35->shades) . ", Sizes=" . json_encode($p35->sizes) . "\n";
}

// 7. Spider Gel (ID 37)
$p37 = Product::find(37);
if ($p37) {
    $p37->shades = [
        ['name' => 'White', 'hex' => '#FFFFFF'],
        ['name' => 'Black', 'hex' => '#111111'],
        ['name' => 'Clear', 'hex' => '#F4EFEB'],
    ];
    $p37->sizes = ['5g'];
    $p37->save();
    echo "✓ ID 37 Spider Gel updated: Shades count=" . count($p37->shades) . ", Sizes=" . json_encode($p37->sizes) . "\n";
}

// 8. 6 in 1 Top Coat (ID 39)
$p39 = Product::find(39);
if ($p39) {
    $p39->title = 'Recolte 6-in-1 No Wipe Top Coat';
    $p39->shades = [
        ['name' => 'Clear', 'hex' => '#FFFFFF'],
    ];
    $p39->sizes = ['50gm'];
    $p39->save();
    echo "✓ ID 39 6 in 1 Top Coat updated: Title='{$p39->title}', Shades count=" . count($p39->shades) . ", Sizes=" . json_encode($p39->sizes) . "\n";
}

echo "\nAll 8 products updated in database successfully.\n";
