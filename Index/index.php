<?php

error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <title>Space Dynamic - SEO HTML5 Template</title>

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="../assets/css/fontawesome.css">
  <link rel="stylesheet" href="../assets/css/templatemo-space-dynamic.css">
  <link rel="stylesheet" href="../assets/css/animated.css">
  <link rel="stylesheet" href="../assets/css/owl.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Include jQuery at the beginning of the head -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#UserDetails').click(function() {
        $('.viewDetails').toggle(); // Toggle the visibility of .viewDetails
      });
    });
  </script>
</head>

<body>

  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>

  <?php
  include '../Header_Footer/header.php';
  ?>

  <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
    <div class="container" style="margin-top: -125px; padding-bottom: 0;">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6 align-self-center">
              <div class="left-content header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                <h6>Safe Hands Connects</h6>

                <h2>Your <em>Fastest</em> Route<br>
                  To Reliable <span>Household</span> Assistance</h2>
                <p>Contact Us Today to Connect with Trusted Workers.</p>
                <form id="search" action="../Service/service.php" method="GET">

                  <button type="submit" class="main-button">Book Now</button>
                </form>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                <img src="../assets/images/chef.png" alt="team meeting" style="height: 600px;width: 570px;margin-left: 45px;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="portfolio" class="our-portfolio section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <div class="section-heading  wow bounceIn" data-wow-duration="1s" data-wow-delay="0.2s">
            <h2>See <em>What</em> We <span>Provide</span></h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.3s">
              <div class="hidden-content">
                <h4>Housekeeper</h4>
                <p>Feel the happiness of coming back to a super clean home thanks to our hardworking housekeepers.</p>
              </div>
              <div class="showed-content">
                <img src="../assets/images/S_box1.jpg" style="height: 110px;" alt="">
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.4s">
              <div class="hidden-content">
                <h4>Babysitter</h4>
                <p>Enjoy worry-free time away while our caring babysitters engage and nurture your little ones</p>
              </div>
              <div class="showed-content">
                <img src="../assets/images/S_box2.webp" style="height: 110px;" alt="">
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.5s">
              <div class="hidden-content">
                <h4>Security Guard</h4>
                <p>Rest assured knowing your property is under the watchful eye of our trained security guards.</p>
              </div>
              <div class="showed-content">
                <img src="../assets/images/S_box3.png" style="height: 110px;" alt="">
              </div>
            </div>
          </a>
        </div>
        <div class="col-lg-3 col-sm-6">
          <a href="#">
            <div class="item wow bounceInUp" data-wow-duration="1s" data-wow-delay="0.6s">
              <div class="hidden-content">
                <h4>Cook</h4>
                <p>Our cooks are trained to work efficiently, ensuring that each meal is prepared to perfection and served promptly .</p>
              </div>
              <div class="showed-content">
                <img src="../assets/images/coock_image.png" style="height: 110px;" alt="">
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>

  <?php
  include '../Header_Footer/footer.php';
  ?>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/owl-carousel.js"></script>
  <script src="../assets/js/animation.js"></script>
  <script src="../assets/js/imagesloaded.js"></script>
  <script src="../assets/js/templatemo-custom.js"></script>

</body>

</html>