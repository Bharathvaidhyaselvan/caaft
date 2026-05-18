<?php
declare(strict_types=1);

/**
 * Replace $caaft_overview_illustration with $caaft_overview_image_src pointing to
 * Unsplash / Pexels raster images — unique URL per service page.
 */
$base = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'services' . DIRECTORY_SEPARATOR;

$u = static function (string $id): string {
    return 'https://images.unsplash.com/photo-' . $id . '?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80';
};

$p = static function (int $id): string {
    return 'https://images.pexels.com/photos/' . $id . '/pexels-photo-' . $id . '.jpeg?auto=compress&cs=tinysrgb&w=1200&h=800';
};

$map = [
    'private-limited-registration.php' => $u('1486406146926-c627a92ad7ab'),
    'public-limited-company-registration.php' => $u('1507679799987-c7319d796a9c'),
    'one-person-company-registration.php' => $u('1522071820081-909f73824506'),
    'llp-registration-services.php' => $u('1560179707-f14e90ef3623'),
    'register-partnership-firm.php' => $u('1450101499163-c8848c66ca85'),
    'register-sole-proprietorship.php' => $u('1554224154-22964511a63f'),
    'msme-udyam-registration.php' => $p(265087),
    'fssai-food-licence-india.php' => $p(6646015),
    'professional-tax-return-filing.php' => $p(8867244),
    'epf-esi-registration-compliance.php' => $p(7681090),
    'iec-registration.php' => $p(3760069),
    'digital-signature-certificate-registration.php' => $p(6863334),
    '12a-80g-registration.php' => $p(7681066),
    'private-company-compliance.php' => $u('1589829545858-d8d0deb36008'),
    'public-ltd-compliance.php' => $u('1497366214618-9603787a25b7'),
    'opc-annual-compliance.php' => $u('1560518883-ba43f26d1ca1'),
    'llp-annual-compliance.php' => $u('1455849314581-6237e31157a0'),
    'partnership-firm-compliance.php' => $u('1521791139728-9929c447b3d1'),
    'sole-proprietorship-compliance.php' => $u('1504384305987-2b56f68a7f8b'),
    'din-kyc-filing.php' => $p(3184292),
    'add-remove-director-service.php' => $p(3184465),
    'increase-authorised-share-capital.php' => $u('1554224152-824d793ca381'),
    'registered-office-change-india.php' => $u('1497366214618-9603787a25b7'),
    'roc-compliance-filing.php' => $u('1560518883-ba43f26d1ca1'),
    'winding-up-of-company.php' => $u('1589829545858-d8d0deb36008'),
    'tax-planning-services.php' => $u('1554224155-8d04cb21cd6c'),
    'income-tax-appeal-services.php' => $u('1454165804606-c3d57bc86b40'),
    'tds-return-filing-services.php' => $u('1450101499163-c8848c66ca85'),
    'tax-audit.php' => $u('1554224155-6726b3ff858f'),
    'gst-registration.php' => $p(3182812),
    'gst-return-filing-services.php' => $u('1554224155-6726b3ff858f'),
    'gst-lut-filing.php' => $p(3184360),
    'gst-advisory.php' => $u('1554224152-824d793ca381'),
    'gst-cancellation-services.php' => $p(265667),
    'gst-assessment-appeal-services.php' => $u('1454165804606-c3d57bc86b40'),
    'bookkeeping-and-accounting-services.php' => $p(265087),
    'financial-analysis-mis.php' => $u('1460925915916-84fbc326b6d9'),
    'financial-statement-analysis.php' => $u('1553877522-69ae732aea78'),
    'accounts-receivable-payable-service.php' => $p(3184287),
    'budgeting-forecasting-services.php' => $u('1554224154-22964511a63f'),
    'business-valuation-services.php' => $u('1553877522-69ae732aea78'),
    'financial-assessment-services.php' => $u('1460925915916-84fbc326b6d9'),
    'feasibility-study.php' => $p(3184339),
    'cfo-financial-management-services.php' => $u('1556761175-b413da4baf72'),
    'payroll-management-compliance.php' => $p(3184374),
];

