<?php
// Include database connection
include '../Connection/Connection.php'; // Ensure this path is correct

// Query to count the total number of bookings and the number of 'Pending' and 'Rejected' bookings
$query = "
    SELECT 
        COUNT(*) AS total_bookings,
        SUM(CASE WHEN order_status = 'Pending' THEN 1 ELSE 0 END) AS pending_bookings,
        SUM(CASE WHEN order_status = 'Rejected' THEN 1 ELSE 0 END) AS rejected_bookings
    FROM booking
";

$result = $conn->query($query);

// Prepare data for the donut pie chart
$totalBookings = 0;
$pendingBookings = 0;
$rejectedBookings = 0;

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalBookings = (int)$row['total_bookings'];
    $pendingBookings = (int)$row['pending_bookings'];
    $rejectedBookings = (int)$row['rejected_bookings'];
    $completedBookings = $totalBookings - $pendingBookings - $rejectedBookings;
}

// Pass the PHP values to JavaScript
echo "<script>
    var totalBookings = " . json_encode($totalBookings) . ";
    var pendingBookings = " . json_encode($pendingBookings) . ";
    var rejectedBookings = " . json_encode($rejectedBookings) . ";
    var completedBookings = " . json_encode($completedBookings) . ";
  </script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookings Donut Pie Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="height: 100%; margin: auto;">
        <canvas id="donutChart" style="display: inline-block;height: 330px;width: 348px;box-sizing: revert-layer;"></canvas>
    </div>

    <script>
        // Register a plugin to draw text in the center of the donut chart
        Chart.register({
            id: 'centerTextPlugin',
            afterDraw: function(chart) {
                var ctx = chart.ctx;
                var width = chart.width;
                var height = chart.height;
                var totalBookings = chart.config.options.totalBookings;

                // Draw the text in the center of the donut
                ctx.restore();
                ctx.font = 'bold 24px Arial';
                ctx.textBaseline = 'middle';

                // Calculate the text position
                var text = totalBookings;
                var textX = Math.round((width - ctx.measureText(text).width) / 2);
                var textY = height / 2 - 10;

                ctx.fillText(text, textX, textY);

                // Draw 'Total Bookings' below the number
                ctx.font = '16px Arial';
                var subText = 'Total Bookings';
                var subTextX = Math.round((width - ctx.measureText(subText).width) / 2);
                var subTextY = height / 2 + 20;

                ctx.fillText(subText, subTextX, subTextY);

                ctx.save();
            }
        });

        // Create a Donut Pie Chart using Chart.js
        var ctx = document.getElementById('donutChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pending Bookings', 'Rejected Bookings', 'Completed Bookings'], // Chart labels
                datasets: [{
                    data: [pendingBookings, rejectedBookings, completedBookings], // Corresponding data for the chart
                    backgroundColor: ['#FF6384', '#FFCE56', '#36A2EB'], // Array of colors for each segment
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                var label = tooltipItem.label || '';
                                var value = tooltipItem.raw || 0;
                                return label + ': ' + value + ' bookings';
                            }
                        }
                    },
                    title: {
                        display: true,
                        // text: 'Comparison of Pending, Rejected, and Completed Bookings'
                    }
                },
                responsive: true,
                cutout: '80%', // Makes the donut thinner by increasing the cutout size
                aspectRatio: 2, // Adjusts the size of the chart based on aspect ratio
                totalBookings: totalBookings // Pass total bookings to the plugin
            }
        });
    </script>
</body>
</html>
