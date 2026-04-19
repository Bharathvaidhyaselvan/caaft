<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/duplicate\-contact\.php$#', $requestedPath)) {
    header('Location: /duplicate-contact', true, 301);
    exit;
}

include APP_ROOT . '/pages/utility/duplicate-contact.php';
