<?php
$files = glob(__DIR__ . '/../public/uploads/products/catalog/REFLECTIVE_POLISH*');
foreach ($files as $f) {
    echo basename($f) . " (" . filesize($f) . " bytes)\n";
}
