<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$btnBgColor = $attributes['btnBgColor'] ?? '#000000';
$btnTextColor = $attributes['btnTextColor'] ?? 'red';
$blockProps = get_block_wrapper_attributes();

$num1 = rand(1, 10);
$num2 = rand(1, 10);
$answer = $num1 + $num2;
?>
<div <?php echo $blockProps; ?>>

    <form id="custom-contact-form" class="larris-contact-form__form" method="POST" action="">
        <ul class="larris-contact-form__list">
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Your Name</label>
                <input class="larris-contact-form__input" type="text" name="ccf_name" value="" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Your Email</label>
                <input class="larris-contact-form__input" type="email" name="ccf_email" value="" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Subject</label>
                <input class="larris-contact-form__input" type="text" name="ccf_subject" value="" required>
            </li>
            <li class="larris-contact-form__item">
                <label class="larris-contact-form__label">Message</label>
                <textarea class="larris-contact-form__textarea" name="ccf_message" required></textarea>
            </li>
            <li class="larris-contact-form__item">
                <!-- <label id="math-question" for="ccf_math">What is <?php echo $num1; ?> + <?php echo $num2; ?>?</label>
                <input id="user-answer" class="larris-contact-form__input" type="text" name="ccf_math" required>
                <input id="answer-key" type="hidden" class="ccf_math_answer" name="ccf_math_answer" value="<?php echo $answer; ?>">
                <p id="warning-input" style="color: red; display: none;">Incorrect answer. Please try again.</p> -->
                <div class="g-recaptcha" data-sitekey="6LdfrQcrAAAAAMyYI41OrQlWFEWpquUCM_a_w0Wj"></div>
            </li>
        </ul>
        <input type="hidden" name="ccf_nonce" value="<?php echo wp_create_nonce('ccf_form_nonce'); ?>">
        <input type="text" name="ccf_honeypot" value="" style="display:none;">
        <button type="submit" class="larris-contact-form-button" style="background-color: <?php echo esc_attr($btnBgColor); ?>; color: <?php echo esc_attr($btnTextColor); ?>;">
            Submit
        </button>
    </form>

    <div id="ccf-response" class="larris-contact-form-response"></div>
</div>

<script>
var ajaxurl = "<?php echo esc_url(admin_url('admin-ajax.php')); ?>";

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("custom-contact-form");
    // const warningEl = document.querySelector("#warning-input");
    const responseElement = document.getElementById("ccf-response");
    const submitButton = form.querySelector(".larris-contact-form-button");

    if (!form || !warningEl || !responseElement) {
        console.error("❌ Required elements not found!");
        return;
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        // if (!checkUserAnswer()) {
        //     console.log("❌ Incorrect answer. Showing warning.");
        //     warningEl.style.display = "block";
        //     return;
        // }

        // console.log("✅ Correct answer submitted");
        // warningEl.style.display = "none";

        submitButton.disabled = true; // Disable button during submission

        const formData = new FormData(form);
        const recaptchaResponse = grecaptcha.getResponse(); // Get reCAPTCHA response

        if (recaptchaResponse.length === 0) {
            responseElement.innerHTML = "❌ Please verify that you are not a robot.";
            submitButton.disabled = false; // Re-enable button
            return;
        }

        // Append reCAPTCHA response to the form data
        formData.append("g-recaptcha-response", recaptchaResponse);
        formData.append("action", "custom_contact_form_handler");


        fetch(ajaxurl, {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            if (!data.status === "success") {
                console.error("❌ Server error:", data);
                responseElement.innerHTML = "An error occurred. Please try again later.";
                return;
            }

            responseElement.innerHTML = data.message;

            // Reload the math question with new numbers
            reloadMathQuestion(data.new_question, data.new_answer);

            // Optionally reset the form fields if desired
            form.reset();

            submitButton.disabled = false; // Re-enable button

        })
        .catch((error) => {
            submitButton.disabled = false; // Re-enable button
            console.error("❌ Fetch error:", error);
            responseElement.innerHTML = "An error occurred. Please try again later.";
        });
    });
});

// const reloadMathQuestion = (question, answer) => {
//     console.log(question, answer);
//     const mathQuestionEl = document.querySelector("#math-question");
//     const answerKeyEl = document.querySelector("#answer-key");
//     const userAnswerEl = document.querySelector("#user-answer");
//     const warningEl = document.querySelector("#warning-input");
//     if (!mathQuestionEl || !answerKeyEl || !userAnswerEl || !warningEl) {
//         console.error("❌ Required elements not found!");
//         return;
//     }
//     mathQuestionEl.innerHTML = question;
//     answerKeyEl.value = answer;
//     userAnswerEl.value = "";
//     warningEl.style.display = "none"; // Hide warning when reloading question
//     userAnswerEl.focus(); // Focus on the answer input field
//     userAnswerEl.select(); // Select the input text for easy overwriting

// }

const checkUserAnswer = () => {
    const userAnswerEl = document.querySelector("#user-answer");
    const answerKeyEl = document.querySelector("#answer-key");

    if (!userAnswerEl || !answerKeyEl) {
        console.error("❌ Required elements not found!");
        return false;
    }

    const userAnswer = userAnswerEl.value.trim();
    const answerKey = answerKeyEl.value.trim();

    return userAnswer === answerKey;
};
</script>