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
    } else {
        // If there are no errors, insert data into past_bookings table
        // Check if movie_id and user_id are set in the session
        if (isset($_SESSION['movie_id']) && isset($_SESSION['user_id'])) {
            // Get the movie ID and user ID from the session
            $movie_id = $_SESSION['movie_id'];
            $user_id = $_SESSION['user_id'];

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
            // Redirect user to login.php if user_id is not provided
            header("Location: login.php");
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
                <!-- CAPTCHA display -->
                    <div id="captcha_display" class="mb-3 border border-light bg-dark text-white p-2 rounded text-center"></div>

                    <!-- Hidden input to store actual CAPTCHA value -->
                    <input type="hidden" id="captcha_value" name="captcha_value">

                    <div class="mb-3">
                        <label for="captcha_input" class="form-label text-white">Enter CAPTCHA:</label>
                        <input type="text" class="form-control" id="captcha_input" name="captcha_input">
                        <span class="error text-danger"><!-- Place for potential error message --></span>
                    </div>

                    <!-- Submit button with CAPTCHA validation -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-dark btn-outline-light" onclick="return validateCaptcha()">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Custom JavaScript -->

<script>
    // Function to set today's date on the date input field
function setTodayDate() {
    var today = new Date().toISOString().split('T')[0];
    document.getElementById('date').value = today;
}

// Function to generate a CAPTCHA code and display it
function generateCaptcha() {
    const captchaDisplay = document.getElementById('captcha_display');
    let captchaCode = Math.floor(1000 + Math.random() * 9000); // Generate a 4-digit code
    captchaDisplay.innerText = captchaCode; // Display the CAPTCHA code
    document.getElementById('captcha_value').value = captchaCode; // Store the CAPTCHA code in a hidden input for validation
}

// Function to validate the CAPTCHA entered by the user against the generated CAPTCHA
function validateCaptcha() {
    const enteredCaptcha = document.getElementById('captcha_input').value;
    const actualCaptcha = document.getElementById('captcha_value').value;
    if (enteredCaptcha !== actualCaptcha) {
        alert('CAPTCHA is incorrect');
        console.log('CAPTCHA failed'); // For debugging
        return false; // Prevent form submission
    }
    console.log('CAPTCHA passed'); // For debugging
    return true; // Allow form submission
}

// Add event listeners when the DOM content is fully loaded
document.addEventListener('DOMContentLoaded', function () {
    setTodayDate(); // Set the current date in the date input field
    generateCaptcha(); // Generate a new CAPTCHA code
});

// Attach the validateCaptcha function to the form's submit event
document.getElementById('yourFormId').addEventListener('submit', function(event) {
    if (!validateCaptcha()) {
        event.preventDefault();
    } else {
        console.log('Form submitted'); 
        
    }
});

</script>
