<?php
// Start session
session_start();

// Unset all session variables (optional)
session_unset();

// Destroy the session
session_destroy();

// Redirect to login page or homepage
header('Location: index.php'); // Adjust the redirection path as needed
exit();
?>
