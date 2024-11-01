<?php
include '../connection/connection.php';
session_start();
error_reporting(0);
if (isset($_POST['bookingId']) && isset($_SESSION['customer_id'])) {
    $bookingId = $_POST['bookingId'];
    $customerId = $_SESSION['customer_id'];

    // Verify if the booking belongs to the current customer
    $stmt = $conn->prepare("SELECT booked_date, arrival_date FROM booking WHERE booking_Id = ? AND customer_Id = ?");
    $stmt->bind_param("ii", $bookingId, $customerId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $bookedDate = new DateTime($row['booked_date']);
        $arrivalDate = new DateTime($row['arrival_date']);
        $currentDate = new DateTime();

        // Check if the cancellation is allowed based on arrival date
        if ($arrivalDate->sub(new DateInterval('PT24H')) > $currentDate) {
            // Proceed with cancellation
            $stmt = $conn->prepare("UPDATE booking SET order_status = 'canceled' WHERE booking_Id = ?");
            $stmt->bind_param("i", $bookingId);

            if ($stmt->execute()) {
                echo 'success'; // Plain text response
            } else {
                echo 'error'; // Plain text response
            }
        } else {
            echo 'Cancellation period has expired or booking is for the current day';
        }
    } else {
        echo 'Invalid booking ID or unauthorized access';
    }

    $stmt->close();
} else {
    echo 'Error: Missing bookingId or customer_id';
}

$conn->close();
?>
