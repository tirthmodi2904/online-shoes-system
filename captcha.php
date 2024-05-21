<?php
session_start();

// Generate a random string for CAPTCHA
function generateCaptcha() {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $length = 6; // Length of CAPTCHA code

    // Generate random string
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $chars[rand(0, strlen($chars) - 1)];
    }

    // Store the random string in session
    $_SESSION['captcha'] = $randomString;

    return $randomString;
}

// Generate CAPTCHA image
function generateCaptchaImage($text) {
    // Set the content type header to image/png
    header('Content-Type: image/png');

    // Create a blank image with dimensions 120x40
    $image = imagecreatetruecolor(120, 40);

    // Allocate colors for background, text, and noise
    $bgColor = imagecolorallocate($image, 255, 255, 255); // White background
    $textColor = imagecolorallocate($image, 0, 0, 0); // Black text

    // Fill the image with the background color
    imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);

    // Draw the text on the image
    imagestring($image, 5, 20, 10, $text, $textColor);

    // Output the image as PNG
    imagepng($image);

    // Free up memory
    imagedestroy($image);
}

// Generate CAPTCHA text
$captchaText = generateCaptcha();

// Generate CAPTCHA image
generateCaptchaImage($captchaText);
?>