<?php
/**
 * Reusable CTA section.
 *
 * Required:
 *   $caaft_cta_heading_id (string)
 *   $caaft_cta_title (string) — or use $caaft_cta_title_lines (string[]) for a forced multi-line heading
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
 *   $caaft_cta_show_button (bool) default true — set false to hide the button row
 *   $caaft_service_cta_label (string) — if set, used as button label when $caaft_cta_button_label is empty
 */
$caaft_cta_title_lines = isset($caaft_cta_title_lines) && is_array($caaft_cta_title_lines)
    ? array_values(array_filter(array_map('strval', $caaft_cta_title_lines), static fn (string $line): bool => trim($line) !== ''))
    : [];
$caaft_has_cta_title = isset($caaft_cta_title) && trim((string) $caaft_cta_title) !== '';
if (!isset($caaft_cta_heading_id) || (!$caaft_has_cta_title && $caaft_cta_title_lines === [])) {
    trigger_error('caaft-cta.php: set $caaft_cta_title or $caaft_cta_title_lines before including', E_USER_WARNING);
}

require_once __DIR__ . '/../caaft-url-helpers.php';

$caaft_cta_show_button = !isset($caaft_cta_show_button) || (bool) $caaft_cta_show_button;

if (isset($caaft_service_cta_label) && trim((string) $caaft_service_cta_label) !== '' && (!isset($caaft_cta_button_label) || trim((string) $caaft_cta_button_label) === '')) {
    $caaft_cta_button_label = (string) $caaft_service_cta_label;
}
$caaft_cta_button_label = isset($caaft_cta_button_label) ? (string) $caaft_cta_button_label : '';
$caaft_cta_button_href = caaft_resolve_page_anchor_href(
    isset($caaft_cta_button_href) && trim((string) $caaft_cta_button_href) !== ''
        ? (string) $caaft_cta_button_href
        : '#quote-content'
);

if ($caaft_cta_button_label === '') {
    trigger_error('caaft-cta.php: set $caaft_cta_button_label or $caaft_service_cta_label before including', E_USER_WARNING);
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
            <h2 id="<?php echo htmlspecialchars((string) $caaft_cta_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="bk-cta-title">
                <?php if ($caaft_cta_title_lines !== []) : ?>
                    <?php foreach ($caaft_cta_title_lines as $caaft_cta_title_line) : ?>
                        <span class="bk-cta-title-line"><?php echo htmlspecialchars($caaft_cta_title_line, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php echo htmlspecialchars((string) $caaft_cta_title, ENT_QUOTES, 'UTF-8'); ?>
                <?php endif; ?>
            </h2>
            <?php if ($caaft_cta_text !== '') : ?>
                <p class="bk-cta-text"><?php echo htmlspecialchars($caaft_cta_text, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
            <?php if ($caaft_cta_show_button) : ?>
                <div class="bk-cta-actions">
                    <a href="<?php echo htmlspecialchars((string) $caaft_cta_button_href, ENT_QUOTES, 'UTF-8'); ?>" class="theme-btn bk-cta-button"><?php echo htmlspecialchars((string) $caaft_cta_button_label, ENT_QUOTES, 'UTF-8'); ?> <i class="<?php echo htmlspecialchars($caaft_cta_button_icon_class, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
