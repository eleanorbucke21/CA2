<?php
include '../base.php';

$jsonFilePath = __DIR__ . '/../movies/film.json';
$selectedGenre = isset($_GET['genre']) ? $_GET['genre'] : 'All';

if (file_exists($jsonFilePath)) {
    $jsonString = file_get_contents($jsonFilePath);
    $jsonData = json_decode($jsonString, true);

    // Here, we assign the ID 'gallery-container' to the main container div
    echo "<div class='container mt-5' id='gallery-container'><div class='row'>";

    foreach ($jsonData['movies'] as $movie) {
        if ($selectedGenre == 'All' || in_array($selectedGenre, $movie['genres'])) {
            if (isset($movie['posterUrl'], $movie['id'])) {
                echo '<div class="col-sm-6 col-md-4 col-lg-3 mb-4 gallery-img">';
                echo '<a href="movie_detail.php?movie_id=' . htmlspecialchars($movie['id']) . '">';
                echo '<img src="' . htmlspecialchars($movie['posterUrl']) . '" alt="' . htmlspecialchars($movie['title']) . '" class="img-fluid rounded shadow" style="width: 100%; height: auto; object-fit: cover;">';
                echo '</a>';
                echo '</div>';
            }
        }
    }

    echo "</div></div>"; 
} else {
    echo '<p>Failed to load movie data. JSON file not found.</p>';
}
?>
