<?php
// session_start();  // Start session to access session variables
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
    <style>
        .hidden {
            display: none;
        }

        .form-control:focus {
            border-color: red;
            box-shadow: 0 0 0 0rem transparent;
        }
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // OTP Verification
        $('#verify-otp-btn').on('click', function() {
            var otp = $('#otp').val(); // Get the entered OTP

            $.ajax({
                url: 'verifyOTP.php', // Server-side script to verify OTP
                type: 'POST',
                data: {
                    otp: otp
                },
                success: function(response) {
                    if (response === 'success') {
                        $('#message').html('<div class="alert alert-success">OTP verified. You can now reset your password.</div>');
                        $('#otp-form').hide(); // Hide OTP input section
                        $('#password-section').removeClass('hidden'); // Show password reset fields
                    } else {
                        $('#message').html('<div class="alert alert-danger">Invalid OTP or OTP has expired. Please try again.</div>');
                        showPopup("Invalid OTP or OTP has expired. Please try again.", true); // Error notification
                    }
                },
                error: function() {
                    $('#message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
                }
            });
        });

        // Password Reset
        $('#reset-password-btn').on('click', function() {
            var newPassword = $('#new-password').val();
            var confirmPassword = $('#confirm-password').val();

            if (newPassword !== confirmPassword) {
                showPopup("Passwords do not match. Please try again.", true); // Error notification
                return;
            }

            $.ajax({
                url: 'update_password.php', // Server-side script to update the password
                type: 'POST',
                data: {
                    new_password: newPassword
                },
                success: function(response) {
                    showPopup("Password updated successfully!", false); // Success notification
                        setTimeout(function() {
                            window.location.href = '../Login/login.php';
                        }, 5000);
                },
                error: function() {
                    showPopup("Error updating password. Please try again.", true); // Error notification
                }
            });
        });
    });
</script>

<body>
    <?php  ?>


    <div id="contact" class="contact-us section" style="margin-top: 100px;padding-top: 110px;padding-bottom: 110px;height: 650px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <!-- Placeholder for any left content -->
                </div>

                <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <!-- Display Error Message if it exists -->
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            echo $_SESSION['error_message'];
                            unset($_SESSION['error_message']); // Clear error message after displaying it
                            ?>
                        </div>
                    <?php endif; ?>

                    <div id="password-section" class="hidden" style="background-color: #ffff;width: 343px;height: 287px;padding: 30px;border-radius: 21px;">
                        <form id="password-form" method="post">
                            <div class="form-group">
                                <label for="new-password">New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new-password" placeholder="New Password" required style="width: 100%; height: 46px; border-radius: 33px; background-color: #d1f3ff; border: none; outline: none; font-size: 15px; font-weight: 300; color: #2a2a2a;padding: 0px 20px; margin-bottom: 20px;">
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm-password" placeholder="Confirm Password" required style="width: 100%; height: 46px; border-radius: 33px; background-color: #d1f3ff; border: none; outline: none; font-size: 15px; font-weight: 300; color: #2a2a2a;padding: 0px 20px; margin-bottom: 20px;">
                            </div>
                            <button type="button" id="reset-password-btn" class="btn btn-success btn-block" style="display: inline-block; background-color: #03a4ed; font-size: 15px; font-weight: 400; color: #fff;width: 283px; text-transform: capitalize; padding: 12px 25px; border-radius: 23px; letter-spacing: 0.25px; border: none;outline: none; transition: all .3s;">Reset Password</button>
                        </form>
                    </div>

                    <!-- <div id="message" class="mt-3">
                    </div> -->
                    <div class="text-center mt-3">
                        <a href="../Login/login.php">Return To Login</a>
                    </div>

                    <form id="otp-form" method="post" style="height: 272px;background-color: #ffff;padding-top: 45px;width: 346px;border-radius: 30px;">
                        <div class="row" style="margin-top: 35px;">
                            <h4 style="margin-top: -55px; margin-left: 65px;">OTP Verification</h4>

                            <div class="col-lg-12" style="margin-top: 5px;width: 300px;margin-left: 30px;">
                                <fieldset>
                                    <div class="input-group">
                                        <label class="placeholder" for="email">Enter OTP</label>
                                        <input type="text" class="form-control" name="otp" id="otp" onkeypress="return /[0-9]/i.test(event.key)" minlength="4" maxlength="4" required style="border-radius: 43px; background-color: #d1f3ff; border: 2px solid #d1f3ff">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-12" style="margin-left: 30px;">
                                <fieldset>
                                    <button type="button" id="verify-otp-btn" class="btn btn-primary btn-block" style="width: 278px;border-radius: 20px;">Verify OTP</button>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset style="display: flex;">
                                    <label for="rememberMe" style="margin-top: 20px; margin-left: 30px;"><a href="../Login/login.php">Return To Login</a></label>
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