<?php
/**
 * Reusable service hero section with left content and right enquiry form.
 *
 * Required:
 *   $caaft_hero_id (string)                      // h1 id + aria-labelledby value
 *   $caaft_hero_h1 (string)                      // small upper heading
 *   $caaft_hero_h2_before (string)               // heading text before highlight
 *   $caaft_hero_h2_highlight (string)            // highlighted heading text
 *   $caaft_hero_h2_after (string)                // heading text after highlight
 *   $caaft_hero_lead_paragraphs (string[])       // one or more lead paragraphs
 *   $caaft_hero_primary_cta_label (string)
 *   $caaft_hero_primary_cta_href (string)
 *
 * Optional:
 *   $caaft_hero_secondary_cta_label (string)
 *   $caaft_hero_secondary_cta_href (string)
 *   $caaft_hero_secondary_cta_icon (string)      // default fas fa-arrow-down
 *   $caaft_hero_primary_cta_icon (string)        // default fas fa-arrow-right
 *   $caaft_hero_secondary_extra_class (string)
 *
 * Enquiry form options (passed through):
 *   $caaft_enquiry_* variables from enquiry-hero-form.php
 */
if (!isset($caaft_hero_id, $caaft_hero_h1, $caaft_hero_h2_before, $caaft_hero_h2_highlight, $caaft_hero_h2_after, $caaft_hero_lead_paragraphs, $caaft_hero_primary_cta_label, $caaft_hero_primary_cta_href)) {
    trigger_error('service-hero-with-enquiry.php: set required $caaft_hero_* variables before including', E_USER_WARNING);
}

$caaft_hero_id = isset($caaft_hero_id) ? (string) $caaft_hero_id : 'service-hero-h1';
$caaft_hero_h1 = isset($caaft_hero_h1) ? (string) $caaft_hero_h1 : '';
$caaft_hero_h2_before = isset($caaft_hero_h2_before) ? (string) $caaft_hero_h2_before : '';
$caaft_hero_h2_highlight = isset($caaft_hero_h2_highlight) ? (string) $caaft_hero_h2_highlight : '';
$caaft_hero_h2_after = isset($caaft_hero_h2_after) ? (string) $caaft_hero_h2_after : '';
$caaft_hero_lead_paragraphs = isset($caaft_hero_lead_paragraphs) && is_array($caaft_hero_lead_paragraphs) ? $caaft_hero_lead_paragraphs : [];
$caaft_hero_primary_cta_label = isset($caaft_hero_primary_cta_label) ? (string) $caaft_hero_primary_cta_label : '';
$caaft_hero_primary_cta_href = isset($caaft_hero_primary_cta_href) ? (string) $caaft_hero_primary_cta_href : '#';
$caaft_hero_secondary_cta_label = isset($caaft_hero_secondary_cta_label) ? (string) $caaft_hero_secondary_cta_label : '';
$caaft_hero_secondary_cta_href = isset($caaft_hero_secondary_cta_href) ? (string) $caaft_hero_secondary_cta_href : '#';
$caaft_hero_primary_cta_icon = isset($caaft_hero_primary_cta_icon) ? (string) $caaft_hero_primary_cta_icon : 'fas fa-arrow-right';
$caaft_hero_secondary_cta_icon = isset($caaft_hero_secondary_cta_icon) ? (string) $caaft_hero_secondary_cta_icon : 'fas fa-arrow-down';
$caaft_hero_secondary_extra_class = isset($caaft_hero_secondary_extra_class) ? (string) $caaft_hero_secondary_extra_class : '';
?>
<section class="hero-section hs-3 caaft-ar-hero" aria-labelledby="<?php echo htmlspecialchars($caaft_hero_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="hero-single singles_forms_frames caaft-ar-hero-single">
        <div class="container">
            <div class="row align-items-center g-4 g-xl-5 caaft-ar-hero-row">
                <div class="col-md-12 col-lg-6 caaft-ar-hero-inner">
                    <h1 id="<?php echo htmlspecialchars($caaft_hero_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-ar-hero-h1"><?php echo htmlspecialchars($caaft_hero_h1, ENT_QUOTES, 'UTF-8'); ?></h1>
                    <h2 class="caaft-ar-hero-h2">
                        <?php echo htmlspecialchars($caaft_hero_h2_before, ENT_QUOTES, 'UTF-8'); ?>
                        <em><?php echo htmlspecialchars($caaft_hero_h2_highlight, ENT_QUOTES, 'UTF-8'); ?></em>
                        <?php echo htmlspecialchars($caaft_hero_h2_after, ENT_QUOTES, 'UTF-8'); ?>
                    </h2>
                    <?php foreach ($caaft_hero_lead_paragraphs as $caaft_hero_lead_paragraph) : ?>
                        <p class="caaft-ar-hero-lead"><?php echo htmlspecialchars((string) $caaft_hero_lead_paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
                    <?php endforeach; ?>
                    <div class="caaft-ar-hero-ctas">
                        <a href="<?php echo htmlspecialchars($caaft_hero_primary_cta_href, ENT_QUOTES, 'UTF-8'); ?>" class="theme-btn caaft-ar-hero-btn-primary">
                            <?php echo htmlspecialchars($caaft_hero_primary_cta_label, ENT_QUOTES, 'UTF-8'); ?> <i class="<?php echo htmlspecialchars($caaft_hero_primary_cta_icon, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                        </a>
                        <?php if ($caaft_hero_secondary_cta_label !== '') : ?>
                            <a href="<?php echo htmlspecialchars($caaft_hero_secondary_cta_href, ENT_QUOTES, 'UTF-8'); ?>" class="theme-btn theme-btn2 caaft-ar-hero-btn-secondary <?php echo htmlspecialchars($caaft_hero_secondary_extra_class, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($caaft_hero_secondary_cta_label, ENT_QUOTES, 'UTF-8'); ?> <i class="<?php echo htmlspecialchars($caaft_hero_secondary_cta_icon, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="hero-img-wrap caaft-ar-hero-img-wrap">
                        <?php include __DIR__ . '/enquiry-hero-form.php'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
