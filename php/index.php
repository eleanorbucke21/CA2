<?php
include '../base.php';

// Assuming movies are stored in a JSON file for this example
$moviesJson = file_get_contents('CA2/movies/film.json');
$moviesArray = json_decode($moviesJson, true)['movies'];

$filteredMovies = $moviesArray; // Default to all movies

// Check if a genre has been selected
if (isset($_GET['genre']) && $_GET['genre'] != '') {
    $selectedGenre = $_GET['genre'];
    // Filter movies by the selected genre
    $filteredMovies = array_filter($moviesArray, function ($movie) use ($selectedGenre) {
        return in_array($selectedGenre, $movie['genres']);
    });
}
?>

<div id="gallery-container">
    <?php foreach ($filteredMovies as $movie): ?>
        <div class="movie">
            <a href="movie_detail.php?id=<?= htmlspecialchars($movie['id']) ?>">
                <img src="<?= htmlspecialchars($movie['posterUrl']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>" width="100" height="150">
            </a>
            <h3><?= htmlspecialchars($movie['title']) ?></h3>
            <!-- Add more movie details as needed -->
        </div>
    <?php endforeach; ?>
</div>
