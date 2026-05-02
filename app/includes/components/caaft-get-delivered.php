<?php
/**
 * Reusable "What Gets Delivered" section.
 *
 * Required:
 *   $caaft_delivered_heading_id (string)
 *   $caaft_delivered_title (string)
 *   $caaft_delivered_items (array) with:
 *     - name (string)
 *     - text (string)
 *
 * Optional:
 *   $caaft_delivered_section_class (string) default "bk-delivered py-90 caaft-get-delivered"
 *   $caaft_delivered_intro (string)
 *   $caaft_delivered_outro (string) paragraph after the table
 */
if (!isset($caaft_delivered_heading_id, $caaft_delivered_title, $caaft_delivered_items) || !is_array($caaft_delivered_items) || $caaft_delivered_items === []) {
    trigger_error('caaft-get-delivered.php: set required delivered variables before including', E_USER_WARNING);
}

$caaft_delivered_heading_id = (string) $caaft_delivered_heading_id;
$caaft_delivered_title = (string) $caaft_delivered_title;
$caaft_delivered_section_class = isset($caaft_delivered_section_class) && $caaft_delivered_section_class !== ''
    ? (string) $caaft_delivered_section_class
    : 'bk-delivered py-90 caaft-get-delivered';
$caaft_delivered_intro = isset($caaft_delivered_intro) ? (string) $caaft_delivered_intro : '';
$caaft_delivered_outro = isset($caaft_delivered_outro) ? (string) $caaft_delivered_outro : '';
?>
<section class="<?php echo htmlspecialchars($caaft_delivered_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_delivered_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <h2 id="<?php echo htmlspecialchars($caaft_delivered_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="bk-section-title"><?php echo htmlspecialchars($caaft_delivered_title, ENT_QUOTES, 'UTF-8'); ?></h2>
        <?php if ($caaft_delivered_intro !== '') : ?>
            <p class="bk-overview-text"><?php echo htmlspecialchars($caaft_delivered_intro, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <div class="bk-delivered-table" role="list">
            <?php foreach ($caaft_delivered_items as $caaft_delivered_index => $caaft_delivered_item) : ?>
                <article class="bk-delivered-row" role="listitem">
                    <span class="bk-delivered-num"><?php echo (int) $caaft_delivered_index + 1; ?>.</span>
                    <h3 class="bk-delivered-name"><?php echo htmlspecialchars((string) ($caaft_delivered_item['name'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="bk-delivered-text"><?php echo htmlspecialchars((string) ($caaft_delivered_item['text'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
        <?php if ($caaft_delivered_outro !== '') : ?>
            <p class="bk-overview-text mt-3"><?php echo htmlspecialchars($caaft_delivered_outro, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
    </div>
</section>
