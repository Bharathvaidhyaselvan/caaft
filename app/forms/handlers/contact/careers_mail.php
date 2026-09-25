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

$root = defined('PROJECT_ROOT') ? PROJECT_ROOT : dirname(APP_ROOT);
$careersDir = $root . '/storage/careers';
if (!is_dir($careersDir) && !@mkdir($careersDir, 0755, true) && !is_dir($careersDir)) {
    caaft_form_abort('Unable to save your application. Please try again later.', 500);
}
$htaccess = $careersDir . '/.htaccess';
if (!is_file($htaccess)) {
    @file_put_contents($htaccess, "Require all denied\nDeny from all\n");
}

$attachments = [];
$storedResumeName = '';
$hasResume = isset($_FILES['resume'])
    && is_array($_FILES['resume'])
    && (int) ($_FILES['resume']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_NO_FILE;

if ($hasResume) {
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

    if (class_exists('finfo')) {
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
            'application/zip',
            'application/x-zip-compressed',
        ];
        if ($detectedMime !== '' && !in_array($detectedMime, $allowedMimes, true)) {
            caaft_form_abort('Unsupported resume file type.');
        }
    }

    $mimeByExtension = [
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'rtf' => 'application/rtf',
    ];
    $attachmentMime = $mimeByExtension[$extension] ?? 'application/octet-stream';

    $safeBase = preg_replace('/[^a-zA-Z0-9._-]+/', '-', pathinfo($originalName, PATHINFO_FILENAME)) ?: 'resume';
    $safeBase = trim($safeBase, '-') ?: 'resume';
    $storedName = date('Ymd-His') . '-' . $safeBase . '.' . $extension;
    $dest = $careersDir . '/' . $storedName;
    if (!@move_uploaded_file($tmpPath, $dest) && !@copy($tmpPath, $dest)) {
        caaft_form_abort('Resume upload failed. Please try again.');
    }
    @chmod($dest, 0644);
    $storedResumeName = $storedName;

    $attachments[] = [
        'path' => $dest,
        'name' => $originalName,
        'type' => $attachmentMime,
    ];
}

$applicationId = date('Ymd-His') . '-' . substr(bin2hex(random_bytes(4)), 0, 8);
$applicationMeta = [
    'id' => $applicationId,
    'submitted_at' => date('c'),
    'job_slug' => $jobSlug,
    'job_title' => (string) $job['title'],
    'department' => (string) $job['department'],
    'first_name' => html_entity_decode(strip_tags($firstName), ENT_QUOTES, 'UTF-8'),
    'last_name' => html_entity_decode(strip_tags($lastName), ENT_QUOTES, 'UTF-8'),
    'email' => $email,
    'phone' => $phone,
    'resume' => $storedResumeName !== '' ? $storedResumeName : null,
    'page_url' => caaft_form_source_url(),
];
@file_put_contents(
    $careersDir . '/' . $applicationId . '.json',
    json_encode($applicationMeta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n"
);

$to = caaft_careers_recipient_email();
$subject = 'Career Application - ' . $job['title'] . ' - ' . $fullName;
$body = '
<h2>New Career Application</h2>
<p><strong>Position:</strong> ' . $jobTitle . '</p>
<p><strong>Department:</strong> ' . htmlspecialchars((string) $job['department'], ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>First Name:</strong> ' . $firstName . '</p>
<p><strong>Last Name:</strong> ' . $lastName . '</p>
<p><strong>Email:</strong> ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '</p>
<p><strong>Mobile:</strong> ' . $phone . '</p>';
if ($storedResumeName !== '') {
    $body .= '<p><strong>Resume:</strong> attached (' . htmlspecialchars($storedResumeName, ENT_QUOTES, 'UTF-8') . ')</p>';
} else {
    $body .= '<p><strong>Resume:</strong> not attached</p>';
}
$body .= '<p><strong>Application ID:</strong> ' . htmlspecialchars($applicationId, ENT_QUOTES, 'UTF-8') . '</p>';
$body .= caaft_form_source_url_html();

$successMessage = 'Thank you for your interest in joining our team! Our HR team will review your application and contact you if your profile matches our requirement.';

$mailOk = caaft_try_send_mail($to, $subject, $body, $fullName, $email, $attachments);
if ($mailOk) {
    caaft_form_redirect_thankyou($successMessage, true);
}

// Application is already saved under storage/careers/. When ZeptoMail credits are exhausted,
// still thank the applicant so the form is not blocked.
if (function_exists('caaft_mail_log')) {
    caaft_mail_log(
        'Careers application saved without email notify for ' . $email
        . ' job=' . $jobSlug
        . ' id=' . $applicationId
        . ' to=' . $to
        . ' (check ZeptoMail credits if API returned Credit exhausted)'
    );
}

caaft_form_redirect_thankyou($successMessage, true);
