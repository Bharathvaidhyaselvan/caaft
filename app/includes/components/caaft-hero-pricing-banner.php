<?php
/**
 * Hero pricing strip (below primary CTA). Use on pages with a custom inline hero.
 *
 * Optional before include:
 *   $caaft_hero_pricing_amount (string)
 *   $caaft_hero_pricing_label (string) — default "Price starts from"
 *   $caaft_hero_pricing_suffix (string) — default "+ GST"
 *   $caaft_hero_pricing_extra (string) — e.g. "Govt. Fee"
 *   $caaft_hero_pricing_href (string) — e.g. #pricing-plans for View Details button
 *   $caaft_hero_pricing_disable (bool)
 *
 * When amount is omitted, loads from includes/data/caaft-hero-service-pricing.php for the caller page.
 */
declare(strict_types=1);

require_once __DIR__ . '/../caaft-resolve-service-pricing.php';

$caaft_hero_pricing_disable = isset($caaft_hero_pricing_disable) && $caaft_hero_pricing_disable;
$caaft_hero_pricing_extra_from_page = isset($caaft_hero_pricing_extra);

if (!$caaft_hero_pricing_disable && !isset($caaft_hero_pricing_amount)) {
    $caaft_hero_pricing_row = caaft_resolve_service_page_pricing();
    if ($caaft_hero_pricing_row !== null) {
        $caaft_hero_pricing_amount = $caaft_hero_pricing_row['amount'];
        if (!$caaft_hero_pricing_extra_from_page) {
            $caaft_hero_pricing_extra = $caaft_hero_pricing_row['govt_fee'] ? 'Govt. Fee' : '';
        }
        if (!isset($caaft_hero_pricing_href) && ($caaft_hero_pricing_row['packages_href'] ?? '') !== '') {
            $caaft_hero_pricing_href = $caaft_hero_pricing_row['packages_href'];
        }
    }
}

$caaft_hero_pricing_amount = isset($caaft_hero_pricing_amount) ? trim((string) $caaft_hero_pricing_amount) : '';
$caaft_hero_pricing_label = isset($caaft_hero_pricing_label) ? trim((string) $caaft_hero_pricing_label) : '';
$caaft_hero_pricing_suffix = isset($caaft_hero_pricing_suffix) ? trim((string) $caaft_hero_pricing_suffix) : '+ GST';
$caaft_hero_pricing_extra = isset($caaft_hero_pricing_extra) ? trim((string) $caaft_hero_pricing_extra) : '';
$caaft_hero_pricing_href = isset($caaft_hero_pricing_href) ? trim((string) $caaft_hero_pricing_href) : '';
$caaft_hero_show_pricing = $caaft_hero_pricing_amount !== '';

if (!$caaft_hero_show_pricing) {
    return;
}

if ($caaft_hero_pricing_label === '') {
    $caaft_hero_pricing_label = 'Price starts from';
}
if ($caaft_hero_pricing_suffix === '') {
    $caaft_hero_pricing_suffix = '+ GST';
}

include __DIR__ . '/caaft-hero-pricing-strip.php';
