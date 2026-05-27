<?php
/**
 * Homepage pricing plans — registration packages (from CAAFT_Website_Pricing.xlsx).
 */
declare(strict_types=1);

$caaft_bsr_pricing_data = require dirname(__DIR__) . '/data/caaft-business-setup-pricing.php';
$caaft_pricing_defaults = $caaft_bsr_pricing_data['section_defaults'];

$caaft_pricing_plans = array_map(
    static function (array $plan): array {
        $plan['show_card_title'] = true;
        return $plan;
    },
    $caaft_bsr_pricing_data['home_plans']
);
$caaft_pricing_layout = 'tiered';
$caaft_pricing_section_id = 'pricing-plans';
$caaft_pricing_heading_id = 'home-pricing-plans-heading';
$caaft_pricing_eyebrow = $caaft_pricing_defaults['eyebrow'];
$caaft_pricing_title = $caaft_pricing_defaults['title'];
$caaft_pricing_subtitle = $caaft_pricing_defaults['subtitle'];
$caaft_pricing_col_class = 'col-md-6 col-lg-4';
$caaft_pricing_section_class = 'py-100';
$caaft_pricing_cta_label = $caaft_pricing_defaults['cta_label'];
$caaft_pricing_footnote = '* Prices are indicative. Final pricing depends on scope. <a href="/contact#contact_us">Get a custom quote &rarr;</a>';

include __DIR__ . '/caaft-pricing-plans.php';
