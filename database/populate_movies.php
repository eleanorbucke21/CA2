<?php
require_once 'database.php'; // Database connection

$jsonData = file_get_contents('../movies/film.json'); 

// Check if the file was read successfully
if ($jsonData === false) {
    die("Error: Unable to read the JSON file.");
}

$films = json_decode($jsonData, true);

// Ensure $films is an array before attempting to loop through it
if (!is_array($films['movies'])) {
    die("Error: No movies data found.");
}

// Prepare SQL insert statement for the Movies table
$stmt = $conn->prepare("INSERT INTO Movies (title, year, runtime, director, actors, plot, posterUrl, videoUrl) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

foreach ($films['movies'] as $movie) {
    // insert statement for each movie
    $stmt->bind_param("ssisssss", 
        $movie['title'], 
        $movie['year'], 
        $movie['runtime'], 
        $movie['director'], 
        $movie['actors'], 
        $movie['plot'], 
        $movie['posterUrl'], 
        $movie['videoUrl']
    );
    $stmt->execute();
}

echo "Movies populated successfully.";

$stmt->close();
$conn->close();
?>