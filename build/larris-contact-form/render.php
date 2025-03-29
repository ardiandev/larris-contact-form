<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$btnBgColor = $attributes['btnBgColor'] ?? '#000000';
$btnTextColor = $attributes['btnTextColor'] ?? 'red';
$blockProps = get_block_wrapper_attributes();
?>
<div <?php echo $blockProps; ?>>

    <form id="custom-contact-form" class="larris-contact-form__form" method="POST" action="">
        <ul class="larris-contact-form__list">
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Your Name</label>
                <input class="larris-contact-form__input" type="text" name="ccf_name" value="John Doe" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Your Email</label>
                <input class="larris-contact-form__input" type="email" name="ccf_email" value="johndoe@example.com" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Subject</label>
                <input class="larris-contact-form__input" type="text" name="ccf_subject" value="Test Subject" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Message</label>
                <textarea class="larris-contact-form__textarea" name="ccf_message" required>Test message content</textarea>
            </li>
        </ul>
        <button type="submit" class="larris-contact-form-button" style="background-color: <?php echo esc_attr($btnBgColor); ?>; color: <?php echo esc_attr($btnTextColor); ?>;">
            Submit
        </button>
    </form>

    <!-- Add this div to display the response -->
    <div id="ccf-response" class="larris-contact-form-response"></div>
</div>

<script>
var ajaxurl = "<?php echo esc_url(admin_url('admin-ajax.php')); ?>";

document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("custom-contact-form");

    if (!form) {
        console.error("❌ Form element not found!");
        return;
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        // Prepare form data
        var formData = new FormData(form);
        formData.append("action", "custom_contact_form_handler");

        // Send the AJAX request
        fetch(ajaxurl, {
            method: "POST",
            body: formData,
        })
        .then((response) => response.text())
        .then((data) => {
            var responseElement = document.getElementById("ccf-response");
            if (responseElement) {
                responseElement.innerHTML = data;
            }
            if (data.includes("✅")) {
                form.reset();
            }
        })
        .catch((error) => console.error("❌ Fetch error:", error));
    });
});
</script>