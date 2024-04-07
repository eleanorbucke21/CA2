<?php
// Include database connection
include '../database/database.php';

// Admin details
$email = "admin";
$password = "adminjava"; // Note: It's recommended to hash the password before storing it in the database for security reasons.

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL to insert admin user
$sql = "INSERT INTO users (email, password, is_admin) VALUES ('$email', '$hashed_password', 1)";

if ($conn->query($sql) === TRUE) {
    echo "Admin user created successfully";
} else {
    echo "Error creating admin user: " . $conn->error;
}

// Close connection (optional, as the script will terminate after execution)
$conn->close();
?>
