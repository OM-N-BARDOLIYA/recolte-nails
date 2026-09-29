<?php

$dirs = [
    __DIR__ . '/../resources',
    __DIR__ . '/../app',
    __DIR__ . '/../database',
    __DIR__ . '/../routes',
    __DIR__ . '/../config',
    __DIR__ . '/../public',
];

$replaces = [
    'R%C3%89COLTE' => 'RECOLTE',
    'R%C3%A9colte' => 'Recolte',
    'r%C3%A9colte' => 'recolte',
    'RÉCOLTE' => 'RECOLTE',
    'Récolte' => 'Recolte',
    'récolte' => 'recolte',
];

$fileCount = 0;
$totalReplacements = 0;

foreach ($dirs as $dir) {
    if (!is_dir($dir)) continue;

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if (!$file->isFile()) continue;

        $ext = strtolower($file->getExtension());
        $allowedExts = ['php', 'js', 'css', 'json', 'svg', 'md', 'html'];
        if (!in_array($ext, $allowedExts)) continue;

        $path = $file->getRealPath();
        $content = file_get_contents($path);
        $newContent = str_replace(array_keys($replaces), array_values($replaces), $content);

        if ($content !== $newContent) {
            file_put_contents($path, $newContent);
            $fileCount++;
            echo "Updated: " . str_replace(realpath(__DIR__ . '/..'), '', $path) . "\n";
        }
    }
}

echo "Finished! Updated $fileCount files.\n";
