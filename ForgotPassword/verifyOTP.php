<?php
session_start();

if (isset($_POST['otp'])) {
    $userOtp = $_POST['otp'];
    $_SESSION['unSuccessfullOTP'] = 0;
    
    // Ensure OTP and expiry are set in session
    if (isset($_SESSION['FPotp']) && isset($_SESSION['FPotp_expiry'])) {
        $generatedOtp = $_SESSION['FPotp'];  // Retrieve OTP from session
        $otpExpiry = $_SESSION['FPotp_expiry'];  // Retrieve OTP expiry time

        // Check if the OTP matches and has not expired
        if ($userOtp == $generatedOtp && time() < $otpExpiry) {
            echo 'success';  // OTP is valid
            // Optionally unset session variables to avoid reusing the OTP
            unset($_SESSION['FPotp']);
            unset($_SESSION['FPotp_expiry']);
        } else {
            echo 'failure';  // Invalid OTP or expired
        }
    } else {
        echo 'failure';  // OTP session variables are not set
    }
} else {
    echo 'failure';  // OTP not provided
}
?>
