<?php
// Start the session to use session variables for feedback
session_start();

// Include database connection
require_once '../database/database.php'; // Adjust the path as needed

// Check if the form submission is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and assign form data
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $date = $conn->real_escape_string(trim($_POST['date']));
    
    // CAPTCHA Validation
    if (isset($_POST['captchaInput']) && $_POST['captchaInput'] == $_SESSION['captcha']) {
        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO bookings (name, email, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $date);
    
        // Execute the statement and check if it's successful
        if ($stmt->execute()) {
            // Success: Set a session message and redirect to a success page
            $_SESSION['message'] = "Booking successfully submitted!";
            header("Location: booking_success.php"); // Adjust redirect location as needed
            exit();
        } else {
            // Error during execution: Set an error message and redirect back to booking form
            $_SESSION['error'] = "There was a problem with your booking. Please try again.";
            header("Location: booking.php"); // Adjust redirect location as needed
            exit();
        }
    
        // Close statement
        $stmt->close();
    } else {
        // CAPTCHA is wrong: Set an error message and redirect back to the booking form
        $_SESSION['error'] = 'Incorrect CAPTCHA. Please try again.';
        header('Location: booking.php');
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // If not a POST request, redirect to the booking form
    header("Location: booking.php");
    exit();
}
?>
