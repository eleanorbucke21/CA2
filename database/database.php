<?php

$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "ca2rental";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    // Log error (example method, implement logging as needed)
    error_log("Connection failed: " . $conn->connect_error);
    // Display a generic error message to the user
    die("Connection failed. Please try again later.");
}

// For development purposes, to confirm successful connection
// echo "Connected successfully";
?>
