<?php
session_start();
require '../connection/connection.php';  // Include your database connection
require '../SMTP/MailClass.php';  // Include your mail class for sending emails

$_SESSION['roleNotExist'] = 0;
$_SESSION['emailDoesNotExist'] = 0;
$_SESSION['emailInactive'] = 0;

if (isset($_POST['email']) && isset($_POST['role'])) {
    $email = $_POST['email'];
    $role = $_POST['role'];
    

    // Check if role is customer or worker
    if ($role === 'customer') {
        // Search for email in customer table
        $sql = "SELECT * FROM customer WHERE customer_email_id = ?";
        $_SESSION['role'] = "customer";
    } elseif ($role === 'worker') {
        // Search for email in worker table
        $sql = "SELECT * FROM worker WHERE worker_email_id = ?";
        $_SESSION['role'] = "worker";
    } else {
        $_SESSION['error_message'] = 'Invalid role selected.';
        header("Location: forgotPassword.php");
        exit;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user's data
        $row = $result->fetch_assoc(); // Fetch the user data

        // Check if the account is active
        if ($row['status'] == 'active') {  // Ensure you're checking the correct status field
            // Generate random OTP and store it in session
            $_SESSION['FPotp'] = rand(1000, 9999);  // Random 4-digit OTP
            $_SESSION['FPotp_expiry'] = time() + 300;  // OTP expires in 5 minutes

            // Store OTP in session
            $otp = $_SESSION['FPotp'];

            // Set user ID in session based on role
            if($role == 'customer'){
                $_SESSION['FPUID'] = $row['customer_id'];
            }
            if($role == 'worker'){
                $_SESSION['FPUID'] = $row['worker_id'];
            }

            // Send OTP via email to the user
            if (sendEmail($email, '', 'Safe Hands Connect', 'Your OTP for resetting your password is: ' . $otp . '. It is valid for 5 minutes.')) {
                // Redirect to OTP verification page
                header("Location: changePassword.php");
            } else {
                // Error sending email
                $_SESSION['error_message'] = 'Failed to send OTP. Please try again later.';
                header("Location: forgotPassword.php");
            }
        } else {
            // If the account is inactive, show an error message
            $_SESSION['error_message'] = 'Your account is inactive. Please contact support.';
            $_SESSION['emailInactive'] = 1;
            header("Location: forgotPassword.php");
        }
    } else {
        // If the email doesn't exist, show an error message
        $_SESSION['error_message'] = 'Email does not exist in our records.';
        header("Location: forgotPassword.php");
        $_SESSION['emailDoesNotExist'] = 1;
    }
} else {
    $_SESSION['error_message'] = 'Invalid request.';
    header("Location: forgotPassword.php");
    exit;
}
?>
