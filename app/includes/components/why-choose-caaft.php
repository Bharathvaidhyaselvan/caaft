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
 *   $why_choose_caaft_section_style (string)
 *   $why_choose_caaft_sticky_main (bool) default true
 *   $why_choose_caaft_show_intro (bool) default true — shows intro paragraph; H2 uses aria-describedby when intro visible
 *   $why_choose_caaft_link_desc (bool) default true — aria-describedby on H2 pointing at intro (set false to omit)
 */
if (!isset($why_choose_caaft_heading_id, $why_choose_caaft_title, $why_choose_caaft_items) || !is_array($why_choose_caaft_items) || $why_choose_caaft_items === []) {
    trigger_error('why-choose-caaft.php: set required variables before including', E_USER_WARNING);
}

$why_choose_caaft_heading_id = (string) $why_choose_caaft_heading_id;
$why_choose_caaft_title = (string) $why_choose_caaft_title;
$why_choose_caaft_show_intro = isset($why_choose_caaft_show_intro) ? (bool) $why_choose_caaft_show_intro : true;
$why_choose_caaft_link_desc = isset($why_choose_caaft_link_desc) ? (bool) $why_choose_caaft_link_desc : true;
$why_choose_caaft_intro = isset($why_choose_caaft_intro)
    ? (string) $why_choose_caaft_intro
    : 'Businesses trust CAAFT for accurate books, timely reporting, and dependable accounting support that scales with growth.';
if ($why_choose_caaft_show_intro && trim($why_choose_caaft_intro) === '') {
    $why_choose_caaft_intro = 'Businesses trust CAAFT for accurate books, timely reporting, and dependable accounting support that scales with growth.';
}
$why_choose_caaft_section_class = isset($why_choose_caaft_section_class) && $why_choose_caaft_section_class !== ''
    ? (string) $why_choose_caaft_section_class
    : 'why-choose-caaft py-90';
$why_choose_caaft_section_style = isset($why_choose_caaft_section_style) && $why_choose_caaft_section_style !== ''
    ? (string) $why_choose_caaft_section_style
    : 'background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.6) 100%), url("/assets/img/caaft-why-choose-us.png") !important;';
$why_choose_caaft_sticky_main = isset($why_choose_caaft_sticky_main) ? (bool) $why_choose_caaft_sticky_main : true;
$why_choose_caaft_desc_id = $why_choose_caaft_heading_id . '-desc';
?>
<section class="<?php echo htmlspecialchars($why_choose_caaft_section_class, ENT_QUOTES, 'UTF-8'); ?>" style="<?php echo htmlspecialchars($why_choose_caaft_section_style, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($why_choose_caaft_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="why-choose-caaft-layout">
            <div class="why-choose-caaft-main<?php echo $why_choose_caaft_sticky_main ? '' : ' why-choose-caaft-main--static'; ?>">
                <h2 id="<?php echo htmlspecialchars($why_choose_caaft_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="why-choose-caaft-title"<?php
                if ($why_choose_caaft_show_intro && $why_choose_caaft_intro !== '' && $why_choose_caaft_link_desc) :
                    ?> aria-describedby="<?php echo htmlspecialchars($why_choose_caaft_desc_id, ENT_QUOTES, 'UTF-8'); ?>"<?php
                endif;
                ?>><?php echo htmlspecialchars($why_choose_caaft_title, ENT_QUOTES, 'UTF-8'); ?></h2>
                <?php if ($why_choose_caaft_show_intro && $why_choose_caaft_intro !== '') : ?>
                    <p id="<?php echo htmlspecialchars($why_choose_caaft_desc_id, ENT_QUOTES, 'UTF-8'); ?>" class="why-choose-caaft-intro"><?php echo htmlspecialchars($why_choose_caaft_intro, ENT_QUOTES, 'UTF-8'); ?></p>
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
