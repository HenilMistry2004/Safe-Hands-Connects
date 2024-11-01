<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stacked Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Set the size of the canvas */
        #stackedBarChart {
            width: 80%;  /* Width of the canvas */
            height: auto; /* Height set to auto */
            aspect-ratio: 16 / 9; 
        }
    </style>
</head>

<body>
    <!-- <h2>Active Services and Sub-Services Booking Count (Last Year)</h2> -->
    <canvas id="stackedBarChart"></canvas>

    <?php
    // Include the database connection file
    include '../Connection/Connection.php'; // Ensure this path is correct

    if (isset($_GET['range'])) {
        $timePeriod = $_GET['range'];
    } else {
        $timePeriod = 12; // Default to 1 year if no range is specified
    }
    
    // Define the start date based on the selected time period
    switch ($timePeriod) {
        case 1: // 1 Month
            $startDate = date('Y-m-d', strtotime('-1 month'));
            break;
        case 6: // 6 Months
            $startDate = date('Y-m-d', strtotime('-6 months'));
            break;
        case 12: // 1 Year
        default:
            $startDate = date('Y-m-d', strtotime('-1 year'));
            break;
    }

    // Prepare an array to store booking counts by service
    $serviceSubServiceData = [];

    // Query to fetch the count of active services and their corresponding bookings within the last year
    $query = "SELECT s.service_name, ss.sub_service_name, COUNT(b.booking_Id) AS booking_count
          FROM service s
          INNER JOIN sub_service ss ON s.service_id = ss.service_id
          LEFT JOIN booking b ON ss.sub_service_id = b.sub_service_id AND b.booked_date >= '$startDate'
          WHERE s.status = 'Active'
          GROUP BY s.service_name, ss.sub_service_name";

    $result = $conn->query($query);

    // Process the fetched data
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $serviceName = $row['service_name'];
            $subServiceName = $row['sub_service_name'];
            $bookingCount = (int)$row['booking_count'];

            // Organize the data by service name
            if (!isset($serviceSubServiceData[$serviceName])) {
                $serviceSubServiceData[$serviceName] = [];
            }

            // Store booking count for the corresponding sub-service
            $serviceSubServiceData[$serviceName][$subServiceName] = $bookingCount;
        }
    }

    // Prepare the data for JavaScript
    echo "<script>
        var chartData = " . json_encode($serviceSubServiceData) . ";
      </script>";
    ?>

    <script>
        // Process PHP data in JavaScript
        var labels = Object.keys(chartData); // Service names for x-axis
        var subServiceNames = [...new Set(Object.values(chartData).flatMap(service => Object.keys(service)))];

        var datasets = subServiceNames.map((subServiceName, index) => ({
            label: subServiceName,
            data: labels.map(label => chartData[label][subServiceName] || 0),
            backgroundColor: `hsl(${index * 30}, 70%, 50%)`, // Different colors for each sub-service
        }));

        var ctx = document.getElementById('stackedBarChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels, // Set service names on x-axis
                datasets: datasets
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Total Bookings for Active Services and Sub-Services (Last Year)'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Services' // X-axis label
                        },
                        stacked: true
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Bookings' // Y-axis label
                        },
                        stacked: true,
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>
