<?php
require_once 'database.php'; // Adjust this path as necessary

$jsonData = file_get_contents('../movies/film.json');
if ($jsonData === false) {
    die("Error reading the JSON file.");
}

$data = json_decode($jsonData, true);
if ($data === null) {
    die("Error decoding the JSON data.");
}

// Assuming $conn is your database connection variable from 'database.php'
$insertGenreStmt = $conn->prepare("INSERT INTO genres (name) VALUES (?) ON DUPLICATE KEY UPDATE genre_id=genre_id;");

if (!$insertGenreStmt) {
    die("Prepare statement failed: " . $conn->error);
}

$processedGenres = [];

foreach ($data['movies'] as $movie) {
    foreach ($movie['genres'] as $genreName) {
        // Skip if this genre has already been added
        if (in_array($genreName, $processedGenres)) {
            continue;
        }

        // Bind the genre name to the prepared statement
        $insertGenreStmt->bind_param("s", $genreName);
        if (!$insertGenreStmt->execute()) {
            echo "Execute failed: (" . $insertGenreStmt->errno . ") " . $insertGenreStmt->error;
        } else {
            // Mark this genre as added
            $processedGenres[] = $genreName;
        }
    }
}

echo "Genres populated successfully.";

$insertGenreStmt->close();
$conn->close();
?>
