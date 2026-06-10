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
$message = post_clean('message');

if ($name === '' || $email === '' || $phone === '' || $service === '' || $message === '') {
    exit('Please fill all required fields.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Invalid email format.');
}

$to = caaft_form_recipient_email();
$subject = 'New Business Registration Inquiry from ' . $name;

$body = '
<h2>Business Registration Inquiry</h2>
<p><strong>Name:</strong> ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Phone:</strong> ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Service:</strong> ' . htmlspecialchars($service, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8')) . '</p>
<p>-----------------------------<br>
<small>Submitted via website form.</small></p>
';
$body .= caaft_form_source_url_html();

if (caaft_send_form_mail($to, $subject, $body, $email, $name)) {
    echo "<script>alert('Thanks for reaching us. You will get notified by our advisory team shortly.'); window.location.href='thankyou.php';</script>";
    exit;
}

echo 'Something went wrong. Please try again.';
