<?php
include 'Connection.php';
require 'Exception.php';
require 'SMTP.php';
require 'PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'safehandsconnect13@gmail.com';                     //SMTP username
$mail->Password   = 'cwsw jwjf clxm qccm';                               //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

//Recipients
$mail->setFrom('safehandsconnect13@gmail.com');

try {
    if (isset($_POST['approve'])) {
        $worker_id = $_POST['approve'];

        $sql = "UPDATE worker SET status ='active' WHERE worker_id = '$worker_id' ;";



        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            $sqlEmail = "SELECT * FROM worker WHERE worker_id = '$worker_id'";
            $emailExec = $conn->query($sqlEmail);
            if ($emailExec->num_rows > 0) {
                $row = $emailExec->fetch_assoc();
                $email = $row['worker_email_id'];
                $mail->addAddress($email);     //Add a recipient



                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Safe Hands Connect';
                $mail->Body    = 'Congratulations, You are now part of Safe Hands Connect team, You can login now, You are Hired.';

                $mail->send();
            } else {
                throw new Exception("Error updating record: " . $conn->error);
            }

            $conn->close();
            header('Location: index.php');
            exit;
        }
    }

    if (isset($_POST['reject'])) {
        $worker_id = $_POST['reject'];
        $sql = "UPDATE worker SET status ='reject' WHERE worker_id = '$worker_id' ;";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            $sqlEmail = "SELECT * FROM worker WHERE worker_id = '$worker_id'";
            $emailExec = $conn->query($sqlEmail);
            if ($emailExec->num_rows > 0) {
                $row = $emailExec->fetch_assoc();
                $email = $row['worker_email_id'];
                $mail->addAddress($email);     //Add a recipient



                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Safe Hands Connect';
                $mail->Body    = 'Your Application is Rejected by team of Safe Hands Connect,We don\'t need workers right now, we will email you if required in future';

                $mail->send();
            } else {
                throw new Exception("Error updating record: " . $conn->error);
            }

            $conn->close();
            header('Location: index.php');
            exit;
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
