<?php error_reporting(0); include '../PopupNotification/popupNotification.php';?>
<!DOCTYPE html>
<html>

<head>
    <title>Login form with JavaScript Validation</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

    <link rel="stylesheet" href="../Login/login.css">
</head>

<body>
    <?php
    //  include '../Header_Footer/header.php'; 
    ?>

    <style>
        .form-control:focus {
            border-color: red;
            box-shadow: 0 0 0 0rem transparent;
        }
    </style>

<header class="header-area header-sticky " data-wow-duration="0.75s" data-wow-delay="0s">
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

                        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- Navigation End -->
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div id="contact" class="contact-us section" style="margin-top: 100px;padding-top: 110px;padding-bottom: 110px;height: 650px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 align-self-center" data-wow-duration="0.5s" data-wow-delay="0.25s">

                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="process_two_factor.php" method="post" style="width: 360px;height: 328px;">
                        <div class="row" style="margin-top: 35px;">
                            <h4 style="margin-top: -55px; margin-left: 5px;">Two Factor Verification</h4>
                            <div class="col-lg-6" style="width: 323px;margin-top: 5px;">
                                <fieldset>
                                    <div class="input-group">
                                        <label class="placeholder" for="Email">Enter OTP</label>
                                        <input class="form-control" name="otp" minlength="4" maxlength="4" onkeypress="return /[0-9]/i.test(event.key)" id="userName" type="text" placeholder="">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-6" style="width: 323px;">
                                <fieldset>
                                    <!-- <div class="input-group">
                                        <label for="userPassword" class="placeholder">Password</label>
                                        <input class="form-control" name="userPassword" id="userPassword" type="password" placeholder="">
                                        <span class="lighting"></span>
                                    </div> -->
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-button" style="width: 301px;">submit</button>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset style="display: flex;">
                                    <!-- <input id="rememberMe" type="checkbox" style="width: 10px;"> -->
                                    <label for="rememberMe" style="margin-top: 20px; margin-left: 5px;"><a href="../Login/login.php">Return To Login</a></label>
                                    <!-- <a class="forgot pull-right" href="#" style="margin-top: 10px; margin-left: 7px;">Forgot Password?</a> -->
                                </fieldset>
                            </div>
                        </div>
                        <div class="contact-dec">
                            <img src="assets/images/contact-decoration.png" alt="">
                        </div>
                        <!-- <div class="signup-wrapper text-center" style="padding: 0px; margin-left: -15px; margin-top: -12px;">
                            <a href="../Registration/registration_Option.php" style="cursor: pointer;">Don't have an account? <span class="text-primary">Create One</span></a>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Removed redundant wrapper section -->

    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js'></script>
    <script src="../Login/script.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/animation.js"></script>
    <script src="../assets/js/imagesloaded.js"></script>
    <script src="../assets/js/templatemo-custom.js"></script>

</body>

</html>