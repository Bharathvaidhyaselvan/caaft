<?php
/**
 * CLI: smoke-test all front-controller routes.
 * Usage: php tools/smoke-routes.php
 */
declare(strict_types=1);

$projectRoot = dirname(__DIR__);
chdir($projectRoot);
file_put_contents($projectRoot . '/tools/smoke-routes-started.txt', date('c') . PHP_EOL);

$pageRoutes = require $projectRoot . '/app/config/page-routes.php';
$serviceRoutes = require $projectRoot . '/app/config/service-routes.php';
$routes = $pageRoutes + $serviceRoutes;

$fail = [];
foreach ($routes as $slug => $file) {
    $_SERVER['REQUEST_URI'] = '/' . $slug;
    $_GET['__route'] = $slug;
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    unset($GLOBALS['caaft_active_page']);

    ob_start();
    try {
        include $projectRoot . '/index.php';
        $html = (string) ob_get_clean();
        if (strlen($html) < 5000 || stripos($html, '</html>') === false) {
            $fail[$slug] = 'incomplete (len=' . strlen($html) . ')';
        }
    } catch (Throwable $e) {
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        $fail[$slug] = $e->getMessage();
    }
}

$report = 'Routes tested: ' . count($routes) . PHP_EOL
    . 'Failures: ' . count($fail) . PHP_EOL;
foreach ($fail as $slug => $reason) {
    $report .= "  - {$slug}: {$reason}" . PHP_EOL;
}

$reportPath = $projectRoot . '/tools/smoke-routes-last.txt';
file_put_contents($reportPath, $report);
fwrite(STDERR, $report);

exit(count($fail) > 0 ? 1 : 0);
