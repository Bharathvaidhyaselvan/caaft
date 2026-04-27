<?php
/**
 * Reusable Why section with numbered cards.
 *
 * Required:
 *   $caaft_why_heading_id (string)
 *   $caaft_why_title (string)
 *   $caaft_why_items (array) with:
 *     - title (string)
 *     - text (string)
 *
 * Optional:
 *   $caaft_why_eyebrow (string)
 *   $caaft_why_section_class (string) default "caaft-ar-why py-90"
 */
if (!isset($caaft_why_heading_id, $caaft_why_title, $caaft_why_items) || !is_array($caaft_why_items) || $caaft_why_items === []) {
    trigger_error('caaft-why-grid.php: set required why-grid variables before including', E_USER_WARNING);
}

$caaft_why_eyebrow = isset($caaft_why_eyebrow) ? (string) $caaft_why_eyebrow : '';
$caaft_why_section_class = isset($caaft_why_section_class) && $caaft_why_section_class !== ''
    ? (string) $caaft_why_section_class
    : 'caaft-ar-why py-90';
?>
<section class="<?php echo htmlspecialchars($caaft_why_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars((string) $caaft_why_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <header class="caaft-ar-why-header">
            <?php if ($caaft_why_eyebrow !== '') : ?>
                <p class="caaft-ar-why-eyebrow"><?php echo htmlspecialchars($caaft_why_eyebrow, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
            <h2 id="<?php echo htmlspecialchars((string) $caaft_why_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-ar-why-h2"><?php echo htmlspecialchars((string) $caaft_why_title, ENT_QUOTES, 'UTF-8'); ?></h2>
        </header>
        <div class="caaft-ar-why-panel">
            <div class="caaft-ar-why-grid">
                <?php foreach ($caaft_why_items as $caaft_why_index => $caaft_why_item) : ?>
                    <article class="caaft-ar-why-cell">
                        <span class="caaft-ar-why-num" aria-hidden="true"><?php echo str_pad((string) ($caaft_why_index + 1), 2, '0', STR_PAD_LEFT); ?></span>
                        <h3 class="caaft-ar-why-title"><?php echo htmlspecialchars((string) ($caaft_why_item['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="caaft-ar-why-text"><?php echo htmlspecialchars((string) ($caaft_why_item['text'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
