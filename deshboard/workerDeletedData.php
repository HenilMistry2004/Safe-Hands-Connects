<style>
    .pagination {
        margin-top: 20px;
        text-align: center;
    }

    .pagination a {
        margin: 0 5px;
        padding: 8px 12px;
        text-decoration: none;
        background-color: #f54744;
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .pagination a:hover {
        background-color: #d43f3c;
    }

    .pagination a.active {
        background-color: #333;
        pointer-events: none;
    }
</style>

<?php
include 'connection.php';

// Pagination settings
$records_per_page = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Fetch total records
$sql_total = "SELECT COUNT(*) AS total FROM worker WHERE status = 'Inactive'";
$result_total = $conn->query($sql_total);
$total_records = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);

// Fetch paginated data
$sql = "SELECT * FROM worker WHERE status = 'Inactive' LIMIT $offset, $records_per_page";
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
} else {
    echo '<p>No inactive workers found.</p>';
}

// Pagination links
echo "<div class='pagination'>";
if ($page > 1) {
    echo "<a href='#' class='pagination-link' data-page='" . ($page - 1) . "'>Previous</a>";
}
for ($i = 1; $i <= $total_pages; $i++) {
    $active = $i === $page ? "active" : "";
    echo "<a href='#' class='pagination-link $active' data-page='$i'>$i</a>";
}
if ($page < $total_pages) {
    echo "<a href='#' class='pagination-link' data-page='" . ($page + 1) . "'>Next</a>";
}
echo "</div>";

$conn->close();
?>
