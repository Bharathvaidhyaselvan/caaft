<?php
declare(strict_types=1);

/**
 * Sets each service overview image to a direct Freepik CDN JPG URL (img.freepik.com).
 * Free resources require attribution to Freepik on the site per their license.
 *
 * Run from repo root: php scripts/apply-overview-freepik-hotlinks.php
 */
$base = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR;

$q = 'w=1200&q=80';
$f = static function (string $path) use ($q): string {
    return 'https://img.freepik.com/free-vector/' . $path . '.jpg?' . $q;
};

/** Unique CDN asset per service page */
$map = [
    '12a-80g-registration.php' => $f('charity-donation-concept-illustration_114360-1500'),
    'accounts-receivable-payable-service.php' => $f('receivable-payable-concept-illustration_114360-2005'),
    'add-remove-director-service.php' => $f('director-board-concept-illustration_114360-1444'),
    'bookkeeping-and-accounting-services.php' => $f('bookkeeping-concept-illustration_114360-3050'),
    'budgeting-forecasting-services.php' => $f('budget-planning-concept-illustration_114360-3500'),
    'business-valuation-services.php' => $f('business-valuation-concept-illustration_114360-2105'),
    'cfo-financial-management-services.php' => $f('cfo-services-concept-illustration_114360-2006'),
    'digital-signature-certificate-registration.php' => $f('digital-signature-concept-illustration_114360-5548'),
    'din-kyc-filing.php' => $f('document-concept-illustration_114360-9000'),
    'epf-esi-registration-compliance.php' => $f('payroll-concept-illustration_114360-5120'),
    'feasibility-study.php' => $f('feasibility-study-concept-illustration_114360-3200'),
    'financial-analysis-mis.php' => $f('mis-reporting-concept-illustration_114360-2004'),
    'financial-assessment-services.php' => $f('data-analysis-concept-illustration_114360-8500'),
    'financial-statement-analysis.php' => $f('financial-statement-concept-illustration_114360-4200'),
    'fssai-food-licence-india.php' => $f('food-safety-concept-illustration_114360-2100'),
    'gst-advisory.php' => $f('business-presentation-concept-illustration_114360-6000'),
    'gst-assessment-appeal-services.php' => $f('appeal-concept-illustration_114360-1999'),
    'gst-cancellation-services.php' => $f('cancellation-concept-illustration_114360-2001'),
    'gst-lut-filing.php' => $f('lut-filing-concept-illustration_114360-2002'),
    'gst-registration.php' => $f('gst-concept-illustration_114360-1234'),
    'gst-return-filing-services.php' => 'https://img.freepik.com/free-vector/online-tax-payment-flat-design_23-2148533456.jpg?' . $q,
    'iec-registration.php' => $f('export-import-concept-illustration_114360-9500'),
    'income-tax-appeal-services.php' => $f('legal-advice-concept-illustration_114360-1819'),
    'increase-authorised-share-capital.php' => $f('share-capital-concept-illustration_114360-1555'),
    'llp-annual-compliance.php' => $f('contract-concept-illustration_114360-7500'),
    'llp-registration-services.php' => $f('partnership-concept-illustration_114360-1111'),
    'msme-udyam-registration.php' => $f('udyam-registration-concept-illustration_114360-2003'),
    'one-person-company-registration.php' => $f('startup-concept-illustration_114360-405'),
    'opc-annual-compliance.php' => $f('corporate-governance-concept-illustration_114360-8000'),
    'partnership-firm-compliance.php' => $f('merger-acquisition-concept-illustration_114360-2222'),
    'payroll-management-compliance.php' => $f('calculator-concept-illustration_114360-7000'),
    'private-company-compliance.php' => $f('compliance-concept-illustration_114360-3333'),
    'private-limited-registration.php' => $f('company-registration-concept-illustration_114360-7890'),
    'professional-tax-return-filing.php' => $f('professional-tax-concept-illustration_114360-1888'),
    'public-limited-company-registration.php' => $f('business-growth-concept-illustration_114360-4500'),
    'public-ltd-compliance.php' => $f('business-meeting-concept-illustration_114360-5000'),
    'register-partnership-firm.php' => $f('teamwork-concept-illustration_114360-2134'),
    'register-sole-proprietorship.php' => $f('business-deal-concept-illustration_114360-730'),
    'registered-office-change-india.php' => $f('registered-office-concept-illustration_114360-1666'),
    'roc-compliance-filing.php' => $f('roc-filing-concept-illustration_114360-1777'),
    'sole-proprietorship-compliance.php' => $f('office-building-concept-illustration_114360-512'),
    'tax-audit.php' => $f('audit-concept-illustration_114360-2588'),
    'tax-planning-services.php' => $f('business-plan-concept-illustration_114360-5500'),
    'tds-return-filing-services.php' => $f('invoice-concept-illustration_114360-12000'),
    'winding-up-of-company.php' => $f('winding-up-concept-illustration_114360-888'),
];

$pattern = '/\$caaft_overview_image_src\s*=\s*(\'[^\']*\'|"[^"]*");/';

foreach ($map as $file => $url) {
    $path = $base . $file;
    if (!is_file($path)) {
        fwrite(STDERR, "Missing: {$file}\n");
        continue;
    }
    $c = file_get_contents($path);
    if ($c === false || !preg_match($pattern, $c)) {
        fwrite(STDERR, "No overview line: {$file}\n");
        continue;
    }
    $replacement = '$caaft_overview_image_src = ' . var_export($url, true) . ';';
    file_put_contents($path, preg_replace($pattern, $replacement, $c, 1));
    echo "OK {$file}\n";
}

$itrUrl = $f('tax-concept-illustration_114360-516');
$itr = $base . 'income-tax-filing-service.php';
$c = file_get_contents($itr);
if ($c !== false) {
    $c2 = preg_replace(
        '/<img src="[^"]+" alt="Income tax return filing support and compliance guidance" loading="lazy"(?:\s+referrerpolicy="no-referrer")?>/',
        '<img src="' . htmlspecialchars($itrUrl, ENT_QUOTES, 'UTF-8') . '" alt="Income tax return filing support and compliance guidance" loading="lazy" referrerpolicy="no-referrer">',
        $c,
        1,
        $cnt
    );
    if ($cnt) {
        file_put_contents($itr, $c2);
        echo "OK income-tax-filing-service.php (inline)\n";
    }
}

echo "Done.\n";
