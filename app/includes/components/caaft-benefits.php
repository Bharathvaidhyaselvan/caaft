<?php
/**
 * Reusable benefits section (matches global CSS in style.css under "caaft-benefits.php").
 *
 * Layout:
 *   - Section: .caaft-benefits — pale blue background (#eaf6fd), default class string "caaft-benefits py-90".
 *   - H2: .caaft-benefits-title — 32px (28px below 576px), weight 800.
 *   - Grid: 3 columns → 2 below 992px → 1 below 576px (.caaft-benefits-grid).
 *   - Cards: white, 12px radius, icon row + one running paragraph per card.
 *
 * Card copy:
 *   - lead + em dash + text in .caaft-benefit-body; .caaft-benefit-lead is bold only (inherits 1.02rem / 1.65 from body).
 *
 * Required:
 *   $caaft_benefits_heading_id (string)
 *   $caaft_benefits_title (string)
 *   $caaft_benefits_items (array) with:
 *     - lead (string)
 *     - text (string)
 *     - icon_class (string)
 *
 * Optional:
 *   $caaft_benefits_section_class (string) default "caaft-benefits py-90"
 *
 * Optional per item:
 *   - tone (string) green | violet | amber | blue | pink | teal — cycles if omitted
 */
if (!isset($caaft_benefits_heading_id, $caaft_benefits_title, $caaft_benefits_items) || !is_array($caaft_benefits_items) || $caaft_benefits_items === []) {
    trigger_error('caaft-benefits.php: set required $caaft_benefits_* variables before including', E_USER_WARNING);
}

$caaft_benefits_heading_id = (string) $caaft_benefits_heading_id;
$caaft_benefits_title = (string) $caaft_benefits_title;
$caaft_benefits_section_class = isset($caaft_benefits_section_class) && $caaft_benefits_section_class !== ''
    ? (string) $caaft_benefits_section_class
    : 'caaft-benefits py-90';

$caaft_benefits_tone_cycle = ['green', 'violet', 'amber', 'blue', 'pink', 'teal'];
?>
<section class="<?php echo htmlspecialchars($caaft_benefits_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_benefits_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <h2 id="<?php echo htmlspecialchars($caaft_benefits_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-benefits-title"><?php echo htmlspecialchars($caaft_benefits_title, ENT_QUOTES, 'UTF-8'); ?></h2>
        <div class="caaft-benefits-grid" role="list">
            <?php foreach ($caaft_benefits_items as $caaft_benefits_index => $caaft_benefits_item) : ?>
                <?php
                $caaft_benefits_lead = (string) ($caaft_benefits_item['lead'] ?? '');
                $caaft_benefits_text = (string) ($caaft_benefits_item['text'] ?? '');
                $caaft_benefits_icon = (string) ($caaft_benefits_item['icon_class'] ?? 'fas fa-check-circle');
                $caaft_benefits_tone = isset($caaft_benefits_item['tone']) && $caaft_benefits_item['tone'] !== ''
                    ? preg_replace('/[^a-z]/', '', strtolower((string) $caaft_benefits_item['tone']))
                    : $caaft_benefits_tone_cycle[(int) $caaft_benefits_index % count($caaft_benefits_tone_cycle)];
                if (!in_array($caaft_benefits_tone, ['green', 'violet', 'amber', 'blue', 'pink', 'teal'], true)) {
                    $caaft_benefits_tone = $caaft_benefits_tone_cycle[(int) $caaft_benefits_index % count($caaft_benefits_tone_cycle)];
                }
                ?>
                <article class="caaft-benefit-card" role="listitem">
                    <span class="caaft-benefit-icon caaft-benefit-icon--<?php echo htmlspecialchars($caaft_benefits_tone, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"><i class="<?php echo htmlspecialchars($caaft_benefits_icon, ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                    <p class="caaft-benefit-body">
                        <strong class="caaft-benefit-lead"><?php echo htmlspecialchars($caaft_benefits_lead, ENT_QUOTES, 'UTF-8'); ?></strong><span class="caaft-benefit-sep"> — </span><span class="caaft-benefit-desc"><?php echo htmlspecialchars($caaft_benefits_text, ENT_QUOTES, 'UTF-8'); ?></span>
                    </p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
