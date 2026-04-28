<?php
/**
 * Reusable CTA section.
 *
 * Required:
 *   $caaft_cta_heading_id (string)
 *   $caaft_cta_title (string)
 *   $caaft_cta_button_label (string)
 *   $caaft_cta_button_href (string)
 *
 * Optional:
 *   $caaft_cta_text (string)
 *   $caaft_cta_section_id (string)
 *   $caaft_cta_section_class (string) default "bk-cta py-90"
 *   $caaft_cta_button_icon_class (string) default "fas fa-arrow-right"
 *   $caaft_cta_secondary_button_label (string)
 *   $caaft_cta_secondary_button_href (string)
 *   $caaft_cta_secondary_button_class (string) default "theme-btn theme-btn2 bk-cta-button"
 *   $caaft_cta_secondary_button_icon_class (string) default "fas fa-arrow-right"
 */
if (!isset($caaft_cta_heading_id, $caaft_cta_title, $caaft_cta_button_label, $caaft_cta_button_href)) {
    trigger_error('caaft-cta.php: set required CTA variables before including', E_USER_WARNING);
}

$caaft_cta_text = isset($caaft_cta_text) ? (string) $caaft_cta_text : '';
$caaft_cta_section_id = isset($caaft_cta_section_id) ? (string) $caaft_cta_section_id : '';
$caaft_cta_section_class = isset($caaft_cta_section_class) && $caaft_cta_section_class !== ''
    ? (string) $caaft_cta_section_class
    : 'bk-cta py-90';
$caaft_cta_button_icon_class = isset($caaft_cta_button_icon_class) && $caaft_cta_button_icon_class !== ''
    ? (string) $caaft_cta_button_icon_class
    : 'fas fa-arrow-right';
$caaft_cta_secondary_button_label = isset($caaft_cta_secondary_button_label) ? (string) $caaft_cta_secondary_button_label : '';
$caaft_cta_secondary_button_href = isset($caaft_cta_secondary_button_href) ? (string) $caaft_cta_secondary_button_href : '#';
$caaft_cta_secondary_button_class = isset($caaft_cta_secondary_button_class) && $caaft_cta_secondary_button_class !== ''
    ? (string) $caaft_cta_secondary_button_class
    : 'theme-btn theme-btn2 bk-cta-button';
$caaft_cta_secondary_button_icon_class = isset($caaft_cta_secondary_button_icon_class) && $caaft_cta_secondary_button_icon_class !== ''
    ? (string) $caaft_cta_secondary_button_icon_class
    : 'fas fa-arrow-right';
?>
<section<?php echo $caaft_cta_section_id !== '' ? ' id="' . htmlspecialchars($caaft_cta_section_id, ENT_QUOTES, 'UTF-8') . '"' : ''; ?> class="<?php echo htmlspecialchars($caaft_cta_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars((string) $caaft_cta_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="bk-cta-panel caaft-cta-panel">
            <h2 id="<?php echo htmlspecialchars((string) $caaft_cta_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="bk-cta-title"><?php echo htmlspecialchars((string) $caaft_cta_title, ENT_QUOTES, 'UTF-8'); ?></h2>
            <?php if ($caaft_cta_text !== '') : ?>
                <p class="bk-cta-text"><?php echo htmlspecialchars($caaft_cta_text, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
            <div class="bk-cta-actions">
                <a href="<?php echo htmlspecialchars((string) $caaft_cta_button_href, ENT_QUOTES, 'UTF-8'); ?>" class="theme-btn bk-cta-button"><?php echo htmlspecialchars((string) $caaft_cta_button_label, ENT_QUOTES, 'UTF-8'); ?> <i class="<?php echo htmlspecialchars($caaft_cta_button_icon_class, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i></a>
                <?php if ($caaft_cta_secondary_button_label !== '') : ?>
                    <a href="<?php echo htmlspecialchars((string) $caaft_cta_secondary_button_href, ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo htmlspecialchars($caaft_cta_secondary_button_class, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars((string) $caaft_cta_secondary_button_label, ENT_QUOTES, 'UTF-8'); ?> <i class="<?php echo htmlspecialchars($caaft_cta_secondary_button_icon_class, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
