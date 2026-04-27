<?php
/**
 * Reusable FAQ accordion section.
 *
 * Required:
 *   $caaft_faq_heading_id (string)
 *   $caaft_faq_title (string)
 *   $caaft_faq_items (array) with:
 *     - question (string)
 *     - answer (string)
 *
 * Optional:
 *   $caaft_faq_section_id (string) default "faq"
 *   $caaft_faq_section_class (string) default "faq-area are_sections_faq py-120 caaft-ar-faq-wrap"
 *   $caaft_faq_accordion_id (string) default "accordionFaq"
 *   $caaft_faq_prefix (string) default "faq"
 *   $caaft_faq_open_first (bool) default true
 */
if (!isset($caaft_faq_heading_id, $caaft_faq_title, $caaft_faq_items) || !is_array($caaft_faq_items) || $caaft_faq_items === []) {
    trigger_error('caaft-faq.php: set required FAQ variables before including', E_USER_WARNING);
}

$caaft_faq_section_id = isset($caaft_faq_section_id) && $caaft_faq_section_id !== '' ? (string) $caaft_faq_section_id : 'faq';
$caaft_faq_section_class = isset($caaft_faq_section_class) && $caaft_faq_section_class !== ''
    ? (string) $caaft_faq_section_class
    : 'faq-area are_sections_faq py-120 caaft-ar-faq-wrap';
$caaft_faq_accordion_id = isset($caaft_faq_accordion_id) && $caaft_faq_accordion_id !== '' ? (string) $caaft_faq_accordion_id : 'accordionFaq';
$caaft_faq_prefix = isset($caaft_faq_prefix) && $caaft_faq_prefix !== '' ? (string) $caaft_faq_prefix : 'faq';
$caaft_faq_open_first = isset($caaft_faq_open_first) ? (bool) $caaft_faq_open_first : true;
?>
<div id="<?php echo htmlspecialchars($caaft_faq_section_id, ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo htmlspecialchars($caaft_faq_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars((string) $caaft_faq_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="site-heading text-center mb-3">
            <h2 id="<?php echo htmlspecialchars((string) $caaft_faq_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="site-title my-3"><?php echo htmlspecialchars((string) $caaft_faq_title, ENT_QUOTES, 'UTF-8'); ?></h2>
        </div>
        <div class="frequent-question col-lg-10">
            <div class="accordion" id="<?php echo htmlspecialchars($caaft_faq_accordion_id, ENT_QUOTES, 'UTF-8'); ?>">
                <?php foreach ($caaft_faq_items as $caaft_faq_index => $caaft_faq_item) :
                    $caaft_faq_number = $caaft_faq_index + 1;
                    $caaft_faq_heading_item_id = $caaft_faq_prefix . 'Heading' . $caaft_faq_number;
                    $caaft_faq_collapse_item_id = $caaft_faq_prefix . 'Collapse' . $caaft_faq_number;
                    $caaft_faq_is_open = $caaft_faq_open_first && $caaft_faq_index === 0;
                    ?>
                    <div class="accordion-item">
                        <p class="accordion-header" id="<?php echo htmlspecialchars($caaft_faq_heading_item_id, ENT_QUOTES, 'UTF-8'); ?>">
                            <button class="accordion-button<?php echo $caaft_faq_is_open ? '' : ' collapsed'; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo htmlspecialchars($caaft_faq_collapse_item_id, ENT_QUOTES, 'UTF-8'); ?>" aria-expanded="<?php echo $caaft_faq_is_open ? 'true' : 'false'; ?>" aria-controls="<?php echo htmlspecialchars($caaft_faq_collapse_item_id, ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo $caaft_faq_number; ?>. <?php echo htmlspecialchars((string) ($caaft_faq_item['question'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>
                            </button>
                        </p>
                        <div id="<?php echo htmlspecialchars($caaft_faq_collapse_item_id, ENT_QUOTES, 'UTF-8'); ?>" class="accordion-collapse collapse<?php echo $caaft_faq_is_open ? ' show' : ''; ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_faq_heading_item_id, ENT_QUOTES, 'UTF-8'); ?>" data-bs-parent="#<?php echo htmlspecialchars($caaft_faq_accordion_id, ENT_QUOTES, 'UTF-8'); ?>">
                            <div class="accordion-body"><?php echo htmlspecialchars((string) ($caaft_faq_item['answer'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
