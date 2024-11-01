<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bullet Graph for Workers</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- <h2>Gender Distribution of Workers</h2> -->
    <canvas id="bulletGraph" style="margin-top: 80px;"></canvas>

    <?php
    // Include the database connection file
    include '../Connection/connection.php'; // Adjust the path as needed

    // Query to count the number of male and female workers
    $query = "SELECT worker_gender, COUNT(*) AS count FROM worker GROUP BY worker_gender";
    $result = $conn->query($query);

    // Initialize variables to store gender count
    $maleCount = 0;
    $femaleCount = 0;

    // Fetch the data from the query result
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (strtolower($row['worker_gender']) === 'male') {
                $maleCount = (int)$row['count'];
            } elseif (strtolower($row['worker_gender']) === 'female') {
                $femaleCount = (int)$row['count'];
            }
        }
    }

    // Prepare data for JavaScript
    echo "<script>
            var maleCount = $maleCount;
            var femaleCount = $femaleCount;
          </script>";
    ?>

    <script>
        // Create a bullet graph using Chart.js
        var ctx = document.getElementById('bulletGraph').getContext('2d');
        new Chart(ctx, {
            type: 'bar', // A horizontal bar chart to resemble a bullet graph
            data: {
                labels: ['Workers'], // Single label for a bullet graph
                datasets: [{
                        label: 'Male Workers',
                        data: [maleCount], // Total male workers
                        backgroundColor: '#4287f5', // Blue color for male
                        barThickness: 30 // Thickness of the bar
                    },
                    {
                        label: 'Female Workers',
                        data: [femaleCount], // Total female workers
                        backgroundColor: '#f54291', // Pink color for female
                        barThickness: 30 // Thickness of the bar
                    }
                ]
            },
            options: {
                indexAxis: 'y', // Display the chart as a horizontal bar
                responsive: true,
                plugins: {
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    },
                    title: {
                        display: true,
                        text: 'Total Number of Male and Female Workers'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Number of Workers' // X-axis title
                        },
                        beginAtZero: true
                    },
                    y: {
                        title: {
                            display: false // No label needed for the Y-axis
                        },
                        stacked: false // To allow separation between bars
                    }
                },
                barPercentage: 0.6, // Adjust this value to control bar width (lower value = narrower bar, more space)
                categoryPercentage: 0.8 // Adjust this value to control space between categories
            }
        });
    </script>

</body>

</html>