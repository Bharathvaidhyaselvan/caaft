<?php
/**
 * Reusable card section (title + optional intro + card grid).
 *
 * Required:
 *   $caaft_card_section_heading_id (string)
 *   $caaft_card_section_title (string)
 *   $caaft_card_section_cards (array) with:
 *     - title (string)
 *     - text (string)
 *
 * Optional:
 *   $caaft_card_section_eyebrow (string)
 *   $caaft_card_section_intro (string)
 *   $caaft_card_section_class (string) default "caaft-ar-what-we-offer py-90"
 *   $caaft_card_grid_col_class (string) default "col-md-6 col-lg-4"
 *   $caaft_card_cta_label (string) default "Get Started"
 *   $caaft_card_cta_href (string) default "/contact#contact_us"
 *   $caaft_card_section_embedded (bool) default false
 */
if (!isset($caaft_card_section_heading_id, $caaft_card_section_title, $caaft_card_section_cards) || !is_array($caaft_card_section_cards) || $caaft_card_section_cards === []) {
    trigger_error('caaft-card-section.php: set required card section variables before including', E_USER_WARNING);
}

$caaft_card_section_heading_id = (string) $caaft_card_section_heading_id;
$caaft_card_section_title = (string) $caaft_card_section_title;
$caaft_card_section_eyebrow = isset($caaft_card_section_eyebrow) ? (string) $caaft_card_section_eyebrow : '';
$caaft_card_section_intro = isset($caaft_card_section_intro) ? (string) $caaft_card_section_intro : '';
$caaft_card_section_class = isset($caaft_card_section_class) && $caaft_card_section_class !== '' ? (string) $caaft_card_section_class : 'caaft-ar-what-we-offer py-90';
$caaft_card_grid_col_class = isset($caaft_card_grid_col_class) && $caaft_card_grid_col_class !== '' ? (string) $caaft_card_grid_col_class : 'col-md-6 col-lg-4';
$caaft_card_cta_label = isset($caaft_card_cta_label) && $caaft_card_cta_label !== '' ? (string) $caaft_card_cta_label : 'Get Started';
$caaft_card_cta_href = isset($caaft_card_cta_href) && $caaft_card_cta_href !== '' ? (string) $caaft_card_cta_href : '/contact#contact_us';
$caaft_card_section_embedded = isset($caaft_card_section_embedded) ? (bool) $caaft_card_section_embedded : false;
?>
<?php if (!$caaft_card_section_embedded) : ?>
<section class="<?php echo htmlspecialchars($caaft_card_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_card_section_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
<?php endif; ?>
        <header class="caaft-ar-offer-header">
            <?php if ($caaft_card_section_eyebrow !== '') : ?>
                <p class="caaft-ar-offer-eyebrow"><?php echo htmlspecialchars($caaft_card_section_eyebrow, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
            <h2 id="<?php echo htmlspecialchars($caaft_card_section_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-ar-offer-h2"><?php echo htmlspecialchars($caaft_card_section_title, ENT_QUOTES, 'UTF-8'); ?></h2>
            <?php if ($caaft_card_section_intro !== '') : ?>
                <p class="caaft-ar-offer-intro"><?php echo htmlspecialchars($caaft_card_section_intro, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
        </header>
        <div class="row g-4 caaft-ar-offer-grid">
            <?php foreach ($caaft_card_section_cards as $caaft_card_index => $caaft_card_item) : ?>
                <div class="<?php echo htmlspecialchars($caaft_card_grid_col_class, ENT_QUOTES, 'UTF-8'); ?>">
                    <article class="caaft-ar-offer-card">
                        <span class="caaft-ar-offer-num" aria-hidden="true"><?php echo str_pad((string) ($caaft_card_index + 1), 2, '0', STR_PAD_LEFT); ?></span>
                        <span class="caaft-ar-offer-icon" aria-hidden="true"><i class="<?php echo htmlspecialchars((string) ($caaft_card_item['icon_class'] ?? 'fas fa-check-circle'), ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                        <h3 class="caaft-ar-offer-card-title"><?php echo htmlspecialchars((string) ($caaft_card_item['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="caaft-ar-offer-card-text"><?php echo htmlspecialchars((string) ($caaft_card_item['text'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                        <a href="<?php echo htmlspecialchars((string) ($caaft_card_item['href'] ?? $caaft_card_cta_href), ENT_QUOTES, 'UTF-8'); ?>" class="caaft-ar-offer-cta"><?php echo htmlspecialchars((string) ($caaft_card_item['cta_label'] ?? $caaft_card_cta_label), ENT_QUOTES, 'UTF-8'); ?> <i class="fas fa-arrow-right"></i></a>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
<?php if (!$caaft_card_section_embedded) : ?>
    </div>
</section>
<?php endif; ?>
