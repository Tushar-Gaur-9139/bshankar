<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function isEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Sanitize and validate input
    $name     = trim($_POST['name']); 
    $email    = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone    = trim($_POST['phone']);
    $comments = htmlspecialchars(trim($_POST['comments']), ENT_QUOTES, 'UTF-8');

    // Input validation
    if (empty($name)) {
        echo '<div class="alert alert-error">Please enter your name.</div>';
        exit();
    }
    if (empty($email) || !isEmail($email)) {
        echo '<div class="alert alert-error">Please enter a valid email address.</div>';
        exit();
    }
    if (empty($phone)) {
        echo '<div class="alert alert-error">Please enter your phone number.</div>';
        exit();
    }
    if (empty($comments)) {
        echo '<div class="alert alert-error">Please describe what you need.</div>';
        exit();
    }

    // Configuration
    $recipient = "427rahulmeena@gmail.com"; // Change this to your email address
    $subject = "Free Consultation Request from $name";

    // Email content
    $email_body = "You have been contacted by $name.\n\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Phone: $phone\n\n";
    $email_body .= "Message:\n$comments\n";

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Send the email
    if (mail($recipient, $subject, $email_body, $headers)) {
        echo '<div class="alert alert-success">Thank you! Your request has been submitted successfully.</div>';
    } else {
        echo '<div class="alert alert-error">Oops! Something went wrong. Please try again later.</div>';
    }
} else {
    echo '<div class="alert alert-error">Invalid request. Please submit the form properly.</div>';
}
?>