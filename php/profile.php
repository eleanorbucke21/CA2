<?php
// Start session
session_start();

// Redirect if not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection, assuming it's set up in base.php
require_once '../base.php';
?>

<div class="container mt-5">
        <h1>Profile Page</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
        
        <!-- Additional user details here -->
        <?php
       
        
        $stmt = $db->prepare("SELECT booking_id, booking_date, details FROM bookings WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION["user_id"]);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h3>Your Past Bookings</h3><ul>";
            while ($booking = $result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($booking['booking_date']) . " - " . htmlspecialchars($booking['details']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>You have no past bookings.</p>";
        }
        $stmt->close();
        
        ?>
    </div>