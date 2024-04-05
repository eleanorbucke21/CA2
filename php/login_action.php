<?php
// Start the session at the beginning of the script
session_start();

// Include the database connection
require_once '../database/database.php'; // Adjust the path as needed

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $email = $db->real_escape_string(trim($_POST['email'])); // Changed from 'username' to 'email'
    $password = trim($_POST['password']);

    // Prepare SQL statement to prevent SQL injection, selecting user by email
    $stmt = $db->prepare("SELECT user_id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        // User found, now verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, so start a new session and save user info in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $user['user_id'];
            $_SESSION["email"] = $user['email']; // Store email

            // Redirect user to profile page
            header("Location: profile.php"); // Adjust the redirect location as needed
            exit();
        } else {
            // Password is not valid, redirect back to the login page with an error message
            header("Location: login.php?error=invalidpassword");
            exit();
        }
    } else {
        // Email doesn't exist, redirect back to the login page with an error message
        header("Location: login.php?error=noemail");
        exit();
    }

    // Close statement
    $stmt->close();
} else {
    // If not a POST request, redirect to the login page
    header("Location: login.php");
    exit();
}
?>
