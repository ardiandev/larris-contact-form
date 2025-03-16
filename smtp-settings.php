<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// SMTP Configuration
function custom_smtp_setup($phpmailer) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = get_option('smtp_host'); // Change to your SMTP provider
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Username   = get_option('smtp_email'); // Change to your email
    $phpmailer->Password   = get_option('smtp_password'); // Use App Password if using Gmail
    $phpmailer->SMTPSecure = 'tls'; // or 'ssl' if required
    $phpmailer->Port       = get_option('smtp_port'); // Change if needed (Gmail: 587, Mailgun: 465, etc.)
    $phpmailer->From       = get_option('smtp_recipient_email');
    $phpmailer->FromName   = get_option('smtp_email_subject');
}
