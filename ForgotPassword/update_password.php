<?php
session_start();

if (isset($_SESSION['FPUID'])) {
    $newPassword = $_POST['new_password'];

    // Securely hash the password
    $hashedPassword = md5($newPassword);

    // Include your database connection
    require '../connection/connection.php';  

    // Get the role from the session
    $role = $_SESSION['role'];
    $userId = $_SESSION['FPUID']; // Assuming user ID is stored in session after OTP verification

    // Prepare SQL query to update the password in the appropriate table
    if ($role === 'customer') {
        $sql = "UPDATE customer SET customer_password = ? WHERE customer_id = ?";
    } elseif ($role === 'worker') {
        $sql = "UPDATE worker SET worker_password = ? WHERE worker_id = ?";
    }

    $stmt = $conn->prepare($sql);

    $stmt->bind_param('si', $hashedPassword, $userId);

    // Execute the query
    $stmt->execute();
    if ($stmt->affected_rows) {
        echo 'success';  // Return success response
    } else {
        echo 'failure: No rows affected, check if the user ID is valid';  // No rows updated
    }
} else {
    echo 'failure: Invalid request, session data not set';  // Return failure if new password is not provided or role is not set
}
?>
