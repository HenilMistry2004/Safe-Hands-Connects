<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Space Dynamic - SEO HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Add this line -->

    <style>
        /* style.css */

        form#contact-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form#contact-form input[type="text"],
        form#contact-form select,
        form#contact-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        form#contact-form textarea {
            resize: vertical;
            min-height: 100px;
        }

        form#contact-form button#form-submit {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #03a4ed;
            color: #fff;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form#contact-form button#form-submit:hover {
            background-color: #fe3f40;
        }
    </style>
</head>

<body>
    <?php
    // include 'header.php';
    include '../connection/connection.php';
    include '../UserDetails/userDetails.php';
    ?>

    <div id="contact" class="contact-us section" style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 align-self-center wow fadeInLeft" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <div class="section-heading">
                        <h2>Feel Free To Send Us a Feedback Message About Services Needs</h2>
                        <div class="phone-info">
                            <h4>For any enquiry, Call Us: <span><i class="fa fa-phone"></i> <a href="#">940-525-0340</a></span></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact-form" action="" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset>
                                    <input type="text" name="name" id="name" placeholder="Name" value= <?php echo $_SESSION['cName']; ?> required>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <select name="bookingId" class="input-group">
                                        <?php
                                        $userId = $_SESSION['userId'];

                                        $stmt = $conn->prepare("SELECT booking_id, service_id FROM booking WHERE customer_id = ?");
                                        $stmt->bind_param("i", $userId);
                                        $stmt->execute();
                                        $result = $stmt->get_result();

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $bookingId = $row['booking_id'];
                                                $serviceId = $row['service_id'];

                                                $stmtService = $conn->prepare("SELECT service_name FROM service WHERE service_id = ?");
                                                $stmtService->bind_param("i", $serviceId);
                                                $stmtService->execute();
                                                $serviceResult = $stmtService->get_result();

                                                if ($serviceResult->num_rows > 0) {
                                                    $serviceRow = $serviceResult->fetch_assoc();
                                                    $serviceName = htmlspecialchars($serviceRow['service_name']);

                                                    echo "<option value='" . htmlspecialchars($bookingId) . "'>Service ID: " . htmlspecialchars($bookingId) . " | Service Name: " . $serviceName . "</option>";
                                                }
                                                $stmtService->close();
                                            }
                                        } else {
                                            echo "<option>No Booking Done</option>";
                                        }
                                        $stmt->close();
                                        ?>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <textarea name="message" class="form-control" id="message" placeholder="Message" required=""></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-button ">Send Message</button>
                                </fieldset>
                            </div>
                        </div>
                        <!-- <div class="contact-dec">
                            <img src="../assets/images/contact-decoration.png" alt="">
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/animation.js"></script>
    <script src="../assets/js/imagesloaded.js"></script>
    <script src="../assets/js/templatemo-custom.js"></script>
</body>

</html>

<?php
    if(isset($_POST['send'])){
        $feedback = $_POST['feedback'];
        $name = $_POST['name'];
        $bookingId = $_POST['bookingId'];

        // Fetching user ID based on name
        $fetchId = "SELECT customer_id FROM customer WHERE customer_name = '$name'";
        $result = $conn->query($fetchId);
        $userId = null;
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['customer_id'];
        }

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

// Close the database connection at the end of the script
$conn->close();
?>