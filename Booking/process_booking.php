<?php
session_start();
include("../connection/connection.php");

// Retrieve and sanitize the posted data
$razorpay_payment_id = mysqli_real_escape_string($conn, $_POST['razorpay_payment_id']);
$service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
$sub_service_id = mysqli_real_escape_string($conn, $_POST['sub_service_id']);

$arrival = mysqli_real_escape_string($conn, $_POST['arrival']);
$departure = mysqli_real_escape_string($conn, $_POST['departure']);
$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$phone = mysqli_real_escape_string($conn, $_POST['phone']);
$price = mysqli_real_escape_string($conn, $_POST['price']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$latitude = mysqli_real_escape_string($conn, $_POST['latitude']); // Retrieve latitude
$longitude = mysqli_real_escape_string($conn, $_POST['longitude']); // Retrieve longitude
$city = mysqli_real_escape_string($conn, $_POST['city']); // Retrieve longitude

$order_status = "Pending";
$customer_id = $_SESSION['customer_id']; // Assuming you have customer_id stored in session


// Insert booking data into the booking table
$sql = "INSERT INTO booking
        (customer_Id, service_id, sub_service_id, customerName, booked_date, arrival_date, departure_date, order_email, order_phone, order_adderss, order_price, order_status,latitude, longitude, city)
        VALUES
        ('$customer_id', '$service_id', '$sub_service_id', '$first_name', NOW(), '$arrival', '$departure', '$email', '$phone', '$address', '$price', '$order_status','$latitude','$longitude','$city')";

if (mysqli_query($conn, $sql)) {
    // Retrieve the last inserted booking ID
    $booking_id = mysqli_insert_id($conn);
    
    // Insert payment data into the payment table
    $payment_sql = "INSERT INTO payment
                    (booking_Id, customer_id, payment_id, total_price, date_time) 
                    VALUES
                    ('$booking_id', '$customer_id', '$razorpay_payment_id', '$price', NOW())";
    
    if (mysqli_query($conn, $payment_sql)) {
        // Redirect to a success page or do further processing
        echo "Booking and payment successfully recorded!";
        header("Location: show_booking.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>