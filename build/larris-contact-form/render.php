<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<form id="custom-contact-form">
    <label>Your Name</label>
    <input type="text" name="ccf_name" value="Ardian Pradana" required>

    <label>Your Email</label>
    <input type="email" name="ccf_email" value="lanangmenoreh@gmail.com" required>

    <label>Subject</label>
    <input type="text" name="ccf_subject" value="Your Subject Here" required>

    <label>Message</label>
    <textarea name="ccf_message" required>Test Contact Form</textarea>

    <button type="submit">Send</button>
</form>

<div id="ccf-response"></div>

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
