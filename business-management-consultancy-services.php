<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/business-management-consultancy-services\.php$#', $requestedPath)) {
    header('Location: /advisory-cfo/business-advisory-services', true, 301);
    exit;
}

include APP_ROOT . '/pages/services/business-advisory-services.php';
