<?php
include "Connection.php";  // Ensure this file contains your database connection code

// Set range to "6months" (for testing purposes)
if (isset($_GET['range'])) {
    $range = $_GET['range'];

    $labels = null;
    $totals = null;

    // Set default range to 1 year if no range is passed
    switch ($range) {
        case '1year':
            $query = "SELECT MONTH(b.booked_date) AS month, 
            COUNT(*) AS total, 
            SUM(ss.sub_service_price) AS total_price
     FROM booking b
     JOIN sub_service ss ON b.sub_service_id = ss.sub_service_id
     WHERE b.booked_date >= NOW() - INTERVAL 1 YEAR
     GROUP BY month";
            break;

        case '6months':
            $query = "SELECT MONTH(b.booked_date) AS month, 
            COUNT(*) AS total, 
            SUM(ss.sub_service_price) AS total_price
     FROM booking b
     JOIN sub_service ss ON b.sub_service_id = ss.sub_service_id
     WHERE b.booked_date >= NOW() - INTERVAL 6 MONTH
     GROUP BY month";
            break;

        case '1month':
            $query = "SELECT DAY(b.booked_date) AS day, 
            COUNT(*) AS total, 
            SUM(ss.sub_service_price) AS total_price
     FROM booking b
     JOIN sub_service ss ON b.sub_service_id = ss.sub_service_id
     WHERE b.booked_date >= NOW() - INTERVAL 1 MONTH
     GROUP BY day";
            break;

        default:
            echo json_encode(['labels' => [], 'totals' => []]);
            exit;
    }

    $result = $conn->query($query);

    $labels = [];
    $totals = [];
    $sub_service_totals = [];  // For storing sub_service totals

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($range == '1month') {
                $labels[] = 'Day ' . $row['day'];  // Use day for 1 month
            } else {
                $labels[] = 'Month ' . $row['month'];  // Use month for 1 year and 6 months
            }
            $totals[] = $row['total'];
            $sub_service_totals[] = $row['total_price'];  // Store total price from sub_service
        }
    }

    // Close the database connection
    $conn->close();

    // Prepare the data array for Chart.js
    $data = [
        "labels" => $labels,
        "datasets" => [
            [
                "label" => "Bookings Count",
                "backgroundColor" => "rgba(255, 99, 132, 0.2)", // Red background color
                "borderColor" => "rgba(255, 99, 132, 1)",       // Red border color
                "borderWidth" => 1,
                "data" => $totals // First dataset for total bookings
            ]
        ]
    ];

    // Output data in JSON format
    $data_json = json_encode($data);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="width: 75%; margin: 0 auto;">
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Dynamic data from the PHP script (encoded in JSON)
        var chartData = <?php echo $data_json; ?>;  // PHP data injected here

        var ctx = document.getElementById('myChart').getContext('2d');

        // Create the chart using Chart.js
        new Chart(ctx, {
            type: 'bar', // Chart type: 'bar'
            data: {
                labels: chartData.labels, // Data labels from PHP
                datasets: chartData.datasets // Data for the chart
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Time Period'  // Label for x-axis
                        }
                    },
                    y: {
                        beginAtZero: true, // Start y-axis at 0
                        title: {
                            display: true,
                            text: 'Number of Bookings'  // Label for y-axis
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
