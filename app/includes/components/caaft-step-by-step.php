<?php
/**
 * Reusable step-by-step process timeline section.
 *
 * Required:
 *   $caaft_steps_heading_id (string)
 *   $caaft_steps_title (string)
 *   $caaft_steps_items (array) with:
 *     - title (string)
 *     - text (string)
 *
 * Optional:
 *   $caaft_steps_section_class (string) default "caaft-ar-how py-90 caaft-step-by-step"
 *   $caaft_steps_numbered (bool) default true
 *   $caaft_steps_eyebrow (string)
 */
if (!isset($caaft_steps_heading_id, $caaft_steps_title, $caaft_steps_items) || !is_array($caaft_steps_items) || $caaft_steps_items === []) {
    trigger_error('caaft-step-by-step.php: set required step-by-step variables before including', E_USER_WARNING);
}

$caaft_steps_heading_id = (string) $caaft_steps_heading_id;
$caaft_steps_title = (string) $caaft_steps_title;
$caaft_steps_section_class = isset($caaft_steps_section_class) && $caaft_steps_section_class !== ''
    ? (string) $caaft_steps_section_class
    : 'caaft-ar-how py-90 caaft-step-by-step';
$caaft_steps_numbered = isset($caaft_steps_numbered) ? (bool) $caaft_steps_numbered : true;
$caaft_steps_eyebrow = isset($caaft_steps_eyebrow) ? (string) $caaft_steps_eyebrow : '';
if ($caaft_steps_numbered) {
    $caaft_steps_section_class .= ' caaft-step-by-step--numbered';
}
?>
<section class="<?php echo htmlspecialchars($caaft_steps_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars($caaft_steps_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <header class="caaft-ar-how-header">
            <?php if ($caaft_steps_eyebrow !== '') : ?>
                <p class="caaft-ar-how-eyebrow"><?php echo htmlspecialchars($caaft_steps_eyebrow, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
            <h2 id="<?php echo htmlspecialchars($caaft_steps_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-ar-how-h2"><?php echo htmlspecialchars($caaft_steps_title, ENT_QUOTES, 'UTF-8'); ?></h2>
        </header>
        <ol class="caaft-ar-how-timeline">
            <?php foreach ($caaft_steps_items as $caaft_steps_index => $caaft_steps_item) : ?>
                <li class="caaft-ar-how-step<?php echo $caaft_steps_index < count($caaft_steps_items) - 1 ? ' caaft-ar-how-step--line' : ''; ?>">
                    <span class="caaft-ar-how-marker <?php echo $caaft_steps_numbered ? 'caaft-ar-how-marker--num' : 'caaft-ar-how-marker--dot'; ?>" aria-hidden="true"><?php echo $caaft_steps_numbered ? (int) $caaft_steps_index + 1 : ''; ?></span>
                    <div class="caaft-ar-how-body">
                        <h3 class="caaft-ar-how-step-title"><?php echo htmlspecialchars((string) ($caaft_steps_item['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="caaft-ar-how-step-text"><?php echo htmlspecialchars((string) ($caaft_steps_item['text'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>
