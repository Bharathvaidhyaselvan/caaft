<?php
/**
 * Homepage hero trust strip — distinct from service-trust-indicators.php.
 *
 * Required:
 *   $caaft_home_trust_items (array) with:
 *     - icon_class (string)
 *     - title (string) — stat / headline value
 *     - description (string) — label
 *
 * Optional:
 *   $caaft_home_trust_aria_label (string) default "Why businesses trust CAAFT"
 */
if (!isset($caaft_home_trust_items) || !is_array($caaft_home_trust_items) || $caaft_home_trust_items === []) {
    trigger_error('home-hero-trust-indicators.php: set non-empty $caaft_home_trust_items before including', E_USER_WARNING);
}

$caaft_home_trust_aria_label = isset($caaft_home_trust_aria_label) ? (string) $caaft_home_trust_aria_label : 'Why businesses trust CAAFT';
?>
<section id="caaft-home-hero-trust" class="caaft-home-trust-strip" aria-label="<?php echo htmlspecialchars($caaft_home_trust_aria_label, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="caaft-home-trust-grid">
            <?php foreach ($caaft_home_trust_items as $caaft_home_trust_item) : ?>
                <article class="caaft-home-trust-card">
                    <span class="caaft-home-trust-shape caaft-home-trust-shape--a" aria-hidden="true"></span>
                    <span class="caaft-home-trust-shape caaft-home-trust-shape--b" aria-hidden="true"></span>
                    <span class="caaft-home-trust-icon" aria-hidden="true">
                        <i class="<?php echo htmlspecialchars((string) ($caaft_home_trust_item['icon_class'] ?? 'far fa-check-circle'), ENT_QUOTES, 'UTF-8'); ?>"></i>
                    </span>
                    <div class="caaft-home-trust-body">
                        <p class="caaft-home-trust-value"><?php echo htmlspecialchars((string) ($caaft_home_trust_item['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="caaft-home-trust-label"><?php echo htmlspecialchars((string) ($caaft_home_trust_item['description'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
