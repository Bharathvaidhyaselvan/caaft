<?php
/**
 * Reusable "Documents required" — two-column grid, horizontal rules, vertical gutter,
 * empty checkbox-style markers (matches GST Return Filing documents layout).
 *
 * Required:
 *   $caaft_docs_heading_id (string)
 *   $caaft_docs_title (string)
 *   $caaft_docs_items (string[])
 *
 * Optional:
 *   $caaft_docs_intro (string)
 *   $caaft_docs_outro (string)
 *   $caaft_docs_section_class (string) default "caaft-documents py-90"
 *   $caaft_docs_tint (bool) default false — pale blue section background
 */
if (!isset($caaft_docs_heading_id, $caaft_docs_title, $caaft_docs_items) || !is_array($caaft_docs_items) || $caaft_docs_items === []) {
    trigger_error('caaft-documents.php: set required $caaft_docs_* variables before including', E_USER_WARNING);
}

$caaft_docs_heading_id = (string) $caaft_docs_heading_id;
$caaft_docs_title = (string) $caaft_docs_title;
$caaft_docs_intro = isset($caaft_docs_intro) ? (string) $caaft_docs_intro : '';
$caaft_docs_outro = isset($caaft_docs_outro) ? (string) $caaft_docs_outro : '';
$caaft_docs_section_class = isset($caaft_docs_section_class) && $caaft_docs_section_class !== ''
    ? (string) $caaft_docs_section_class
    : 'caaft-documents py-90';
$caaft_docs_tint = isset($caaft_docs_tint) ? (bool) $caaft_docs_tint : false;
if ($caaft_docs_tint) {
    $caaft_docs_section_class .= ' caaft-documents--tint';
}
?>
<section class="<?php echo htmlspecialchars($caaft_docs_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_docs_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <h2 id="<?php echo htmlspecialchars($caaft_docs_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-documents-title"><?php echo htmlspecialchars($caaft_docs_title, ENT_QUOTES, 'UTF-8'); ?></h2>
        <?php if ($caaft_docs_intro !== '') : ?>
            <p class="caaft-documents-intro"><?php echo htmlspecialchars($caaft_docs_intro, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <div class="caaft-documents-grid" role="list">
            <?php foreach ($caaft_docs_items as $caaft_docs_item) : ?>
                <div class="caaft-documents-item" role="listitem">
                    <span class="caaft-documents-checkbox" aria-hidden="true"></span>
                    <span><?php echo htmlspecialchars((string) $caaft_docs_item, ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if ($caaft_docs_outro !== '') : ?>
            <p class="caaft-documents-outro"><?php echo htmlspecialchars($caaft_docs_outro, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
    </div>
</section>
