<?php

// Buffer the output
ob_start();

//Initialize the session
session_start();

include 'database/config.php';

// Define variables and initialize with empty values
$name = $email = $password = $confirm_password = $phone = $address =  "";
$name_err = $email_err = $password_err = $confirm_password_err = $phone_err = $address_err = "";

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: index.php");
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Validate full name
  if (empty(trim($_POST["name"]))) {
    $name_err = "Please enter a full name.";
  } else if (!preg_match('/^[a-zA-Z ]+$/', trim($_POST["name"]))) {
    $name_err = "Full name can only contain letters and spaces.";
  } else {
    $name = trim($_POST["name"]);
  }

  // Validate full name
  if (empty(trim($_POST["phone"]))) {
    $phone_err = "Please enter a phone number.";
  } else if (!preg_match('/^[0-9]+$/', trim($_POST["phone"]))) {
    $phone_err = "Phone number can only contain numbers.";
  } else {
    $phone = trim($_POST["phone"]);
  }

  // Validate full name
  if (empty(trim($_POST["address"]))) {
    $address_err = "Please enter an address.";
  } else if (!preg_match("/^(\\d{1,}) [a-zA-Z0-9\\s]+(\\,)? [a-zA-Z]+(\\,)? [A-Z]{2} [0-9]{5,6}$/", trim($_POST["address"]))) {
    $address_err = "Address can only contain letters, numbers and spaces. Example: '3344 W Alameda Avenue, Lakewood, CO 80222'";
  } else {
    $address = trim($_POST["address"]);
  }

  // Validate email
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter a email.";
  } else if (!preg_match("/^([a-zA-Z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", trim($_POST["email"]))) {
    $email_err = "Invalid email format";
  } else {
    // Prepare a select statement
    $sql = "SELECT id FROM user_info WHERE email = ?";

    if ($stmt = mysqli_prepare($db, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      // Set parameters
      $param_email = trim($_POST["email"]);

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        /* store result */
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $email_err = "This email is already taken.";
        } else {
          $email = trim($_POST["email"]);
          $email = strval($email);
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } else if (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password !== $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }

  // Check input errors before inserting in database
  if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

    // Prepare an insert statement
    $sql = "INSERT INTO user_info (`name`, `email`, `phone`, `address`, `password`) VALUES ('" . $name . "', '" . $email . "', '" . $phone  . "', '" . $address . "', '" . $password . "')";

    if ($db->query($sql)) {
      session_start();

      // Store data in session variables
      $_SESSION['loggedin'] = true;
      $_SESSION['email'] = $email;

      header("location: index.php");
    } else {
      echo "Error: " . $sql . "<br>" . $db->error;
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

  <title>Sign Up Page</title>
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
        <a class="nav-link active" href="login.php">Login</a>
        <a href="index.php" class="book-a-table-btn d-none d-lg-flex">Book a table</a>
        <a id="Cart" href="cart.php" type="button" class="book-a-table-btn d-none d-lg-flex">Cart</a>
      </div>
    </div>
  </header><!-- End Header -->

  <main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Signup Page</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Signup Page</li>
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
                <div class="col-lg-3 col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Full Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required>
                  <span class="invalid-feedback"><?php echo $name_err; ?></span>
                </div>
                <div class="col-lg-3 col-md-6 form-group mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" required>
                  <span class="invalid-feedback"><?php echo $email_err; ?></span>
                </div>
                <div class="col-lg-3 col-md-6 form-group mt-md-0">
                  <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" data-rule="minlen:9;maxlen:9" data-msg="Please enter at least 9 chars" required>
                  <span class="invalid-feedback"><?php echo $phone_err; ?></span>
                </div>
                <div class="col-lg-3 col-md-6 form-group mt-md-0">
                  <input type="tel" class="form-control" name="address" id="address" placeholder="Your Address" data-rule="minlen:5" data-msg="Please enter at least 5 chars" required>
                  <span class="invalid-feedback"><?php echo $address_err; ?></span>
                </div>
                <div class="col-lg-6 col-md-8 form-group">
                  <input type="text" name="password" class="form-control" id="password" placeholder="Password" data-rule="minlen:8" data-msg="Please enter at least 8 chars" required>
                  <span class="invalid-feedback"><?php echo $password_err; ?></span>
                </div>
                <div class="col-lg-6 col-md-8 form-group">
                  <input type="text" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm_password" data-rule="minlen:8" data-msg="Please enter at least 8 chars" required>
                  <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                </div>
                <div class="text-center"><button type="submit">Sign Up</button></div>
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