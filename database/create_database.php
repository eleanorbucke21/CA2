<?php
$host = '127.0.0.1';
$user = 'root'; // Default XAMPP MySQL user
$pass = ''; // Default XAMPP MySQL password is typically empty
$charset = 'utf8mb4';

// Set up DSN (Data Source Name)
$dsn = "mysql:host=$host;charset=$charset";

// Set PDO options
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Create a PDO instance (connect to the server)
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // SQL statement to create a database
    $sql = "CREATE DATABASE IF NOT EXISTS ca2rental";
    
    // Execute SQL statement
    $pdo->exec($sql);
    
    echo "Database ca2rental created successfully";
} catch (PDOException $e) {
    die("Could not connect to the database server: " . $e->getMessage());
}
