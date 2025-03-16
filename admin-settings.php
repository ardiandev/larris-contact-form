<?php
if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// Register settings
function cf_smtp_register_settings() {
    // SMTP Settings
    register_setting('cf_smtp_settings_group', 'smtp_host');
    register_setting('cf_smtp_settings_group', 'smtp_port');
    register_setting('cf_smtp_settings_group', 'smtp_username');
    register_setting('cf_smtp_settings_group', 'smtp_password');
    register_setting('cf_smtp_settings_group', 'smtp_encryption');
    register_setting('cf_smtp_settings_group', 'smtp_recipient_email');

    // reCAPTCHA Settings
    register_setting('cf_smtp_settings_group', 'recaptcha_site_key');
    register_setting('cf_smtp_settings_group', 'recaptcha_secret_key');

    // Add sections
    add_settings_section('cf_smtp_main_section', 'SMTP Configuration', null, 'cf-smtp-settings');
    add_settings_section('cf_recaptcha_section', 'Google reCAPTCHA', null, 'cf-smtp-settings');

    // Add fields for SMTP
    add_settings_field('smtp_host', 'SMTP Host', 'cf_smtp_field_smtp_host', 'cf-smtp-settings', 'cf_smtp_main_section');
    add_settings_field('smtp_port', 'SMTP Port', 'cf_smtp_field_smtp_port', 'cf-smtp-settings', 'cf_smtp_main_section');
    add_settings_field('smtp_username', 'SMTP Username', 'cf_smtp_field_smtp_username', 'cf-smtp-settings', 'cf_smtp_main_section');
    add_settings_field('smtp_password', 'SMTP Password', 'cf_smtp_field_smtp_password', 'cf-smtp-settings', 'cf_smtp_main_section');
    add_settings_field('smtp_encryption', 'Encryption (SSL/TLS)', 'cf_smtp_field_smtp_encryption', 'cf-smtp-settings', 'cf_smtp_main_section');
    add_settings_field('smtp_recipient_email', 'Recipient Email', 'cf_smtp_field_smtp_recipient_email', 'cf-smtp-settings', 'cf_smtp_main_section');

    // Add fields for reCAPTCHA
    add_settings_field('recaptcha_site_key', 'reCAPTCHA Site Key', 'cf_recaptcha_field_site_key', 'cf-smtp-settings', 'cf_recaptcha_section');
    add_settings_field('recaptcha_secret_key', 'reCAPTCHA Secret Key', 'cf_recaptcha_field_secret_key', 'cf-smtp-settings', 'cf_recaptcha_section');
}

add_action('admin_init', 'cf_smtp_register_settings');

// Callback functions for SMTP fields
function cf_smtp_field_smtp_host() {
    $value = get_option('smtp_host', '');
    echo "<input type='text' name='smtp_host' value='" . esc_attr($value) . "' class='regular-text'>";
}

function cf_smtp_field_smtp_port() {
    $value = get_option('smtp_port', '');
    echo "<input type='number' name='smtp_port' value='" . esc_attr($value) . "' class='small-text'>";
}

function cf_smtp_field_smtp_username() {
    $value = get_option('smtp_username', '');
    echo "<input type='text' name='smtp_username' value='" . esc_attr($value) . "' class='regular-text'>";
}

function cf_smtp_field_smtp_password() {
    $value = get_option('smtp_password', '');
    echo "<input type='password' name='smtp_password' value='" . esc_attr($value) . "' class='regular-text'>";
}

function cf_smtp_field_smtp_encryption() {
    $value = get_option('smtp_encryption', 'tls'); // Default to 'tls' if not set
    ?>
    <select name="smtp_encryption">
        <option value="none" <?php selected($value, 'none'); ?>>None</option>
        <option value="ssl" <?php selected($value, 'ssl'); ?>>SSL</option>
        <option value="tls" <?php selected($value, 'tls'); ?>>TLS</option>
    </select>
    <?php
}


function cf_smtp_field_smtp_recipient_email() {
    $value = get_option('smtp_recipient_email', '');
    echo "<input type='email' name='smtp_recipient_email' value='" . esc_attr($value) . "' class='regular-text'>";
}

// Callback functions for reCAPTCHA fields
function cf_recaptcha_field_site_key() {
    $value = get_option('recaptcha_site_key', '');
    echo "<input type='text' name='recaptcha_site_key' value='" . esc_attr($value) . "' class='regular-text'>";
}

function cf_recaptcha_field_secret_key() {
    $value = get_option('recaptcha_secret_key', '');
    echo "<input type='text' name='recaptcha_secret_key' value='" . esc_attr($value) . "' class='regular-text'>";
}

