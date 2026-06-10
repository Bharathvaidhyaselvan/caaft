<?php
/**
 * One-time deployment health check. Delete this file after verifying the upload.
 */
declare(strict_types=1);

header('Content-Type: text/plain; charset=utf-8');

$projectRoot = __DIR__;
$appRoot = $projectRoot . '/app';

$critical = [
    'index.php',
    '.htaccess',
    'contact_mail.php',
    'homecontact_mail.php',
    'app/bootstrap.php',
    'app/config/mail.php',
    'app/includes/perf-assets.php',
    'app/includes/caaft-url-helpers.php',
    'app/includes/caaft-resolve-service-pricing.php',
    'app/includes/data/caaft-hero-service-pricing.php',
    'app/includes/components/service-hero-with-enquiry.php',
    'app/includes/components/caaft-cta.php',
    'app/config/page-routes.php',
    'app/config/service-routes.php',
    'app/pages/services/header-top.php',
    'app/pages/services/header.php',
    'app/pages/services/footer.php',
    'app/pages/services/footer-bottom.php',
    'app/pages/services/epf-esi-registration-compliance.php',
    'app/pages/services/msme-udyam-registration.php',
    'app/pages/services/private-limited-registration.php',
    'assets/css/style.css',
    'assets/js/main.js',
];

$missing = [];
foreach ($critical as $rel) {
    if (!is_file($projectRoot . '/' . str_replace('/', DIRECTORY_SEPARATOR, $rel))) {
        $missing[] = $rel;
    }
}

$pageRoutes = is_file($appRoot . '/config/page-routes.php')
    ? require $appRoot . '/config/page-routes.php'
    : [];
$serviceRoutes = is_file($appRoot . '/config/service-routes.php')
    ? require $appRoot . '/config/service-routes.php'
    : [];
$routes = $pageRoutes + $serviceRoutes;

$missingTargets = [];
foreach ($routes as $slug => $target) {
    $path = $appRoot . '/' . str_replace('/', DIRECTORY_SEPARATOR, $target);
    if (!is_file($path)) {
        $missingTargets[$slug] = $target;
    }
}

echo "CAAFT deploy check\n";
echo "PHP: " . PHP_VERSION . "\n";
echo "Project root: {$projectRoot}\n\n";

echo "Critical files missing: " . count($missing) . "\n";
foreach ($missing as $rel) {
    echo "  - {$rel}\n";
}

echo "\nRoute targets missing: " . count($missingTargets) . "\n";
if ($missingTargets !== []) {
    $shown = 0;
    foreach ($missingTargets as $slug => $target) {
        echo "  - /{$slug} => {$target}\n";
        if (++$shown >= 25) {
            echo '  ... and ' . (count($missingTargets) - 25) . " more\n";
            break;
        }
    }
}

$mailConfig = is_file($appRoot . '/config/mail.php') ? require $appRoot . '/config/mail.php' : [];
$formRecipient = trim((string) ($mailConfig['form_recipient'] ?? 'services@caaft.com'));
echo "\nForm mail recipient: {$formRecipient}\n";

if ($missing === [] && $missingTargets === []) {
    echo "\nOK: All checked files and route targets are present.\n";
    echo "If pages still return HTTP 500, open the host PHP error log for the failing URL.\n";
} else {
    echo "\nFAIL: Upload is incomplete. Re-upload the full site ZIP and extract over the document root.\n";
}
