<?php
declare(strict_types=1);

require_once APP_ROOT . '/forms/validation/common.php';
require_post_request();

if (has_honeypot_value(['firstname', 'website'])) {
    caaft_form_abort('Spam detected.');
}

$secret = '6LcO3ukrAAAAAKpBylqkN7yp3JbXhmrwW8fKBJ13';
$recaptchaResponse = (string) ($_POST['g-recaptcha-response'] ?? '');
$verify = @file_get_contents(
    'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secret)
    . '&response=' . urlencode($recaptchaResponse)
);
$captchaSuccess = $verify !== false ? json_decode($verify) : null;
if (empty($captchaSuccess->success)) {
    caaft_form_abort('Please verify that you are not a robot.');
}

$jobs = require APP_ROOT . '/includes/data/caaft-careers.php';
$jobSlug = preg_replace('/[^a-z0-9-]/', '', strtolower(trim((string) ($_POST['job_slug'] ?? '')))) ?: '';
$job = $jobs[$jobSlug] ?? null;
if ($job === null || empty($job['open'])) {
    caaft_form_abort('This position is closed and no longer accepting applications.');
}

$firstName = post_clean('first_name');
$lastName = post_clean('last_name');
$email = caaft_sanitize_mail_address((string) ($_POST['email'] ?? ''));
$phone = post_clean('phone');
$jobTitle = htmlspecialchars((string) $job['title'], ENT_QUOTES, 'UTF-8');
$fullName = trim($firstName . ' ' . $lastName);

if ($firstName === '' || $lastName === '' || $email === '' || $phone === '') {
    caaft_form_abort('All required fields must be filled.');
}

if (!preg_match('/^[0-9]{10}$/', $phone)) {
    caaft_form_abort('Please enter a valid 10-digit mobile number.');
}

if (empty($_POST['agree_terms'])) {
    caaft_form_abort('Please agree to the terms and conditions and privacy policy.');
}

if (!isset($_FILES['resume']) || !is_array($_FILES['resume'])) {
    caaft_form_abort('Please attach your resume.');
}

$resume = $_FILES['resume'];
if (($resume['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    caaft_form_abort('Resume upload failed. Please try again.');
}

$maxBytes = 5 * 1024 * 1024;
$size = (int) ($resume['size'] ?? 0);
$tmpPath = (string) ($resume['tmp_name'] ?? '');
$originalName = (string) ($resume['name'] ?? 'resume');
$originalName = preg_replace('/[^\w.\- ()]+/u', '_', $originalName) ?: 'resume';

if ($tmpPath === '' || !is_uploaded_file($tmpPath)) {
    caaft_form_abort('Resume upload failed. Please try again.');
}

if ($size <= 0 || $size > $maxBytes) {
    caaft_form_abort('Resume must be 5 MB or smaller.');
}

$extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
$allowedExtensions = ['doc', 'docx', 'pdf', 'rtf'];
if (!in_array($extension, $allowedExtensions, true)) {
    caaft_form_abort('Supported resume formats: .doc, .docx, .pdf, .rtf');
}

$finfo = new finfo(FILEINFO_MIME_TYPE);
$detectedMime = (string) $finfo->file($tmpPath);
$allowedMimes = [
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/rtf',
    'text/rtf',
    'text/plain',
    'application/octet-stream',
];
if (!in_array($detectedMime, $allowedMimes, true)) {
    caaft_form_abort('Unsupported resume file type.');
}

$mimeByExtension = [
    'pdf' => 'application/pdf',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'rtf' => 'application/rtf',
];
$attachmentMime = $mimeByExtension[$extension] ?? 'application/octet-stream';

$to = caaft_careers_recipient_email();

$subject = 'Career Application - ' . $job['title'] . ' - ' . $fullName;
$body = '
<h2>New Career Application</h2>
<p><strong>Position:</strong> ' . $jobTitle . '</p>
<p><strong>Department:</strong> ' . htmlspecialchars((string) $job['department'], ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>First Name:</strong> ' . $firstName . '</p>
<p><strong>Last Name:</strong> ' . $lastName . '</p>
<p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Mobile:</strong> ' . $phone . '</p>
<p><strong>Resume:</strong> ' . htmlspecialchars($originalName, ENT_QUOTES, 'UTF-8') . '</p>';
$body .= caaft_form_source_url_html();

$attachments = [[
    'path' => $tmpPath,
    'name' => $originalName,
    'type' => $attachmentMime,
]];

// Careers applications: email HR only — do not push to Zoho CRM.
$mailOk = caaft_try_send_mail($to, $subject, $body, $fullName, $email, $attachments);
$successMessage = 'Thank you for your interest in joining our team! Our HR team will review your application and contact you if your profile matches our requirement.';

if ($mailOk) {
    caaft_form_redirect_thankyou($successMessage, true);
}

caaft_form_abort('There was an error sending your application. Please try again later.', 500);
