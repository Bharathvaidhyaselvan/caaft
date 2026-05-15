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
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
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

    // 5. Email setup
    $to = caaft_form_recipient_email();
    $subject = "GST Return Filing Inquiry from " . $name;

    // 6. Email headers
    $headers  = "From: {$name} <{$email}>\r\n";
    $headers .= "Reply-To: {$email}\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // 7. Email body
    $body = "
    <h2>GST Return Filing Inquiry</h2>
    <p><strong>Name:</strong> {$name}</p>
    <p><strong>Email:</strong> {$email}</p>
    <p><strong>Phone:</strong> {$phone}</p>
    <p><strong>Service:</strong> {$service}</p>
    <p><strong>Message:</strong><br>" . nl2br($message) . "</p>
    <hr>
    <p><small>Submitted via website form.</small></p>
    ";

    // 8. Send mail
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>
                alert('Thanks for reaching us. Our team will contact you shortly.');
                window.location.href='thankyou.php';
              </script>";
        exit;
    } else {
        echo "Something went wrong. Please try again.";
    }

} else {
    echo "Invalid request.";
}
