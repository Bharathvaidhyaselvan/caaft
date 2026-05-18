<?php
declare(strict_types=1);

$root = dirname(__DIR__);
$base = $root . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR;

$map = [
    'private-limited-registration.php' => 'company',
    'public-limited-company-registration.php' => 'company',
    'one-person-company-registration.php' => 'company',
    'llp-registration-services.php' => 'company',
    'register-partnership-firm.php' => 'company',
    'register-sole-proprietorship.php' => 'company',
    'msme-udyam-registration.php' => 'registrations',
    'fssai-food-licence-india.php' => 'registrations',
    'professional-tax-return-filing.php' => 'registrations',
    'epf-esi-registration-compliance.php' => 'registrations',
    'iec-registration.php' => 'registrations',
    'digital-signature-certificate-registration.php' => 'registrations',
    '12a-80g-registration.php' => 'registrations',
    'private-company-compliance.php' => 'compliance',
    'public-ltd-compliance.php' => 'compliance',
    'opc-annual-compliance.php' => 'compliance',
    'llp-annual-compliance.php' => 'compliance',
    'partnership-firm-compliance.php' => 'compliance',
    'sole-proprietorship-compliance.php' => 'compliance',
    'din-kyc-filing.php' => 'roc',
    'add-remove-director-service.php' => 'roc',
    'increase-authorised-share-capital.php' => 'roc',
    'registered-office-change-india.php' => 'roc',
    'roc-compliance-filing.php' => 'roc',
    'winding-up-of-company.php' => 'roc',
    'tax-planning-services.php' => 'tax',
    'income-tax-appeal-services.php' => 'tax',
    'tds-return-filing-services.php' => 'tax',
    'tax-audit.php' => 'tax',
    'gst-registration.php' => 'gst',
    'gst-return-filing-services.php' => 'gst',
    'gst-lut-filing.php' => 'gst',
    'gst-advisory.php' => 'gst',
    'gst-cancellation-services.php' => 'gst',
    'gst-assessment-appeal-services.php' => 'gst',
    'bookkeeping-and-accounting-services.php' => 'accounting',
    'financial-analysis-mis.php' => 'accounting',
    'financial-statement-analysis.php' => 'accounting',
    'accounts-receivable-payable-service.php' => 'accounting',
    'budgeting-forecasting-services.php' => 'advisory',
    'business-valuation-services.php' => 'advisory',
    'financial-assessment-services.php' => 'advisory',
    'feasibility-study.php' => 'advisory',
    'cfo-financial-management-services.php' => 'advisory',
    'payroll-management-compliance.php' => 'payroll',
];

$patternSrc = '/\$caaft_overview_image_src\s*=\s*(\'[^\']*\'|"[^"]*"|\'[^\']*\'\s*\.\s*[^\']+\')\s*;/';

$replacement = static function (string $slug): string {
    return "\$caaft_overview_illustration = '{$slug}';";
};

foreach ($map as $file => $slug) {
    $path = $base . $file;
    if (!is_file($path)) {
        fwrite(STDERR, "Missing: {$path}\n");
        continue;
    }
    $c = file_get_contents($path);
    if ($c === false) {
        fwrite(STDERR, "Read fail: {$path}\n");
        continue;
    }
    if (!preg_match($patternSrc, $c)) {
        fwrite(STDERR, "No image_src line: {$file}\n");
        continue;
    }
    $new = preg_replace($patternSrc, $replacement($slug), $c, 1);
    if ($new === null || $new === $c) {
        fwrite(STDERR, "Replace fail: {$file}\n");
        continue;
    }
    file_put_contents($path, $new);
    echo "OK {$file} -> {$slug}\n";
}

$itr = $base . 'income-tax-filing-service.php';
$c = file_get_contents($itr);
if ($c !== false) {
    $c2 = preg_replace(
        '/<img src="https:\/\/images\.unsplash\.com[^"]+" alt="Income tax return filing[^"]*" loading="lazy" referrerpolicy="no-referrer">/',
        '<img src="/assets/img/overview/tax.svg?v=1" alt="Income tax return filing support and compliance guidance" loading="lazy">',
        $c,
        1,
        $cnt
    );
    if ($cnt) {
        file_put_contents($itr, $c2);
        echo "OK income-tax-filing-service.php inline img -> tax.svg\n";
    } else {
        fwrite(STDERR, "ITR img pattern not found\n");
    }
}

echo "Done.\n";