$pattern = '/\$caaft_overview_illustration\s*=\s*\'[^\']+\'\s*;/';

foreach ($map as $file => $url) {
    $path = $base . $file;
    if (!is_file($path)) {
        fwrite(STDERR, "Missing: {$file}\n");
        continue;
    }
    $c = file_get_contents($path);
    if (!preg_match($pattern, $c)) {
        fwrite(STDERR, "No illustration line: {$file}\n");
        continue;
    }
    $replacement = '$caaft_overview_image_src = ' . var_export($url, true) . ';';
    $new = preg_replace($pattern, $replacement, $c, 1);
    file_put_contents($path, $new);
    echo "OK {$file}\n";
}

// Fix duplicate URLs: registered-office vs public-ltd used same — swap registered-office to different
$rocOffice = $base . 'registered-office-change-india.php';
$c = file_get_contents($rocOffice);
if ($c !== false) {
    $url = $u('1517245386807-9b4d0a6c4d0e');
    $c2 = preg_replace(
        '/\$caaft_overview_image_src = \'[^\']+\';/',
        '$caaft_overview_image_src = ' . var_export($url, true) . ';',
        $c,
        1
    );
    file_put_contents($rocOffice, $c2);
    echo "Patched registered-office-change-india.php (unique image)\n";
}

// gst-assessment duplicate of appeal — use pexels
$gstAsp = $base . 'gst-assessment-appeal-services.php';
$c = file_get_contents($gstAsp);
if ($c !== false) {
    $url = $p(7688336);
    $c2 = preg_replace(
        '/\$caaft_overview_image_src = \'[^\']+\';/',
        '$caaft_overview_image_src = ' . var_export($url, true) . ';',
        $c,
        1
    );
    file_put_contents($gstAsp, $c2);
    echo "Patched gst-assessment-appeal-services.php (unique image)\n";
}

// financial-assessment duplicate financial-analysis — change
$fa = $base . 'financial-assessment-services.php';
$c = file_get_contents($fa);
if ($c !== false) {
    $url = $u('1542744173-53cec1e3c00b');
    $c2 = preg_replace(
        '/\$caaft_overview_image_src = \'[^\']+\';/',
        '$caaft_overview_image_src = ' . var_export($url, true) . ';',
        $c,
        1
    );
    file_put_contents($fa, $c2);
    echo "Patched financial-assessment-services.php (unique image)\n";
}

// business-valuation duplicate financial-statement — change
$bv = $base . 'business-valuation-services.php';
$c = file_get_contents($bv);
if ($c !== false) {
    $url = $u('1522071901485-9ccb54c071c4');
    $c2 = preg_replace(
        '/\$caaft_overview_image_src = \'[^\']+\';/',
        '$caaft_overview_image_src = ' . var_export($url, true) . ';',
        $c,
        1
    );
    file_put_contents($bv, $c2);
    echo "Patched business-valuation-services.php (unique image)\n";
}

// winding-up same as private compliance — change winding
$wu = $base . 'winding-up-of-company.php';
$c = file_get_contents($wu);
if ($c !== false) {
    $url = $u('1520607960663-4a2bc51225a5');
    $c2 = preg_replace(
        '/\$caaft_overview_image_src = \'[^\']+\';/',
        '$caaft_overview_image_src = ' . var_export($url, true) . ';',
        $c,
        1
    );
    file_put_contents($wu, $c2);
    echo "Patched winding-up-of-company.php (unique image)\n";
}

$itr = $base . 'income-tax-filing-service.php';
$c = file_get_contents($itr);
if ($c !== false) {
    $taxImg = $u('1554224155-6726b3ff858f');
    $c2 = preg_replace(
        '/<img src="[^"]+" alt="Income tax return filing support and compliance guidance" loading="lazy[^"]*">/',
        '<img src="' . $taxImg . '" alt="Income tax return filing support and compliance guidance" loading="lazy" referrerpolicy="no-referrer">',
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
