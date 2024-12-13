<?php
// Include your database connection
include '../Connection/connection.php'; // Adjust the path as needed

// Fetch data for the chart
$query = "SELECT 
            s.service_name, 
            SUM(b.order_price) AS total_revenue
          FROM 
            booking b
          JOIN 
            service s ON b.service_id = s.service_id
          GROUP BY 
            s.service_name";

$result = $conn->query($query);

$services = [];
$revenues = [];

while ($row = $result->fetch_assoc()) {
    $services[] = $row['service_name']; // Service names
    $revenues[] = $row['total_revenue']; // Total revenue
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Revenue Generated Per Service</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 60%; margin: auto;">
        <canvas id="revenuePieChart"></canvas>
    </div>

    <script>
        // Data from PHP
        const services = <?php echo json_encode($services); ?>;
        const revenues = <?php echo json_encode($revenues); ?>;

        // Generate random colors for each service
        const colors = services.map(() => {
            return `rgba(${Math.floor(Math.random() * 255)}, 
                        ${Math.floor(Math.random() * 255)}, 
                        ${Math.floor(Math.random() * 255)}, 0.7)`;
        });

        // Initialize Chart.js
        const ctx = document.getElementById('revenuePieChart').getContext('2d');
        const revenuePieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: services, // Service names as labels
                datasets: [{
                    label: 'Revenue Generated',
                    data: revenues, // Revenue values
                    backgroundColor: colors, // Random colors
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const value = tooltipItem.raw.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
                                return `${tooltipItem.label}: ${value}`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
