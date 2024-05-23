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

  <title>Cart Page</title>
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
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <div style="display: flex;">
        <a class="nav-link" href="login.php" id="Login" style="display: inline;">Login</a>
        <a class="nav-link" href="database/logout.php" id="Logout" style="display: none;">Logout</a>
        <a href="index.php" class="book-a-table-btn d-none d-lg-flex">Book a table</a>
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

  <main id="main">
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Cart Page</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Cart Page</li>
          </ol>
        </div>

      </div>
    </section>

    <section class="inner-page">
      <div class="container">

        <section id="menu" class="menu section-bg">
          <div class="container" data-aos="fade-up">

            <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
              <?php

              include('database/config.php');

              if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $GLOBALS['shipping'] = 10.0;
                $GLOBALS['tax'] = 13.0;
                $GLOBALS['total'] = 0.0;

                $email = $_SESSION['email'];

                $sql = "SELECT c.*, c.id as food_id, mi.image as image, mi.title as title, mi.price as price
            FROM cart c
            LEFT JOIN menu_items mi
            ON c.menuItemId = mi.id
            AND c.userEmail = '$email'
            ORDER BY c.id";

                if ($result = mysqli_query($db, $sql)) {
                  while ($row = mysqli_fetch_object($result)) {

                    $GLOBALS['total'] = $GLOBALS['total'] + ($row->quantity * $row->total_price);
              ?>
                    <div class="col-lg-6 menu-item">
                      <img src=<?php echo "assets/images/food/" . $row->image; ?> class="menu-img" alt="" />
                      <div class="menu-content">
                        <?php echo $row->title; ?><span><?php echo $row->price . "€"; ?></span>
                      </div>
                      <div class="menu-ingredients">
                        <?php echo "Quantity: " . $row->quantity; ?>
                      </div>
                      <div>
                        <button type="submit" value="<?php echo $row->id; ?>" class="btn btn-default remove-btn book-a-table-btn">REMOVE</button>
                      </div>
                    </div>
                  <?php
                  } ?>
            </div>
          </div>
        </section><!-- End Menu Section -->


        <div class="cart__totals">
          <table class="totals">
            <tbody>
              <tr>
                <th class="align-left font-normal tertiary">Subtotal</th>
                <td class="align-right" id="subtotalP">$<?php echo floatval($GLOBALS['total']); ?></td>
              </tr>
              <tr>
                <th class="align-left font-normal tertiary">Shipping <small>(estimated)<small></th>
                <td class="align-right">$<?php echo floatval($GLOBALS['shipping']); ?></td>
              </tr>
              <tr>
                <th class="align-left font-normal tertiary">Tax <small>(estimated)<small></th>
                <td class="align-right">$<?php echo floatval($GLOBALS['tax']); ?></td>
              </tr>
              <tr>
                <th class="align-left">Total</th>
                <td class="align-right" id="totalP"><b>$<?php echo floatval($GLOBALS['total'] + $GLOBALS['shipping'] + $GLOBALS['tax']); ?></b></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2" class="tertiary"><small>Estimations based on New York, United States</small></td>
              </tr>
            </tfoot>
          </table>
          <div class="form__footer">
            <a href="index.php" type="button" class="book-a-table-btn d-none d-lg-flex text-center col-lg-4 col-md-6 form-group mt-3 mt-md-0">Continue Shopping</a>
            <a href="index.php" type="button" id="checkout" class="book-a-table-btn d-none d-lg-flex text-center col-lg-4 col-md-6 form-group mt-3 mt-md-0" type='submit'>Checkout</a>
          </div>
        </div>
      <?php
                } else {
      ?>
        <div class="cart__totals">
          <p>There is nothing in this cart.</p>
          <div class="form__footer">
            <a href="index.php" type="button" class="book-a-table-btn d-none d-lg-flex">Continue Shopping</a>
          </div>
        </div>
      <?php
                }
              } else {
      ?>
      <div class="cart__totals">
        <p>There is nothing in this cart.</p>
        <p>Please login first.</p>
        <div class="form__footer">
          <a href="index.php" type="button" class="book-a-table-btn d-none d-lg-flex">Continue Shopping</a>
        </div>
      </div>
    <?php
              } ?>
    <!-- </form> -->
      </div>
    </section>
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

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
<script>
  $('.remove-btn').click(function(params) {
    params.preventDefault();

    var val = $(this).val();

    $.post("database/add_update_delete_product.php", {
        case: "delete",
        id: val
      })
      .done(function(data) {
        console.log(data);
      });
  });

  $('#checkout').click(function(params) {
    params.preventDefault();
    <?php
    $email = $_SESSION['email'];
    $sql = "SELECT c.*, c.id as food_id, mi.image as image, mi.title as title, mi.price as price
            FROM cart c
            LEFT JOIN menu_items mi
            ON c.menuItemId = mi.id
            AND c.userEmail = '$email'
            ORDER BY c.id";

    if ($result = mysqli_query($db, $sql)) {
      while ($row = mysqli_fetch_object($result)) {

        $id = $row->food_id;
        $query = "DELETE FROM cart WHERE cart.id='$id'";
        if ($db->query($query)) {
    ?>
          alert("Your order is on the way!!");
          location.reload();
    <?php
        } else {
          echo "Error updating record: " . $db->error;
        }
      }
    } else {
      echo "Error";
    }
    ?>
  });
</script>