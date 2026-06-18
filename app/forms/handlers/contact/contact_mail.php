<?php
require_once APP_ROOT . '/forms/validation/common.php';
require_post_request();
if (has_honeypot_value(['firstname', 'website'])) {
    exit('Spam detected.');
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    exit('Invalid request.');
}

$secret = '6LcO3ukrAAAAAKpBylqkN7yp3JbXhmrwW8fKBJ13';
$recaptcha_response = (string) ($_POST['g-recaptcha-response'] ?? '');
$verify = @file_get_contents(
    'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret)
    . '&response=' . urlencode($recaptcha_response),
);
$captcha_success = $verify !== false ? json_decode($verify) : null;

if (empty($captcha_success->success)) {
    exit('Please verify that you are not a robot.');
}

$name = post_clean('name');
$company = post_clean('company');
$email = caaft_sanitize_mail_address((string) ($_POST['email'] ?? ''));
$phone = post_clean('phone');
$service = post_clean('service');
$about = post_clean('about');
$about_other = post_clean('about_other');
$msg = post_clean('msg');
$title = post_clean('title');

if ($name === '' || $email === '' || $phone === '' || $service === '' || $about === '') {
    exit('All required fields must be filled.');
}

$to = caaft_form_recipient_email();
$subject = 'New Contact Form Submission' . ($title !== '' ? ' - ' . $title : '');

$body = '
<h2>New Contact Form Submission</h2>
<p><strong>Name:</strong> ' . $name . '</p>';
$body .= caaft_form_company_html($company);
$body .= '
<p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Phone:</strong> ' . $phone . '</p>
<p><strong>Service:</strong> ' . $service . '</p>
<p><strong>Heard About Us:</strong> ' . $about . '</p>';

if ($about_other !== '') {
    $body .= '<p><strong>Other Source:</strong> ' . $about_other . '</p>';
}

$body .= caaft_form_message_html($msg);
$body .= caaft_form_source_url_html();

caaft_form_complete_submission(
    caaft_form_build_lead_data('contact', ''),
    $to,
    $subject,
    $body,
    $name,
    $email,
);
