<?php
include 'connection.php';

$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

try {
    $sql = "SELECT * FROM customer WHERE status = 'Inactive' LIMIT $limit OFFSET $offset";
    $select = $conn->query($sql);

    if ($select) {
        if ($select->num_rows > 0) {
?>
            <table style="margin-left: 70px;">
                <tr style="background-color: #4e73df">
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
            // Pagination controls
            $countQuery = "SELECT COUNT(*) AS total FROM customer WHERE status = 'Inactive'";
            $countResult = $conn->query($countQuery);
            $total = $countResult->fetch_assoc()['total'];
            $totalPages = ceil($total / $limit);

            echo '<div class="pagination" style="margin-top: 20px;">';
            if ($page > 1) {
                echo "<button class='page-link' data-page='" . ($page - 1) . "'>Previous</button>";
            }
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = $i == $page ? "style='font-weight:bold;'" : "";
                echo "<button class='page-link' data-page='$i' $activeClass>$i</button>";
            }
            if ($page < $totalPages) {
                echo "<button class='page-link' data-page='" . ($page + 1) . "'>Next</button>";
            }
            echo '</div>';
        } else {
            echo "No data is deleted.";
        }
    } else {
        throw new Exception("Query execution failed");
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
