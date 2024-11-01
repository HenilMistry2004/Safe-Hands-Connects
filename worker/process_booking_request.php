<?php 
include '../connection/connection.php'; 
session_start();
error_reporting(0);
if(isset($_POST['bookingId']) && isset($_SESSION['empId'])) {
    $bookingId = $_POST['bookingId'];
    $workerId = $_SESSION['empId'];

    // Prepare and execute the insert query
    $stmt = $conn->prepare("INSERT INTO worker_booking (worker_id, booking_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $workerId, $bookingId);

    if ($stmt->execute()) {
        // Prepare and execute the update query
        $stmt1 = $conn->prepare("UPDATE booking SET order_status = 'approved' WHERE booking_Id = ?");
        $stmt1->bind_param("i", $bookingId);

        if ($stmt1->execute()) {
            echo 'success';
        } else {
            echo 'error';
        }

        $stmt1->close();
    } else {
        echo 'error';
    }

    $stmt->close();
} else {
    echo 'error';
}

$conn->close();
?>


<?php 
// include '../connection/connection.php'; 
// session_start();

// if(isset($_POST['bookingId']) && isset($_SESSION['empId'])) {
//     $bookingId = $_POST['bookingId'];
//     $workerId = $_SESSION['empId'];

//     // Prepare and execute the insert query
//     $stmt = $conn->prepare("INSERT INTO worker_booking (worker_id, booking_id) VALUES (?, ?)");
//     if (!$stmt) {
//         echo 'Error preparing insert statement: ' . $conn->error;
//         exit();
//     }
//     $stmt->bind_param("ii", $workerId, $bookingId);

//     if ($stmt->execute()) {
//         // Prepare and execute the update query
//         $stmt1 = $conn->prepare("UPDATE booking SET order_status = 'approved' WHERE booking_Id = ?");
//         if (!$stmt1) {
//             echo 'Error preparing update statement: ' . $conn->error;
//             exit();
//         }
//         $stmt1->bind_param("i", $bookingId);

//         if ($stmt1->execute()) {
//             echo 'success';
//         } else {
//             echo 'Error updating booking status: ' . $stmt1->error;
//         }

//         $stmt1->close();
//     } else {
//         echo 'Error inserting into worker_booking: ' . $stmt->error;
//     }

//     $stmt->close();
// } else {
//     echo 'Error: Missing bookingId or empId';
// }

// $conn->close();
?>
