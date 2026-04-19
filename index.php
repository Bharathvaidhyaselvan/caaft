<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
$requestedRoute = isset($_GET['__route']) ? trim((string) $_GET['__route'], "/") : '';

if ($requestedRoute === '' && !empty($_SERVER['PATH_INFO'])) {
    $requestedRoute = trim((string) $_SERVER['PATH_INFO'], '/');
}

if ($requestedRoute === '') {
    $pathTrim = trim($requestedPath, '/');
    if ($pathTrim !== '' && strcasecmp($pathTrim, 'index.php') !== 0) {
        if (!preg_match('/\.(css|js|mjs|map|png|jpe?g|gif|webp|svg|ico|xml|txt|woff2?|ttf|eot|pdf|zip|html|htm)(\?|$)/i', $pathTrim)) {
            $physical = __DIR__ . '/' . str_replace('/', DIRECTORY_SEPARATOR, $pathTrim);
            if (!is_file($physical)) {
                $requestedRoute = $pathTrim;
            }
        }
    }
}

if ($requestedPath === '/index.php' && $requestedRoute === '') {
    header('Location: /', true, 301);
    exit;
}

$serviceRoutes = require APP_ROOT . '/config/service-routes.php';
$pageRoutes = require APP_ROOT . '/config/page-routes.php';
$allRoutes = $serviceRoutes + $pageRoutes;

if ($requestedRoute !== '' && isset($allRoutes[$requestedRoute])) {
    include APP_ROOT . '/' . $allRoutes[$requestedRoute];
    return;
}

include APP_ROOT . '/pages/core/index.php';
