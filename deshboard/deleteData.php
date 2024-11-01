<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    // echo "hello";
    include 'connection.php';

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

    

    if (isset($_GET['id'])) {
        $customer_id = $_GET['id'];

        $sql = "update customer set status ='Inactive' where customer_id = '$customer_id' ;";

        if ($conn->query($sql) === TRUE) {
            $fetchEmail = "SELECT * FROM customer WHERE customer_id='$customer_id'";
            $execute = $conn->query($fetchEmail);

            if ($execute->num_rows > 0) {
                $row = $execute->fetch_assoc();
                $email = $row['customer_email_id'];
                
                
                try {
                    //Server settings                    //Enable verbose debug output
                    
                    $mail->addAddress($email);     //Add a recipient



                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Safe Hands Connect';
                    $mail->Body    = 'Regrettably, due to violations of rules we terminated your account, effective immediately. We value all our customers but must maintain a safe and respectful environment for everyone.';

                    $mail->send();
                    //echo 'Message has been sent';
                    echo '<script>alert("Email has been sent successfully!")</script>';
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . ')</script>';
                }
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
        header('location: index.php');
    }


    if (isset($_GET['worker_id'])) {
        $worker_id = $_GET['worker_id'];
        echo $worker_id;

        $sql = "update worker set status ='Inactive' where worker_id = '$worker_id' ;";

        if ($conn->query($sql) === TRUE) {
            $fetchEmail = "SELECT worker_email_id FROM worker WHERE worker_id='$worker_id'";
            $execute = $conn->query($fetchEmail);
            if ($execute->num_rows > 0) {
                $row = $execute->fetch_assoc();
                $email = $row['worker_email_id'];

                try {

                    $mail->addAddress($email);     //Add a recipient



                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Safe Hands Connect';
                    $mail->Body    = 'Unfortunately, after careful consideration, the decision has been made to terminate your employment effective immediately. We appreciate your contributions and wish you the best in your future.';

                    $mail->send();
                    //echo 'Message has been sent';
                    echo '<script>alert("Email has been sent successfully!")</script>';
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . ')</script>';
                }
            }
        }

        $conn->close();
        header('location: index.php');
    }

    if (isset($_GET['service_id'])) {

        $service_id = $_GET['service_id'];
        $sql = "update service set status= 'inactive' where service_id = '$service_id';";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
        header('location: index.php');
    }

    if (isset($_GET['booking_Id'])) {
        $booking_id = $_GET['booking_Id'];
        $sql = "update booking set order_status	= 'Rejected' where booking_Id = '$booking_id';";

        if ($conn->query($sql) === TRUE) {
            $fetchId = "SELECT customer_Id FROM booking WHERE booking_Id = '$booking_id'";
            $execId = $conn->query($fetchId);
            $outOfNames = $execId->fetch_assoc();
            $customer_id = $outOfNames['customer_Id'];
            $fetchEmail = "SELECT customer_email_id FROM customer WHERE customer_id='$customer_id'";
            $execute = $conn->query($fetchEmail);
            if ($execute->num_rows > 0) {
                $row = $execute->fetch_assoc();
                $email = $row['customer_email_id'];
                try {

                    $mail->addAddress($email);     //Add a recipient



                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Safe Hands Connect';
                    $mail->Body    = 'Your Booking has been Cancelled by the Team of Safe Hands Connect. Booking ID : ' . $booking_id . '';

                    $mail->send();
                    //echo 'Message has been sent';
                    echo '<script>alert("Email has been sent successfully!")</script>';
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    echo '<script>alert("Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . ')</script>';
                }
                header('location: index.php');
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
        // header('location: index.php');
    }
    ?>




</body>

</html>