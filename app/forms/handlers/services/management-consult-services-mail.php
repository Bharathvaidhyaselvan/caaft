<?php
require_once APP_ROOT . '/forms/validation/common.php';
require_post_request();
if (has_honeypot_value(['firstname','website'])) { exit('Spam detected.'); }
error_reporting(0);

$recaptcha_secret = "6LcO3ukrAAAAAKpBylqkN7yp3JbXhmrwW8fKBJ13";
$captcha = $_POST['g-recaptcha-response'] ?? '';
$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $captcha);
$responseKeys = json_decode($response, true);

if (intval($responseKeys["success"] ?? 0) !== 1) {
    die("reCAPTCHA verification failed. Please try again.");
}

if (!empty($_POST['firstname']) || !empty($_POST['website'])) {
    die("Spam detected.");
}

$validationError = caaft_form_validate_enquiry_post(true);
if ($validationError !== null) {
    die($validationError);
}

$name = post_clean('name');
$company = post_clean('company');
$email = caaft_sanitize_mail_address((string) ($_POST['email'] ?? ''));
$phone = post_clean('phone');
$service = post_clean('service');
$message = post_clean('message');

$to = caaft_form_recipient_email();
$category = caaft_form_enquiry_category('Advisory & CFO Services');
$subject = caaft_form_enquiry_subject($category, $name);
$body = caaft_form_enquiry_heading_html($category) . "
<p><strong>Name:</strong> {$name}</p>";
$body .= caaft_form_company_html($company);
$body .= "
<p><strong>Email:</strong> " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "</p>
<p><strong>Phone:</strong> {$phone}</p>
<p><strong>Service:</strong> {$service}</p>";
$body .= caaft_form_message_html($message);
$body .= caaft_form_source_url_html();

caaft_form_complete_submission(
    caaft_form_build_lead_data('enquiry', $category),
    $to,
    $subject,
    $body,
    $name,
    $email,
    'Your message has been sent successfully!',
    true,
);
