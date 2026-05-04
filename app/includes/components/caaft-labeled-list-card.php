<?php
/**
 * Reusable section: H2 + optional lead + single white card with divided rows.
 * Each row: theme blue bullet (var(--theme-color)), bold label + colon, then body text (same line).
 *
 * Required:
 *   $caaft_llc_heading_id (string)
 *   $caaft_llc_title (string)
 *   $caaft_llc_items (array) of items, each:
 *     - label (string)
 *     - text (string)
 *
 * Optional:
 *   $caaft_llc_lead (string) — intro paragraph below H2, above the card
 *   $caaft_llc_section_class (string) default "caaft-labeled-list-card-section py-90"
 *     Append " caaft-labeled-list-card-section--tint" for a pale grey section background (#f8fafc).
 */
if (!isset($caaft_llc_heading_id, $caaft_llc_title, $caaft_llc_items) || !is_array($caaft_llc_items) || $caaft_llc_items === []) {
    trigger_error('caaft-labeled-list-card.php: set required $caaft_llc_* variables before including', E_USER_WARNING);
}

$caaft_llc_heading_id = (string) $caaft_llc_heading_id;
$caaft_llc_title = (string) $caaft_llc_title;
$caaft_llc_lead = isset($caaft_llc_lead) ? trim((string) $caaft_llc_lead) : '';
$caaft_llc_section_class = isset($caaft_llc_section_class) && $caaft_llc_section_class !== ''
    ? (string) $caaft_llc_section_class
    : 'caaft-labeled-list-card-section py-90';
?>
<section class="<?php echo htmlspecialchars($caaft_llc_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_llc_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <h2 id="<?php echo htmlspecialchars($caaft_llc_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-labeled-list-card-title"><?php echo htmlspecialchars($caaft_llc_title, ENT_QUOTES, 'UTF-8'); ?></h2>
        <?php if ($caaft_llc_lead !== '') : ?>
            <p class="caaft-labeled-list-card-lead"><?php echo htmlspecialchars($caaft_llc_lead, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <div class="caaft-labeled-list-card">
            <ul class="caaft-labeled-list-card-items">
                <?php foreach ($caaft_llc_items as $caaft_llc_item) : ?>
                    <?php
                    $caaft_llc_label = trim((string) ($caaft_llc_item['label'] ?? ''));
                    $caaft_llc_text = trim((string) ($caaft_llc_item['text'] ?? ''));
                    ?>
                    <li>
                        <span class="caaft-labeled-list-card-bullet" aria-hidden="true"></span>
                        <p class="caaft-labeled-list-card-row">
                            <strong class="caaft-labeled-list-card-label"><?php echo htmlspecialchars($caaft_llc_label, ENT_QUOTES, 'UTF-8'); ?>:</strong><span class="caaft-labeled-list-card-text"> <?php echo htmlspecialchars($caaft_llc_text, ENT_QUOTES, 'UTF-8'); ?></span>
                        </p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
