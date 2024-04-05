<?php
include '../base.php';

$jsonFilePath = __DIR__ . '/../movies/film.json';

if (file_exists($jsonFilePath)) {
    $jsonString = file_get_contents($jsonFilePath);
    $jsonData = json_decode($jsonString, true);

    echo "<div class='container mt-5'><div class='row'>";

    foreach ($jsonData['movies'] as $movie) {
        if (isset($movie['posterUrl'], $movie['id'])) { // Ensure the movie has an id and a posterUrl
            // Wrap the image in an anchor tag, pointing to movie_detail.php with the movie's id as a query parameter
            echo '<div class="col-sm-6 col-md-4 col-lg-3 mb-4 gallery-img">';
            echo '<a href="movie_detail.php?movie_id=' . htmlspecialchars($movie['id']) . '">';
            echo '<img src="' . htmlspecialchars($movie['posterUrl']) . '" alt="' . htmlspecialchars($movie['title']) . '" class="rounded shadow" style="width: 200px; height: 250px; object-fit: cover;">';
            echo '</a>';
            echo '</div>'; // Close the column div
        }
    }

    echo "</div></div>";
} else {
    echo '<p>Failed to load movie data. JSON file not found.</p>';
}
?>
