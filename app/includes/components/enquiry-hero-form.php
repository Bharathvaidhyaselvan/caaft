<?php
/**
 * Reusable hero "Enquire Now" block (.quote-content + form).
 *
 * Set before include:
 *   $caaft_enquiry_service (string) — value for hidden input "service" (required)
 *
 * Optional:
 *   $caaft_enquiry_action (string) — form action, default /account-services-mail.php
 *   $caaft_enquiry_title (string) — heading, default "Enquire Now"
 *   $caaft_enquiry_recaptcha (bool) — show g-recaptcha, default true
 *   $caaft_enquiry_recaptcha_sitekey (string) — reCAPTCHA site key
 *   $caaft_enquiry_honeypot_website (bool) — name="website" honeypot, default true
 *   $caaft_enquiry_form_id (string) — optional id on <form>
 *   $caaft_enquiry_textarea_rows (int) — default 5
 *   $caaft_enquiry_input_id_prefix (string) — optional prefix for field ids (e.g. ar → id ar-enquiry-name, ar-firstname-honeypot)
 *
 * Optional pricing strip (shown below submit, inside .quote-content):
 *   $caaft_enquiry_pricing_amount (string) — e.g. "14,999"; if empty, strip is omitted
 *   $caaft_enquiry_pricing_label (string) — default "Price starts from" when amount is set
 *   $caaft_enquiry_pricing_suffix (string) — default "+ GST"
 *   $caaft_enquiry_pricing_extra (string) — e.g. "Govt. Fee"; empty hides the "| …" segment
 */
if (!isset($caaft_enquiry_service) || $caaft_enquiry_service === '') {
    trigger_error('enquiry-hero-form.php: set $caaft_enquiry_service before including', E_USER_WARNING);
}
$caaft_enquiry_service = isset($caaft_enquiry_service) ? (string) $caaft_enquiry_service : '';
$caaft_enquiry_action = $caaft_enquiry_action ?? '/account-services-mail.php';
if (isset($caaft_service_cta_label) && trim((string) $caaft_service_cta_label) !== '') {
    $caaft_enquiry_title = (string) $caaft_service_cta_label;
} else {
    $caaft_enquiry_title = isset($caaft_enquiry_title) && trim((string) $caaft_enquiry_title) !== ''
        ? (string) $caaft_enquiry_title
        : 'Enquire Now';
}
$caaft_enquiry_recaptcha = $caaft_enquiry_recaptcha ?? true;
$caaft_enquiry_recaptcha_sitekey = $caaft_enquiry_recaptcha_sitekey ?? '6LcO3ukrAAAAADerciVZtVVgPZqbR-iH04HfKq-K';
$caaft_enquiry_honeypot_website = $caaft_enquiry_honeypot_website ?? true;
$caaft_enquiry_form_id = isset($caaft_enquiry_form_id) ? (string) $caaft_enquiry_form_id : '';
$caaft_enquiry_textarea_rows = isset($caaft_enquiry_textarea_rows) ? (int) $caaft_enquiry_textarea_rows : 5;
if ($caaft_enquiry_textarea_rows < 2) {
    $caaft_enquiry_textarea_rows = 2;
}
if ($caaft_enquiry_textarea_rows > 12) {
    $caaft_enquiry_textarea_rows = 12;
}
$caaft_enquiry_input_id_prefix = isset($caaft_enquiry_input_id_prefix)
    ? preg_replace('/[^a-zA-Z0-9_-]/', '', (string) $caaft_enquiry_input_id_prefix)
    : '';
$caaft_enquiry_field_id_attr = function (string $suffix) use ($caaft_enquiry_input_id_prefix) {
    if ($caaft_enquiry_input_id_prefix === '') {
        return '';
    }
    return ' id="' . htmlspecialchars($caaft_enquiry_input_id_prefix . $suffix, ENT_QUOTES, 'UTF-8') . '"';
};

require_once __DIR__ . '/../caaft-resolve-service-pricing.php';

if (!isset($caaft_enquiry_pricing_amount) || trim((string) $caaft_enquiry_pricing_amount) === '') {
    $caaft_enquiry_pricing_row = caaft_resolve_service_page_pricing();
    if ($caaft_enquiry_pricing_row !== null) {
        $caaft_enquiry_pricing_amount = $caaft_enquiry_pricing_row['amount'];
        if (!isset($caaft_enquiry_pricing_extra) || trim((string) $caaft_enquiry_pricing_extra) === '') {
            $caaft_enquiry_pricing_extra = $caaft_enquiry_pricing_row['govt_fee'] ? 'Govt. Fee' : '';
        }
    }
}

