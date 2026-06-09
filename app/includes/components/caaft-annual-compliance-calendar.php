<?php
/**
 * Annual compliance calendar table (chip layout).
 *
 * Required:
 *   $caaft_annual_compliance_calendar_key — key in data/caaft-annual-compliance-calendars.php
 *
 * Optional:
 *   $caaft_annual_compliance_calendar_heading_id
 *   $caaft_annual_compliance_calendar_title
 *   $caaft_annual_compliance_calendar_intro
 */
declare(strict_types=1);

$caaft_calendar_key = isset($caaft_annual_compliance_calendar_key)
    ? trim((string) $caaft_annual_compliance_calendar_key)
    : '';

if ($caaft_calendar_key === '') {
    trigger_error('caaft-annual-compliance-calendar.php: set $caaft_annual_compliance_calendar_key before including', E_USER_WARNING);
    return;
}

$caaft_calendar_data = require dirname(__DIR__) . '/data/caaft-annual-compliance-calendars.php';
if (!isset($caaft_calendar_data[$caaft_calendar_key]) || !is_array($caaft_calendar_data[$caaft_calendar_key])) {
    trigger_error('caaft-annual-compliance-calendar.php: unknown calendar key "' . $caaft_calendar_key . '"', E_USER_WARNING);
    return;
}

$caaft_calendar = $caaft_calendar_data[$caaft_calendar_key];
$caaft_calendar_rows = $caaft_calendar['rows'] ?? [];
if ($caaft_calendar_rows === []) {
    return;
}

$caaft_calendar_heading_id = isset($caaft_annual_compliance_calendar_heading_id)
    ? trim((string) $caaft_annual_compliance_calendar_heading_id)
    : 'annual-compliance-calendar-heading';
$caaft_calendar_title = isset($caaft_annual_compliance_calendar_title) && trim((string) $caaft_annual_compliance_calendar_title) !== ''
    ? trim((string) $caaft_annual_compliance_calendar_title)
    : (string) ($caaft_calendar['title'] ?? 'Annual Compliance Calendar');
$caaft_calendar_intro = isset($caaft_annual_compliance_calendar_intro) && trim((string) $caaft_annual_compliance_calendar_intro) !== ''
    ? trim((string) $caaft_annual_compliance_calendar_intro)
    : (string) ($caaft_calendar['intro'] ?? '');
$caaft_calendar_columns = $caaft_calendar['columns'] ?? ['Month', 'Activity', 'Form / Action', 'Deadline'];
?>
<section class="llp-vs-section caaft-annual-compliance-calendar" aria-labelledby="<?php echo htmlspecialchars($caaft_calendar_heading_id, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="container">
        <h2 id="<?php echo htmlspecialchars($caaft_calendar_heading_id, ENT_QUOTES, 'UTF-8'); ?>" class="compliance-calendar-title"><?php echo htmlspecialchars($caaft_calendar_title, ENT_QUOTES, 'UTF-8'); ?></h2>
        <?php if ($caaft_calendar_intro !== '') : ?>
            <p class="compliance-calendar-intro"><?php echo htmlspecialchars($caaft_calendar_intro, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endif; ?>
        <div class="table-responsive compliance-calendar-wrap">
            <table class="compliance-calendar-table">
                <thead>
                    <tr>
                        <?php foreach ($caaft_calendar_columns as $caaft_calendar_col) : ?>
                            <th><?php echo htmlspecialchars((string) $caaft_calendar_col, ENT_QUOTES, 'UTF-8'); ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($caaft_calendar_rows as $caaft_calendar_row) : ?>
                        <?php
                        $caaft_calendar_deadline_tone = (($caaft_calendar_row['deadline_tone'] ?? '') === 'red')
                            ? 'calendar-chip--deadline-red'
                            : 'calendar-chip--deadline-soft';
                        $caaft_calendar_forms = $caaft_calendar_row['forms'] ?? [];
                        if (!is_array($caaft_calendar_forms)) {
                            $caaft_calendar_forms = [(string) $caaft_calendar_forms];
                        }
                        ?>
                        <tr>
                            <td><span class="calendar-chip calendar-chip--month"><?php echo htmlspecialchars((string) ($caaft_calendar_row['month'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span></td>
                            <td><?php echo htmlspecialchars((string) ($caaft_calendar_row['activity'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <?php foreach ($caaft_calendar_forms as $caaft_calendar_form) : ?>
                                    <span class="calendar-chip calendar-chip--form"><?php echo htmlspecialchars((string) $caaft_calendar_form, ENT_QUOTES, 'UTF-8'); ?></span>
                                <?php endforeach; ?>
                            </td>
                            <td><span class="calendar-chip <?php echo htmlspecialchars($caaft_calendar_deadline_tone, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars((string) ($caaft_calendar_row['deadline'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></span></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
