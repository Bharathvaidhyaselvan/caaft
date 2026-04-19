<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/blog1\.php$#', $requestedPath)) {
    header('Location: /blog', true, 301);
    exit;
}

include APP_ROOT . '/pages/blog/blog1.php';
