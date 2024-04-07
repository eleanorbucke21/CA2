<?php
// Check if session is not already started
if(session_status() == PHP_SESSION_NONE) {
    // If session is not started, start the session
    session_start();
}

// Generate random CAPTCHA string
$captcha = generateCaptcha();

// Store CAPTCHA string in session if needed
$_SESSION['captcha'] = $captcha;

// Output CAPTCHA string
echo $captcha;

// Function to generate random CAPTCHA string
function generateCaptcha() {
    $characters = '0123456789';
    $captchaLength = 6;
    $captcha = '';
    for ($i = 0; $i < $captchaLength; $i++) {
        $captcha .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $captcha;
}
?>
