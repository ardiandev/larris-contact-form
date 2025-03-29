<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$btnBgColor = $attributes['btnBgColor'] ?? '#000000';
$btnTextColor = $attributes['btnTextColor'] ?? 'red';
$blockProps = get_block_wrapper_attributes();

$recaptcha_site_key = get_option('larris_recaptcha_site_key', '');
?>
<div <?php echo $blockProps; ?>>

    <form id="custom-contact-form" class="larris-contact-form__form" method="POST" action="">
        <ul class="larris-contact-form__list">
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Your Name</label>
                <input class="larris-contact-form__input" type="text" value="ardian" name="ccf_name" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Your Email</label>
                <input class="larris-contact-form__input" type="email" value="lanangmenoreh@gmail.com" name="ccf_email" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Subject</label>
                <input class="larris-contact-form__input" type="text" value="job offer" name="ccf_subject" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Message</label>
                <textarea class="larris-contact-form__textarea" name="ccf_message" required>Test Message</textarea>
            </li>
        </ul>
        <?php if (!empty($recaptcha_site_key)) : ?>
            <div class="g-recaptcha" data-sitekey="<?php echo esc_attr($recaptcha_site_key); ?>"></div>
        <?php endif; ?>
        <button type="submit" class="larris-contact-form-button" style="background-color: <?php echo esc_attr($btnBgColor); ?>; color: <?php echo esc_attr($btnTextColor); ?>;">
            Submit
        </button>
    </form>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
        if (!grecaptcha.getResponse()) {
            alert("⚠️ Please complete the reCAPTCHA before submitting.");
            e.preventDefault();
            return;
        }

        // Prepare form data
        var formData = new FormData(form);
        formData.append("g-recaptcha-response", grecaptcha.getResponse());
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
                grecaptcha.reset();
            }
        })
        .catch((error) => console.error("❌ Fetch error:", error));

        e.preventDefault(); // Prevent default form submission
    });
});
</script>
