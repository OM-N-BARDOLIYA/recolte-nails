<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\PageContent;

echo "=== STARTING CLIENT UPDATES ===\n";

// 1. BIAB - INSTEAD OF COLOR FILTERS, NUMBERING 01 TO 09
$biab = Product::where('slug', 'recolte-biab-liquid-builder-gel')->first();
if ($biab) {
    $biabShades = [];
    for ($i = 1; $i <= 9; $i++) {
        $num = str_pad($i, 2, '0', STR_PAD_LEFT);
        $biabShades[] = [
            'name' => $num,
            'hex' => '#E8B4B8',
        ];
    }
    $biab->shades = $biabShades;
    $biab->save();
    echo "1. BIAB updated with numbering 01 to 09\n";
}

// 2. BUILDER GEL - INSTEAD OF COLOR FILTERS, NUMBERING 01 TO 13, CHANGE SIZE FILTERS - 15ML, 30ML, 50ML, REMOVE 3 NAILS SHEET IMAGES
$bg = Product::where('slug', 'recolte-sculpting-master-builder-gel')->first();
if ($bg) {
    $bgShades = [];
    for ($i = 1; $i <= 13; $i++) {
        $num = str_pad($i, 2, '0', STR_PAD_LEFT);
        $bgShades[] = [
            'name' => $num,
            'hex' => '#F4C7CB',
        ];
    }
    $bg->shades = $bgShades;
    $bg->sizes = ['15ml', '30ml', '50ml'];
    
    // Filter out 3 nail sheet images: builder_gel_3_.jpg, builder_gel_4_.jpg, builder_gel_1_.jpg
    $filteredImages = array_values(array_filter($bg->images ?? [], function($img) {
        return !str_contains($img, 'builder_gel_3_.jpg') && 
               !str_contains($img, 'builder_gel_4_.jpg') && 
               !str_contains($img, 'builder_gel_1_.jpg');
    }));
    $bg->images = $filteredImages;
    $bg->save();
    echo "2. Builder Gel updated: 01 to 13, sizes 15ml, 30ml, 50ml, removed 3 nail sheets (remaining images: " . count($filteredImages) . ")\n";
}

// 3. CARVING GEL - INSTEAD OF COLOR FILTERS, NUMBERING 01 TO 06, SIZE 5GM REMOVE SCULPTURE WORD FROM TITLE
$cg = Product::where('slug', 'recolte-3d-sculpture-carving-gel')->first();
if ($cg) {
    $cg->title = 'Récolte 3D Carving Gel';
    $cgShades = [];
    for ($i = 1; $i <= 6; $i++) {
        $num = str_pad($i, 2, '0', STR_PAD_LEFT);
        $cgShades[] = [
            'name' => $num,
            'hex' => '#FFFFFF',
        ];
    }
    $cg->shades = $cgShades;
    $cg->sizes = ['5gm'];
    $cg->save();
    echo "3. Carving Gel updated: Title '{$cg->title}', numbering 01 to 06, size 5gm\n";
}

// 4. GEL POLISH -> 208 -> REMOVE SUITE WORD FROM TITLE AND COLOR OPTIONS FILTER, SIZE - 15ML
$gp208 = Product::where('slug', 'recolte-208-colors-master-salon-gel-polish-suite')->first();
if ($gp208) {
    $gp208->title = 'Récolte 208 Colors Master Salon Gel Polish';
    $gp208->shades = [];
    $gp208->sizes = ['15ml'];
    $gp208->save();
    echo "4. Gel Polish 208 updated: Title '{$gp208->title}', no shades, size 15ml\n";
}

// 5. GEL POLISH -> 150 -> REMOVE COLOR OPTION FILTERS, SIZE - 8ML, 15ML
$gp150 = Product::where('slug', 'recolte-150-shades-classic-gel-polish-luxury-collection')->first();
if ($gp150) {
    $gp150->shades = [];
    $gp150->sizes = ['8ml', '15ml'];
    $gp150->save();
    echo "5. Gel Polish 150 updated: no shades, sizes 8ml, 15ml\n";
}

