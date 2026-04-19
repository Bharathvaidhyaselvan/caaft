<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/compliance\-calendar\.php$#', $requestedPath)) {
    header('Location: /compliance-calendar', true, 301);
    exit;
}

include APP_ROOT . '/pages/core/compliance-calendar.php';
