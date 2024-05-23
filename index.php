<?php

// Buffer the output
ob_start();

//Initialize the session
session_start();

include 'database/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tastopia</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="assets/img/favicon.png" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <script async src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
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
      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#menu">Menu</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <div style="display: flex;">
        <a class="nav-link" href="login.php" id="Login" style="display: inline;">Login</a>
        <a class="nav-link" href="database/logout.php" id="Logout" style="display: none;">Logout</a>
        <a href="#book-a-table" class="nav-link book-a-table-btn scrollto d-none d-lg-flex">Book a table</a>
        <a id="Cart" href="cart.php" type="button" class="nav-link book-a-table-btn d-none d-lg-flex">Cart</a>
      </div>
    </div>
  </header><!-- End Header -->
  <?php
  // Check if the user is already logged in, if yes then redirect him to welcome page
  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo "<script> console.log('Logged In: " . $_SESSION['email'] . "'); </script>";
  ?>
    <script>
      document.querySelector('#Login').style = 'display: none';
      document.querySelector('#Logout').style = 'display: inline';
      // document.querySelector('#Profile').style = 'display: inline';
    </script>
  <?php
  } else {
  ?>
    <script>
      document.querySelector('#Login').style = 'display: inline';
      document.querySelector('#Logout').style = 'display: none';
      // document.querySelector('#Profile').style = 'display: inline';
    </script>
  <?php
  }
  ?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Welcome to <span>Tastopia</span></h1>
          <h2>Welcome to Tastopia, where fresh and premium ingredients collide.</h2>

          <div class="btns">
            <a href="#menu" class="btn-menu animated fadeInUp scrollto">Our Menu</a>
            <a href="#book-a-table" class="btn-book animated fadeInUp scrollto">Book a Table</a>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="assets/images/restaurant1.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>Welcome to Tastopia, where fresh and premium ingredients collide.</h3>
            <p class="fst-italic">
              We at Tastopia are deeply committed to our essential values:
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> Excellent Ingredients: To make sure that every dish is brimming with flavor and nutrition, we exclusively source the freshest produce, finest meats, and artisanal cheeses.</li>
              <li><i class="bi bi-check-circle"></i> Craftsmanship: Our talented chefs carefully and precisely prepare each meal by combining traditional favorites with cutting-edge twists.</li>
              <li><i class="bi bi-check-circle"></i> Hospitality: We work hard to establish a warm environment where visitors are made to feel welcomed and at home, making every visit a special occasion.</li>
            </ul>
            <p>
              Join us at Tastopia and experience a culinary journey unlike any other. Savor the delight of fine cuisine that is always freshly made and lovingly prepared by our skilled chefs.
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Menu</h2>
          <p>Check Our Tasty Menu</p>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li data-filter="*" class="filter-active">All</li>
              <?php
              $query = 'SELECT * FROM menu_items mi, food_categories fc WHERE mi.categoryId = mi.id';
              if ($result = mysqli_query($db, $query)) {
                while ($row = mysqli_fetch_array($result)) { ?>

                  <li data-filter=<?php echo ".filter-" . strtolower($row['name']); ?>><?php echo $row['name']; ?></li>
              <?php }
                mysqli_free_result($result);
              } else {
                echo '0 result';
              } ?>
            </ul>
          </div>
        </div>
        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
          <?php
          $query = "SELECT mi.*, fc.name as name FROM menu_items mi LEFT JOIN food_categories fc ON mi.categoryId = fc.id";
          if ($result = mysqli_query($db, $query)) {
            while ($row = mysqli_fetch_array($result)) { ?>
              <div class="col-lg-6 menu-item <?php echo "filter-" . strtolower($row['name']); ?>">
                <img src=<?php echo "assets/images/food/" . $row['image']; ?> class="menu-img" alt="" />
                <div class="menu-content">
                  <?php echo $row['title']; ?><span><?php echo $row['price'] . "€"; ?></span>
                </div>
                <div class="menu-ingredients">
                  <?php echo $row['ingredients']; ?>
                </div>
                <div>
                  <button type="submit" value="<?php echo $row['id']; ?>" class="btn btn-default add-to-cart book-a-table-btn">
                    +<i class="fa fa-shopping-cart"></i></button>
                </div>
              </div>
          <?php }
            mysqli_free_result($result);
          } else {
            echo '0 result';
          } ?>
        </div>
      </div>
    </section><!-- End Menu Section -->

    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Reservation</h2>
          <p>Book a Table</p>
        </div>
        <form action="database/php-email-form.php" method="post" role="form" class="php-email-form" data-aos="fade-up" data-aos-delay="100">
          <div class="row">
            <div class="col-lg-4 col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" required>
              <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" required>
              <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
              <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone" data-rule="minlen:9;maxlen:9" data-msg="Please enter at least 9 chars" required>
              <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3">
              <input type="date" name="date" class="form-control" id="date" placeholder="Date" required>
              <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3">
              <input type="time" class="form-control" name="time" id="time" placeholder="Time" min="12:00" max="22:00" required pattern="[0-9]{2}:[0-9]{2}">
              <div class="validate"></div>
            </div>
            <div class="col-lg-4 col-md-6 form-group mt-3">
              <input type="number" class="form-control" name="people" id="people" placeholder="# of people" data-rule="minlen:1" data-msg="Please enter at least 1 chars" required>
              <div class="validate"></div>
            </div>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
            <div class="validate"></div>
          </div>
          <div class="mb-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your booking request was sent. We will call back or send an Email to confirm your reservation. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Book a Table</button></div>
        </form>
      </div>
    </section><!-- End Book A Table Section -->

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

<script>
  // Make the AJAX call to add the product to the cart
  $('.add-to-cart').click(function(params) {
    params.preventDefault();

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    ?>

      var val = $(this).val(); // Get the value of the button (which is the menu item ID)
      var orderDate = new Date().toISOString(); // Get the current time and date in ISO format

      $.post("database/add_update_delete_product.php", {
          case: "add",
          menuItemId: val
        })
        .done(function(data) {
          console.log(data);
          // window.location.reload();
        });

    <?php    } else {
    ?>
      if (window.confirm('You need to login/sign up first to add any product to cart. \n If you click "ok" you would be redirected.')) {
        window.location.href = 'login.php';
      };
    <?php    } ?>
  });
</script>

</html>