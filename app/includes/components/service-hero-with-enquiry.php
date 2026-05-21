<?php
/**
 * Reusable service hero section with left content and right enquiry form.
 *
 * Required:
 *   $caaft_hero_id (string)                      // h1 id + aria-labelledby value
 *   $caaft_hero_h1 (string)                      // small upper heading
 *   $caaft_hero_h2_before (string)               // heading text before highlight
 *   $caaft_hero_h2_highlight (string)            // highlighted heading text
 *   $caaft_hero_h2_after (string)                // heading text after highlight
 *   $caaft_hero_lead_paragraphs (string[])       // one or more lead paragraphs
 *   $caaft_hero_primary_cta_label (string)
 *   $caaft_hero_primary_cta_href (string)
 *
 * Optional:
 *   $caaft_hero_secondary_cta_label (string)
 *   $caaft_hero_secondary_cta_href (string)
 *   $caaft_hero_secondary_cta_icon (string)      // default fas fa-arrow-down
 *   $caaft_hero_primary_cta_icon (string)        // default fas fa-arrow-right
 *   $caaft_hero_secondary_extra_class (string)
 *
 * Enquiry form options (passed through):
 *   $caaft_enquiry_* variables from enquiry-hero-form.php
 *
 * Optional pricing strip below primary/secondary CTAs (left column, dark hero):
 *   $caaft_hero_pricing_disable (bool) — when true, no strip is shown
 *   $caaft_hero_pricing_amount (string) — if omitted, looked up from includes/data/caaft-hero-service-pricing.php by service page
 *   $caaft_hero_pricing_label (string) — default "Price starts from" when amount is set
 *   $caaft_hero_pricing_suffix (string) — default "+ GST"
 *   $caaft_hero_pricing_extra (string) — e.g. "Govt. Fee"; empty hides the "| …" segment
 */
if (!isset($caaft_hero_id, $caaft_hero_h1, $caaft_hero_h2_before, $caaft_hero_h2_highlight, $caaft_hero_h2_after, $caaft_hero_lead_paragraphs)) {
    trigger_error('service-hero-with-enquiry.php: set required $caaft_hero_* variables before including', E_USER_WARNING);
}

require_once __DIR__ . '/../caaft-url-helpers.php';

$caaft_hero_id = isset($caaft_hero_id) ? (string) $caaft_hero_id : 'service-hero-h1';
$caaft_hero_h1 = isset($caaft_hero_h1) ? (string) $caaft_hero_h1 : '';
$caaft_hero_h2_before = isset($caaft_hero_h2_before) ? (string) $caaft_hero_h2_before : '';
$caaft_hero_h2_highlight = isset($caaft_hero_h2_highlight) ? (string) $caaft_hero_h2_highlight : '';
$caaft_hero_h2_after = isset($caaft_hero_h2_after) ? (string) $caaft_hero_h2_after : '';
$caaft_hero_lead_paragraphs = isset($caaft_hero_lead_paragraphs) && is_array($caaft_hero_lead_paragraphs) ? $caaft_hero_lead_paragraphs : [];
$caaft_hero_primary_cta_label = isset($caaft_hero_primary_cta_label) ? (string) $caaft_hero_primary_cta_label : '';
$caaft_hero_primary_cta_href = caaft_normalize_hero_contact_href(
    isset($caaft_hero_primary_cta_href) ? (string) $caaft_hero_primary_cta_href : ''
);

// Enquiry form heading: match hero primary CTA label (optional $caaft_service_cta_label override).
if (isset($caaft_service_cta_label) && trim((string) $caaft_service_cta_label) !== '') {
    $caaft_enquiry_title = trim((string) $caaft_service_cta_label);
} elseif (trim($caaft_hero_primary_cta_label) !== '') {
    $caaft_enquiry_title = trim($caaft_hero_primary_cta_label);
}
$caaft_hero_secondary_cta_label = isset($caaft_hero_secondary_cta_label) ? (string) $caaft_hero_secondary_cta_label : '';
$caaft_hero_secondary_cta_href = caaft_resolve_page_anchor_href(
    isset($caaft_hero_secondary_cta_href) ? (string) $caaft_hero_secondary_cta_href : '#'
);
$caaft_hero_primary_cta_icon = isset($caaft_hero_primary_cta_icon) ? (string) $caaft_hero_primary_cta_icon : 'fas fa-arrow-right';
$caaft_hero_secondary_cta_icon = isset($caaft_hero_secondary_cta_icon) ? (string) $caaft_hero_secondary_cta_icon : 'fas fa-arrow-down';
$caaft_hero_secondary_extra_class = isset($caaft_hero_secondary_extra_class) ? (string) $caaft_hero_secondary_extra_class : '';

// Auto-highlight the trailing clause when the page provides a single H2 string.
if (trim($caaft_hero_h2_highlight) === '' && trim($caaft_hero_h2_after) === '' && trim($caaft_hero_h2_before) !== '') {
    $caaft_h2_source = trim($caaft_hero_h2_before);
    $caaft_h2_split_pos = strrpos($caaft_h2_source, '. ');
    $caaft_h2_separator_len = 2;

    if ($caaft_h2_split_pos === false) {
        $caaft_h2_split_pos = strrpos($caaft_h2_source, ' — ');
        $caaft_h2_separator_len = 3;
    }

    if ($caaft_h2_split_pos === false) {
        $caaft_h2_split_pos = strrpos($caaft_h2_source, ' - ');
        $caaft_h2_separator_len = 3;
    }

    if ($caaft_h2_split_pos !== false) {
        $caaft_hero_h2_before = trim(substr($caaft_h2_source, 0, $caaft_h2_split_pos + $caaft_h2_separator_len));
        $caaft_hero_h2_highlight = trim(substr($caaft_h2_source, $caaft_h2_split_pos + $caaft_h2_separator_len));
    }
}

