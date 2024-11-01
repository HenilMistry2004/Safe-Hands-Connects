<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP + Chart.js Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div style="width: 75%; margin: 0 auto;">
        <label for="timeRange">Select Time Range:</label>
        <!-- Use 'onchange' instead of 'onselect' -->
        <select id="timeRange" onchange="bookingGraph()">
            <option value="1year">1 Year</option>
            <option value="6months">6 Months</option>
            <option value="1month">1 Month</option>
        </select>

        <div class="bookingGraph"></div>
        <!-- <canvas id="myChart" width="400" height="200"></canvas> -->
    </div>

    <script>
        function bookingGraph() {
            var time = document.getElementById("timeRange").value;

            $.ajax({
                url: 'chartprocess.php',
                method: 'GET',
                data: {
                    range: time // Send 'range' parameter to the PHP script
                },
                success: function(response) {
                    // Insert the chart's HTML response into the .bookingGraph div
                    $('.bookingGraph').html(response);
                    $('.bookingGraph').show();
                }
            });
        }

        // Optional: Trigger the graph on page load to show initial data
        $(document).ready(function() {
            bookingGraph();
        });
    </script>
</body>

</html>
