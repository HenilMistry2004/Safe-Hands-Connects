<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Pagination</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f54744;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .pagination {
            text-align: center;
            margin: 20px 0;
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
            color: white;
            pointer-events: none;
        }
    </style>
</head>
<body>

<?php
$records_per_page = 10;
include 'Connection.php';

if (isset($_POST['report'])) {
    $reportType = $_POST['report'];
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $offset = ($page - 1) * $records_per_page;

    try {
        if ($reportType === "tpsReport" && isset($_POST['date'])) {
            $date = $_POST['date'];
            $sql_total = "SELECT COUNT(*) AS total FROM booking WHERE DATE(booked_date) = '$date'";
            $result_total = $conn->query($sql_total);
            $total_records = $result_total->fetch_assoc()['total'];
            $total_pages = ceil($total_records / $records_per_page);

            $sql = "SELECT * FROM booking WHERE DATE(booked_date) = '$date' LIMIT $offset, $records_per_page";
            $select = $conn->query($sql);
            renderTable($select, $total_pages, $page, 'tps-pagination');
        } elseif ($reportType === "misReport" && isset($_POST['month']) && isset($_POST['year'])) {
            $month = $_POST['month'];
            $year = $_POST['year'];

            $sql_total = "SELECT COUNT(*) AS total FROM booking WHERE MONTH(booked_date) = '$month' AND YEAR(booked_date) = '$year'";
            $result_total = $conn->query($sql_total);
            $total_records = $result_total->fetch_assoc()['total'];
            $total_pages = ceil($total_records / $records_per_page);

            $sql = "SELECT * FROM booking WHERE MONTH(booked_date) = '$month' AND YEAR(booked_date) = '$year' LIMIT $offset, $records_per_page";
            $select = $conn->query($sql);
            renderTable($select, $total_pages, $page, 'mis-pagination');
        }
    } catch (Exception $e) {
        echo "<table><tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr></table>";
    }
}

function renderTable($select, $total_pages, $page, $paginationClass)
{
    if ($select->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Customer Name</th>
                    <th>Customer Id</th>
                    <th>Services Id</th>
                    <th>Email</th>
                    <th>Contact No</th>
                </tr>";
        while ($row = $select->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['customerName']}</td>
                    <td>{$row['customer_Id']}</td>
                    <td>{$row['service_id']}</td>
                    <td>{$row['order_email']}</td>
                    <td>{$row['order_phone']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<table><tr><td colspan='5'>No data found.</td></tr></table>";
    }

    // Pagination controls
    echo "<div class='pagination'>";
    if ($page > 1) {
        echo "<a href='#' class='$paginationClass' data-page='" . ($page - 1) . "'>Previous</a> ";
    }
    for ($i = 1; $i <= $total_pages; $i++) {
        $activeClass = ($i === $page) ? "active" : "";
        echo "<a href='#' class='$paginationClass $activeClass' data-page='$i'>$i</a> ";
    }
    if ($page < $total_pages) {
        echo "<a href='#' class='$paginationClass' data-page='" . ($page + 1) . "'>Next</a>";
    }
    echo "</div>";
}

$conn->close();
?>

</body>
</html>
