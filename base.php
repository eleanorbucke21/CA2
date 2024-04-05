<?php
session_start();
// Example of setting a variable for dynamic page title
$pageTitle = "Home";

// Define the BASE_URL constant
define('BASE_URL', 'http://localhost/CA2');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Custom Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="http://localhost/CA2/assets/css/style.css">

    <!-- FONT AWESOME-->
    <script src="https://kit.fontawesome.com/8084e45a7c.js" crossorigin="anonymous"></script>

    <title>CCT Rental - <?php echo $pageTitle; ?></title>
</head>

<body class="bg-dark">
<header>
<?php include 'php/navbar.php'; ?>
</header>

<main class="container-fluid bg-dark">
  <div class="container px-5">
    <div class="row">
      <?php
      if (isset($mainContentPath) && file_exists($mainContentPath)) {
          include $mainContentPath;
      } else {
          echo "<p>Content not found.</p>";
      }
      ?>
    </div>
  </div>
</main>


<footer>
<?php include 'php/footer.php'; ?>
</footer>

    <!-- Custom JavaScript-->
    <script src="assets/js/filter_movies.js"></script>
</body>

</html>
