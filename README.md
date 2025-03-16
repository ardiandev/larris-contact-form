# Larris Contact Form

A simple contact form plugin for WordPress that uses a shortcode and supports SMTP for email delivery.

## Features

- Lightweight and easy to use
- Uses a shortcode `[contact_form]` for easy embedding
- Supports SMTP for reliable email delivery
- Customizable form styling via CSS

## Installation

### Automatic Installation

1. Download the plugin ZIP file.
2. In your WordPress dashboard, go to **Plugins > Add New**.
3. Click **Upload Plugin** and select the ZIP file.
4. Click **Install Now**, then activate the plugin.

### Manual Installation

1. Upload the plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.

## Usage

1. Add the shortcode `[contact_form]` to any post or page.
2. Configure SMTP settings using a plugin like **WP Mail SMTP** (if needed).
3. Customize the form via CSS using the `#custom-contact-form` selector.

## Shortcode Options

| Attribute | Description                       | Default                       |
| --------- | --------------------------------- | ----------------------------- |
| `to`      | Email address to receive messages | WordPress admin email         |
| `subject` | Subject of the email              | `New Contact Form Submission` |

Example usage:

```html
[contact_form to="example@example.com" subject="Contact Request"]
```

## Custom Styling

Modify the form appearance by adding CSS styles:

```css
#custom-contact-form {
  background: #f7f7f7;
  padding: 20px;
  border-radius: 5px;
}
```

## Changelog

### Version 1.2

- Improved SMTP support
- Enhanced security for form submissions
- Minor bug fixes

## License

This plugin is licensed under the **GPL2** license. See [GPL2 License](https://www.gnu.org/licenses/gpl-2.0.html) for more details.

## Author

Developed by [Your Name](https://ardianpradana.com).

## Support

For issues or feature requests, please visit [ardianpradana.com](https://ardianpradana.com).
