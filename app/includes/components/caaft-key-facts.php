<?php
/**
 * Reusable Key Facts & Figures section.
 *
 * Required:
 *   $caaft_key_facts_heading_id (string)
 *   $caaft_key_facts_title (string)
 *   $caaft_key_facts_items (string[])
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

$caaft_key_facts_make_short_headline = static function (string $value): string {
    $value = trim($value);
    if ($value === '') {
        return '';
    }

    $words = preg_split('/\s+/u', $value, -1, PREG_SPLIT_NO_EMPTY);
    if (!is_array($words) || $words === []) {
        return '';
    }

    return trim(implode(' ', array_slice($words, 0, 2)));
};
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
                $caaft_key_facts_text = '';

                if (is_array($caaft_key_facts_item)) {
                    $caaft_key_facts_stat = trim((string) ($caaft_key_facts_item['stat'] ?? ''));
                    $caaft_key_facts_text = trim((string) ($caaft_key_facts_item['text'] ?? ''));
                } else {
                    $caaft_key_facts_item_text = trim((string) $caaft_key_facts_item);

                    if ($caaft_key_facts_item_text !== '') {
                        $caaft_key_facts_split = preg_split('/\s(?:—|-)\s/u', $caaft_key_facts_item_text, 2);

                        if (is_array($caaft_key_facts_split) && count($caaft_key_facts_split) === 2) {
                            $caaft_key_facts_stat = trim((string) $caaft_key_facts_split[0]);
                            $caaft_key_facts_text = trim((string) $caaft_key_facts_split[1]);
                        } else {
                            $caaft_key_facts_text = $caaft_key_facts_item_text;
                        }
                    }
                }

                if ($caaft_key_facts_stat === '' && $caaft_key_facts_text !== '') {
                    $caaft_key_facts_stat = $caaft_key_facts_text;
                }

                $caaft_key_facts_stat = $caaft_key_facts_make_short_headline($caaft_key_facts_stat);
                ?>
                <article class="<?php echo htmlspecialchars($caaft_key_facts_card_class, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php if ($caaft_key_facts_stat !== '') : ?>
                        <h3 class="bk-facts-stat"><?php echo htmlspecialchars($caaft_key_facts_stat, ENT_QUOTES, 'UTF-8'); ?></h3>
                    <?php endif; ?>
                    <p class="bk-facts-stat-text"><?php echo htmlspecialchars($caaft_key_facts_text, ENT_QUOTES, 'UTF-8'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
