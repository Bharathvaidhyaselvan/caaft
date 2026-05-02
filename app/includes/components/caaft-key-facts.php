<?php
/**
 * Reusable Key Facts & Figures section.
 *
 * Required:
 *   $caaft_key_facts_heading_id (string)
 *   $caaft_key_facts_title (string)
 *   $caaft_key_facts_items (array)
 *
 * Each item may be:
 *   - string: single paragraph
 *   - array with 'stat' + 'text' (big stat + body)
 *   - array with 'title' + 'desc' (heading + body; optional 'stat' before title)
 *   Optional per item: 'stat_icon_class' (e.g. Font Awesome) — shown above 'stat' when set (use with 'stat')
 *
 * Optional:
 *   $caaft_key_facts_section_class (string) default "bk-facts py-90"
 *   $caaft_key_facts_grid_class (string) default "bk-facts-grid bk-facts-grid--plain"
 *   $caaft_key_facts_card_class (string) default "bk-facts-card bk-facts-card--plain"
 */
if (!isset($caaft_key_facts_heading_id, $caaft_key_facts_title, $caaft_key_facts_items) || !is_array($caaft_key_facts_items) || $caaft_key_facts_items === []) {
    trigger_error('caaft-key-facts.php: set required key-facts variables before including', E_USER_WARNING);
}

$caaft_key_facts_section_class = isset($caaft_key_facts_section_class) && $caaft_key_facts_section_class !== ''
    ? (string) $caaft_key_facts_section_class
    : 'bk-facts py-90';
$caaft_key_facts_grid_class = isset($caaft_key_facts_grid_class) && $caaft_key_facts_grid_class !== ''
    ? (string) $caaft_key_facts_grid_class
    : 'bk-facts-grid bk-facts-grid--plain';
$caaft_key_facts_card_class = isset($caaft_key_facts_card_class) && $caaft_key_facts_card_class !== ''
    ? (string) $caaft_key_facts_card_class
    : 'bk-facts-card bk-facts-card--plain';

?>
<section class="<?php echo htmlspecialchars($caaft_key_facts_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars((string) $caaft_key_facts_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <header class="bk-facts-header">
            <h2 id="<?php echo htmlspecialchars((string) $caaft_key_facts_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="bk-section-title"><?php echo htmlspecialchars((string) $caaft_key_facts_title, ENT_QUOTES, 'UTF-8'); ?></h2>
        </header>
        <div class="<?php echo htmlspecialchars($caaft_key_facts_grid_class, ENT_QUOTES, 'UTF-8'); ?>">
            <?php foreach ($caaft_key_facts_items as $caaft_key_facts_item) : ?>
                <?php
                $caaft_key_facts_stat = '';
                $caaft_key_facts_title = '';
                $caaft_key_facts_desc = '';
                $caaft_key_facts_text = '';

                $caaft_key_facts_stat_icon_class = '';
                if (is_array($caaft_key_facts_item)) {
                    $caaft_key_facts_stat = trim((string) ($caaft_key_facts_item['stat'] ?? ''));
                    $caaft_key_facts_stat_icon_class = trim((string) ($caaft_key_facts_item['stat_icon_class'] ?? ''));
                    $caaft_key_facts_title = trim((string) ($caaft_key_facts_item['title'] ?? ''));
                    $caaft_key_facts_desc = trim((string) ($caaft_key_facts_item['desc'] ?? ''));
                    $caaft_key_facts_text = trim((string) ($caaft_key_facts_item['text'] ?? ''));
                } else {
                    $caaft_key_facts_text = trim((string) $caaft_key_facts_item);
                }
                ?>
                <article class="<?php echo htmlspecialchars($caaft_key_facts_card_class, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php if ($caaft_key_facts_stat !== '' || $caaft_key_facts_stat_icon_class !== '') : ?>
                        <h3 class="bk-facts-stat<?php echo $caaft_key_facts_stat_icon_class !== '' ? ' bk-facts-stat--with-icon' : ''; ?>">
                            <?php if ($caaft_key_facts_stat_icon_class !== '') : ?>
                                <i class="<?php echo htmlspecialchars($caaft_key_facts_stat_icon_class, ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                            <?php endif; ?>
                            <?php if ($caaft_key_facts_stat !== '') : ?>
                                <span class="bk-facts-stat-label"><?php echo htmlspecialchars($caaft_key_facts_stat, ENT_QUOTES, 'UTF-8'); ?></span>
                            <?php endif; ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ($caaft_key_facts_title !== '') : ?>
                        <h3 class="bk-facts-title"><?php echo htmlspecialchars($caaft_key_facts_title, ENT_QUOTES, 'UTF-8'); ?></h3>
                    <?php endif; ?>
                    <?php
                    $caaft_key_facts_body = $caaft_key_facts_desc !== '' ? $caaft_key_facts_desc : $caaft_key_facts_text;
                    ?>
                    <p class="bk-facts-stat-text"><?php echo htmlspecialchars($caaft_key_facts_body, ENT_QUOTES, 'UTF-8'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
