<?php
require __DIR__ . '/../vendor/autoload.php';

foreach (glob('public/uploads/products/catalog/BUILDER_GEL_*') as $f) {
    echo basename($f) . " (" . filesize($f) . " bytes)\n";
}
