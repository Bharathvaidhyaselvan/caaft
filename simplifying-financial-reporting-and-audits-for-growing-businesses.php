<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/simplifying\-financial\-reporting\-and\-audits\-for\-growing\-businesses\.php$#', $requestedPath)) {
    header('Location: /insights/simplifying-financial-reporting-and-audits-for-growing-businesses', true, 301);
    exit;
}

include APP_ROOT . '/pages/blog/simplifying-financial-reporting-and-audits-for-growing-businesses.php';
