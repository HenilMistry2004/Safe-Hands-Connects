<?php
session_start();
include("../connection/connection.php");
error_reporting(0);

// Get customer_id from session
$customer_id = $_SESSION['customer_id'];
if ($customer_id <= 0) {
    die("Invalid customer ID.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="show_booking.css">
</head>

<body>
    <?php include '../Header_Footer/header.php'; ?>

    <div id="contact" class="contact-us section" style="margin-top: 107px; height: 614px;">
        <div class="container col-lg-8 " data-wow-duration="0.5s" data-wow-delay="0.6s">
            <div class="row" style="margin-top: -80px;width: 1346px;margin-left: -185px;">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>Booking Details for Customer ID: <?php echo htmlspecialchars($customer_id); ?></h4>
                            <button class="btn btn-primary" id="loadPending">Pending Bookings</button>
                            <button class="btn btn-success" id="loadCompleted">Completed Bookings</button>

                            <div id="pendingBookings" class="mt-4"></div>
                            <div id="completedBookings" class="mt-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#loadPending').click(function(event) {
                event.preventDefault();

                // Clear completed bookings before loading pending bookings
                $('#completedBookings').html('');

                $.ajax({
                    url: 'fetch_bookings.php', // Separate PHP file to fetch bookings
                    type: 'POST',
                    data: {
                        status: 'Pending',
                        customer_id: <?php echo $customer_id; ?>
                    },
                    success: function(response) {
                        $('#pendingBookings').html(response);
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching pending bookings. Please try again later.');
                        console.error('AJAX error:', error);
                    }
                });
            });

            $('#loadCompleted').click(function(event) {
                event.preventDefault();

                // Clear pending bookings before loading completed bookings
                $('#pendingBookings').html('');

                $.ajax({
                    url: 'fetch_bookings.php', // Separate PHP file to fetch bookings
                    type: 'POST',
                    data: {
                        status: 'Completed',
                        customer_id: <?php echo $customer_id; ?>
                    },
                    success: function(response) {
                        $('#completedBookings').html(response);
                    },
                    error: function(xhr, status, error) {
                        alert('Error fetching completed bookings. Please try again later.');
                        console.error('AJAX error:', error);
                    }
                });
            });
        });
    </script>

</body>

</html>
