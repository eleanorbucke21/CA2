<?php
$host = '127.0.0.1';
$db   = 'ca2rental';
$user = 'root'; // Default XAMPP MySQL user
$pass = ''; // Default XAMPP MySQL password is typically empty
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Commands to create tables
    $commands = [
        'CREATE TABLE IF NOT EXISTS genres (
            genre_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(50) UNIQUE NOT NULL
        )',
        'CREATE TABLE IF NOT EXISTS movies (
            movie_id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            year YEAR,
            runtime INT,
            director VARCHAR(255),
            actors TEXT,
            plot TEXT,
            posterUrl VARCHAR(2083),
            videoUrl VARCHAR(2083)
        )',
        'CREATE TABLE IF NOT EXISTS moviegenres (
            movie_id INT,
            genre_id INT,
            FOREIGN KEY (movie_id) REFERENCES movies(movie_id),
            FOREIGN KEY (genre_id) REFERENCES genres(genre_id),
            PRIMARY KEY (movie_id, genre_id)
        )',
        'CREATE TABLE IF NOT EXISTS users (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            role ENUM(\'admin\', \'user\') NOT NULL
        )',
        'CREATE TABLE IF NOT EXISTS past_bookings (
            view_id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            movie_id INT,
            view_date DATE NOT NULL,
            FOREIGN KEY (user_id) REFERENCES users(user_id),
            FOREIGN KEY (movie_id) REFERENCES movies(movie_id)
        )'
    ];

    // Execute each command
    foreach ($commands as $command) {
        $pdo->exec($command);
    }

    echo "Tables created successfully.";
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
