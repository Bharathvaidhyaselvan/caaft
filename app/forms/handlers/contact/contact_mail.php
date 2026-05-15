<?php
require_once APP_ROOT . '/forms/validation/common.php';
require_post_request();
if (has_honeypot_value(['firstname','website'])) { exit('Spam detected.'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Honeypot Spam Check
    if (!empty($_POST['firstname'])) {
        exit("Spam detected.");
    }

    // Google reCAPTCHA secret key
    $secret = '6LcO3ukrAAAAAKpBylqkN7yp3JbXhmrwW8fKBJ13'; // Replace with your Google secret key
    $recaptcha_response = $_POST['g-recaptcha-response'] ?? '';

    // Verify reCAPTCHA
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha_response}");
    $captcha_success = json_decode($verify);

    if ($captcha_success->success == false) {
        exit("Please verify that you are not a robot.");
    }

    // 🧾 Collect form data safely
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $phone   = htmlspecialchars(trim($_POST['phone']));
    $about   = htmlspecialchars(trim($_POST['about']));
    $about_other = isset($_POST['about_other']) ? htmlspecialchars(trim($_POST['about_other'])) : '';
    $msg     = htmlspecialchars(trim($_POST['msg']));
    $title   = htmlspecialchars(trim($_POST['title']));

    // 🧩 Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($about) || empty($msg)) {
        exit("All fields are required.");
    }

    // Email setup
    $to = caaft_form_recipient_email();
    $subject = "New Contact Form Submission - $title";

    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email body (HTML format)
    $body = "
    <h2>New Contact Form Submission</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>Phone:</strong> {$phone}</p>
    <p><strong>Heard About Us:</strong> {$about}</p>";

    if (!empty($about_other)) {
        $body .= "<p><strong>Other Source:</strong> {$about_other}</p>";
    }

    $body .= "<p><strong>Message:</strong><br>" . nl2br($msg) . "</p>";

    // Send the mail
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Thanks for reaching us you will get notified by our advisory team shortly'); window.location.href='thankyou.php' </script>";
    } else {
        echo "Something went wrong. Please try again later.";
    }

} else {
    echo "Invalid request.";
}