$caaft_enquiry_pricing_amount = isset($caaft_enquiry_pricing_amount) ? trim((string) $caaft_enquiry_pricing_amount) : '';
$caaft_enquiry_pricing_label = isset($caaft_enquiry_pricing_label) ? trim((string) $caaft_enquiry_pricing_label) : '';
$caaft_enquiry_pricing_suffix = isset($caaft_enquiry_pricing_suffix) ? trim((string) $caaft_enquiry_pricing_suffix) : '+ GST';
$caaft_enquiry_pricing_extra = isset($caaft_enquiry_pricing_extra) ? trim((string) $caaft_enquiry_pricing_extra) : '';
$caaft_enquiry_show_pricing = $caaft_enquiry_pricing_amount !== '';
if ($caaft_enquiry_show_pricing && $caaft_enquiry_pricing_label === '') {
    $caaft_enquiry_pricing_label = 'Price starts from';
}
if ($caaft_enquiry_pricing_suffix === '') {
    $caaft_enquiry_pricing_suffix = '+ GST';
}

// Load Google's reCAPTCHA script once per request when the widget is shown.
if ($caaft_enquiry_recaptcha && !\defined('CAAFT_ENQUIRY_RECAPTCHA_JS_PRINTED')) {
    \define('CAAFT_ENQUIRY_RECAPTCHA_JS_PRINTED', true);
    echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>' . "\n";
}
?>
<div class="quote-content" id="quote-content">
    <div class="quote-head"><span><?php echo htmlspecialchars($caaft_enquiry_title, ENT_QUOTES, 'UTF-8'); ?></span></div>
    <div class="quote-form">
        <form action="<?php echo htmlspecialchars((string) $caaft_enquiry_action, ENT_QUOTES, 'UTF-8'); ?>" method="POST" class="contact"<?php echo $caaft_enquiry_form_id !== '' ? ' id="' . htmlspecialchars($caaft_enquiry_form_id, ENT_QUOTES, 'UTF-8') . '"' : ''; ?>>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group"><input name="firstname" type="text" class="hide-robot" style="display:none;" autocomplete="off" tabindex="-1" aria-hidden="true"<?php echo $caaft_enquiry_field_id_attr('-firstname-honeypot'); ?>></div>
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-user-tie" aria-hidden="true"></i></span>
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required autocomplete="name"<?php echo $caaft_enquiry_field_id_attr('-enquiry-name'); ?>>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-envelope" aria-hidden="true"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required autocomplete="email"<?php echo $caaft_enquiry_field_id_attr('-enquiry-email'); ?>>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="input-group">
                        <span class="input-group-text"><i class="far fa-phone" aria-hidden="true"></i></span>
                        <input type="text" name="phone" class="form-control" placeholder="Your Phone" required autocomplete="tel"<?php echo $caaft_enquiry_field_id_attr('-enquiry-phone'); ?>>
                        <?php if ($caaft_enquiry_honeypot_website) : ?>
                            <input type="text" name="website" class="hide-robot" style="display:none;" tabindex="-1" autocomplete="off" aria-hidden="true"<?php echo $caaft_enquiry_field_id_attr('-enquiry-website'); ?>>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="input-group textarea">
                        <span class="input-group-text"><i class="far fa-comment-lines" aria-hidden="true"></i></span>
                        <textarea name="message" class="form-control" rows="<?php echo (int) $caaft_enquiry_textarea_rows; ?>" placeholder="Your Message" required<?php echo $caaft_enquiry_field_id_attr('-enquiry-message'); ?>></textarea>
                    </div>
                </div>
                <input type="hidden" name="service" value="<?php echo htmlspecialchars($caaft_enquiry_service, ENT_QUOTES, 'UTF-8'); ?>">
                <?php if ($caaft_enquiry_recaptcha) : ?>
                    <div class="col-lg-12">
                        <div class="g-recaptcha" data-sitekey="<?php echo htmlspecialchars((string) $caaft_enquiry_recaptcha_sitekey, ENT_QUOTES, 'UTF-8'); ?>"></div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-12">
                    <button type="submit" class="theme-btn">Submit Now <i class="fas fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>
    <?php if ($caaft_enquiry_show_pricing) : ?>
        <div class="caaft-enquiry-pricing-banner" role="note">
            <span class="caaft-enquiry-pricing-label"><?php echo htmlspecialchars($caaft_enquiry_pricing_label, ENT_QUOTES, 'UTF-8'); ?></span>
            <div class="caaft-enquiry-pricing-line">
                <span class="caaft-enquiry-pricing-amount-wrap">
                    <span class="caaft-enquiry-pricing-rupee">₹</span><strong class="caaft-enquiry-pricing-amount"><?php echo htmlspecialchars($caaft_enquiry_pricing_amount, ENT_QUOTES, 'UTF-8'); ?></strong>
                </span>
                <span class="caaft-enquiry-pricing-suffix"><?php echo htmlspecialchars($caaft_enquiry_pricing_suffix, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php if ($caaft_enquiry_pricing_extra !== '') : ?>
                    <span class="caaft-enquiry-pricing-sep" aria-hidden="true">|</span>
                    <span class="caaft-enquiry-pricing-extra"><?php echo htmlspecialchars($caaft_enquiry_pricing_extra, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
