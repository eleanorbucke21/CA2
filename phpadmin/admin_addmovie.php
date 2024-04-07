<?php

// Extend the base.php file
include '../base.php';

// Include database connection
include '../database/database.php';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assign form data to variables
    $title = $_POST['title'];
    $year = $_POST['year'];
    $runtime = $_POST['runtime'];
    $director = $_POST['director'];
    $actors = $_POST['actors'];
    $plot = $_POST['plot'];
    $videoUrl = $_POST['videoUrl'];

    // Handle the file upload for 'poster'
    if (isset($_FILES['poster']) && $_FILES['poster']['error'] == 0) {
        // Define the path to the upload directory
        $targetDirectory = "../uploads/posters/"; // Ensure this directory exists and is writable
        $fileName = basename($_FILES['poster']['name']);
        $targetFilePath = $targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Specify allowed file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Upload file to server
            if (move_uploaded_file($_FILES['poster']['tmp_name'], $targetFilePath)) {
                // File upload success, insert into database
                $posterUrl = $targetFilePath;
            } else {
                $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            }
        } else {
            $_SESSION['error'] = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
        }
    }

    // Insert movie record into database
    if (!isset($_SESSION['error'])) {
        $stmt = $db->prepare("INSERT INTO movies (title, year, runtime, director, actors, plot, posterUrl, videoUrl) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssisssss", $title, $year, $runtime, $director, $actors, $plot, $posterUrl, $videoUrl);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Movie added successfully!";
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