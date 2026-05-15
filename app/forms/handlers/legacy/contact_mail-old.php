<?php
require_once APP_ROOT . '/forms/validation/common.php';
require_post_request();
if (has_honeypot_value(['firstname','website'])) { exit('Spam detected.'); }
/*Here we are going to declare the variables*/
//include 'admin/dbc.php';
//error_reporting(0);
// print_r($_POST);
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$service = $_POST['service'];
$about = $_POST['about'];
$title = $_POST['title'];
$msg = $_POST['msg'];

$to = caaft_form_recipient_email();
$subject ="Contact mail from CAAFT Consultancy Services Private Limited";


$headers   = 'MIME-Version: 1.0' . "\r\n";
$headers  .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers   = "From: " . $email . "\r\n";
$headers  .= "Return-Path: " . $email . "\r\n";
$headers  .= "Reply-To: ". $email . "\r\n";
$headers  .= "MIME-Version: 1.0\r\n";
$headers  .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$body 	   = "<html><body>";
 
$body     .= "<table bgcolor='#fff' cellpadding='7' cellspacing='0' border='1' width='600px'>";
$body 	  .= "<tr><td>Name </td><td> <strong>".$name."</strong></td></tr>";
$body     .= "<tr><td>Email</td><td> <strong>".$email."</strong></td></tr>";
$body     .= "<tr><td>Phone No </td><td> <strong>".$phone."</strong></td></tr>";
$body     .= "<tr><td>Service</td><td> <strong>".$service."</strong></td></tr>";
$body     .= "<tr><td>About </td><td> <strong>".$about."</strong></td></tr>";
$body     .= "<tr><td>Title </td><td> <strong>".$title."</strong></td></tr>";
$body     .= "<tr><td>Message </td><td> <strong>".$msg."</strong></td></tr>";
$body   .= "</table>";
$body   .= "</body></html>";


 //echo $body; exit;
if (@mail($to, $subject, $body, $headers))
{
    
	{
echo "<script language=\"javascript\">
	alert(\"Thank you for contact us and you will be shortly contacted by our representatives\")
	window.location=\"index.php\"
	</script>";
	}
}
