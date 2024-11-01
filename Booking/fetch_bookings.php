<?php
session_start();
include("../connection/connection.php");
error_reporting(0);

// Get customer_id from POST data
$customer_id = $_POST['customer_id'];
$status = $_POST['status'];

// Validate customer_id
if ($customer_id <= 0) {
    die("Invalid customer ID.");
}

// Prepare the query based on status
$query = "SELECT * FROM booking WHERE customer_Id = ? AND order_status = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $customer_id, $status);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Check if there are any bookings
if ($result->num_rows > 0) {
    // Create table for the bookings
    echo '<table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Customer Name</th>
                    <th>Booked Date</th>
                    <th>Arrival Date</th>
                    <th>Departure Date</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

    while ($row = $result->fetch_assoc()) {
        $bookingId = $row['booking_Id'];
        $currentDate = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $arrivalDate = new DateTime($row['arrival_date'], new DateTimeZone('Asia/Kolkata'));

        // Calculate the datetime 24 hours before arrival
        $before24Hours = clone $arrivalDate;
        $before24Hours->sub(new DateInterval('P1D')); // P1D represents a period of 1 day
        // Check if the booking is cancellable
        $canCancel = $currentDate < $before24Hours;

        echo '<tr>
                <td>' . htmlspecialchars($row['booking_Id']) . '</td>
                <td>' . htmlspecialchars($row['customerName']) . '</td>
                <td>' . htmlspecialchars($row['booked_date']) . '</td>
                <td>' . htmlspecialchars($row['arrival_date']) . '</td>
                <td>' . htmlspecialchars($row['departure_date']) . '</td>
                <td>' . htmlspecialchars($row['order_email']) . '</td>
                <td>' . htmlspecialchars($row['order_phone']) . '</td>
                <td>' . htmlspecialchars($row['order_adderss']) . '</td>
                <td>' . htmlspecialchars($row['order_status']) . '</td>
                <td>';

        if ($canCancel && $row['order_status'] === 'Pending') {
            echo '<button class="btn btn-danger" onclick="cancelBooking(' . $bookingId . ')">Cancel</button>';
        } else {
            echo '<span class="text-muted">Cannot Cancel</span>';
        }

        echo '</td></tr>';
    }

    echo '</tbody></table>';
} else {
    echo '<p>You have no ' . strtolower($status) . ' bookings at the moment.</p>';
}
?>
