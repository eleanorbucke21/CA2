<?php
// Start session
session_start();

// Extend the base.php file
include '../base.php';

// Include database connection
include '../database/database.php';

// Process the form submission for updating movie details
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['movie_id'])) {
    // Extract and sanitize inputs
    $movieId = $_POST['movie_id'];
    $title = $_POST['title']; // Sanitize this as needed
    // Assume other variables ($year, $runtime, etc.) are set similarly

    // Prepare the update statement (include all fields you're updating)
    $stmt = $db->prepare("UPDATE movies SET title = ?, year = ?, runtime = ?, director = ?, actors = ?, plot = ?, posterUrl = ?, videoUrl = ? WHERE movie_id = ?");
    // Make sure to adjust the bind_param line according to your variables and their types
    $stmt->bind_param("siisssssi", $title, $year, $runtime, $director, $actors, $plot, $posterUrl, $videoUrl, $movieId);
    $stmt->execute();

    // Redirect or display a success message
    header('Location: ../phpadmin/admin.php');
    exit;
}

// Fetch the movie details if "edit" query parameter is set
if (isset($_GET['edit'])) {
    $movieId = $_GET['edit'];
    $stmt = $db->prepare("SELECT * FROM movies WHERE movie_id = ?");
    $stmt->bind_param("i", $movieId); // "i" denotes the type is INT
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();
    if (!$movie) {
        die("Movie not found");
    }
} else {
    die("No movie ID provided");
}
?>

<!-- HTML and form go here, as in your previous snippet -->
<div class="container">
    <h2 class="text-white">Edit Movie</h2>
    <form action="admin_editmovies.php" method="post">
        <input type="hidden" name="movie_id" value="<?php echo htmlspecialchars($movie['movie_id']); ?>">

        <div class="mb-3">
            <label for="title" class="form-label text-white">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($movie['title']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="year" class="form-label text-white">Year:</label>
            <input type="number" class="form-control" id="year" name="year" value="<?php echo htmlspecialchars($movie['year']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="runtime" class="form-label text-white">Runtime (in minutes):</label>
            <input type="number" class="form-control" id="runtime" name="runtime" value="<?php echo htmlspecialchars($movie['runtime']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="director" class="form-label text-white">Director:</label>
            <input type="text" class="form-control" id="director" name="director" value="<?php echo htmlspecialchars($movie['director']); ?>" required>
        </div>

        <div class="mb-3">
            <label for="actors" class="form-label text-white">Actors:</label>
            <textarea class="form-control" id="actors" name="actors" required><?php echo htmlspecialchars($movie['actors']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="plot" class="form-label text-white">Plot:</label>
            <textarea class="form-control" id="plot" name="plot" required><?php echo htmlspecialchars($movie['plot']); ?></textarea>
        </div>

        <div class="mb-3">
            <label for="posterUrl" class="form-label text-white">Poster URL:</label>
            <input type="url" class="form-control" id="posterUrl" name="posterUrl" value="<?php echo htmlspecialchars($movie['posterUrl']); ?>">
        </div>

        <div class="mb-3">
            <label for="videoUrl" class="form-label text-white">Video URL:</label>
            <input type="url" class="form-control" id="videoUrl" name="videoUrl" value="<?php echo htmlspecialchars($movie['videoUrl']); ?>">
        </div>

        <button type="submit" class="btn btn-dark btn-outline-light">Save Changes</button>
    </form>
</div>
