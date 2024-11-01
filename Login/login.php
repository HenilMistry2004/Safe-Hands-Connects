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

    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php include '../Header_Footer/header.php'; ?>

    <style>
        .form-control:focus {
            border-color: red;
            box-shadow: 0 0 0 0rem transparent;
        }
    </style>

    <div id="contact" class="contact-us section" style="margin-top: 100px; padding-top: 110px; padding-bottom: 110px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 align-self-center" data-wow-duration="0.5s" data-wow-delay="0.25s">

                </div>
                <div class="col-lg-6" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" action="login_Process1.php" method="post" style="width: 360px; height: 410px;">
                        <div class="row" style="margin-top: 35px;">
                            <h3 style="margin-top: -55px; margin-left: 105px;">Login</h3>
                            <div class="col-lg-6" style="width: 323px;">
                                <fieldset>
                                    <div class="input-group">
                                        <label class="placeholder" for="Email">Email</label>
                                        <input class="form-control" name="email" id="userName" type="text" placeholder="">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="col-lg-6" style="width: 323px;">
                                <fieldset>
                                    <div class="input-group">
                                        <label for="userPassword" class="placeholder">Password</label>
                                        <input class="form-control" name="userPassword" id="userPassword" type="password" placeholder="">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-button" style="width: 301px;">Login</button>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset style="display: flex;">
                                    <input id="rememberMe" type="checkbox" style="width: 10px;">
                                    <label for="rememberMe" style="margin-top: 10px; margin-left: 5px;">Remember Me</label>
                                    <a class="forgot pull-right" href="../ForgotPassword/forgotPassword.php" style="margin-top: 10px; margin-left: 7px;">Forgot Password?</a>
                                </fieldset>
                            </div>
                        </div>
                        <div class="contact-dec">
                            <img src="assets/images/contact-decoration.png" alt="">
                        </div>
                        <div class="signup-wrapper text-center" style="padding: 0px; margin-left: -15px; margin-top: -12px;">
                            <a href="../Registration/registration_Option.php" style="cursor: pointer;">Don't have an account? <span class="text-primary">Create One</span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Removed redundant wrapper section -->

    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js'></script>
    <script src="./script.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/animation.js"></script>
    <script src="../assets/js/imagesloaded.js"></script>
    <script src="../assets/js/templatemo-custom.js"></script>

</body>

</html>