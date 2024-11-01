<?php
include 'connection.php';

try {
    $sql = "select * from customer where status = 'Inactive';";
    $select = $conn->query($sql);

    if ($select) {
        if ($select->num_rows > 0) {
?>
            <table style="margin-left: 70px;">
                <tr style=" background-color: #f54744">
                    <th> Id</th>
                    <th> Name</th>
                    <th> Email</th>
                    <th> Contact No.</th>
                    <th> Address </th>
                    <th> Gender </th>
                    <th> DOB </th>
                </tr>

                <?php
                while ($row = $select->fetch_assoc()) {
                    $id = $row["customer_id"];
                    echo '<tr>';
                    echo '<td>' . $row["customer_id"] . '</td>';
                    echo '<td>' . $row["customer_name"] . '</td>';
                    echo '<td>' . $row['customer_email_id'] . '</td>';
                    echo '<td>' . $row['customer_contact_no'] . '</td>';
                    echo '<td>' . $row['customer_address'] . '</td>';
                    echo '<td>' . $row['customer_gender'] . '</td>';
                    echo '<td>' . $row['customer_dob'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </table>

<?php
        }else{
            echo("No data is deleted.");
        }
    } else {
        throw new Exception("Query execution failed");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
