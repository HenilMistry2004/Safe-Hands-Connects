<?php
// Include database connection
include '../Connection/Connection.php'; // Ensure this path is correct

// Query to fetch the sum of order prices grouped by order status
$query = "
    SELECT order_status, SUM(order_price) AS total_price, COUNT(*) AS total_bookings
    FROM booking
    GROUP BY order_status
";

$result = $conn->query($query);

// Prepare data for the donut chart
$orderStatuses = [];
$totalPricesByStatus = [];
$totalBookings = 0;
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orderStatuses[] = $row['order_status'];
        $totalPricesByStatus[] = (float)$row['total_price'];
        $totalBookings += $row['total_bookings'];
    }
}

// Pass the PHP arrays to JavaScript
echo "<script>
    var orderStatuses = " . json_encode($orderStatuses) . ";
    var totalPricesByStatus = " . json_encode($totalPricesByStatus) . ";
    var totalBookings = $totalBookings;
  </script>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Status Donut Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="margin: auto; height: 345px; width: 345px;">
        <canvas id="donutChart"></canvas>
    </div>

    <script>
        // Function to generate random colors
        function generateRandomColors(count) {
            const colors = [];
            for (let i = 0; i < count; i++) {
                const color = `#${Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0')}`;
                colors.push(color);
            }
            return colors;
        }

        // Custom plugin to display total bookings at the center
        const centerTextPlugin = {
            id: 'centerText',
            beforeDraw: function(chart) {
                const { width } = chart;
                const { height } = chart;
                const ctx = chart.ctx;

                ctx.restore();

                // Adjusted font sizes
                const fontSize1 = (height / 150).toFixed(2); // Smaller size for the number
                const fontSize2 = (height / 300).toFixed(2); // Smaller size for the text

                ctx.textAlign = 'center'; // Center align the text
                ctx.textBaseline = 'middle';

                const text1 = `${totalBookings}`;
                const text2 = "Bookings";

                const textX = width / 2; // Horizontal center
                const textY1 = height / 1.7 - 15; // Move upward for the first line
                const textY2 = height / 1.7 + 20; // Move downward for the second line, adding more space

                // Draw the first line of text (number of bookings)
                ctx.font = `${fontSize1}em sans-serif`;
                ctx.fillStyle = '#000';
                ctx.fillText(text1, textX, textY1);

                // Draw the second line of text ("Bookings")
                ctx.font = `${fontSize2}em sans-serif`;
                ctx.fillText(text2, textX, textY2);

                ctx.save();
            }
        };

        // Generate random colors for the chart
        const randomColors = generateRandomColors(orderStatuses.length);

        // Create a Donut Chart using Chart.js
        var ctx = document.getElementById('donutChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: orderStatuses, // Status labels
                datasets: [{
                    data: totalPricesByStatus, // Corresponding total order prices for each status
                    backgroundColor: randomColors, // Random colors for each segment
                    hoverOffset: 4
                }]
            },
            options: {
                cutout: '80%', // Makes the donut thinner by increasing the inner radius
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return orderStatuses[tooltipItem.dataIndex] + ': Rs ' + tooltipItem.raw.toLocaleString();
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Total Order Price by Status'
                    }
                },
                responsive: true
            },
            plugins: [centerTextPlugin] // Add the custom plugin
        });
    </script>
</body>

</html>
