<?php
// Reset OPcache
if (function_exists('opcache_reset')) {
    opcache_reset();
    echo '<b>OPcache cleared OK</b><br>';
} else {
    echo '<b>OPcache not active (no action needed)</b><br>';
}

// Invalidate specific file
$file = dirname(__DIR__) . '/app/Http/Controllers/Admin/GaleriController.php';
if (function_exists('opcache_invalidate')) {
    opcache_invalidate($file, true);
    echo 'Controller invalidated OK<br>';
}

// Show PHP version and upload limits
echo '<pre>';
echo 'PHP: ' . PHP_VERSION . "\n";
echo 'upload_max_filesize: ' . ini_get('upload_max_filesize') . "\n";
echo 'post_max_size: ' . ini_get('post_max_size') . "\n";
echo 'OPcache enabled: ' . (ini_get('opcache.enable') ? 'YES' : 'NO') . "\n";
echo '</pre>';
echo '<b>Done. Silakan upload foto galeri kembali.</b>';
