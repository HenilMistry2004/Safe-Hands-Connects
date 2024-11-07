<?php
session_start();

$_SESSION['inactiveEmployee'] = 0;
$_SESSION['inactiveCustomer'] = 0;

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login Handling</title>
</head>

<body>

    <?php
    // For connection
    include '../connection/connection.php';

    // Initialize session variables
    $_SESSION['loginMessage'] = 0;
    $_SESSION['request'] = 0;

    $email = $_POST['email'];
    $password = $_POST['userPassword'];
    $_SESSION['twoFactor'] = null;
    $_SESSION['loggedin'] = false;
    // After successful login or two-factor authentication:
    $_SESSION['showWelcome'] = false; // Set the flag to show the welcome message on the next page load


    try {
        // Use password hashing for security
        $encPass = md5($password); // Replace with password_hash($password, PASSWORD_DEFAULT) if storing securely in the future.

        // Employee query
        $empQuery = "SELECT * FROM worker WHERE worker_email_id = ? AND worker_password = ? AND status = 'active'";
        $stmtEmp = $conn->prepare($empQuery);
        $stmtEmp->bind_param("ss", $email, $encPass);
        $stmtEmp->execute();
        $checkEmployee = $stmtEmp->get_result();

        // Customer query
        $cusQuery = "SELECT * FROM customer WHERE customer_email_id = ? AND customer_password = ? AND status = 'active'";
        $stmtCus = $conn->prepare($cusQuery);
        $stmtCus->bind_param("ss", $email, $encPass);
        $stmtCus->execute();
        $checkCustomer = $stmtCus->get_result();

        // Employee query
        $empIAQuery = "SELECT * FROM worker WHERE worker_email_id = ? AND status = 'Inactive'";
        $stmtIAEmp = $conn->prepare($empIAQuery);
        $stmtIAEmp->bind_param("s", $email);
        $stmtIAEmp->execute();
        $checkIAEmployee = $stmtIAEmp->get_result();


        // Customer query
        $cusIAQuery = "SELECT * FROM customer WHERE customer_email_id = ? AND status = 'Inactive'";
        $stmtIACus = $conn->prepare($cusIAQuery);
        $stmtIACus->bind_param("s", $email);
        $stmtIACus->execute();
        $checkIACustomer = $stmtIACus->get_result();


        // Admin query
        $adminQuery = "SELECT * FROM admin WHERE admin_email_id = ? AND admin_password = ?";
        $stmtAdmin = $conn->prepare($adminQuery);
        $stmtAdmin->bind_param("ss", $email, $password);  // Ensure password is hashed in your database for consistency
        $stmtAdmin->execute();
        $checkAdmin = $stmtAdmin->get_result();

        // Request query
        $requestQuery = "SELECT * FROM worker WHERE worker_email_id = ? AND worker_password = ? AND status = 'requested'";
        $stmtReq = $conn->prepare($requestQuery);
        $stmtReq->bind_param("ss", $email, $encPass);
        $stmtReq->execute();
        $checkRequest = $stmtReq->get_result();

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === false) {
            if ($checkIACustomer->num_rows > 0) {
                $_SESSION['inactiveCustomer'] = 1;
            }
            if ($checkIAEmployee->num_rows > 0) {
                $_SESSION['inactiveEmployee'] = 1;
            }
            // Handle different user types
            if ($checkCustomer->num_rows > 0) {
                $row = $checkCustomer->fetch_assoc();
                $_SESSION['twoFactor'] = $row['isTwoFactorEnable'];

                if ($_SESSION['twoFactor'] == 1) {
                    $_SESSION['otp'] = rand(1000, 9999); // Generate a 4-digit OTP
                    $_SESSION['otp_expiry'] = time() + 300; // OTP valid for 5 minutes

                    $_SESSION['twoFacterEmail'] = $email;
                    $_SESSION['twoFacterPassword'] = $encPass;
                    $_SESSION['user'] = "customer";

                    $otp = $_SESSION['otp'];
                    $email = $_SESSION['twoFacterEmail'];
                    require '../SMTP/MailClass.php';
                    $_SESSION['successfullyAuthenticated'] = false;
                    $_SESSION['OTP'] = $otp;
                    $message_for_customer = "<html>
                                                <head>
                                                    <style>
                                                        body {
                                                            font-family: Arial, sans-serif;
                                                            background-color: #f4f4f4;
                                                            margin: 0;
                                                            padding: 0;
                                                        }
                                                        .email-container {
                                                            width: 100%;
                                                            max-width: 600px;
                                                            margin: 0 auto;
                                                            background-color: #ffffff;
                                                            border-radius: 8px;
                                                            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
                                                        }
                                                        .header {
                                                            background-color: #4CAF50;
                                                            padding: 20px;
                                                            color: #ffffff;
                                                            text-align: center;
                                                            font-size: 24px;
                                                        }
                                                        .content {
                                                            padding: 20px;
                                                            text-align: center;
                                                        }
                                                        .content h2 {
                                                            color: #333;
                                                        }
                                                        .otp-code {
                                                            font-size: 24px;
                                                            font-weight: bold;
                                                            color: #4CAF50;
                                                            margin: 20px 0;
                                                        }
                                                        .footer {
                                                            background-color: #f4f4f4;
                                                            padding: 10px;
                                                            text-align: center;
                                                            font-size: 12px;
                                                            color: #888;
                                                        }
                                                        .image-container {
                                                            margin: 20px 0;
                                                            align-items: center;
                                                            width: 25%;
                                                            height: 25%;
                                                            padding-left: 35%;
                                                        }
                                                    </style>
                                                </head>
                                                <body>
                                                    <div class='email-container'>
                                                        <div class='header'>
                                                            Safe Hands Connect
                                                        </div>
                                                        <div class='content'>
                                                            <h2>Hello,</h2>
                                                            <p>Here is your One-Time Password (OTP) for login:</p>
                                                            <div class='otp-code'>$otp</div>
                                                            <p>Please use this code to complete your login process. This code is valid for 10 minutes.</p>
                                                            <div class='image-container'>
                                                                <img src='http://www.myhopeforever.org/uploads/7/7/8/1/7781319/published/urgent-needs.png?1494377996' alt='Mail Image' style='width:100%; max-width:300px;'>
                                                            </div>
                                                        </div>
                                                        <div class='footer'>
                                                            &copy; 2024 Safe Hands Connect. All Rights Reserved.
                                                        </div>
                                                    </div>
                                                </body>
                                            </html>";
                    if(sendEmail($email, '', 'Safe Hands Connect', $message_for_customer)){
                        header('Location: ../Two_Factor_Authentication/two_Factor.php');
                        exit;
                    } else {
                        echo "Failed to send OTP email. Please try again.";
                        exit;
                    }
                    // header('Location: ../Two_Factor_Authentication/two_Factor.php');
                    exit;
                } else {

                    $_SESSION['cName'] = $row['customer_name'];
                    $_SESSION['cEmail_ID'] = $row['customer_email_id'];
                    $_SESSION['userId'] = $row['customer_id'];
                    $_SESSION['customer_id'] = $row['customer_id'];
                    $_SESSION['userPassword'] = $row['customer_password'];
                    $_SESSION['userContactNumber'] = $row['customer_contact_no'];
                    $_SESSION['userAddress'] = $row['customer_address'];
                    $_SESSION['userGender'] = $row['customer_gender'];
                    $_SESSION['userDOB'] = $row['customer_dob'];
                    $_SESSION['loginMessage']++;
                    $_SESSION['user'] = "customer";

                    $_SESSION['loggedin'] = true;
                    header('Location: ../Index/index.php');
                    exit;
                }
            } else if ($checkEmployee->num_rows > 0) {
                $row1 = $checkEmployee->fetch_assoc();
                
                $_SESSION['twoFactor'] = $row1['isTwoFactorEnable'];
                
                $_SESSION['user'] = "worker";
                if ($_SESSION['twoFactor'] == 1) {
                    $_SESSION['twoFacterWorkerEmail'] = $email;
                    $_SESSION['loggtwoFacterWorkerPassword'] = $encPass;
                    
                    $_SESSION['otp'] = rand(1000, 9999); // Generate a 4-digit OTP
                    $_SESSION['otp_expiry'] = time() + 300; // OTP valid for 5 minutes

                    $otp = $_SESSION['otp'];
                    $email = $_SESSION['twoFacterWorkerEmail'];

                    $_SESSION['loggedin'] = false;
                    $_SESSION['successfullyAuthenticated'] = false;

                    require '../SMTP/MailClass.php';
                    $_SESSION['OTP'] = $otp;
                    $message = "<html>
                                    <head>
                                        <style>
                                            body {
                                                font-family: Arial, sans-serif;
                                                background-color: #f4f4f4;
                                                margin: 0;
                                                padding: 0;
                                            }
                                            .email-container {
                                                width: 100%;
                                                max-width: 600px;
                                                margin: 0 auto;
                                                background-color: #ffffff;
                                                border-radius: 8px;
                                                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
                                            }
                                            .header {
                                                background-color: #4CAF50;
                                                padding: 20px;
                                                color: #ffffff;
                                                text-align: center;
                                                font-size: 24px;
                                            }
                                            .content {
                                                padding: 20px;
                                                text-align: center;
                                            }
                                            .content h2 {
                                                color: #333;
                                            }
                                            .otp-code {
                                                font-size: 24px;
                                                font-weight: bold;
                                                color: #4CAF50;
                                                margin: 20px 0;
                                            }
                                            .footer {
                                                background-color: #f4f4f4;
                                                padding: 10px;
                                                text-align: center;
                                                font-size: 12px;
                                                color: #888;
                                            }
                                            .image-container {
                                                margin: 20px 0;
                                                align-items: center;
                                                width: 25%;
                                                height: 25%;
                                                padding-left: 35%;
                                            }
                                        </style>
                                    </head>
                                    <body>
                                        <div class='email-container'>
                                            <div class='header'>
                                                Safe Hands Connect
                                            </div>
                                            <div class='content'>
                                                <h2>Hello,</h2>
                                                <p>Here is your One-Time Password (OTP) for login:</p>
                                                <div class='otp-code'>$otp</div>
                                                <p>Please use this code to complete your login process. This code is valid for 10 minutes.</p>
                                                <div class='image-container'>
                                                    <img src='http://www.myhopeforever.org/uploads/7/7/8/1/7781319/published/urgent-needs.png?1494377996' alt='Mail Image' style='width:100%; max-width:300px;'>
                                                </div>
                                            </div>
                                            <div class='footer'>
                                                &copy; 2024 Safe Hands Connect. All Rights Reserved.
                                            </div>
                                        </div>
                                    </body>
                                </html>";
                    sendEmail($email, '', 'Safe Hands Connect', $message);

                    header('Location: ../Two_Factor_Authentication/two_Factor.php');
                    exit;
                } else {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['eName'] = $row1['worker_name'];
                    $_SESSION['eEmail_ID'] = $row1['worker_email_id'];
                    $_SESSION['loggedin'] = true;
                    $_SESSION['empId'] = $row1['worker_id'];
                    $_SESSION['loginMessage']++;
                    header('Location: ../Index/index.php');
                    // header('Location: login.php');
                    exit;
                }
            } else if ($checkAdmin->num_rows > 0) {
                $row = $checkAdmin->fetch_assoc();
                $_SESSION['adminEmailId'] = $row['admin_email_id'];
                $_SESSION['adminName'] = $row['admin_name'];
                $_SESSION['adminLoggedIn'] = true;
                $_SESSION['loginMessage']++;
                header('Location: ../deshboard/index.php');
                exit;
            } else if ($checkRequest->num_rows > 0) {
                $_SESSION['request']++;
                header('Location: login.php');
                exit;
            } else {
                // echo "No matching records found.";
                header('Location: login.php');
                exit;
            }
        } else {
            header('Location: login.php');
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
    }
    ?>
</body>

</html>