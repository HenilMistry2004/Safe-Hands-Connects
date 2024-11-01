<?php
include 'connection.php';

$sql = "SELECT * FROM worker WHERE status = 'Inactive';";
$select = $conn->query($sql);

if ($select->num_rows > 0) {
    echo '<table style="margin-left: 55px;">';
    echo "<tr style='background-color: #f54744'>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact No.</th>
                                                    <th>Address</th>
                                                    <th>Gender</th>
                                                    <th>DOB</th>
                                                    
                                                </tr>";

    while ($row = $select->fetch_assoc()) {
        $worker_id = $row["worker_id"];
        echo '<tr>';
        echo '<td>' . $row["worker_id"] . '</td>';
        echo '<td>' . $row["worker_name"] . '</td>';
        echo '<td>' . $row['worker_email_id'] . '</td>';
        echo '<td>' . $row['worker_contact'] . '</td>';
        echo '<td>' . $row['worker_address'] . '</td>';
        echo '<td>' . $row['worker_gender'] . '</td>';
        echo '<td>' . $row['worker_dob'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

$conn->close();
