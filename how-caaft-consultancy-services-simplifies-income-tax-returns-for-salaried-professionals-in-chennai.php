<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/how\-caaft\-consultancy\-services\-simplifies\-income\-tax\-returns\-for\-salaried\-professionals\-in\-chennai\.php$#', $requestedPath)) {
    header('Location: /insights/how-caaft-consultancy-services-simplifies-income-tax-returns-for-salaried-professionals-in-chennai', true, 301);
    exit;
}

include APP_ROOT . '/pages/blog/how-caaft-consultancy-services-simplifies-income-tax-returns-for-salaried-professionals-in-chennai.php';
