<?php
session_start();
$_SESSION['unmatchOPT'] = 0;
if (isset($_SESSION['otp']) && isset($_SESSION['otp_expiry'])) {
    $otpSent = $_SESSION['otp'];
    $user_input_otp = $_POST['otp']; // OTP entered by the user
    $_SESSION['user_input_otp'] = $user_input_otp;

    // Check if OTP has expired
    if (time() > $_SESSION['otp_expiry']) {
        echo "OTP expired!";
    } else if ($user_input_otp == $otpSent) {
        // If OTP is correct, proceed to the index page
        unset($_SESSION['otp']);
        unset($_SESSION['otp_expiry']);
        $_SESSION['loggedin'] = true;
        $_SESSION['successfullyAuthenticated'] = true;
        $_SESSION['showWelcome'] = true;
        if($_SESSION['user'] == "customer"){
            header("Location: ../Index/index.php");
        }
        if($_SESSION['user'] == "worker"){
            header("Location: ../worker/booking_request.php");
        }

        exit;
    } else {
        $_SESSION['unmatchOPT'] = 1;
        header("Location: two_Factor.php");
    }
}
?>