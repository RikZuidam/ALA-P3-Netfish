<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$to_email = "rhj.zuidam@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by PHP Script";
$headers = "From: rhj.zuidam@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}