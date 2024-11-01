<?php
// Include database connection
include '../Connection/Connection.php'; // Ensure this path is correct

// Query to fetch the sum of order prices grouped by services
$query = "
    SELECT s.service_name, SUM(b.order_price) AS total_price
    FROM booking b
    JOIN service s ON b.service_id = s.service_id
    GROUP BY s.service_id
";

$result = $conn->query($query);

// Prepare data for the pie chart
$serviceNames = [];
$totalPrices = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $serviceNames[] = $row['service_name'];
        $totalPrices[] = (float)$row['total_price'];
    }
}

// Pass the PHP arrays to JavaScript
echo "<script>
    var serviceNames = " . json_encode($serviceNames) . ";
    var totalPrices = " . json_encode($totalPrices) . ";
  </script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Service-wise Order Price Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="margin: auto; height: 383px;">
        <canvas id="pieChart"></canvas>
    </div>

    <script>
        // Create a Pie Chart using Chart.js
        var ctx = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: serviceNames, // Service names for the pie chart labels
                datasets: [{
                    label: '',
                    data: totalPrices, // Corresponding total order prices
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                        '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0'
                    ], // Array of colors for each slice
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'Total Order Price By ' + serviceNames[tooltipItem.dataIndex] + ': Rs ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Total Order Price for Each Service'
                    }
                },
                responsive: true
            }
        });
    </script>
</body>
</html>
