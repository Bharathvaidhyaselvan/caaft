<?php
require_once APP_ROOT . '/forms/validation/common.php';
require_post_request();
if (has_honeypot_value(['firstname','website'])) { exit('Spam detected.'); }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Spam control: Honeypot check
    if (!empty($_POST['firstname']) || !empty($_POST['website'])) {
        // Bot detected
        exit("Spam detected. Submission blocked.");
    }

    // Google reCAPTCHA secret key
    $secret = '6LcO3ukrAAAAAKpBylqkN7yp3JbXhmrwW8fKBJ13'; // Replace with your secret key
    $recaptcha_response = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $verify_response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha_response}");
    $response_data = json_decode($verify_response);

    if (!$response_data->success) {
        exit("reCAPTCHA verification failed. Please try again.");
    }

    // Collect form data safely
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $phone   = htmlspecialchars(trim($_POST['phone']));
    $service = htmlspecialchars(trim($_POST['service']));
    $msg     = htmlspecialchars(trim($_POST['msg']));
    $title   = htmlspecialchars(trim($_POST['title']));

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($msg)) {
        exit("Please fill all required fields.");
    }

    // Email setup
    $to = caaft_form_recipient_email();
    $subject = "Contact Form Submission: $title";

    // Email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email body
    $body = "<h2>Contact Form Submission</h2>
            <p><strong>Name:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Service:</strong> {$service}</p>
            <p><strong>Message:</strong><br>".nl2br($msg)."</p>";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Thanks for reaching us you will get notified by our advisory team shortly'); window.location.href='thankyou.php' </script>";
    } else {
        echo "Oops! Something went wrong. Please try again.";
    }

} else {
    // Prevent direct access
    echo "Invalid request method.";
}
?>