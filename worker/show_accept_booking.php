<?php
session_start();

error_reporting(0);
include("../connection/connection.php");

// if (!isset($_SESSION['loggedin'])) {
//     header("Location: login1.php");
// }
$wid = $_SESSION['empId'];
// $wid = 2;

$sql = "SELECT b.*, s.service_name, ss.sub_service_name
        FROM booking b
        INNER JOIN worker_booking wb ON b.booking_Id = wb.booking_id
        INNER JOIN service s ON b.service_id = s.service_id
        INNER JOIN sub_service ss ON b.sub_service_id = ss.sub_service_id
        WHERE wb.worker_id = ? AND b.order_status = 'approved';";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $wid);
$stmt->execute();
$result = $stmt->get_result();
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

    <div id="contact" class="contact-us section" style="height: 655px; margin-top: 115px;">
        <div class="container col-lg-8" data-wows-duration="0.5s" data-wow-delay="0.6s">
            <div class="row" style="width: 1343px;margin-left: -185px;margin-top: -85px;">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                        <h4 style="margin-left: 440px;margin-top: 0px;margin-bottom: 10px;">Show Your Accept Booking</h4>
                            <table class="table table-striped table=-active table-bordered table-responsive-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Service Name</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $sid = $row['service_id'];
                                            $serviceNameFetch = "SELECT service_name FROM service WHERE service_id = '$sid'";
                                            $serviceResult = $conn->query($serviceNameFetch);
                                            $serviceRow = mysqli_fetch_assoc($serviceResult);
                                            echo "<tr>";
                                            echo "<td>" . $row["booking_Id"] . "</td>";
                                            echo "<td>" . $row['service_name'] . "<br   >" . $row['sub_service_name'] . "</td>";
                                            echo "<td>" . $row["arrival_date"] . "</td>";
                                            echo "<td>" . $row["departure_date"] . "</td>";
                                            echo "<td>" . $row["customerName"] . "</td>";
                                            echo "<td>" . $row["order_email"] . "</td>";
                                            echo "<td>" . $row["order_phone"] . "</td>";

                                            echo "<td>" . $row["order_adderss"] . "</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='15'>No bookings found</td></tr>";
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




</body>

</html>