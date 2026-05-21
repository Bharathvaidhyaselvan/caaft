<?php
declare(strict_types=1);

if (!defined('APP_ROOT')) {
    define('APP_ROOT', __DIR__);
}

if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', dirname(__DIR__));
}

if (!isset($GLOBALS['appSeoConfig'])) {
    $GLOBALS['appSeoConfig'] = require APP_ROOT . '/config/seo.php';
}

require_once APP_ROOT . '/includes/perf-assets.php';

if (!function_exists('canonical_url')) {
    function canonical_url(string $fallback): string
    {
        $scriptName = basename($_SERVER['SCRIPT_NAME'] ?? '');
        $overrides = $GLOBALS['appSeoConfig']['canonicalOverrides'] ?? [];
        return $overrides[$scriptName] ?? $fallback;
    }
}
