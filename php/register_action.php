<?php

require_once '../database/database.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    require_once '../database/database.php'; // Adjust path to your database connection file
    
    // Collect and sanitize input
    $name = $db->real_escape_string($_POST['name']);
    $email = $db->real_escape_string($_POST['email']);
    $password = $db->real_escape_string($_POST['password']);
    $role = 'user'; // Default role
    
    // Hash the password for storing
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    
    // Bind parameters and execute statement
    $stmt->bind_param("ssss", $name, $email, $hashedPassword, $role);
    
    // Check for successful insertion
    if ($stmt->execute()) {
        // Redirect to login page 
        header("Location: login.php");
        exit();
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }
    
    // Close statement and connection
    $stmt->close();
    $db->close();
} else {
    // Redirect or handle the error if not accessed via POST
    header("Location: register.php"); 
    exit();
}
?>