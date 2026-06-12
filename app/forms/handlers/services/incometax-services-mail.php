<?php
require_once APP_ROOT . '/forms/validation/common.php';
require_post_request();
if (has_honeypot_value(['firstname','website'])) { exit('Spam detected.'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Honeypot spam control
    if (!empty($_POST['firstname']) || !empty($_POST['website'])) {
        exit("Spam detected.");
    }

    // 2. reCAPTCHA verification
    $secret = '6LcO3ukrAAAAAKpBylqkN7yp3JbXhmrwW8fKBJ13'; // Replace with your secret key
    $responseKey = $_POST['g-recaptcha-response'] ?? '';

    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$responseKey}");
    $captcha = json_decode($verify);

    if (empty($captcha) || !$captcha->success) {
        exit("Please verify that you are not a robot.");
    }

    // 3. Collect and sanitize inputs
    $name     = htmlspecialchars(trim($_POST['name']));
    $email    = caaft_sanitize_mail_address((string) ($_POST['email'] ?? ''));
    $phone    = htmlspecialchars(trim($_POST['phone']));
    $service  = htmlspecialchars(trim($_POST['service']));
    $message  = htmlspecialchars(trim($_POST['message']));

    // 4. Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($message)) {
        exit("Please fill all required fields.");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit("Invalid email format.");
    }

    $to = caaft_form_recipient_email();
    $category = caaft_form_enquiry_category('Taxation');
    $subject = caaft_form_enquiry_subject($category, $name);
    $body = "
    " . caaft_form_enquiry_heading_html($category) . "
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "</p>
    <p><strong>Phone:</strong> {$phone}</p>
    <p><strong>Service:</strong> {$service}</p>
    <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
    <hr>
    <p><small>Submitted via website form.</small></p>
    ";
    $body .= caaft_form_source_url_html();

    caaft_form_complete_submission(
        caaft_form_build_lead_data('enquiry', $category),
        $to,
        $subject,
        $body,
        $name,
        $email,
        'Thanks for reaching us. Our team will contact you shortly.',
    );

} else {
    echo "Invalid request.";
}
