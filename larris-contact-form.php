<?php
/**
 * Plugin Name:       Larris Contact Form
 * Description:       Example block scaffolded with Create Block tool.
 * Version:           0.1.0
 * Requires at least: 6.7
 * Requires PHP:      7.4
 * Author:            Ardian Pradana
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       larris-contact-form
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if (is_admin()) {
    // Include the admin settings file only in the admin area
    require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
}

function create_block_larris_contact_form_block_init() {
	if ( function_exists( 'wp_register_block_types_from_metadata_collection' ) ) { // Function introduced in WordPress 6.8.
		wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
	} else {
		if ( function_exists( 'wp_register_block_metadata_collection' ) ) { // Function introduced in WordPress 6.7.
			wp_register_block_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
		}
		$manifest_data = require __DIR__ . '/build/blocks-manifest.php';
		foreach ( array_keys( $manifest_data ) as $block_type ) {
			register_block_type( __DIR__ . "/build/{$block_type}" );
		}
	}
}
add_action( 'init', 'create_block_larris_contact_form_block_init' );

// ✅ Place AJAX Handler Here (Not in render.php)
function custom_contact_form_handler() {

    $emailRecipient = get_option('larris_contact_form_email', get_option('admin_email'));


    if (isset($_POST['action']) && $_POST['action'] === 'custom_contact_form_handler') { 
        $name = sanitize_text_field($_POST['ccf_name']);
        $email = sanitize_email($_POST['ccf_email']);
        $subject = sanitize_text_field($_POST['ccf_subject']);
        $message = sanitize_textarea_field($_POST['ccf_message']);

        $to = $emailRecipient;
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


