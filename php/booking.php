<?php
// Start session
session_start();

// Include base file
include '../base.php';

// Include database connection
include '../database/database.php';

// Check if movie_id is set in the URL and store it in a session variable
if (isset($_GET['movie_id'])) {
    $_SESSION['movie_id'] = $_GET['movie_id'];
}

// Suppress output for specific messages
$suppressMessages = true;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate date
    $dateErr = '';
    $date = $_POST["date"];
    if (empty($date)) {
        $dateErr = "Date is required";
    }

    // Validate CAPTCHA
    if (!isset($_POST["captcha_input"]) || empty($_POST["captcha_input"]) || strtolower($_POST["captcha_input"]) !== strtolower($_SESSION["captcha"])) {
        $captchaErr = "CAPTCHA is incorrect";
    } else {
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
                    if (!$suppressMessages) {
                        echo "Error adding booking: " . $stmt->error;
                    }
                }
                $stmt->close();
            } else {
                // Redirect user to movie_detail.php if movie_id is not provided
                header("Location: movie_detail.php");
                exit();
            }
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
        $poster_url = $movie['posterUrl'];
    } else {
        if (!$suppressMessages) {
            echo "Movie not found.";
        }
        exit();
    }
    $stmt->close();
} else {
    if (!$suppressMessages) {
        echo "Movie ID not provided.";
    }
    exit();
}
?>


<!-- booking form-->
<div class="container mt-5">
    <div class="row">
        <!-- Column for the movie poster image -->
        <div class="col-md-6">
            <!-- Display movie poster image -->
            <img src="<?php echo htmlspecialchars($poster_url); ?>" alt="Movie Poster" class="img-fluid" style="width: 600px; height: 650px;">
        </div>
        <!-- Column for the form -->
        <div class="col-md-6">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="mb-3">
                    <label for="date" class="form-label text-white">Date:</label>
                    <input type="date" class="form-control" id="date" name="date">
                    <span class="error text-danger"><?php echo isset($dateErr) ? $dateErr : ''; ?></span>
                </div>
                <!-- CAPTCHA -->
                <label for="captcha_input" class="form-label text-white">CAPTCHA:</label>
                <div class="mb-3 border border-light bg-dark text-white p-2 rounded text-center">
                    <?php include 'captcha.php'; ?>
                </div>
                <div class="mb-3">
                    <label for="captcha_input" class="form-label text-white">Enter CAPTCHA:</label>
                    <input type="text" class="form-control" id="captcha_input" name="captcha_input">
                    <span class="error text-danger"><?php echo isset($captchaErr) ? $captchaErr : ''; ?></span>
                </div>
                <!-- Submit button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-dark btn-outline-light">Submit</button>
                </div>
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
