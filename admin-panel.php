<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// Add a new top-level menu in WordPress Admin
function cf_smtp_add_admin_menu() {
    add_menu_page(
        'Contact Form',       // Page Title
        'Contact Form',       // Menu Title
        'manage_options',      // Capability
        'cf-smtp-settings',    // Menu Slug
        'cf_smtp_settings_page', // Callback function
        'dashicons-email',     // Icon
        25                     // Position
    );
}
add_action('admin_menu', 'cf_smtp_add_admin_menu');

// Display the settings page
function cf_smtp_settings_page() {
    ?>
    <div class="wrap">
        <h1>SMTP & reCAPTCHA Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('cf_smtp_settings_group');
            do_settings_sections('cf-smtp-settings');
            submit_button();
            ?>
        </form>
        <p>Paste the shortcode <code>[contact_form]</code> in any page or post to display the contact form.</p>
    </div>
    <?php
}

// Include settings logic
require_once plugin_dir_path(__FILE__) . 'admin-settings.php';