// 6. GEL POLISH 96 -> REMOVE COLOR OPTION, CHANGE TITLE - RECOLTE 96 SHADES SIGNATURE GEL POLISH LUXURIOUS SALON KIT, SIZE - 15ML
$gp96 = Product::where('slug', 'recolte-96-shades-signature-gel-polish-set')->first();
if ($gp96) {
    $gp96->title = 'Récolte 96 Shades Signature Gel Polish Luxurious Salon Kit';
    $gp96->shades = [];
    $gp96->sizes = ['15ml'];
    $gp96->save();
    echo "6. Gel Polish 96 updated: Title '{$gp96->title}', no shades, size 15ml\n";
}

// 7. GEL POLISH R1 -> 60 -> REMOVE COLOR OPTION, SIZE - 8ML, 15ML
$gpR1 = Product::where('slug', 'recolte-60-shades-essential-gel-polish-kit-r1-series')->first();
if ($gpR1) {
    $gpR1->shades = [];
    $gpR1->sizes = ['8ml', '15ml'];
    $gpR1->save();
    echo "7. Gel Polish R1 updated: no shades, sizes 8ml, 15ml\n";
}

// 8. GEL POLISH R2 -> 60 -> REMOVE COLOR OPTION, SIZE - 8ML, 15ML
$gpR2 = Product::where('slug', 'recolte-60-shades-prestige-gel-polish-kit-r2-series')->first();
if ($gpR2) {
    $gpR2->shades = [];
    $gpR2->sizes = ['8ml', '15ml'];
    $gpR2->save();
    echo "8. Gel Polish R2 updated: no shades, sizes 8ml, 15ml\n";
}

// 9. MATTE TOP COAT -> REMOVE VELVET WORD FROM TITLE, INSTEAD OF COLORS SELECTION FILTERS, ADD SELECTION OF REGULAR AND RUSSIAN TOP COAT, SIZE 15ML
$matte = Product::where('slug', 'recolte-velvet-matte-top-coat')->first();
if ($matte) {
    $matte->title = 'Récolte Matte Top Coat';
    $matte->shades = [
        ['name' => 'Regular Top Coat', 'hex' => '#F4EFEB'],
        ['name' => 'Russian Top Coat', 'hex' => '#FFFFFF'],
    ];
    $matte->sizes = ['15ml'];
    $matte->save();
    echo "9. Matte Top Coat updated: Title '{$matte->title}', shades Regular and Russian, size 15ml\n";
}

// 10. PAINTING GEL -> REMOVE COLOR OPTION, ADD NOTE - NON SPREADABLE , SIZE - 5GM
$painting = Product::where('slug', 'recolte-fine-art-nail-painting-gel')->first();
if ($painting) {
    $painting->shades = [];
    $painting->sizes = ['5gm'];
    $painting->save();
    echo "10. Painting Gel updated: no shades, size 5gm\n";
}

// 11. PLATINUM GEL -> REMOVE FOIL WORD FROM TITLE, REMOVE COLOR OPTION, SIZE - 5GM
$plat = Product::where('slug', 'recolte-platinum-foil-glitter-gel')->first();
if ($plat) {
    $plat->title = 'Récolte Platinum Glitter Gel';
    $plat->shades = [];
    $plat->sizes = ['5gm'];
    $plat->save();
    echo "11. Platinum Gel updated: Title '{$plat->title}', no shades, size 5gm\n";
}

// 12. HOME PAGE 4TH CATEGORY -> TIPS to CAT EYES
$catSec = PageContent::where('page', 'home')->where('section_key', 'categories_section')->first();
if ($catSec && isset($catSec->content['categories'])) {
    $c = $catSec->content;
    if (isset($c['categories'][3])) {
        $c['categories'][3]['title'] = 'Cat Eyes';
    }
    $catSec->content = $c;
    $catSec->save();
    echo "12. Home Page 4th Category updated to 'Cat Eyes'\n";
}

echo "=== ALL CLIENT UPDATES COMPLETED ===\n";
