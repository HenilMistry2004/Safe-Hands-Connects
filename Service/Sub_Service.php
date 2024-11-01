<?php
session_start();
error_reporting(0);
include("../connection/connection.php");
if (!isset($_POST['service_id'])) {
    header("Location: ../Service/service.php");
    exit();
}
$service_id = $_POST['service_id'];


?>
<!DOCTYPE html>
<html>

<head>
    <title>Service Page</title>

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="service.css">
</head>

<body>
    <?php include '../Header_Footer/header.php'; ?>

    <div id="contact" class="contact-us section" style="margin-top: 100px; padding-top: 110px; padding-bottom: 110px;">
        <div class="container">
            <div class="row">
                <div class="" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <div>
                        <h1 style=" color :#ffffff; margin-top: 15px; margin-left: 520px; padding-bottom: 20px;">OUR SERVICE</h1>
                    </div>
                </div>

                <div class="" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <div class="row" style="margin-left: 200px;">
                        <?php
                        $query = "SELECT * FROM sub_service WHERE service_id = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param('i', $service_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <div class="col-lg-3 col-md-6 col-sm-12" style="width: 300px;">
                                    <div class="card mb-4">

                                        <div class="card-body">
                                            <h2 class="card-title"><?php echo $row['sub_service_name']; ?></h2>
                                            <p class="card-text" style="height: 100px;"><?php echo $row['description']; ?></p>
                                            <br>
                                            <p><b>Price Of This Service</b></p>
                                            <p class="card-text"><?php echo $row['sub_service_price']; ?> per Hours</p>
                                            <form method="post" action="../Booking/booking.php">
                                                <input type="hidden" name="sub_service_id" value="<?php echo $row['sub_service_id']; ?>">
                                                <input type="hidden" name="sub_service_name" value="<?php echo $row['sub_service_name']; ?>">
                                                <input type="hidden" name="service_id" value="<?php echo $service_id ;?>">
                                                <input type="hidden" name="sub_service_price" value="<?php echo $row['sub_service_price']; ?>">
                                                <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="Book Now">

                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo " <h1 style=' color :#ffffff ;'> No sub-services available for this service.</p>";
                        }
                        ?>
                    </div>
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
