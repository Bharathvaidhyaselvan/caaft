<?php
/**
 * Reusable "Who Needs" section cards.
 *
 * Required:
 *   $caaft_who_needs_heading_id (string)
 *   $caaft_who_needs_title (string)
 *   $caaft_who_needs_items (string[])
 *
 * Optional:
 *   $caaft_who_needs_intro (string)
 *   $caaft_who_needs_closing (string)
 *   $caaft_who_needs_section_class (string) default "py-90 caaft-who-needs"
 */
if (!isset($caaft_who_needs_heading_id, $caaft_who_needs_title, $caaft_who_needs_items) || !is_array($caaft_who_needs_items) || $caaft_who_needs_items === []) {
    trigger_error('caaft-who-needs.php: set required who-needs variables before including', E_USER_WARNING);
}

$caaft_who_needs_heading_id = (string) $caaft_who_needs_heading_id;
$caaft_who_needs_title = (string) $caaft_who_needs_title;
$caaft_who_needs_items = $caaft_who_needs_items;
$caaft_who_needs_intro = isset($caaft_who_needs_intro) ? (string) $caaft_who_needs_intro : '';
$caaft_who_needs_closing = isset($caaft_who_needs_closing) ? (string) $caaft_who_needs_closing : '';
$caaft_who_needs_section_class = isset($caaft_who_needs_section_class) && $caaft_who_needs_section_class !== ''
    ? (string) $caaft_who_needs_section_class
    : 'py-90 caaft-who-needs';
?>
<section class="<?php echo htmlspecialchars($caaft_who_needs_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_who_needs_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <header class="caaft-who-needs-header">
            <h2 id="<?php echo htmlspecialchars($caaft_who_needs_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="bk-section-title"><?php echo htmlspecialchars($caaft_who_needs_title, ENT_QUOTES, 'UTF-8'); ?></h2>
            <?php if ($caaft_who_needs_intro !== '') : ?>
                <p class="caaft-who-needs-intro"><?php echo htmlspecialchars($caaft_who_needs_intro, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
        </header>
        <div class="caaft-who-needs-grid">
            <?php foreach ($caaft_who_needs_items as $caaft_who_needs_item) : ?>
                <article class="caaft-who-needs-card">
                    <p><?php echo htmlspecialchars((string) $caaft_who_needs_item, ENT_QUOTES, 'UTF-8'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
        <?php if ($caaft_who_needs_closing !== '') : ?>
            <p class="caaft-who-needs-closing"><?php echo htmlspecialchars($caaft_who_needs_closing, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
    </div>
</section>
