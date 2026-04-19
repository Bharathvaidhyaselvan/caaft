<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/how\-caaft\-consultancy\-services\-supports\-small\-businesses\-with\-gst\-compliance\-in\-chennai\.php$#', $requestedPath)) {
    header('Location: /insights/how-caaft-consultancy-services-supports-small-businesses-with-gst-compliance-in-chennai', true, 301);
    exit;
}

include APP_ROOT . '/pages/blog/how-caaft-consultancy-services-supports-small-businesses-with-gst-compliance-in-chennai.php';
