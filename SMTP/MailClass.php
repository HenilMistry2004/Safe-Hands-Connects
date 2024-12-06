<?php
require 'Exception.php';
require 'SMTP.php';
require 'PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendEmail($recipientEmail, $name, $subject, $body) {
    $mail = new PHPMailer(true); // Passing true enables exceptions

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'safehandsconnect13@gmail.com'; // Your email address
        $mail->Password   = 'mdyp ljbx pvlw aknw';       // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('safehandsconnect13@gmail.com');    // Sender's email address
        $mail->addAddress($recipientEmail);        // Recipient's email address

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Send email
        $mail->send();
        echo '<script>alert("Email has been sent successfully!")</script>';
        return true;
    } catch (Exception $e) {
        echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '")</script>';
        return false;

    }
}

?>
