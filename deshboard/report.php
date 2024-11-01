<?php
include 'connection.php';

try {
    if (isset($_POST['date'])) {
        $date = $_POST['date'];
        $sql = "SELECT * FROM booking WHERE DATE(booked_date) = '$date'";
        $select = $conn->query($sql);

        if ($select === false) {
            throw new Exception("Error executing SQL query: " . $conn->error);
        }

        if ($select->num_rows > 0) {
            echo "<table style='margin-left: 55px;'>";
            echo "<tr style='background-color: #1cc88a!important'>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Status</th>
                    </tr>";

            while ($row = $select->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['order_first_name'] . '</td>';
                echo '<td>' . $row['order_last_name'] . '</td>';
                echo '<td>' . $row['order_email'] . '</td>';
                echo '<td>' . $row['order_phone'] . '</td>';
                echo '<td>' . $row['order_status'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "No data found on selected dates";
        }
    } else {
        echo "Error: Date parameter not received.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
