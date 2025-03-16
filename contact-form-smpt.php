<?php
/**
 * Plugin Name: Contact Form SMTP
 * Plugin URI:  https://ardianpradana.com
 * Description: A simple contact form using a shortcode with SMTP support.
 * Version:     1.2
 * Author:      Your Name
 * Author URI:  https://ardianpradana.com
 * License:     GPL2
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

function custom_contact_form_enqueue_styles() {
    wp_enqueue_style('custom-contact-form-style', plugin_dir_url(__FILE__) . 'style.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'custom_contact_form_enqueue_styles');

function enqueue_recaptcha_script() {
    wp_enqueue_script('google-recaptcha', 'https://www.google.com/recaptcha/api.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_recaptcha_script');



// Include SMTP settings
// Include SMTP settings and admin panel
require_once plugin_dir_path(__FILE__) . 'smtp-settings.php';
require_once plugin_dir_path(__FILE__) . 'admin-panel.php';


// Shortcode function
function custom_contact_form() {
    $site_key = get_option('recaptcha_site_key'); // Replace with your reCAPTCHA Site Key
    $message = '';
    if (isset($_GET['cf_status'])) {
        if ($_GET['cf_status'] == 'success') {
            $message = '<p style="color: green;">Your message has been sent successfully.</p>';
        } elseif ($_GET['cf_status'] == 'error') {
            $message = '<p style="color: red;">Failed to send your message. Please try again.</p>';
        }
    }
    
    ob_start(); ?>
    <form id="custom-contact-form" method="post">
        <?php echo $message; ?>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

        </div>
        <div>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
      
         <!-- Google reCAPTCHA -->
         <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
         <div>
             <button type="submit" name="cf_submit">Send</button>
        </div>
        
    </form>
    <?php 
    return ob_get_clean();
}

// Register shortcode
add_shortcode('contact_form', 'custom_contact_form');

// Form handling with SMTP
function handle_custom_contact_form() {
    if (isset($_POST['cf_submit'])) {
        $secret_key = get_option('recaptcha_secret_key'); // Replace with your reCAPTCHA Secret Key
        $captcha_response = sanitize_text_field($_POST['g-recaptcha-response']);

        // Verify reCAPTCHA
        $response = wp_remote_get("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha_response");
        $response_keys = json_decode(wp_remote_retrieve_body($response), true);

        // ❗ Fix: Check if reCAPTCHA verification is successful **inside** the if block
        if (!$response_keys["success"]) {
            wp_die('reCAPTCHA verification failed. Please try again.');
        }

        // Process form if reCAPTCHA is valid
        $name    = sanitize_text_field($_POST['name']);
        $subject = sanitize_text_field($_POST['subject']);
        $email   = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);

        $to = get_option('smtp_recipient_email', 'default-email@example.com'); 
        $email_subject = "New Contact Form Submission: " . $subject;

        $email_body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; }
                .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9; }
                h2 { color: #333; }
                p { margin: 5px 0; }
                .footer { margin-top: 20px; font-size: 12px; color: #777; }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Subject:</strong> $subject</p>
                <p><strong>Message:</strong></p>
                <p style='border-left: 4px solid #007bff; padding-left: 10px; color: #555;'>$message</p>
                <div class='footer'>This message was sent from your website contact form.</div>
            </div>
        </body>
        </html>";

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            "From: $name <$email>",
            "Reply-To: $email"
        );

        add_action('phpmailer_init', 'custom_smtp_setup');

        if (wp_mail($to, $email_subject, $email_body, $headers)) {
            wp_redirect(add_query_arg('cf_status', 'success', wp_get_referer()));
        } else {
            wp_redirect(add_query_arg('cf_status', 'error', wp_get_referer()));
        }
        exit;
    }
}

add_action('init', 'handle_custom_contact_form');



