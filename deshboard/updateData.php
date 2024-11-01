<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include 'Connection.php';

    if ($_POST['updateDetails']) {
        $value = $_POST['updateDetails'];
        if ($value === "customer") {
            $customer_Id = $_POST['customerId'];
            $customer_Name = $_POST['updateName'];
            $customer_Email_Id = $_POST['updateEmail'];
            $customer_Contact = $_POST['updateContact'];
            $customer_Address = $_POST['updateAddress'];
            $customer_Gender = $_POST['updateGender'];
            $customer_DOB = $_POST['updateDOB'];

            $sql = "UPDATE customer SET customer_name = '$customer_Name', customer_email_id = '$customer_Email_Id', customer_contact_no = '$customer_Contact', customer_address = '$customer_Address', customer_gender = '$customer_Gender', customer_dob = '$customer_DOB' WHERE customer_id = '$customer_Id';";

            if ($conn->query($sql) == TRUE) {
                echo "Record updated successfully";
                header('location: index.php');
            } else {
                echo "Error updating record: " . $conn->error;
            }

            $conn->close();
        } elseif ($value === "worker") {
            $worker_Id = $_POST['workerId'];
            $worker_Name = $_POST['updateName'];
            $worker_Email_Id = $_POST['updateEmail'];
            $worker_Contact = $_POST['updateContact'];
            $worker_Address = $_POST['updateAddress'];
            $worker_Gender = $_POST['updateGender'];
            $worker_DOB = $_POST['updateDOB'];

            $sql = "UPDATE worker SET worker_name = '$worker_Name', worker_email_id = '$worker_Email_Id', worker_contact = '$worker_Contact', worker_address = '$worker_Address', worker_gender = '$worker_Gender', worker_dob = '$worker_DOB' WHERE worker_id = '$worker_Id';";

            if ($conn->query($sql) == TRUE) {
                echo "Record updated successfully";
                header('location: index.php');
            } else {
                echo "Error updating record: " . $conn->error;
            }

            $conn->close();
        }
    }
    ?>

    <?php
    if (isset($_GET['booking_Id'])) {
        $booking_Id = $_GET['booking_Id'];

        $sql = "update booking set order_status	 = 'approve' where  booking_Id= '$booking_Id';";

        if ($conn->query($sql) == TRUE) {
            echo "Record updated successfully";
            header('location: index.php');
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    $conn->close();
    ?>

</body>

</html>