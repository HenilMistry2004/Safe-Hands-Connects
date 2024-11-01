<?php
session_start();
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

    <title>Safe Hands Connects</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> <!-- Make sure the path is correct -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php
    include '../PopupNotification/popupNotification.php';
    include '../UserDetails/userDetails.php';
    ?>

    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- Logo Start -->
                        <div class="logo">
                            <a href="#" class="logo">
                                <img src="../assets/images/logo.png" style="width: 70px; height: 70px;">
                            </a>
                        </div>
                        <div style="margin-left: 105px; padding-top: 30px;">
                            <h3 style="color: #03a4ed;">Safe Hands Connects</h3>
                        </div>

                        <ul class="nav">
                            <li class="scroll-to-section"><a href="../Index/index.php" class="active">Home</a></li>

                            <?php
                            // Check if user is authenticated and has passed 2FA
                            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['successfullyAuthenticated']) && $_SESSION['successfullyAuthenticated'] === true) {
                                // Check if customer with 2FA enabled
                                if (isset($_SESSION['cEmail_ID']) && $_SESSION['twoFactor'] == 1) {
                                    if ($_SESSION['OTP'] == $_SESSION['user_input_otp']) {
                            ?>
                                        <li class="scroll-to-section"><a href="../Booking/show_booking.php">Show Orders</a></li>
                                        <li class="scroll-to-section"><a href="../Service/service.php">Services</a></li>
                                        <li>
                                            <div class="userDetails" id="UserDetails" style="cursor: pointer; background-color: beige; border: 2px solid black; height: 50px; width: 50px; border-radius: 50px;">
                                                <?php echo "<p style='margin-top: 1px; margin-left: 2px; font-size: 30px;'>" . substr($_SESSION['cName'], 0, 1) . "</p>"; ?>
                                            </div>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="scroll-to-section"><a href="../Booking/show_booking.php">Show Orders</a></li>
                                        <li class="scroll-to-section"><a href="../Service/service.php">Services</a></li>
                                        <li>
                                            <div class="userDetails" id="UserDetails" style="cursor: pointer; background-color: beige; border: 2px solid black; height: 50px; width: 50px; border-radius: 50px;">
                                                <?php echo "<p style='margin-top: 1px; margin-left: 2px; font-size: 30px;'>" . substr($_SESSION['cName'], 0, 1) . "</p>"; ?>
                                            </div>
                                        </li>
                                    <?php
                                    }
                                } elseif (isset($_SESSION['cEmail_ID']) && $_SESSION['twoFactor'] == 0) {
                                    // 2FA disabled
                                    ?>
                                    <li class="scroll-to-section"><a href="../Booking/show_booking.php">Show Orders</a></li>
                                    <li class="scroll-to-section"><a href="../Service/service.php">Services</a></li>
                                    <li>
                                        <div class="userDetails" id="UserDetails" style="cursor: pointer; background-color: beige; border: 2px solid black; height: 50px; width: 50px; border-radius: 50px;">
                                            <?php echo "<p style='margin-top: 1px; margin-left: 2px; font-size: 30px;'>" . substr($_SESSION['cName'], 0, 1) . "</p>"; ?>
                                        </div>
                                    </li>

                                <?php
                                } elseif (isset($_SESSION['eEmail_ID']) && $_SESSION['twoFactor'] == 1) {
                                    if (isset($_SESSION['OTP']) && isset($_SESSION['user_input_otp']) && ($_SESSION['OTP'] == $_SESSION['user_input_otp'])) {
                                ?>
                                        <li class="scroll-to-section"><a href="../worker/show_accept_booking.php">Accepted Requests</a></li>
                                        <li class="scroll-to-section"><a href="../worker/booking_request.php">Bookings Requested</a></li>
                                        <li>
                                            <div class="userDetails" id="UserDetails" style="cursor: pointer; background-color: beige; border: 2px solid black; height: 50px; width: 50px; border-radius: 50px;">
                                                <?php echo "<p style='margin-top: 1px; margin-left: 2px; font-size: 30px;'>" . substr($_SESSION['eName'], 0, 1) . "</p>"; ?>
                                            </div>
                                        </li>
                                    <?php
                                    } else {
                                        // Incorrect OTP or logic error
                                    }
                                } elseif (isset($_SESSION['eEmail_ID']) && $_SESSION['twoFactor'] == 0) {
                                    // 2FA disabled for worker
                                    ?>
                                    <li class="scroll-to-section"><a href="../worker/show_accept_booking.php">Accepted Requests</a></li>
                                    <li class="scroll-to-section"><a href="../worker/booking_request.php">Bookings Requested</a></li>
                                    <li>
                                        <div class="userDetails" id="UserDetails" style="cursor: pointer; background-color: beige; border: 2px solid black; height: 50px; width: 50px; border-radius: 50px;">
                                            <?php echo "<p style='margin-top: 1px; margin-left: 0px; font-size: 30px;'>" . substr($_SESSION['eName'], 0, 1) . "</p>"; ?>
                                        </div>
                                    </li>
                            <?php
                                }
                            } else {
                                // If no user is logged in
                            ?>
                                <li class="scroll-to-section"><a href="../Service/service.php">Services</a></li>
                                <li class="scroll-to-section">
                                    <div class="main-red-button"><a href="../Login/login.php">Login</a></div>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- Navigation End -->
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Scripts -->
    <script src="../vendor/jquery/jquery.min.js"></script> <!-- Make sure the path is correct -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script> <!-- Make sure the path is correct -->
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/animation.js"></script>
    <script src="../assets/js/imagesloaded.js"></script>
    <script src="../assets/js/templatemo-custom.js"></script>

</body>

</html>