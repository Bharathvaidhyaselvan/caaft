<?php
/**
 * Resolve indicative hero/enquiry pricing for app/pages/services/*.php callers.
 */
declare(strict_types=1);

require_once __DIR__ . '/caaft-url-helpers.php';

/**
 * @return array{amount: string, govt_fee: bool, packages_href: string}|null
 */
function caaft_resolve_service_page_pricing(): ?array
{
    static $map = null;
    static $bsrPackagePages = null;
    if ($map === null) {
        $path = __DIR__ . '/data/caaft-hero-service-pricing.php';
        $map = is_file($path) ? require $path : [];
    }
    if ($bsrPackagePages === null) {
        $bsrPath = __DIR__ . '/data/caaft-business-setup-pricing.php';
        $bsrData = is_file($bsrPath) ? require $bsrPath : [];
        $bsrAllPackagePages = array_keys($bsrData['by_page'] ?? []);
        // Other registration pages: hero pricing only — no mid-page pricing cards or View Details link.
        $bsrNoHeroPackagesLink = [
            'msme-udyam-registration.php',
            'fssai-food-licence-india.php',
            'professional-tax-return-filing.php',
            'epf-esi-registration-compliance.php',
            'iec-registration.php',
            'digital-signature-certificate-registration.php',
            '12a-80g-registration.php',
        ];
        $bsrPackagePages = array_values(array_diff($bsrAllPackagePages, $bsrNoHeroPackagesLink));
    }

    $callerKey = caaft_resolve_service_page_basename();
    if ($callerKey === '' || !isset($map[$callerKey]) || !is_array($map[$callerKey])) {
        return null;
    }

    $row = $map[$callerKey];
    $amount = isset($row['amount']) ? trim((string) $row['amount']) : '';
    if ($amount === '') {
        return null;
    }

    return [
        'amount' => $amount,
        'govt_fee' => !empty($row['govt_fee']),
        'packages_href' => in_array($callerKey, $bsrPackagePages, true) ? caaft_same_page_anchor('pricing-plans') : '',
    ];
}

function caaft_resolve_service_page_basename(): string
{
    foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 24) as $bt) {
        if (empty($bt['file'])) {
            continue;
        }
        $norm = str_replace('\\', '/', (string) $bt['file']);
        if (preg_match('#/pages/services/([^/]+\.php)$#', $norm, $m)) {
            return $m[1];
        }
    }

    return '';
}
