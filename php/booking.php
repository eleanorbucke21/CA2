<?php

// Extend the base.php file
include '../base.php';
session_start(); 

// Generate a random captcha and store it in session
$_SESSION['captcha'] = rand(1000, 9999);

// Booking Message
$bookingMessage = '';
if (isset($_SESSION['booking_message'])) {
    $bookingMessage = $_SESSION['booking_message'];
    // Optionally clear the message after displaying it to avoid repetition on page refresh
    unset($_SESSION['booking_message']);
}
?>


<div class="container mt-5">
    <h2 class=text-white>Movie Streaming Rental</h2>
    <!-- Display booking message-->
    <?php if (!empty($bookingMessage)): ?>
        <div class="alert alert-info">
            <?php echo $bookingMessage; ?>
        </div>
    <?php endif; ?>

    <!-- Booking Form -->
    <form id="bookingForm" action="process_booking.php" method="POST">
        <div class="mb-3">
          <label for="date" class="form-label text-white">Date</label>
          <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <!-- CAPTCHA Section -->
        <div class="mb-3">
          <label for="captcha" class="form-label text-white">Captcha</label>
          <p id="captcha" class="border p-2 rounded text-center">
            <?php echo $_SESSION['captcha']; ?>
          </p>
          <input type="text" class="form-control" id="captchaInput" name="captchaInput" placeholder="Enter the captcha" required>
        </div>

        <button type="submit" class="btn btn-dark btn-outline-light">Submit Booking</button>
    </form>
</div>

<script>
  // Script to set the booking date to today's date
  document.addEventListener('DOMContentLoaded', function () {
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('date').value = today;
  });
</script>

