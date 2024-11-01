<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    <div style="width: 700px;">
        <canvas id="myChart" role="img" width="" height="100"> </canvas>
    </div>
    <?php
    // if (isset($_POST['month']) && isset($_POST['year'])) {
        $month = 4;
        $year = 2024;
        include 'Connection.php';

        try {
            $sql = "SELECT * FROM booking WHERE MONTH(booked_date) = '$month' AND YEAR(booked_date) = '$year';";
            $select = $conn->query($sql);

            $serviceQuery = "SELECT * FROM service";
            $service = $conn->query($serviceQuery);

            $serviceName = array();
            $totalserviseProvided = array();

            while ($row = $service->fetch_assoc()) {
                $serviceName[$row['service_id']] = $row['service_name'];
                $totalserviseProvided[$row['service_id']] = 0;
            }

            while ($row = $select->fetch_assoc()) {
                if (array_key_exists($row['service_id'], $totalserviseProvided)) {
                    $totalserviseProvided[$row['service_id']]++;
                }
            }
    ?>

            <script>
                const ctx = document.getElementById('myChart').getContext('2d');

                const labels = <?php echo json_encode(array_values($serviceName)); ?>;
                const data = <?php echo json_encode(array_values($totalserviseProvided)); ?>;

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: '# of Services Provided',
                            data: data,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
    <?php

            if ($select === false) {
                throw new Exception("Error executing SQL query: " . $conn->error);
            }
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    // } else {
    //     echo "Error!";
    // }
    ?>

</body>

</html>