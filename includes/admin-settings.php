<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Add menu page
function larris_contact_form_add_admin_menu() {
    add_options_page(
        'Larris Contact Form Settings', 
        'Contact Form', 
        'manage_options', 
        'larris-contact-form-settings', 
        'larris_contact_form_settings_page'
    );
}
add_action('admin_menu', 'larris_contact_form_add_admin_menu');

// Render the settings page
function larris_contact_form_settings_page() {
    ?>
    <div class="wrap">
        <h1>Larris Contact Form Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('larris_contact_form_options');
            do_settings_sections('larris-contact-form-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function larris_contact_form_register_settings() {
    register_setting('larris_contact_form_options', 'larris_contact_form_email');

    add_settings_section(
        'larris_contact_form_section',
        'Email Settings',
        null,
        'larris-contact-form-settings'
    );

    add_settings_field(
        'larris_contact_form_email',
        'Recipient Email',
        'larris_contact_form_email_field_callback',
        'larris-contact-form-settings',
        'larris_contact_form_section'
    );
}
add_action('admin_init', 'larris_contact_form_register_settings');

// Callback function to render input field
function larris_contact_form_email_field_callback() {
    $email = get_option('larris_contact_form_email', 'admin@your-blog.com');
    echo '<input type="email" name="larris_contact_form_email" value="' . esc_attr($email) . '" class="regular-text">';
}
