<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$btnBgColor = $attributes['btnBgColor'] ?? '#000000';
$btnTextColor = $attributes['btnTextColor'] ?? 'red';
$blockProps = get_block_wrapper_attributes();
?>
<div <?php echo $blockProps; ?>>

    <form id="custom-contact-form" class="larris-contact-form__form">
        <ul class="larris-contact-form__list">
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Your Name</label>
                <input class="larris-contact-form__input" type="text" name="ccf_name" value="Ardian Pradana" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Your Email</label>
                <input class="larris-contact-form__input" type="email" name="ccf_email" value="lanangmenoreh@gmail.com" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Subject</label>
                <input class="larris-contact-form__input" type="text" name="ccf_subject" value="Your Subject Here" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Message</label>
                <textarea class="larris-contact-form__textarea" name="ccf_message" required>Test Contact Form</textarea>
            </li>
        </ul>
        <div class="button-form-container">
            <button class="larris-contact-form__button" style="backgroun-color: <?php echo $btnBgColor ?>; color: <?php $btnTextColor ?>"  type="submit">Send</button>
        </div>
    </form>

    <div id="ccf-response" class="larris-contact-form__response"></div>
</div>

<script>
document.getElementById("custom-contact-form").addEventListener("submit", function(e) {
    e.preventDefault();
    
    var formData = new FormData(this);
    formData.append("action", "custom_contact_form_handler");

    fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById("ccf-response").innerHTML = data;
        if (data.includes("✅")) {
            document.getElementById("custom-contact-form").reset();
        }
    });
});
</script>
