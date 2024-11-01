<?php
session_start();
$worker_id = $_SESSION['empId'];
// $worker_id = 2;
error_reporting(0);
include("../connection/connection.php");
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../Login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Service Page</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../Login/login.css">
</head>

<body>
    <?php include '../Header_Footer/header.php'; ?>

    <div id="contact" class="contact-us section" style="margin-top: 100px; height: 700px;">
        <div class="container col-lg-8" data-wow-duration="0.5s" data-wow-delay="0.6s">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 style="margin-left: 350px;">Booking Request</h4>
                            <table class="table table-striped table-active table-bordered table-hover table-responsive-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Updated SQL query to include sub_service_id
                                    $sql = "SELECT b.*, s.service_name, ss.sub_service_name
                                            FROM booking b
                                            INNER JOIN service s 
                                                ON b.service_id = s.service_id
                                            INNER JOIN sub_service ss 
                                                ON b.sub_service_id = ss.sub_service_id
                                            INNER JOIN worker w
                                                ON b.service_id = w.service_id 
                                                AND b.sub_service_id = w.sub_service_id
                                            WHERE b.order_status = 'Pending';
                                            ";

                                    $result = $conn->query($sql);

                                    if (!$result) {
                                        // Handle query execution error
                                        echo "Error: " . $conn->error;
                                    } elseif ($result->num_rows > 0) {
                                        // Output data of each row
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<tr>
                                                    <td>' . $row["customerName"] . '</td>
                                                    <td>' . $row["order_email"] . '</td>
                                                    <td>' . $row["order_adderss"] . '</td>
                                                    <td>' . $row['service_name'] 
                                                    ."<br>". $row['sub_service_name'] . '</td>
                                                    <td>
                                                        <form id="acceptForm" method="post">
                                                            <input type="hidden" value="' . $row['booking_Id'] . '" class="btn btn-success accept-btn" name="bookingId">
                                                            <input type="button" value="Accept" class="btn btn-success accept-btn" name="accept" onclick="acceptBooking(' . $row['booking_Id'] . ')">
                                                        </form>
                                                    </td>
                                                </tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6">No bookings found</td></tr>';
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js'></script>
            <script src="./script.js"></script>
            <script src="../vendor/jquery/jquery.min.js"></script>
            <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../assets/js/owl-carousel.js"></script>
            <script src="../assets/js/animation.js"></script>
            <script src="../assets/js/imagesloaded.js"></script>
            <script src="../assets/js/templatemo-custom.js"></script>

            <script>
    function acceptBooking(bookingId) {
        // Serialize the form data for the specific booking
        $.ajax({
            type: 'POST',
            url: 'process_booking_request.php',
            data: { bookingId: bookingId },
            success: function(response) {
                    alert('Booking accepted successfully!');
                    location.reload(); // Reload the page to reflect changes
            },
            error: function(xhr, status, error) {
                alert('Error accepting booking. Please try again later.');
            }
        });
    }
</script>

</body>

</html>