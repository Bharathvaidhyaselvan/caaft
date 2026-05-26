<?php
/**
 * Renders Business Setup pricing for hub or a single service page.
 *
 * Set one of:
 * - $caaft_bsr_pricing_mode = 'hub' on business-setup-and-registration.php
 * - $caaft_bsr_pricing_page = basename of service file (defaults to current script)
 */
declare(strict_types=1);

$caaft_bsr_pricing_data = require dirname(__DIR__) . '/data/caaft-business-setup-pricing.php';

if (($caaft_bsr_pricing_mode ?? '') === 'hub') {
    ?>
    <section class="home3-plans-area py-90 caaft-pricing-hub-intro" id="bsr-pricing-plans" aria-labelledby="bsr-pricing-plans-heading">
        <div class="container">
            <div class="site-heading text-center mb-10 wow fadeInUp" data-wow-delay=".1s">
                <span class="site-title-tagline"><i><img src="assets/img/trend-img.webp" alt="" class="img-fluid" width="30" height="30"></i> Pricing Plan</span>
                <h2 id="bsr-pricing-plans-heading" class="site-title mt-2">Let&rsquo;s Check Our <span>Pricing</span> Plan For You</h2>
                <p class="caaft-pricing-subtitle mt-2">Transparent packages for company incorporation and essential business registrations.</p>
            </div>
        </div>
    </section>
    <?php

    foreach ($caaft_bsr_pricing_data['hub_sections'] as $caaft_bsr_hub_section) {
        $caaft_pricing_plans = $caaft_bsr_hub_section['plans'];
        $caaft_pricing_section_id = $caaft_bsr_hub_section['section_id'];
        $caaft_pricing_heading_id = $caaft_bsr_hub_section['heading_id'];
        $caaft_pricing_title = $caaft_bsr_hub_section['title'];
        $caaft_pricing_subtitle = '';
        $caaft_pricing_col_class = $caaft_bsr_hub_section['col_class'];
        $caaft_pricing_is_subsection = true;
        $caaft_pricing_section_class = 'home3-plans-area py-50 caaft-pricing-hub-group';
        include __DIR__ . '/caaft-pricing-plans.php';
    }

    return;
}

if (!empty($caaft_bsr_pricing_page)) {
    $caaft_bsr_page_key = $caaft_bsr_pricing_page;
} elseif (!empty($GLOBALS['caaft_active_page'])) {
    $caaft_bsr_page_key = $GLOBALS['caaft_active_page'] . '.php';
} else {
    $caaft_bsr_page_key = basename($_SERVER['SCRIPT_FILENAME'] ?? '');
}
if ($caaft_bsr_page_key === '' || !isset($caaft_bsr_pricing_data['by_page'][$caaft_bsr_page_key])) {
    return;
}

$caaft_bsr_page_pricing = $caaft_bsr_pricing_data['by_page'][$caaft_bsr_page_key];
$caaft_pricing_plans = array_map(static function (array $plan): array {
    $plan['href'] = '#quote-content';

    return $plan;
}, $caaft_bsr_page_pricing['plans']);
$caaft_pricing_col_class = $caaft_bsr_page_pricing['col_class'] ?? 'col-md-6 col-lg-4';
$caaft_pricing_section_id = 'pricing-plans';
$caaft_pricing_heading_id = 'service-pricing-plans-heading';
$caaft_pricing_title = 'Let&rsquo;s Check Our <span>Pricing</span> Plan For You';
$caaft_pricing_subtitle = count($caaft_pricing_plans) > 1
    ? 'Choose incorporation only or a bundled incorporation + compliance package.'
    : '';
$caaft_pricing_is_subsection = false;
$caaft_pricing_section_class = 'home3-plans-area py-90';
include __DIR__ . '/caaft-pricing-plans.php';
