<?php
/**
 * Router for PHP built-in server only.
 * Usage: php -S 127.0.0.1:8000 router.php
 * (.htaccess is ignored by php -S; without this, /about etc. never hit index.php.)
 */
declare(strict_types=1);

if (PHP_SAPI !== 'cli-server') {
    return false;
}

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if ($path !== '/' && $path !== '') {
    $full = __DIR__ . $path;
    if (is_file($full)) {
        return false;
    }
}

chdir(__DIR__);
require __DIR__ . '/index.php';
return true;
