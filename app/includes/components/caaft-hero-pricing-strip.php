<?php
/**
 * Hero "Price starts from" strip with optional View Details button inside the card.
 *
 * Requires: $caaft_hero_pricing_label, $caaft_hero_pricing_amount, $caaft_hero_pricing_suffix
 * Optional: $caaft_hero_pricing_extra, $caaft_hero_pricing_href (targets #pricing-plans on same page)
 * Optional: $caaft_hero_pricing_details_label (default "View Details")
 */
declare(strict_types=1);

require_once __DIR__ . '/../caaft-url-helpers.php';

$caaft_hero_pricing_href = isset($caaft_hero_pricing_href) ? trim((string) $caaft_hero_pricing_href) : '';
if ($caaft_hero_pricing_href !== '') {
    $caaft_hero_pricing_href = caaft_resolve_page_anchor_href($caaft_hero_pricing_href);
}
$caaft_hero_pricing_details_label = isset($caaft_hero_pricing_details_label) && trim((string) $caaft_hero_pricing_details_label) !== ''
    ? trim((string) $caaft_hero_pricing_details_label)
    : 'View Details';
$caaft_hero_pricing_show_details = $caaft_hero_pricing_href !== '';
?>
<div class="caaft-hero-cta-pricing-banner<?php echo $caaft_hero_pricing_show_details ? ' caaft-hero-cta-pricing-banner--has-details' : ''; ?>" role="note">
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
        <?php if ($caaft_hero_pricing_show_details) : ?>
            <span class="caaft-hero-cta-pricing-sep" aria-hidden="true">|</span>
            <a
                href="<?php echo htmlspecialchars($caaft_hero_pricing_href, ENT_QUOTES, 'UTF-8'); ?>"
                class="caaft-hero-cta-pricing-details-btn"
                aria-label="<?php echo htmlspecialchars($caaft_hero_pricing_details_label . ' — pricing packages on this page', ENT_QUOTES, 'UTF-8'); ?>">
                <?php echo htmlspecialchars($caaft_hero_pricing_details_label, ENT_QUOTES, 'UTF-8'); ?>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        <?php endif; ?>
    </div>
</div>
