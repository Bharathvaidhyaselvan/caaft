<?php
/**
 * Reusable Why Choose CAAFT section.
 *
 * Required:
 *   $why_choose_caaft_heading_id (string)
 *   $why_choose_caaft_title (string)
 *   $why_choose_caaft_items (array) with:
 *     - icon_class (string)
 *     - title (string)
 *     - text (string)
 *
 * Optional:
 *   $why_choose_caaft_intro (string)
 *   $why_choose_caaft_section_class (string)
 */
if (!isset($why_choose_caaft_heading_id, $why_choose_caaft_title, $why_choose_caaft_items) || !is_array($why_choose_caaft_items) || $why_choose_caaft_items === []) {
    trigger_error('why-choose-caaft.php: set required variables before including', E_USER_WARNING);
}

$why_choose_caaft_heading_id = (string) $why_choose_caaft_heading_id;
$why_choose_caaft_title = (string) $why_choose_caaft_title;
$why_choose_caaft_intro = isset($why_choose_caaft_intro)
    ? (string) $why_choose_caaft_intro
    : 'Businesses trust CAAFT for accurate books, timely reporting, and dependable accounting support that scales with growth.';
$why_choose_caaft_section_class = isset($why_choose_caaft_section_class) && $why_choose_caaft_section_class !== ''
    ? (string) $why_choose_caaft_section_class
    : 'why-choose-caaft py-90';
?>
<section class="<?php echo htmlspecialchars($why_choose_caaft_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($why_choose_caaft_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="why-choose-caaft-layout">
            <div class="why-choose-caaft-main">
                <h2 id="<?php echo htmlspecialchars($why_choose_caaft_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="why-choose-caaft-title"><?php echo htmlspecialchars($why_choose_caaft_title, ENT_QUOTES, 'UTF-8'); ?></h2>
                <?php if ($why_choose_caaft_intro !== '') : ?>
                    <p class="why-choose-caaft-intro"><?php echo htmlspecialchars($why_choose_caaft_intro, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>
            <div class="why-choose-caaft-cards" role="list">
                <?php foreach ($why_choose_caaft_items as $why_choose_caaft_item) : ?>
                    <article class="why-choose-caaft-card" role="listitem">
                        <span class="why-choose-caaft-card-icon" aria-hidden="true"><i class="<?php echo htmlspecialchars((string) ($why_choose_caaft_item['icon_class'] ?? 'far fa-check-circle'), ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                        <h3><?php echo htmlspecialchars((string) ($why_choose_caaft_item['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?php echo htmlspecialchars((string) ($why_choose_caaft_item['text'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
