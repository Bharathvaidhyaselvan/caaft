<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/contact\.php$#', $requestedPath)) {
    header('Location: /contact', true, 301);
    exit;
}

include APP_ROOT . '/pages/core/contact.php';
