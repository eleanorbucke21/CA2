<?php
// Include base file
include '../base.php';

// Include database connection
include '../database/database.php';

// Start session
session_start();

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
        // Dummy user ID and movie ID for demonstration purposes
        $user_id = 1;
        $movie_id = 1;

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
    }
}
?>

<!-- booking.php -->

<div class="container mt-5">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="mb-3">
            <label for="date" class="form-label text-white">Date:</label>
            <input type="date" class="form-control" id="date" name="date">
            <span class="error text-danger"><?php echo isset($dateErr) ? $dateErr : ''; ?></span>
        </div>
        <button type="submit" class="btn btn-dark btn-outline-light">Submit</button>
    </form>
</div>

<!-- JavaScript -->
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
