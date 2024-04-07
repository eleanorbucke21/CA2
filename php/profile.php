<?php
// Start session
session_start();

// Include database connection
include '../database/database.php';

// Redirect if not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection, assuming it's set up in base.php
require_once '../base.php';
?>

<div class="container mt-5 text-white">
    <h1>Profile Page</h1>
    <?php
    // Fetch user's name from the users table
    $stmt = $db->prepare("SELECT name FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc(); // Fetch the user's name

    // Display welcome message with the user's name
    if ($user) {
        echo "<p>Welcome, " . htmlspecialchars($user['name']) . "!</p>";
    } else {
        // If user not found, display a default welcome message
        echo "<p>Welcome!</p>";
    }
    $stmt->close();

    // Fetch past bookings for the user with movie poster URLs
    $stmt = $db->prepare("SELECT pb.view_date, m.posterUrl FROM past_bookings pb INNER JOIN movies m ON pb.movie_id = m.movie_id WHERE pb.user_id = ?");
    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display past bookings
    if ($result->num_rows > 0) {
        echo "<h3>Your Past Bookings</h3>";
        echo "<div class='booking-grid'>";
        while ($booking = $result->fetch_assoc()) {
            echo "<div class='booking'>";
            echo "<img src='" . htmlspecialchars($booking['posterUrl']) . "' alt='Movie Poster' style='width: 100px; height: auto;'>";
            echo "<p>Date Booked: " . htmlspecialchars($booking['view_date']) . "</p>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>You have no past bookings.</p>";
    }
    $stmt->close();
    ?>
</div>

<style>
    .booking-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .booking {
        border: 1px solid lightgrey;
        padding: 10px;
        flex: 0 0 calc(33.33% - 20px); /* Adjust the width as needed */
    }

    .booking img {
        display: block;
        margin-bottom: 10px;
    }
</style>
