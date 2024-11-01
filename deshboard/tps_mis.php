<?php
if (isset($_POST['date'])) {
    $date = $_POST['date'];

    include 'Connection.php';

    try {
        $sql = "SELECT * FROM booking WHERE DATE(booked_date) = '$date'";
        $select = $conn->query($sql);

        if ($select === false) {
            throw new Exception("Error executing SQL query: " . $conn->error);
        }

        if ($select->num_rows > 0) {

?>
            <table style='margin-left: 55px;'>
                <tr style='background-color: #f54744'>
                    <th>Customer Name</th>
                    <th>Customer Id</th>
                    <th>Services Id</th>
                    <th>Email</th>
                    <th>Contact No</th>
                </tr>
    <?php
            while ($row = $select->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['customerName'] . '</td>';
                echo '<td>' . $row['customer_Id'] . '</td>';
                echo '<td>' . $row['service_id'] . '</td>';
                echo '<td>' . $row['order_email'] . '</td>';
                echo '<td>' . $row['order_phone'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo "<tr><td colspan='5'>No data found on selected date</td></tr>";
        }
    } catch (Exception $e) {
        echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
    }

    $conn->close();
    echo " </table>";
}
    ?>

    <!-- MIS -->

    <?php
    if (isset($_POST['month']) && isset($_POST['year'])) {
        $month = $_POST['month'];
        $year = $_POST['year'];

        include 'Connection.php';

        try {
            $sql = "SELECT * FROM booking WHERE MONTH(booked_date) = '$month' AND YEAR(booked_date) = '$year';";
            $select = $conn->query($sql);

            if ($select === false) {
                throw new Exception("Error executing SQL query: " . $conn->error);
            }

            if ($select->num_rows > 0) {

    ?>
                <table style='margin-left: 55px;'>
                    <tr style='background-color: #f54744'>
                        <th>Customer Name</th>
                        <th>Customer Id</th>
                        <th>Services Id</th>
                        <th>Email</th>
                        <th>Contact No</th>
                    </tr>
        <?php
                while ($row = $select->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['customerName'] . '</td>';
                    echo '<td>' . $row['customer_Id'] . '</td>';
                    echo '<td>' . $row['service_id'] . '</td>';
                    echo '<td>' . $row['order_email'] . '</td>';
                    echo '<td>' . $row['order_phone'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='5'>No data found on selected month or year.</td></tr>";
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
        }

        $conn->close();

        echo "</table>";
    } 
        ?>