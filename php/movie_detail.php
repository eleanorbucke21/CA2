<?php
// Start the session (if not already started)
session_start();

include '../base.php';

// Path to the JSON file
$jsonFilePath = __DIR__ . '/../movies/film.json';

// Check if the JSON file exists
if (file_exists($jsonFilePath)) {
    // Read JSON file contents
    $jsonData = file_get_contents($jsonFilePath);

    // Decode JSON data into an associative array
    $movies = json_decode($jsonData, true);

    // Get movie ID from URL query parameter
    $movieId = $_GET['movie_id'] ?? null;

    // Check if movie ID is provided and exists in the JSON data
    if ($movieId !== null && isset($movies['movies'][$movieId])) {
        $movie = $movies['movies'][$movieId];

        // Display movie details with provided styling
        ?>
        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <img id="movieImageLarge" src="<?php echo $movie['posterUrl']; ?>" alt="<?php echo $movie['title']; ?>" class="img-fluid rounded d-md-block">
                </div>
                <div class="col-md-6 rounded-container text-white">
                    <h2 id="movieTitle" class="text-lg mb-3"><?php echo $movie['title']; ?></h2>
                    <h3 id="movieYear" class="text-md mb-3">Year: <?php echo $movie['year']; ?></h3>
                    <h3 class="text-md mb-2">Plot:</h3>
                    <h3 id="moviePlot" class="text-md mb-3"><?php echo $movie['plot']; ?></h3>
                    <p id="movieCast" class="text-sm mb-2">Cast: <?php echo $movie['actors']; ?></p>
                    <p id="movieDirector" class="text-sm mb-2">Director: <?php echo $movie['director']; ?></p>
                </div>
                <div class="col-md-6">
                    <img id="movieImageSmall" src="<?php echo $movie['posterUrl']; ?>" alt="<?php echo $movie['title']; ?>" class="img-fluid rounded d-md-none">
                </div>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
<div class="text-center my-5 col-12">
    <a href="booking.html" class="btn btn-danger">Book Now</a>
</div>
<?php endif; ?>

                <div class="col-12">
                    <div class="text-center my-5">
                        <iframe id="movieVideo" width="100%" height="560" src="https://www.youtube.com/embed/<?php echo getYoutubeVideoId($movie['videoUrl']); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        // Movie not found or ID not provided
        echo "<p>Movie not found or invalid movie ID.</p>";
    }
} else {
    // JSON file not found
    echo '<p>Failed to load movie data. JSON file not found.</p>';
}

// Function to extract YouTube video ID from the URL
function getYoutubeVideoId($url) {
    $videoIdMatch = preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches);
    return $videoIdMatch ? $matches[1] : null;
}
?>
