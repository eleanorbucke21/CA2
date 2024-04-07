<?php
// Start session
session_start();

// Extend the base.php file
include '../base.php';

// Include database connection
include '../database/database.php';

// Check if movie_id is set in the URL and store it in a session
if (isset($_GET['movie_id'])) {
    $_SESSION['movie_id'] = $_GET['movie_id'];
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate date
    $dateErr = '';
    $date = $_POST["date"];
    if (empty($date)) {
        $dateErr = "Date is required";
    }

    // If there are no errors, insert data into past_bookings table
    if (empty($dateErr)) {
        // Check if movie_id is set in the session
        if (isset($_SESSION['movie_id'])) {
            // Get the movie ID from the session
            $movie_id = $_SESSION['movie_id'];

            // Dummy user ID for demonstration purposes
            $user_id = 1;

            // Prepare and execute SQL statement
            $stmt = $db->prepare("INSERT INTO past_bookings (user_id, movie_id, view_date) VALUES (?, ?, ?)");
            $stmt->bind_param("iis", $user_id, $movie_id, $date);
            if ($stmt->execute()) {
                // Redirect user to profile.php upon successful booking
                header("Location: profile.php");
                exit(); // Ensure no further code is executed after redirection
            } else {
                echo "Error adding booking: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Redirect user to movie_detail.php if movie_id is not provided
            header("Location: movie_detail.php");
            exit();
        }
    }
}

// Fetch movie details from the database including the poster URL
if (isset($_SESSION['movie_id'])) {
    $movie_id = $_SESSION['movie_id'];
    $stmt = $db->prepare("SELECT * FROM movies WHERE movie_id = ?");
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();
        $poster_url = isset($movie['posterUrl']) ? $movie['posterUrl'] : ''; // Check if posterUrl exists
    } else {
        // Movie not found
        echo "Movie not found.";
        exit();
    }
    $stmt->close();
} else {
    // Movie ID not provided
    echo "Movie ID not provided.";
    exit();
}
?>

<!-- booking form-->

<div class="container mt-5">
    <div class="row">
        <!-- Column for the movie poster image -->
        <div class="col-md-6">
            <!-- Debugging: Display poster URL -->
            <?php echo "Debug: Poster URL - " . htmlspecialchars($poster_url); ?>
            
            <!-- Display movie poster image -->
            <img src="<?php echo htmlspecialchars($poster_url); ?>" alt="Movie Poster" class="img-fluid">
        </div>
        <!-- Column for the form -->
        <div class="col-md-6">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="date" class="form-label text-white">Date:</label>
                    <input type="date" class="form-control" id="date" name="date">
                    <span class="error text-danger"><?php echo isset($dateErr) ? $dateErr : ''; ?></span>
                </div>
                <button type="submit" class="btn btn-dark btn-outline-light">Submit</button>
            </form>
        </div>
    </div>
</div>

<!-- Custom JavaScript -->
<script>
// Function to set today's date
function setTodayDate() {
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('date').value = today;
}

// Call the function to set today's date when the page loads
document.addEventListener('DOMContentLoaded', function () {
    setTodayDate();
});
</script>
