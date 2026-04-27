<?php
/**
 * Reusable Get in Touch two-column section.
 *
 * Required:
 *   $caaft_git_heading_id (string)
 *   $caaft_git_title (string)
 *   $caaft_git_lead (string)
 *   $caaft_git_actions (array)
 *   $caaft_git_cards (array)
 *
 * Optional:
 *   $caaft_git_section_id (string) default "get-in-touch"
 *   $caaft_git_section_class (string) default "caaft-ar-get-in-touch py-90"
 *   $caaft_git_eyebrow (string)
 *   $caaft_git_note (string)
 */
if (!isset($caaft_git_heading_id, $caaft_git_title, $caaft_git_lead, $caaft_git_actions, $caaft_git_cards) || !is_array($caaft_git_actions) || !is_array($caaft_git_cards)) {
    trigger_error('caaft-get-in-touch.php: set required get-in-touch variables before including', E_USER_WARNING);
}

$caaft_git_section_id = isset($caaft_git_section_id) && $caaft_git_section_id !== '' ? (string) $caaft_git_section_id : 'get-in-touch';
$caaft_git_section_class = isset($caaft_git_section_class) && $caaft_git_section_class !== ''
    ? (string) $caaft_git_section_class
    : 'caaft-ar-get-in-touch py-90';
$caaft_git_eyebrow = isset($caaft_git_eyebrow) ? (string) $caaft_git_eyebrow : '';
$caaft_git_note = isset($caaft_git_note) ? (string) $caaft_git_note : '';
?>
<section id="<?php echo htmlspecialchars($caaft_git_section_id, ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo htmlspecialchars($caaft_git_section_class, ENT_QUOTES, 'UTF-8'); ?>" aria-labelledby="<?php echo htmlspecialchars((string) $caaft_git_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <div class="row align-items-stretch g-4 g-xl-5">
            <div class="col-lg-6 caaft-ar-git-col-main">
                <?php if ($caaft_git_eyebrow !== '') : ?>
                    <p class="caaft-ar-git-eyebrow"><?php echo htmlspecialchars($caaft_git_eyebrow, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
                <h2 id="<?php echo htmlspecialchars((string) $caaft_git_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="caaft-ar-git-h2"><?php echo strip_tags((string) $caaft_git_title, '<em><strong><br>'); ?></h2>
                <p class="caaft-ar-git-lead"><?php echo htmlspecialchars((string) $caaft_git_lead, ENT_QUOTES, 'UTF-8'); ?></p>
                <div class="caaft-ar-git-ctas">
                    <?php foreach ($caaft_git_actions as $caaft_git_action) : ?>
                        <a href="<?php echo htmlspecialchars((string) ($caaft_git_action['href'] ?? '#'), ENT_QUOTES, 'UTF-8'); ?>" class="<?php echo htmlspecialchars((string) ($caaft_git_action['class'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>"<?php echo !empty($caaft_git_action['target']) ? ' target="' . htmlspecialchars((string) $caaft_git_action['target'], ENT_QUOTES, 'UTF-8') . '"' : ''; ?><?php echo !empty($caaft_git_action['rel']) ? ' rel="' . htmlspecialchars((string) $caaft_git_action['rel'], ENT_QUOTES, 'UTF-8') . '"' : ''; ?>><?php echo strip_tags((string) ($caaft_git_action['label'] ?? ''), '<i><em><strong><br>'); ?></a>
                    <?php endforeach; ?>
                </div>
                <?php if ($caaft_git_note !== '') : ?>
                    <p class="caaft-ar-git-note"><?php echo htmlspecialchars($caaft_git_note, ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <div class="caaft-ar-git-cards d-flex flex-column">
                    <?php foreach ($caaft_git_cards as $caaft_git_card) : ?>
                        <div class="caaft-ar-git-card">
                            <span class="caaft-ar-git-card-icon" aria-hidden="true"><i class="<?php echo htmlspecialchars((string) ($caaft_git_card['icon_class'] ?? 'fas fa-info-circle'), ENT_QUOTES, 'UTF-8'); ?>"></i></span>
                            <div class="caaft-ar-git-card-body">
                                <span class="caaft-ar-git-card-label"><?php echo htmlspecialchars((string) ($caaft_git_card['label'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php foreach (($caaft_git_card['values'] ?? []) as $caaft_git_value_index => $caaft_git_value) : ?>
                                    <a href="<?php echo htmlspecialchars((string) ($caaft_git_value['href'] ?? '#'), ENT_QUOTES, 'UTF-8'); ?>" class="caaft-ar-git-card-value<?php echo $caaft_git_value_index > 0 ? ' caaft-ar-git-card-value--second' : ''; ?>"<?php echo !empty($caaft_git_value['target']) ? ' target="' . htmlspecialchars((string) $caaft_git_value['target'], ENT_QUOTES, 'UTF-8') . '"' : ''; ?><?php echo !empty($caaft_git_value['rel']) ? ' rel="' . htmlspecialchars((string) $caaft_git_value['rel'], ENT_QUOTES, 'UTF-8') . '"' : ''; ?>><?php echo htmlspecialchars((string) ($caaft_git_value['text'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></a>
                                <?php endforeach; ?>
                                <?php if (!empty($caaft_git_card['hint'])) : ?>
                                    <span class="caaft-ar-git-card-hint"><?php echo htmlspecialchars((string) $caaft_git_card['hint'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
