<?php
/**
 * Reusable trust indicators strip.
 *
 * Required:
 *   $caaft_trust_items (array) with:
 *     - icon_class (string)
 *     - title (string)
 *     - description (string)
 *
 * Optional:
 *   $caaft_trust_aria_label (string) default "Trust indicators"
 *   $caaft_trust_grid_class (string) default "caaft-ar-trust-grid--eq-4"
 */
if (!isset($caaft_trust_items) || !is_array($caaft_trust_items) || $caaft_trust_items === []) {
    trigger_error('service-trust-indicators.php: set non-empty $caaft_trust_items before including', E_USER_WARNING);
}

$caaft_trust_aria_label = isset($caaft_trust_aria_label) ? (string) $caaft_trust_aria_label : 'Trust indicators';
$caaft_trust_grid_class = isset($caaft_trust_grid_class) ? (string) $caaft_trust_grid_class : 'caaft-ar-trust-grid--eq-4';
?>
<section class="caaft-ar-trust-indicators" aria-label="<?php echo htmlspecialchars($caaft_trust_aria_label, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="caaft-ar-trust-grid <?php echo htmlspecialchars($caaft_trust_grid_class, ENT_QUOTES, 'UTF-8'); ?>">
            <?php foreach ($caaft_trust_items as $caaft_trust_item) : ?>
                <article class="caaft-ar-trust-item">
                    <span class="caaft-ar-trust-icon" aria-hidden="true">
                        <i class="<?php echo htmlspecialchars((string) ($caaft_trust_item['icon_class'] ?? 'far fa-check-circle'), ENT_QUOTES, 'UTF-8'); ?>"></i>
                    </span>
                    <div class="caaft-ar-trust-content">
                        <h3><?php echo htmlspecialchars((string) ($caaft_trust_item['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?php echo htmlspecialchars((string) ($caaft_trust_item['description'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
