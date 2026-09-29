<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\PageContent;
use App\Models\User;

$replaces = [
    'RÉCOLTE' => 'RECOLTE',
    'Récolte' => 'Recolte',
    'récolte' => 'recolte',
];

// 1. Products
$products = Product::all();
$prodCount = 0;
foreach ($products as $p) {
    $changed = false;
    foreach (['title', 'tagline', 'description', 'key_ingredients', 'how_to_use', 'category'] as $col) {
        if ($p->$col) {
            $orig = $p->$col;
            $new = str_replace(array_keys($replaces), array_values($replaces), $orig);
            if ($orig !== $new) {
                $p->$col = $new;
                $changed = true;
            }
        }
    }
    if ($p->benefits && is_array($p->benefits)) {
        $orig = json_encode($p->benefits);
        $new = str_replace(array_keys($replaces), array_values($replaces), $orig);
        if ($orig !== $new) {
            $p->benefits = json_decode($new, true);
            $changed = true;
        }
    }
    if ($p->shades && is_array($p->shades)) {
        $orig = json_encode($p->shades);
        $new = str_replace(array_keys($replaces), array_values($replaces), $orig);
        if ($orig !== $new) {
            $p->shades = json_decode($new, true);
            $changed = true;
        }
    }
    if ($p->sizes && is_array($p->sizes)) {
        $orig = json_encode($p->sizes);
        $new = str_replace(array_keys($replaces), array_values($replaces), $orig);
        if ($orig !== $new) {
            $p->sizes = json_decode($new, true);
            $changed = true;
        }
    }
    if ($changed) {
        $p->save();
        $prodCount++;
    }
}
echo "Updated $prodCount products.\n";

// 2. Categories
$catCount = 0;
foreach (Category::all() as $cat) {
    $changed = false;
    foreach (['name', 'description'] as $col) {
        if ($cat->$col) {
            $orig = $cat->$col;
            $new = str_replace(array_keys($replaces), array_values($replaces), $orig);
            if ($orig !== $new) {
                $cat->$col = $new;
                $changed = true;
            }
        }
    }
    if ($changed) {
        $cat->save();
        $catCount++;
    }
}
echo "Updated $catCount categories.\n";

// 3. Site Settings
$settingCount = 0;
foreach (SiteSetting::all() as $s) {
    if ($s->value) {
        $orig = $s->value;
        $new = str_replace(array_keys($replaces), array_values($replaces), $orig);
        if ($orig !== $new) {
            $s->value = $new;
            $s->save();
            $settingCount++;
        }
    }
}
echo "Updated $settingCount site settings.\n";

// 4. Page Content
$pageContentCount = 0;
foreach (PageContent::all() as $pc) {
    if ($pc->content) {
        $orig = json_encode($pc->content, JSON_UNESCAPED_UNICODE);
        $new = str_replace(array_keys($replaces), array_values($replaces), $orig);
        if ($orig !== $new) {
            $pc->content = json_decode($new, true);
            $pc->save();
            $pageContentCount++;
        }
    }
}
echo "Updated $pageContentCount page contents.\n";

// 5. Users
foreach (User::all() as $u) {
    if ($u->name) {
        $orig = $u->name;
        $new = str_replace(array_keys($replaces), array_values($replaces), $orig);
        if ($orig !== $new) {
            $u->name = $new;
            $u->save();
            echo "Updated user name.\n";
        }
    }
}
echo "Database replacement complete!\n";
