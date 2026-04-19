<?php
require_once __DIR__ . '/app/bootstrap.php';

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '';
if (preg_match('#^/major\-updates\-to\-aoc\-4\-mgt\-7\-roc\-annual\-filing\-forms\.php$#', $requestedPath)) {
    header('Location: /insights/major-updates-to-aoc-4-mgt-7-roc-annual-filing-forms', true, 301);
    exit;
}

include APP_ROOT . '/pages/blog/major-updates-to-aoc-4-mgt-7-roc-annual-filing-forms.php';