$caaft_hero_pricing_disable = isset($caaft_hero_pricing_disable) && $caaft_hero_pricing_disable;
$caaft_hero_pricing_extra_from_page = isset($caaft_hero_pricing_extra);

require_once __DIR__ . '/../caaft-resolve-service-pricing.php';

if (!$caaft_hero_pricing_disable && !isset($caaft_hero_pricing_amount)) {
    $caaft_hero_pricing_row = caaft_resolve_service_page_pricing();
    if ($caaft_hero_pricing_row !== null) {
        $caaft_hero_pricing_amount = $caaft_hero_pricing_row['amount'];
        if (!$caaft_hero_pricing_extra_from_page) {
            $caaft_hero_pricing_extra = $caaft_hero_pricing_row['govt_fee'] ? 'Govt. Fee' : '';
        }
    }
}

$caaft_hero_pricing_amount = isset($caaft_hero_pricing_amount) ? trim((string) $caaft_hero_pricing_amount) : '';
$caaft_hero_pricing_label = isset($caaft_hero_pricing_label) ? trim((string) $caaft_hero_pricing_label) : '';
$caaft_hero_pricing_suffix = isset($caaft_hero_pricing_suffix) ? trim((string) $caaft_hero_pricing_suffix) : '+ GST';
$caaft_hero_pricing_extra = isset($caaft_hero_pricing_extra) ? trim((string) $caaft_hero_pricing_extra) : '';
$caaft_hero_show_pricing = $caaft_hero_pricing_amount !== '';
if ($caaft_hero_show_pricing && $caaft_hero_pricing_label === '') {
    $caaft_hero_pricing_label = 'Price starts from';
}
if ($caaft_hero_pricing_suffix === '') {
    $caaft_hero_pricing_suffix = '+ GST';
}

?>
<section class="hero-section hs-3 caaft-ar-hero" aria-labelledby="<?php echo htmlspecialchars($caaft_hero_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="hero-single singles_forms_frames caaft-ar-hero-single">
        <div class="container">
            <div class="row align-items-center g-4 g-xl-5 caaft-ar-hero-row">
                <div class="col-md-12 col-lg-6 caaft-ar-hero-inner">
                    <h1 id="<?php echo htmlspecialchars($caaft_hero_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-ar-hero-h1"><?php echo htmlspecialchars($caaft_hero_h1, ENT_QUOTES, 'UTF-8'); ?></h1>
                    <h2 class="caaft-ar-hero-h2">
                        <?php echo htmlspecialchars($caaft_hero_h2_before, ENT_QUOTES, 'UTF-8'); ?>
                        <?php if ($caaft_hero_h2_highlight !== '') : ?>
                            <em><?php echo htmlspecialchars($caaft_hero_h2_highlight, ENT_QUOTES, 'UTF-8'); ?></em>
                        <?php endif; ?>
                        <?php echo htmlspecialchars($caaft_hero_h2_after, ENT_QUOTES, 'UTF-8'); ?>
                    </h2>
                    <?php foreach ($caaft_hero_lead_paragraphs as $caaft_hero_lead_paragraph) : ?>
                        <p class="caaft-ar-hero-lead"><?php echo htmlspecialchars((string) $caaft_hero_lead_paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
                    <div class="caaft-ar-hero-ctas">
                        <a href="<?php echo htmlspecialchars($caaft_hero_primary_cta_href, ENT_QUOTES, 'UTF-8'); ?>" class="theme-btn caaft-ar-hero-btn-primary">
                            <?php echo htmlspecialchars($caaft_hero_primary_cta_label, ENT_QUOTES, 'UTF-8'); ?> <i class="<?php echo htmlspecialchars($caaft_hero_primary_cta_icon, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                        </a>
                        <?php if ($caaft_hero_secondary_cta_label !== '') : ?>
                            <a href="<?php echo htmlspecialchars($caaft_hero_secondary_cta_href, ENT_QUOTES, 'UTF-8'); ?>" class="theme-btn theme-btn2 caaft-ar-hero-btn-secondary <?php echo htmlspecialchars($caaft_hero_secondary_extra_class, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($caaft_hero_secondary_cta_label, ENT_QUOTES, 'UTF-8'); ?> <i class="<?php echo htmlspecialchars($caaft_hero_secondary_cta_icon, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php if ($caaft_hero_show_pricing) : ?>
                        <div class="caaft-hero-cta-pricing-banner" role="note">
                            <span class="caaft-hero-cta-pricing-label"><?php echo htmlspecialchars($caaft_hero_pricing_label, ENT_QUOTES, 'UTF-8'); ?></span>
                            <div class="caaft-hero-cta-pricing-line">
                                <span class="caaft-hero-cta-pricing-amount-wrap">
                                    <span class="caaft-hero-cta-pricing-rupee">₹</span><strong class="caaft-hero-cta-pricing-amount"><?php echo htmlspecialchars($caaft_hero_pricing_amount, ENT_QUOTES, 'UTF-8'); ?></strong>
                                </span>
                                <span class="caaft-hero-cta-pricing-suffix"><?php echo htmlspecialchars($caaft_hero_pricing_suffix, ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php if ($caaft_hero_pricing_extra !== '') : ?>
                                    <span class="caaft-hero-cta-pricing-sep" aria-hidden="true">|</span>
                                    <span class="caaft-hero-cta-pricing-extra"><?php echo htmlspecialchars($caaft_hero_pricing_extra, ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="hero-img-wrap caaft-ar-hero-img-wrap">
                        <?php include __DIR__ . '/enquiry-hero-form.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
