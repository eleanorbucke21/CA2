<?php
// Start session
session_start();

// Extend the base.php file
include '../base.php';

// Include database connection
include '../database/database.php';

// Handle delete request before fetching movies to ensure the list is updated
if (isset($_GET['delete'])) {
    $movieId = $_GET['delete'];
    // Security: Ensure $movieId is an integer to prevent SQL injection
    $movieId = filter_var($movieId, FILTER_VALIDATE_INT);
    if ($movieId) {
        $stmt = $db->prepare("DELETE FROM movies WHERE movie_id = ?");
        $stmt->bind_param("i", $movieId);
        $stmt->execute();

        // Optionally, add a message about the successful deletion
        $_SESSION['message'] = 'Movie deleted successfully';

        // Redirect to prevent resubmission
        header('Location: ../phpadmin/admin.php');
        exit;
    } else {
        // Handle the case where $movieId is not valid
        $_SESSION['error'] = 'Invalid request';
    }
}

// Initialize an array to hold movies
$movies = [];

// Execute the query to fetch all movies
$result = $db->query("SELECT * FROM movies");

// Check if the query was successful
if ($result) {
    // Fetch all movies using a loop
    while ($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
    $result->free();
} else {
    // Handle error if the query failed
    echo "Error: " . $db->error;
}
?>

<!-- Button to Add a New Movie -->
<div class="text-center">
    <a href="../phpadmin/admin_addmovie.php" class="btn btn-secondary btn-outline-light me-2">Add Movies</a>
</div>
<!-- List of Movies to edit delete -->
<div class="container text-white">
    <h2>Movies List</h2>
    <table class="table table-dark">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie): ?>
                <tr>
                    <td><?php echo htmlspecialchars($movie['title']); ?></td>
                    <td>
                        <a href="admin_editmovies.php?edit=<?php echo $movie['movie_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="admin.php?delete=<?php echo $movie['movie_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this movie?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

