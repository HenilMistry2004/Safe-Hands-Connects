<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <script src="ajax/headerLink.js"></script>
</head>

<body>
    <?php
    $_SESSION['customerRegistrationMessage'] = 0;
    $_SESSION['employeRegistrationMessage'] = 0;
    $value = $_POST['value'];

    $_SESSION['registerMessage'] = 0;

    include '../connection/connection.php';

    if ($value == "customer") {
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $year = $_POST['year'];
        $address = $_POST['address'];
        $pass = $_POST['password'];
        $twoFactor = isset($_POST['twoFacter']) ? 1 : 0; // Assumes checkbox or similar
        $date = $year . "-" . sprintf("%02d", $month) . "-" . sprintf("%02d", $day);

        $_SESSION['customerRegistrationMessage']++;

        $encryptedPassword = md5($pass);

        if (!empty($name) && !empty($contact) && !empty($email) && !empty($gender) && !empty($date) && !empty($address) && !empty($pass)) {
            // Check if email already exists
            $checkEmailStmt = $conn->prepare("SELECT customer_email_id FROM customer WHERE customer_email_id = ?");
            $checkEmailStmt->bind_param("s", $email);
            $checkEmailStmt->execute();
            $checkEmailStmt->store_result();

            if ($checkEmailStmt->num_rows > 0) {
                echo "Error: Email already exists. Please use a different email.";
            } else {
                // Prepare and execute insert statement
                $stmt = $conn->prepare("INSERT INTO customer (customer_name, customer_password, customer_email_id, customer_contact_no, customer_gender, customer_address, customer_dob, isTwoFactorEnable) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $name, $encryptedPassword, $email, $contact, $gender, $address, $date, $twoFactor);

                if ($stmt->execute()) {
                    // Uncomment below to send an email
                    // require 'MailClass.php';
                    // sendEmail($email, trim($name), 'Safe Hands Connect', 'Thank you ' . trim($name) . ' for registering in "Safe Hands Connect", You have successfully registered your account.');
                    header("Location: ../Login/login.php");
                    exit(); // Stop script execution after header redirection
                } else {
                    echo 'Error: ' . $stmt->error;
                }
            }
            $checkEmailStmt->close();
            $stmt->close();
        } else {
            echo "Error: All fields are required.";
        }
    } else {
        $services_id = $_POST['service'];
        $name = $_POST['name'];
        $contact = $_POST['contact'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $month = $_POST['month'];
        $day = $_POST['day'];
        $year = $_POST['year'];
        $address = $_POST['address'];
        $pass = $_POST['password'];
        $sub_services = $_POST['sub_services'];

        $latitude = $_POST['latitude']; // Retrieve latitude
        $longitude = $_POST['longitude']; // Retrieve longitude
        $city = $_POST['city']; // Retrieve city

        $twoFactor = isset($_POST['twoFacter']) ? 1 : 0; // Assumes checkbox or similar
        $date = $year . "-" . sprintf("%02d", $month) . "-" . sprintf("%02d", $day);

        $_SESSION['employeRegistrationMessage']++;

        $encryptedPassword = md5($pass);

        if (!empty($name) && !empty($contact) && !empty($email) && !empty($gender) && !empty($date) && !empty($address) && !empty($pass) && !empty($services_id)) {
            // Check if email already exists
            $checkEmailStmt = $conn->prepare("SELECT worker_email_id FROM worker WHERE worker_email_id = ?");
            $checkEmailStmt->bind_param("s", $email);
            $checkEmailStmt->execute();
            $checkEmailStmt->store_result();

            if ($checkEmailStmt->num_rows > 0) {
                echo "Error: Email already exists. Please use a different email.";
            } else {
                // Prepare and execute insert statement
                $stmt = $conn->prepare("INSERT INTO worker (worker_name, worker_password, worker_email_id, worker_contact, worker_address, worker_gender, worker_dob, service_id, isTwoFactorEnable, sub_service_id, latitude, longitude, city) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssisssss", $name, $encryptedPassword, $email, $contact, $address, $gender, $date, $services_id, $twoFactor, $sub_services, $latitude, $longitude, $city);

                if ($stmt->execute()) {
                    $_SESSION['registerMessage']++;
                    header("Location: ../Index/index.php");
                    exit(); // Stop script execution after header redirection
                } else {
                    echo 'Error: ' . $stmt->error;
                }
            }
            $checkEmailStmt->close();
            $stmt->close();
        } else {
            echo "Error: All fields are required.";
        }
    }
    ?>
</body>

</html>