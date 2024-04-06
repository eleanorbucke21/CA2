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
    $movieId = (isset($_GET['movie_id']) ? $_GET['movie_id'] - 1 : null);

    // Check if movie ID is provided and exists in the JSON data
    if ($movieId !== null && isset($movies['movies'][$movieId])) {
        $movie = $movies['movies'][$movieId];

        // Ensure the content-type is set to text/html for proper rendering
        header('Content-Type: text/html; charset=utf-8');
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo htmlspecialchars($movie['title']); ?></title>
            <link rel="stylesheet" href="path/to/your/bootstrap.css"> <!-- Make sure to adjust the path -->
            <!-- Add additional CSS or JS links as needed -->
        </head>
        <body>

        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <img id="movieImageLarge" src="<?php echo htmlspecialchars($movie['posterUrl']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>" class="img-fluid rounded d-md-block">
                </div>
                <div class="col-md-6 rounded-container text-white">
                    <h2 id="movieTitle" class="text-lg mb-3"><?php echo htmlspecialchars($movie['title']); ?></h2>
                    <h3 id="movieYear" class="text-md mb-3">Year: <?php echo htmlspecialchars($movie['year']); ?></h3>
                    <h3 class="text-md mb-2">Plot:</h3>
                    <h3 id="moviePlot" class="text-md mb-3"><?php echo htmlspecialchars($movie['plot']); ?></h3>
                    <p id="movieCast" class="text-sm mb-2">Cast: <?php echo htmlspecialchars($movie['actors']); ?></p>
                    <p id="movieDirector" class="text-sm mb-2">Director: <?php echo htmlspecialchars($movie['director']); ?></p>
                </div>
                <div class="col-md-6">
                    <img id="movieImageSmall" src="<?php echo htmlspecialchars($movie['posterUrl']); ?>" alt="<?php echo htmlspecialchars($movie['title']); ?>" class="img-fluid rounded d-md-none">
                </div>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                <div class="text-center my-5 col-12">
                    <a href="booking.php" class="btn btn-dark btn-outline-light">Book Now</a> <!-- Ensure this link points to your booking form -->
                </div>
                <?php endif; ?>

                <div class="col-12">
                    <div class="text-center my-5">
                        <iframe id="movieVideo" width="100%" height="560" src="https://www.youtube.com/embed/<?php echo getYoutubeVideoId($movie['videoUrl']); ?>" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>

        </body>
        </html>
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
