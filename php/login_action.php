<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection
require_once '../database/database.php';

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection, selecting user by email
    $stmt = $db->prepare("SELECT user_id, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password is correct, store user info in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $user['user_id'];
            $_SESSION["email"] = $user['email'];
            // Check if the user is an admin
            if ($user['role'] === 'admin') {
                $_SESSION["role"] = 'admin';
            }
            // Redirect user to profile page
            header("Location: profile.php");
            exit();
        } else {
            // Password is incorrect
            header("Location: login.php?error=invalidpassword");
            exit();
        }
    } else {
        // Email not found
        header("Location: login.php?error=noemail");
        exit();
    }
} else {
    // If not a POST request, redirect to the login page
    header("Location: login.php");
    exit();
}
?>
