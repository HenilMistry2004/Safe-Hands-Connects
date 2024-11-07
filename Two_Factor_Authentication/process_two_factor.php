<?php
session_start();
$_SESSION['unmatchOPT'] = 0;

include '../connection/connection.php';

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

        if ($_SESSION['user'] == "customer") {
            // Ensure two-factor email and password are set
            if (isset($_SESSION['twoFacterEmail'], $_SESSION['twoFacterPassword'])) {
                // Customer query
                $cusQuery = "SELECT * FROM customer WHERE customer_email_id = ? AND customer_password = ? AND status = 'active'";
                $stmtCus = $conn->prepare($cusQuery);
                $stmtCus->bind_param("ss", $_SESSION['twoFacterEmail'], $_SESSION['twoFacterPassword']);
                $stmtCus->execute();
                $checkCustomer = $stmtCus->get_result();

                if ($checkCustomer->num_rows > 0) {
                    $row = $checkCustomer->fetch_assoc();
                    $_SESSION['cName'] = $row['customer_name'];
                    $_SESSION['cEmail_ID'] = $row['customer_email_id'];
                    $_SESSION['userId'] = $row['customer_id'];
                    $_SESSION['customer_id'] = $row['customer_id'];
                    $_SESSION['userPassword'] = $row['customer_password'];
                    $_SESSION['userContactNumber'] = $row['customer_contact_no'];
                    $_SESSION['userAddress'] = $row['customer_address'];
                    $_SESSION['userGender'] = $row['customer_gender'];
                    $_SESSION['userDOB'] = $row['customer_dob'];
                    $_SESSION['loginMessage'] = $_SESSION['loginMessage'] ?? 0;
                    $_SESSION['loginMessage']++;

                    header("Location: ../Index/index.php");
                    exit;
                } else {
                    $_SESSION['inactiveCustomer'] = 1;
                    header("Location: two_Factor.php");
                    exit;
                }
            }
        } elseif ($_SESSION['user'] == "worker") {
            // Ensure two-factor email and password are set for worker
            if (isset($_SESSION['twoFacterWorkerEmail'], $_SESSION['twoFacterWorkerPassword'])) {
                // Employee query
                $empQuery = "SELECT * FROM worker WHERE worker_email_id = ? AND worker_password = ? AND status = 'active'";
                $stmtEmp = $conn->prepare($empQuery);
                $stmtEmp->bind_param("ss", $_SESSION['twoFacterWorkerEmail'], $_SESSION['twoFacterWorkerPassword']);
                $stmtEmp->execute();
                $checkEmployee = $stmtEmp->get_result();

                if ($checkEmployee->num_rows > 0) {
                    $row1 = $checkEmployee->fetch_assoc();
                    $_SESSION['eName'] = $row1['worker_name'];
                    $_SESSION['eEmail_ID'] = $row1['worker_email_id'];
                    $_SESSION['loggedin'] = true;
                    $_SESSION['empId'] = $row1['worker_id'];
                    $_SESSION['loginMessage'] = $_SESSION['loginMessage'] ?? 0;
                    $_SESSION['loginMessage']++;

                    header("Location: ../worker/booking_request.php");
                    exit;
                } else {
                    header("Location: two_Factor.php");
                    exit;
                }
            }
        }
    } else {
        $_SESSION['unmatchOPT'] = 1;
        header("Location: two_Factor.php");
        exit;
    }
}
?>
