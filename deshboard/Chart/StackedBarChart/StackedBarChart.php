<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stacked Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div style="width: 100%;">
        <label for="timeRange">Select Time Range:</label>
        <select id="timeRange" onchange="bookingGraph()">
            <option value="12">1 Year</option>
            <option value="6">6 Months</option>
            <option value="1">1 Month</option>
        </select>

        <div class="bookingGraph"></div>
    </div>

    <script>
        function bookingGraph() {
            var time = document.getElementById("timeRange").value;

            $.ajax({
                url: 'Chart/StackedBarChart/fetchChartData.php',
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
