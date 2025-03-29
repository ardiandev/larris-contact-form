<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php
 
/**
 * Custom Contact Form Block Render
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

function render_larris_contact_form($attributes) {
    $emailRecipent = isset($attributes['emailRecipent']) ? esc_attr($attributes['emailRecipent']) : get_option('admin_email');

    ob_start();
    ?>
    <form id="custom-contact-form">
        <input type="hidden" name="ccf_emailRecipent" value="<?php echo esc_attr($emailRecipent); ?>">
        <input type="text" name="ccf_name" placeholder="Your Name" required>
        <input type="email" name="ccf_email" placeholder="Your Email" required>
        <input type="text" name="ccf_subject" placeholder="Subject" required>
        <textarea name="ccf_message" placeholder="Your Message" required></textarea>
        <button type="submit">Send</button>
    </form>

    <script>
        document.getElementById("custom-contact-form").addEventListener("submit", function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("action", "custom_contact_form_handler");

            fetch("<?php echo esc_url(admin_url('admin-ajax.php')); ?>", {
                method: "POST",
                body: formData
            }).then(response => response.text()).then(result => alert(result));
        });
    </script>
    <?php
    return ob_get_clean();
}

echo render_larris_contact_form($attributes);

// ✅ Define AJAX handler inside `render.php` (but ensure it is not redeclared)
if (!function_exists('custom_contact_form_handler')) {
    function custom_contact_form_handler() {
        if ($_POST['action'] === 'custom_contact_form_handler') {
            $name = sanitize_text_field($_POST['ccf_name']);
            $email = sanitize_email($_POST['ccf_email']);
            $subject = sanitize_text_field($_POST['ccf_subject']);
            $message = sanitize_textarea_field($_POST['ccf_message']);

            // Get email recipient from form input
            $to = isset($_POST['ccf_emailRecipent']) ? sanitize_email($_POST['ccf_emailRecipent']) : get_option('admin_email');

            $headers = "From: $name <$email>\r\nReply-To: $email\r\nContent-Type: text/plain; charset=UTF-8";
            $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";

            if (wp_mail($to, $subject, $body, $headers)) {
                echo "✅ Message sent successfully!";
            } else {
                echo "❌ Failed to send message.";
            }
        }
        wp_die();
    }

    add_action('wp_ajax_nopriv_custom_contact_form_handler', 'custom_contact_form_handler');
    add_action('wp_ajax_custom_contact_form_handler', 'custom_contact_form_handler');
}
?>
