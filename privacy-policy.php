<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/privacy\-policy\.php$#', $requestedPath)) {
    header('Location: /privacy-policy', true, 301);
    exit;
}

include APP_ROOT . '/pages/core/privacy-policy.php';
