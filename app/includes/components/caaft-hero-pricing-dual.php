<?php
/**
 * Side-by-side hero pricing (e.g. Business | Individual on ITR page).
 *
 * Optional:
 *   $caaft_hero_pricing_dual_left_label, $caaft_hero_pricing_dual_left_amount
 *   $caaft_hero_pricing_dual_right_label, $caaft_hero_pricing_dual_right_amount
 *   $caaft_hero_pricing_dual_suffix (string) default "+ GST"
 *   $caaft_hero_pricing_dual_left_extra, $caaft_hero_pricing_dual_right_extra
 *
 * If left amount omitted, resolves business pricing from caaft-hero-service-pricing.php for caller page.
 */
declare(strict_types=1);

require_once __DIR__ . '/../caaft-resolve-service-pricing.php';

$caaft_hero_pricing_dual_suffix = isset($caaft_hero_pricing_dual_suffix) && trim((string) $caaft_hero_pricing_dual_suffix) !== ''
    ? trim((string) $caaft_hero_pricing_dual_suffix)
    : '+ GST';

$caaft_hero_pricing_dual_left_label = isset($caaft_hero_pricing_dual_left_label)
    ? trim((string) $caaft_hero_pricing_dual_left_label)
    : 'Business — price starts from';
$caaft_hero_pricing_dual_right_label = isset($caaft_hero_pricing_dual_right_label)
    ? trim((string) $caaft_hero_pricing_dual_right_label)
    : 'Individual — price starts from';

$caaft_hero_pricing_dual_left_amount = isset($caaft_hero_pricing_dual_left_amount)
    ? trim((string) $caaft_hero_pricing_dual_left_amount)
    : '';
$caaft_hero_pricing_dual_right_amount = isset($caaft_hero_pricing_dual_right_amount)
    ? trim((string) $caaft_hero_pricing_dual_right_amount)
    : '2,499';

if ($caaft_hero_pricing_dual_left_amount === '') {
    $caaft_hero_pricing_row = caaft_resolve_service_page_pricing();
    if ($caaft_hero_pricing_row !== null) {
        $caaft_hero_pricing_dual_left_amount = $caaft_hero_pricing_row['amount'];
    }
}

$caaft_hero_pricing_dual_left_extra = isset($caaft_hero_pricing_dual_left_extra)
    ? trim((string) $caaft_hero_pricing_dual_left_extra)
    : '';
$caaft_hero_pricing_dual_right_extra = isset($caaft_hero_pricing_dual_right_extra)
    ? trim((string) $caaft_hero_pricing_dual_right_extra)
    : '';

if ($caaft_hero_pricing_dual_left_amount === '' && $caaft_hero_pricing_dual_right_amount === '') {
    return;
}

$caaft_render_hero_pricing_banner = static function (
    string $label,
    string $amount,
    string $suffix,
    string $extra
): void {
    if ($amount === '') {
        return;
    }
    ?>
    <div class="caaft-hero-cta-pricing-banner" role="note">
        <span class="caaft-hero-cta-pricing-label"><?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?></span>
        <div class="caaft-hero-cta-pricing-line">
            <span class="caaft-hero-cta-pricing-amount-wrap">
                <span class="caaft-hero-cta-pricing-rupee">₹</span><strong class="caaft-hero-cta-pricing-amount"><?php echo htmlspecialchars($amount, ENT_QUOTES, 'UTF-8'); ?></strong>
            </span>
            <span class="caaft-hero-cta-pricing-suffix"><?php echo htmlspecialchars($suffix, ENT_QUOTES, 'UTF-8'); ?></span>
            <?php if ($extra !== '') : ?>
                <span class="caaft-hero-cta-pricing-sep" aria-hidden="true">|</span>
                <span class="caaft-hero-cta-pricing-extra"><?php echo htmlspecialchars($extra, ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <?php
};
?>
<div class="caaft-hero-cta-pricing-row">
    <?php
    $caaft_render_hero_pricing_banner(
        $caaft_hero_pricing_dual_left_label,
        $caaft_hero_pricing_dual_left_amount,
        $caaft_hero_pricing_dual_suffix,
        $caaft_hero_pricing_dual_left_extra
    );
    $caaft_render_hero_pricing_banner(
        $caaft_hero_pricing_dual_right_label,
        $caaft_hero_pricing_dual_right_amount,
        $caaft_hero_pricing_dual_suffix,
        $caaft_hero_pricing_dual_right_extra
    );
    ?>
</div>
