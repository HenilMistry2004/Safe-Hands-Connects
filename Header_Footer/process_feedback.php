<?php
include "../connection/connection.php";
session_start();
error_reporting(0);
    if(isset($_POST['send'])){
        $feedback = $_POST['message'];
        $name = $_POST['name'];
        $bookingId = $_POST['bookingId'];

        // Fetching user ID based on name
        $fetchId = "SELECT customer_id FROM customer WHERE customer_name = '$name'";
        $result = $conn->query($fetchId);
        $userId = $_SESSION['userId'];

        if ($userId !== null) {
            // Insert feedback into the database
            $sql = "INSERT INTO feedback(booking_id, customer_id, comment) VALUES ($bookingId, $userId, '$feedback')";
            if ($conn->query($sql) === TRUE) {
                echo '<div class="alert alert-success" role="alert">Feedback sent successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error Occurred</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">User ID not found</div>';
        }
    }
?>