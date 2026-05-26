<?php
/**
 * Hero "Price starts from" strip (div or link to #pricing-plans).
 *
 * Requires: $caaft_hero_pricing_label, $caaft_hero_pricing_amount, $caaft_hero_pricing_suffix
 * Optional: $caaft_hero_pricing_extra, $caaft_hero_pricing_href
 */
declare(strict_types=1);

require_once __DIR__ . '/../caaft-url-helpers.php';

$caaft_hero_pricing_href = isset($caaft_hero_pricing_href) ? trim((string) $caaft_hero_pricing_href) : '';
if ($caaft_hero_pricing_href !== '') {
    $caaft_hero_pricing_href = caaft_resolve_page_anchor_href($caaft_hero_pricing_href);
}
$caaft_hero_pricing_is_link = $caaft_hero_pricing_href !== '';
$caaft_hero_pricing_tag = $caaft_hero_pricing_is_link ? 'a' : 'div';
$caaft_hero_pricing_class = 'caaft-hero-cta-pricing-banner' . ($caaft_hero_pricing_is_link ? ' caaft-hero-cta-pricing-banner--link' : '');
?>
<<?php echo $caaft_hero_pricing_tag; ?>
    class="<?php echo htmlspecialchars($caaft_hero_pricing_class, ENT_QUOTES, 'UTF-8'); ?>"
    <?php if ($caaft_hero_pricing_is_link) : ?>
        href="<?php echo htmlspecialchars($caaft_hero_pricing_href, ENT_QUOTES, 'UTF-8'); ?>"
        aria-label="View Transparent Service Packages pricing"
    <?php else : ?>
        role="note"
    <?php endif; ?>>
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
</<?php echo $caaft_hero_pricing_tag; ?>>
