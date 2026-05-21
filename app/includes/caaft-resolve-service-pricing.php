<?php
/**
 * Resolve indicative hero/enquiry pricing for app/pages/services/*.php callers.
 */
declare(strict_types=1);

/**
 * @return array{amount: string, govt_fee: bool}|null
 */
function caaft_resolve_service_page_pricing(): ?array
{
    static $map = null;
    if ($map === null) {
        $path = __DIR__ . '/data/caaft-hero-service-pricing.php';
        $map = is_file($path) ? require $path : [];
    }

    $callerKey = '';
    foreach (debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 24) as $bt) {
        if (empty($bt['file'])) {
            continue;
        }
        $norm = str_replace('\\', '/', (string) $bt['file']);
        if (preg_match('#/pages/services/([^/]+\.php)$#', $norm, $m)) {
            $callerKey = $m[1];
            break;
        }
    }

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
    ];
}
