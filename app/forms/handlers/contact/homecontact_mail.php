<?php
require_once APP_ROOT . '/forms/validation/common.php';
require_post_request();
if (has_honeypot_value(['firstname','website'])) { exit('Spam detected.'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['firstname']) || !empty($_POST['website'])) {
        exit("Spam detected. Submission blocked.");
    }

    $secret = '6LcO3ukrAAAAAKpBylqkN7yp3JbXhmrwW8fKBJ13';
    $recaptcha_response = $_POST['g-recaptcha-response'];

    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha_response}");
    $response_data = json_decode($verify_response);

    if (!$response_data->success) {
        exit("reCAPTCHA verification failed. Please try again.");
    }

    $name    = htmlspecialchars(trim($_POST['name']));
    $company = htmlspecialchars(trim((string) ($_POST['company'] ?? '')));
    $email   = caaft_sanitize_mail_address((string) ($_POST['email'] ?? ''));
    $phone   = htmlspecialchars(trim($_POST['phone']));
    $service = htmlspecialchars(trim($_POST['service']));
    $msg     = htmlspecialchars(trim($_POST['msg']));
    $title   = htmlspecialchars(trim($_POST['title']));

    if (empty($name) || empty($email) || empty($phone) || empty($service)) {
        exit("Please fill all required fields.");
    }

    $to = caaft_form_recipient_email();
    $subject = "Contact Form Submission: $title";
    $body = "<h2>Contact Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>";
    if ($company !== '') {
        $body .= '<p><strong>Company:</strong> ' . $company . '</p>';
    }
    $body .= "<p><strong>Email:</strong> " . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . "</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Service:</strong> {$service}</p>";
    if ($msg !== '') {
        $body .= '<p><strong>Message:</strong><br>' . nl2br($msg) . '</p>';
    }
    $body .= caaft_form_source_url_html();

    caaft_form_complete_submission(
        caaft_form_build_lead_data('home_contact', ''),
        $to,
        $subject,
        $body,
        $name,
        $email,
    );

} else {
    echo "Invalid request method.";
}
