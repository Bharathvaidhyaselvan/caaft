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
$caaft_pricing_defaults = $caaft_bsr_pricing_data['section_defaults'];

if (($caaft_bsr_pricing_mode ?? '') === 'hub') {
    ?>
    <section class="home3-plans-area py-90 caaft-pricing-hub-intro" id="bsr-pricing-plans" aria-labelledby="bsr-pricing-plans-heading">
        <div class="container">
            <div class="site-heading text-center mb-10 wow fadeInUp" data-wow-delay=".1s">
                <span class="site-title-tagline"><i><img src="assets/img/trend-img.webp" alt="" class="img-fluid" width="30" height="30"></i> <?php echo htmlspecialchars($caaft_pricing_defaults['eyebrow'], ENT_QUOTES, 'UTF-8'); ?></span>
                <h2 id="bsr-pricing-plans-heading" class="site-title mt-2"><?php echo $caaft_pricing_defaults['title']; ?></h2>
                <p class="home3-section-lead mt-2"><?php echo htmlspecialchars($caaft_pricing_defaults['subtitle'], ENT_QUOTES, 'UTF-8'); ?></p>
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
        $caaft_pricing_cta_label = $caaft_pricing_defaults['cta_label'];
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
$caaft_bsr_tier_badge_pages = [
    'private-limited-registration.php',
    'public-limited-company-registration.php',
    'one-person-company-registration.php',
    'llp-registration-services.php',
    'register-partnership-firm.php',
    'register-sole-proprietorship.php',
];
$caaft_bsr_use_tier_badges = in_array($caaft_bsr_page_key, $caaft_bsr_tier_badge_pages, true);
$caaft_pricing_plans = array_map(static function (array $plan, int $index) use ($caaft_bsr_use_tier_badges): array {
    $plan['href'] = '#quote-content';
    if ($caaft_bsr_use_tier_badges) {
        $plan['badge'] = $index === 0 ? 'Standard' : 'Premium';
    }

    return $plan;
}, $caaft_bsr_page_pricing['plans'], array_keys($caaft_bsr_page_pricing['plans']));
$caaft_pricing_col_class = $caaft_bsr_page_pricing['col_class'] ?? 'col-md-6 col-lg-4';
$caaft_pricing_section_id = 'pricing-plans';
$caaft_pricing_heading_id = 'service-pricing-plans-heading';
$caaft_pricing_eyebrow = $caaft_pricing_defaults['eyebrow'];
$caaft_pricing_title = $caaft_pricing_defaults['service_title'] ?? $caaft_pricing_defaults['title'];
$caaft_pricing_subtitle = count($caaft_pricing_plans) > 1
    ? $caaft_pricing_defaults['service_subtitle_multi']
    : $caaft_pricing_defaults['service_subtitle_single'];
$caaft_pricing_is_subsection = false;
$caaft_pricing_section_class = 'home3-plans-area py-90';
$caaft_pricing_cta_label = $caaft_pricing_defaults['cta_label'];
include __DIR__ . '/caaft-pricing-plans.php';
