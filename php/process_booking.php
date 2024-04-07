<?php
// process_booking.php

// Include database connection
include '../database/database.php';

// Start session
session_start();

// Function to regenerate CAPTCHA
function regenerateCaptcha() {
    $_SESSION['captcha'] = rand(1000, 9999);
    echo $_SESSION['captcha'];
}

// Check if action is specified
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'regenerate_captcha':
            regenerateCaptcha();
            break;
        default:
            // Handle other actions if needed
            break;
    }
} else {
    // Handle form submission
    $date = $captcha = '';
    $dateErr = $captchaErr = '';

    // Validate date
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["date"])) {
            $dateErr = "Date is required";
        } else {
            $date = $_POST["date"];
            // Additional validation for date can be added here if needed
        }

        // Validate CAPTCHA (dummy implementation, replace with your CAPTCHA validation)
        if (empty($_POST["captcha"])) {
            $captchaErr = "CAPTCHA is required";
        } else {
            $captcha = $_POST["captcha"];
            // Dummy CAPTCHA validation (replace with your CAPTCHA validation logic)
            if ($captcha !== $_SESSION['captcha']) {
                $captchaErr = "Invalid CAPTCHA";
            }
        }

        // If there are no errors, insert data into past_bookings table
        if (empty($dateErr) && empty($captchaErr)) {
            $user_id = 1; 
            $movie_id = 1; 

            // Prepare and execute SQL statement
            $stmt = $db->prepare("INSERT INTO past_bookings (user_id, movie_id, view_date) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $user_id, $movie_id, $date);
            if ($stmt->execute()) {
                // Redirect user to profile.php upon successful booking
                header("Location: profile.php");
                exit(); 
            } else {
                echo "Error adding booking: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}
?>
