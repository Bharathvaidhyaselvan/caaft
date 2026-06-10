<?php
require_once APP_ROOT . '/forms/validation/common.php';

require_post_request();
if (has_honeypot_value(['firstname', 'website'])) {
    exit('Spam detected.');
}

$recaptchaSecret = '6LcO3ukrAAAAAKpBylqkN7yp3JbXhmrwW8fKBJ13';
$responseKey = (string) ($_POST['g-recaptcha-response'] ?? '');

if (!caaft_verify_recaptcha($responseKey, $recaptchaSecret)) {
    exit('Please verify that you are not a robot.');
}

$name = post_clean('name');
$email = trim((string) ($_POST['email'] ?? ''));
$phone = post_clean('phone');
$service = post_clean('service');
$about = post_clean('about');
$aboutOther = post_clean('about_other');
$msg = post_clean('msg');
$title = post_clean('title');

if ($name === '' || $email === '' || $phone === '' || $service === '' || $about === '' || $msg === '') {
    exit('All fields are required.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Invalid email format.');
}

$to = caaft_form_recipient_email();
$subject = 'New Contact Form Submission' . ($title !== '' ? ' - ' . $title : '');

$body = '
<h2>New Contact Form Submission</h2>
<p><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Phone:</strong> ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Service:</strong> ' . htmlspecialchars($service, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Heard About Us:</strong> ' . htmlspecialchars($about, ENT_QUOTES, 'UTF-8') . '</p>';

if ($aboutOther !== '') {
    $body .= '<p><strong>Other Source:</strong> ' . htmlspecialchars($aboutOther, ENT_QUOTES, 'UTF-8') . '</p>';
}

$body .= '<p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($msg, ENT_QUOTES, 'UTF-8')) . '</p>';
$body .= caaft_form_source_url_html();

if (caaft_send_form_mail($to, $subject, $body, $email, $name)) {
    echo "<script>alert('Thanks for reaching us you will get notified by our advisory team shortly'); window.location.href='thankyou.php';</script>";
    exit;
}

echo 'Something went wrong. Please try again later.';
