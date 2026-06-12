<?php
require_once APP_ROOT . '/forms/validation/common.php';
require_post_request();
if (has_honeypot_value(['firstname','website'])) { exit('Spam detected.'); }
// Turn on error reporting (disable in production)
error_reporting(0);

// reCAPTCHA Secret Key
$recaptcha_secret = "6LcO3ukrAAAAAKpBylqkN7yp3JbXhmrwW8fKBJ13"; // Replace with your secret key

// Verify reCAPTCHA
if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
} else {
    $captcha = '';
}

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha_secret . "&response=" . $captcha);
$responseKeys = json_decode($response, true);

if (intval($responseKeys["success"]) !== 1) {
    die("reCAPTCHA verification failed. Please try again.");
}

// Spam bot detection (honeypot)
if (!empty($_POST['firstname']) || !empty($_POST['website'])) {
    die("Spam detected.");
}

// Sanitize inputs
$name    = htmlspecialchars(trim($_POST['name']));
$email   = caaft_sanitize_mail_address((string) ($_POST['email'] ?? ''));
$phone   = htmlspecialchars(trim($_POST['phone']));
$service = htmlspecialchars(trim($_POST['service']));
$message = htmlspecialchars(trim($_POST['message']));

if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($message)) {
    die("Please fill in all required fields.");
}

$to = caaft_form_recipient_email();
$category = caaft_form_enquiry_category('Accounting & Reporting');
$subject = caaft_form_enquiry_subject($category, $name);
$body = "
" . caaft_form_enquiry_heading_html($category) . "
<p><strong>Name:</strong> $name</p>
<p><strong>Email:</strong> " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "</p>
<p><strong>Phone:</strong> $phone</p>
<p><strong>Service:</strong> $service</p>
<p><strong>Message:</strong><br>$message</p>
";
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
