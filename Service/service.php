<?php
session_start();
error_reporting(0);
include("../connection/connection.php");
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
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <?php include '../Header_Footer/header.php'; ?>

    <div id="contact" class="contact-us section" style="margin-top: 100px;padding-top: 60px;padding-bottom: 110px;">
        <div class="container">
            <div class="row">
                <!-- Left empty space -->
                <div class="">
                    <div style="margin-left: 510px;">
                        <h1 style=" color :#ffffff ;">OUR SERVICE</h1>
                    </div>
                </div>

                <!-- Service display section -->
                <div class="" style="visibility: visible; margin-top: 100px;">
                    <div class="row" style="margin-top: 35px;">
                        <?php
                        $query = "SELECT * FROM service WHERE status ='active'";
                        $query_run = mysqli_query($conn, $query);
                        if ($query_run->num_rows > 0) {
                            while ($row = $query_run->fetch_assoc()) {
                        ?>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card mb-4" style="height: 410px;">
                                        <div>
                                            <img src="<?php echo $row['services_image']; ?>" alt="<?php echo $row['service_name']; ?>" height="200px" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h2 class="card-title"><?php echo $row['service_name']; ?></h2>
                                            <p class="card-text" style="height: 95px;"><?php echo $row['description']; ?></p>
                                            <form method="post" action="Sub_Service.php">
                                                <input type="hidden" name="service_id" value="<?php echo $row['service_id']; ?>">
                                                <input type="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" value="Book Now">

                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>No active services available.</p>";
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