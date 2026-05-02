<?php
/**
 * Reusable "Who Needs" section — two-column bullet list (GST registration style).
 *
 * Required:
 *   $caaft_wnl_heading_id (string)
 *   $caaft_wnl_title (string)
 *   $caaft_wnl_items (string[])
 *
 * Optional:
 *   $caaft_wnl_intro (string)
 *   $caaft_wnl_closing (string)   // paragraph after the list
 *   $caaft_wnl_section_class (string)  // default "caaft-who-needs-list-section"
 */
if (!isset($caaft_wnl_heading_id, $caaft_wnl_title, $caaft_wnl_items) || !is_array($caaft_wnl_items) || $caaft_wnl_items === []) {
    trigger_error('caaft-who-needs-list.php: set required $caaft_wnl_* variables before including', E_USER_WARNING);
}

$caaft_wnl_heading_id = (string) $caaft_wnl_heading_id;
$caaft_wnl_title = (string) $caaft_wnl_title;
$caaft_wnl_items = $caaft_wnl_items;
$caaft_wnl_intro = isset($caaft_wnl_intro) ? (string) $caaft_wnl_intro : '';
$caaft_wnl_closing = isset($caaft_wnl_closing) ? (string) $caaft_wnl_closing : '';
$caaft_wnl_section_class = isset($caaft_wnl_section_class) && $caaft_wnl_section_class !== ''
    ? (string) $caaft_wnl_section_class
    : 'caaft-who-needs-list-section';
?>
<section class="<?php echo htmlspecialchars($caaft_wnl_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_wnl_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="caaft-who-needs-list-card">
            <h2 id="<?php echo htmlspecialchars($caaft_wnl_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-who-needs-list-title"><?php echo htmlspecialchars($caaft_wnl_title, ENT_QUOTES, 'UTF-8'); ?></h2>
            <?php if ($caaft_wnl_intro !== '') : ?>
                <p class="caaft-who-needs-list-intro"><?php echo htmlspecialchars($caaft_wnl_intro, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
            <ul class="caaft-who-needs-list-items">
                <?php foreach ($caaft_wnl_items as $caaft_wnl_item) : ?>
                    <li><?php echo htmlspecialchars((string) $caaft_wnl_item, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if ($caaft_wnl_closing !== '') : ?>
                <p class="caaft-who-needs-list-closing"><?php echo htmlspecialchars($caaft_wnl_closing, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
