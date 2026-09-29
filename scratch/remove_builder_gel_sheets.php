<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$builderGel = \App\Models\Product::where('slug', 'recolte-sculpting-master-builder-gel')->first();
if ($builderGel) {
    $builderGel->images = [
        '/uploads/products/catalog/BUILDER_GEL_builder_gel_1_.png',
        '/uploads/products/catalog/BUILDER_GEL_builder_gel_3_.png',
        '/uploads/products/catalog/BUILDER_GEL_builder_gel_2_.png',
        '/uploads/products/catalog/BUILDER_GEL_artboard_1.jpg',
        '/uploads/products/catalog/BUILDER_GEL_artboard_2.jpg',
        '/uploads/products/catalog/BUILDER_GEL_artboard_3.jpg',
        '/uploads/products/catalog/BUILDER_GEL_artboard_4.jpg',
        '/uploads/products/catalog/BUILDER_GEL_artboard_5.jpg',
        '/uploads/products/catalog/BUILDER_GEL_builder_gel_2_.jpg',
        '/uploads/products/catalog/BUILDER_GEL_builder_gel_5_.jpg',
        '/uploads/products/catalog/BUILDER_GEL_builder_gel_6_.png',
        '/uploads/products/catalog/BUILDER_GEL_builder_gel_7_.png',
        '/uploads/products/catalog/BUILDER_GEL_builder_gel_1_.mp4',
        '/uploads/products/catalog/BUILDER_GEL_video_showcase.mp4',
    ];
    $builderGel->save();
    echo "Removed 3 nail sheet images from Builder Gel. Remaining images count: " . count($builderGel->images) . "\n";
} else {
    echo "Builder Gel product not found.\n";
}
