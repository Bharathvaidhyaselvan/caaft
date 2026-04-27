<?php
/**
 * Reusable overview card: content left + image right.
 *
 * Required:
 *   $caaft_overview_heading_id (string)
 *   $caaft_overview_title (string)
 *   $caaft_overview_image_src (string)
 *   $caaft_overview_image_alt (string)
 *
 * Optional:
 *   $caaft_overview_paragraphs (string[])  // supports <strong>, <em>, <br>
 *   $caaft_overview_bullets (string[])     // supports <strong>, <em>, <br>
 */
if (!isset($caaft_overview_heading_id, $caaft_overview_title, $caaft_overview_image_src, $caaft_overview_image_alt)) {
    trigger_error('caaft-overview-card.php: set required $caaft_overview_* variables before including', E_USER_WARNING);
}

$caaft_overview_heading_id = isset($caaft_overview_heading_id) ? (string) $caaft_overview_heading_id : 'overview-heading';
$caaft_overview_title = isset($caaft_overview_title) ? (string) $caaft_overview_title : '';
$caaft_overview_image_src = isset($caaft_overview_image_src) ? (string) $caaft_overview_image_src : '';
$caaft_overview_image_alt = isset($caaft_overview_image_alt) ? (string) $caaft_overview_image_alt : '';
$caaft_overview_paragraphs = isset($caaft_overview_paragraphs) && is_array($caaft_overview_paragraphs) ? $caaft_overview_paragraphs : [];
$caaft_overview_bullets = isset($caaft_overview_bullets) && is_array($caaft_overview_bullets) ? $caaft_overview_bullets : [];
?>
<section class="bk-overview py-90" aria-labelledby="<?php echo htmlspecialchars($caaft_overview_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="bk-overview-card caaft-overview-card">
            <div class="bk-overview-layout caaft-overview-layout">
                <div class="bk-overview-content caaft-overview-content">
                    <h2 id="<?php echo htmlspecialchars($caaft_overview_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="bk-section-title"><?php echo htmlspecialchars($caaft_overview_title, ENT_QUOTES, 'UTF-8'); ?></h2>
                    <?php foreach ($caaft_overview_paragraphs as $caaft_overview_paragraph) : ?>
                        <p class="bk-overview-text"><?php echo strip_tags((string) $caaft_overview_paragraph, '<strong><em><br>'); ?></p>
                    <?php endforeach; ?>
                    <?php if ($caaft_overview_bullets !== []) : ?>
                        <ul class="bk-overview-bullets">
                            <?php foreach ($caaft_overview_bullets as $caaft_overview_bullet) : ?>
                                <li><?php echo strip_tags((string) $caaft_overview_bullet, '<strong><em><br>'); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="bk-overview-image-wrap caaft-overview-image-wrap">
                    <img src="<?php echo htmlspecialchars($caaft_overview_image_src, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($caaft_overview_image_alt, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
