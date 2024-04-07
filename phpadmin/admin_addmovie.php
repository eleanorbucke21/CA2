<?php

// Extend the base.php file
include '../base.php';

// Include database connection
include '../database/database.php';

// Function to update the JSON file with the current movies from the database
function updateJsonFile() {
    global $db; // Make the database connection available inside the function
    $jsonFilePath = __DIR__ . '/../movies/film.json'; // Path to the JSON file
    
    // Fetch all movies from the database
    $movies = [];
    $result = $db->query("SELECT * FROM movies");
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
        $result->free();
    }
    
    // Encode the movies to JSON and write to the file
    $jsonString = json_encode($movies);
    file_put_contents($jsonFilePath, $jsonString);
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Your existing form handling code here...

    // Insert movie record into database
    if (!isset($_SESSION['error'])) {
        $stmt = $db->prepare("INSERT INTO movies (title, year, runtime, director, actors, plot, posterUrl, videoUrl) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssss", $title, $year, $runtime, $director, $actors, $plot, $posterUrl, $videoUrl);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Movie added successfully!";
            updateJsonFile(); // Call function to update JSON file
        } else {
            $_SESSION['error'] = "Error: " . $db->error;
        }
    }

    // Redirect to admin.php
    header('Location: ../phpadmin/admin.php');
    exit;
}

?>
<!-- Add New Movie Form -->
<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label text-white">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label text-white">Year:</label>
            <input type="text" class="form-control" id="year" name="year">
        </div>
        <div class="mb-3">
            <label for="runtime" class="form-label text-white">Runtime (minutes):</label>
            <input type="number" class="form-control" id="runtime" name="runtime">
        </div>
        <div class="mb-3">
            <label for="director" class="form-label text-white">Director:</label>
            <input type="text" class="form-control" id="director" name="director">
        </div>
        <div class="mb-3">
            <label for="actors" class="form-label text-white">Actors:</label>
            <textarea class="form-control" id="actors" name="actors" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="plot" class="form-label text-white">Plot:</label>
            <textarea class="form-control" id="plot" name="plot" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="poster" class="form-label text-white">Poster:</label>
            <input type="file" class="form-control" id="poster" name="poster" accept="image/*" required>
        </div>
        <div class="mb-3">
            <label for="videoUrl" class="form-label text-white">Video URL:</label>
            <input type="text" class="form-control" id="videoUrl" name="videoUrl">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-dark btn-outline-light">Add Movie</button>
        </div>
    </form>
</div>