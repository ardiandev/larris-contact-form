=== Larris Contact Form ===
Contributors:      The WordPress Contributors  
Tags:              block, contact form, captcha, email, ajax  
Tested up to:      6.7  
Stable tag:        0.1.0  
Requires at least: 6.7  
Requires PHP:      7.4  
License:           GPL-2.0-or-later  
License URI:       https://www.gnu.org/licenses/gpl-2.0.html  
Author URI:        https://ardianpradana.com  
Author:            Ardian Pradana  

A simple and secure contact form block built with modern WordPress tools, complete with spam protection and AJAX support.

== Description ==

**Larris Contact Form** is a custom Gutenberg block plugin that lets users add a contact form to any page or post using the Block Editor.  
Features include:

- AJAX-based form submission (no page reload)
- Spam protection with a honeypot field
- Basic math CAPTCHA challenge
- Admin-configurable recipient email address
- Clean, semantic markup and secure field validation

The plugin is scaffolded with the Create Block tool and supports WordPress 6.7+.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/larris-contact-form` directory, or install the plugin via the WordPress Plugin Installer.
2. Activate the plugin through the ‘Plugins’ screen in WordPress.
3. Go to **Settings > Larris Contact Form** to set the email address where you want to receive messages.
4. Insert the "Larris Contact Form" block into any post or page via the block editor.

== Frequently Asked Questions ==

= Does it support AJAX submissions? =

Yes, all messages are sent asynchronously without reloading the page.

= How does it protect against spam? =

It uses a hidden honeypot field and a simple math CAPTCHA to prevent spam bot submissions.

= Can I customize the email recipient? =

Yes, you can set the desired recipient email address from the plugin settings page under **Settings > Larris Contact Form**.

= Will it work with older versions of WordPress? =

The plugin requires WordPress 6.7 or higher due to its use of block metadata and recent APIs.

== Screenshots ==

1. Larris Contact Form block in the editor.
2. Larris Contact Form displayed on the front end.
3. Email settings page in the WordPress admin panel.

== Changelog ==

= 0.1.0 =
* Initial release with:
    - Block editor integration
    - AJAX contact form
    - CAPTCHA and honeypot spam protection
    - Email settings panel

== Arbitrary Section ==

### Developer Notes

- Blocks are registered using `wp_register_block_types_from_metadata_collection` for WordPress 6.8+.
- Fallback registration provided for WordPress 6.7 compatibility.
- Includes secure validation and sanitization of all submitted form data.
- Email is sent using `wp_mail()` with proper headers.
