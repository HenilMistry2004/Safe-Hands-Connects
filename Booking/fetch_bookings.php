<?php
session_start();
include("../connection/connection.php");
error_reporting(0);

// Get customer_id and status from POST data
$customer_id = $_POST['customer_id'];
$status = $_POST['status'];
$page = isset($_POST['page']) && is_numeric($_POST['page']) ? (int)$_POST['page'] : 1;

// Validate customer_id
if ($customer_id <= 0) {
    die("Invalid customer ID.");
}

$recordsPerPage = 10;
$offset = ($page - 1) * $recordsPerPage;

// Prepare the query to count total records
$countQuery = "SELECT COUNT(*) AS total FROM booking WHERE customer_Id = ? AND order_status = ?";
$countStmt = $conn->prepare($countQuery);
$countStmt->bind_param("is", $customer_id, $status);
$countStmt->execute();
$countResult = $countStmt->get_result();
$totalRecords = $countResult->fetch_assoc()['total'];

$totalPages = ceil($totalRecords / $recordsPerPage);

// Prepare the query to fetch records with LIMIT and OFFSET
$query = "SELECT * FROM booking WHERE customer_Id = ? AND order_status = ? LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("isii", $customer_id, $status, $recordsPerPage, $offset);
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

    // Pagination controls
    echo '<nav aria-label="Page navigation">
            <ul class="pagination">';

    if ($page > 1) {
        echo '<li class="page-item">
                <button class="page-link" onclick="fetchPage(' . ($page - 1) . ')">Previous</button>
              </li>';
    }

    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = $i === $page ? 'active' : '';
        echo '<li class="page-item ' . $activeClass . '">
                <button class="page-link" onclick="fetchPage(' . $i . ')">' . $i . '</button>
              </li>';
    }

    if ($page < $totalPages) {
        echo '<li class="page-item">
                <button class="page-link" onclick="fetchPage(' . ($page + 1) . ')">Next</button>
              </li>';
    }

    echo '</ul>
          </nav>';
} else {
    echo '<p>You have no ' . strtolower($status) . ' bookings at the moment.</p>';
}

?>
