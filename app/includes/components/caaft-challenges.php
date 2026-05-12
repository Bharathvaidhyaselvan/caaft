<?php
/**
 * Reusable challenges list section.
 *
 * Required:
 *   $caaft_challenges_heading_id (string)
 *   $caaft_challenges_title (string)
 *   $caaft_challenges_intro (string)
 *   $caaft_challenges_items (string[])
 *
 * Optional:
 *   $caaft_challenges_outro (string)
 *   $caaft_challenges_section_class (string) default "bk-challenges py-90 caaft-challenges"
 *
 * Styling: list bullets use var(--theme-color) in style.css (see .bk-challenges .bk-challenges-list li::before).
 */
if (!isset($caaft_challenges_heading_id, $caaft_challenges_title, $caaft_challenges_intro, $caaft_challenges_items) || !is_array($caaft_challenges_items) || $caaft_challenges_items === []) {
    trigger_error('caaft-challenges.php: set required challenges variables before including', E_USER_WARNING);
}

$caaft_challenges_outro = isset($caaft_challenges_outro) ? (string) $caaft_challenges_outro : '';
$caaft_challenges_subtext = isset($caaft_challenges_subtext) ? (string) $caaft_challenges_subtext : '';
$caaft_challenges_section_class = isset($caaft_challenges_section_class) && $caaft_challenges_section_class !== ''
    ? (string) $caaft_challenges_section_class
    : 'bk-challenges py-90 caaft-challenges';
?>
<section class="<?php echo htmlspecialchars($caaft_challenges_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars((string) $caaft_challenges_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <header class="bk-challenges-header">
            <h2 id="<?php echo htmlspecialchars((string) $caaft_challenges_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="bk-section-title"><?php echo htmlspecialchars((string) $caaft_challenges_title, ENT_QUOTES, 'UTF-8'); ?></h2>
            <p class="bk-challenges-intro"><?php echo htmlspecialchars((string) $caaft_challenges_intro, ENT_QUOTES, 'UTF-8'); ?></p>
<?php if ($caaft_challenges_subtext !== '') : ?>
    <p class="bk-challenges-intro"><?php echo htmlspecialchars($caaft_challenges_subtext, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
        </header>
        <div class="bk-challenges-box">
            <ul class="bk-challenges-list">
                <?php foreach ($caaft_challenges_items as $caaft_challenges_item) : ?>
    <li><?php echo $caaft_challenges_item; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if ($caaft_challenges_outro !== '') : ?>
                <p class="bk-challenges-outro"><?php echo htmlspecialchars($caaft_challenges_outro, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
