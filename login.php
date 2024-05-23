<?php

// Buffer the output
ob_start();

// Initialize the session
session_start();

include 'database/config.php';

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  header('location: index.php');
}

// Define variables and initialize with empty values
$email = $password = '';
$email_err = $password_err = $login_err = '';

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Check if email is empty
  if (empty(trim($_POST['email']))) {
    $email_err = 'Please enter email.';
  } else {
    $email = trim($_POST['email']);
  }

  // Check if password is empty
  if (empty(trim($_POST['password']))) {
    $password_err = 'Please enter your password.';
  } else {
    $password = trim($_POST['password']);
  }

  // Validate credentials
  if (empty($email_err) && empty($password_err)) {
    // Prepare a select statement
    $sql = 'SELECT email, password FROM user_info WHERE email = ?';

    if ($stmt = mysqli_prepare($db, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, 's', $param_email);

      // Set parameters
      $param_email = $email;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if email exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1) {
          // Bind result variables
          mysqli_stmt_bind_result(
            $stmt,
            $email,
            $hashed_password
          );

          if (mysqli_stmt_fetch($stmt)) {
            if (strcmp($password, $hashed_password) == 0) {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION['loggedin'] = true;
              $_SESSION['email'] = $email;

              // Redirect user to welcome page
              header('location: index.php');
            } else {
              // Password is not valid, display a generic error message
              $login_err = 'Invalid email or password.';
            }
          }
        } else {
          // email doesn't exist, display a generic error message
          $login_err = 'Invalid email or password.';
        }
      } else {
        echo 'Oops! Something went wrong. Please try again later.';
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login Page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="assets/js/main.js"></script>
</head>

<body>
  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-phone d-flex align-items-center"><span>+1 5589 55488 55</span></i>
        <i class="bi bi-clock d-flex align-items-center ms-4"><span> Mon-Sat: 11AM - 23PM</span></i>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-cente">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

      <h1 class="logo me-auto me-lg-0"><a href="index.php">Tastopia</a></h1>

      <div style="display: flex;">
        <a class="nav-link active" href="signup.php">Sign Up</a>
        <a href="index.php" class="book-a-table-btn d-none d-lg-flex">Book a table</a>
        <a id="Cart" href="cart.php" type="button" class="book-a-table-btn d-none d-lg-flex">Cart</a>
      </div>
    </div>
  </header><!-- End Header -->

  <main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Login Page</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Login Page</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">
        <!-- ======= Login Section ======= -->
        <section id="book-a-table" class="book-a-table">
          <div class="container" data-aos="fade-up">

            <form action="" method="post" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
              <div class="row">
                <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" required>
                  <span class="invalid-feedback"><?php echo $email_err; ?></span>
                </div>
                <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="password" id="password" placeholder="Password" required>
                  <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="text-center col-lg-4 col-md-6 form-group mt-3 mt-md-0"><button type="submit">Login</button></div>
              </div>
            </form>

          </div>
        </section><!-- End Login Section -->
      </div>
    </section>

  </main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-5 col-sm-3">
            <img src="assets/images/white_logo.png" alt="" class="img-fluid" />
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Tastopia</h3>
              <p>
                A108 Adam Street <br>
                NY 535022, USA<br><br>
                <strong>Phone:</strong> +1 5589 55488 55<br>
                <strong>Email:</strong> info@example.com<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Subscribe for events, offers ect.</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Tastopia</span></strong>. All Rights Reserved
      </div>
      <div class="copyright">
        Made for a thesis!! Not an actual restaurant!!
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>