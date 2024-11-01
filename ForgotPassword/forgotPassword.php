<?php
include '../PopupNotification/popupNotification.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Forgot Password</title>

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
    <div id="contact" class="contact-us section" style="margin-top: 100px;padding-top: 110px;padding-bottom: 110px;height: 650px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 align-self-center " data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <!-- Placeholder for any left content -->
                </div>

                <div class="col-lg-6 " data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <!-- Display Error Message if it exists -->
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <!-- <div class="alert alert-danger" role="alert">
                            <?php
                            // echo $_SESSION['error_message'];
                            // unset($_SESSION['error_message']); // Clear error message after displaying it
                            ?>
                        </div> -->
                    <?php endif; ?>

                    <form id="contact" action="process_forgot_password.php" method="post" style="width: 360px;height: 373px;">
                        <div class="row" style="margin-top: 35px;">
                            <h4 style="margin-top: -55px; margin-left: 5px;">Reset Password</h4>
                            
                            <div class="col-lg-12" style="margin-top: 5px;margin-bottom: 20px;">
                                <fieldset>
                                    <label for="role">Select Role</label>
                                    <select class="form-control" name="role" id="role" required>
                                        <option value="">-- Select Role --</option>
                                        <option value="customer">Customer</option>
                                        <option value="worker">Worker</option>
                                    </select>
                                </fieldset>
                            </div>

                            <div class="col-lg-12" style="margin-top: 5px;">
                                <fieldset>
                                    <div class="input-group">
                                        <label class="placeholder" for="email">Enter Email</label>
                                        <input class="form-control" name="email" id="email" type="email" required>
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-button" style="width: 301px;">Submit</button>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset style="display: flex;">
                                    <label for="rememberMe" style="margin-top: 20px; margin-left: 5px;"><a href="../Login/login.php">Return To Login</a></label>
                                </fieldset>
                            </div>
                        </div>
                        <div class="contact-dec">
                            <img src="assets/images/contact-decoration.png" alt="">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
