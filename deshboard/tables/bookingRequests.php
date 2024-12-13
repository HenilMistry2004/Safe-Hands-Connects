<div id="requestDetails">
    <?php
    include 'connection.php';

    // Get the current page number from the request, default is 1
    $page = isset($_GET['page_booking']) ? intval($_GET['page_booking']) : 1;
    $limit = 10; // Number of records per page
    $offset = ($page - 1) * $limit; // Calculate the offset

    // SQL query to get the total number of pending bookings
    $totalSql = "SELECT COUNT(*) AS total FROM booking WHERE order_status = 'pending'";
    $result = $conn->query($totalSql);
    if (!$result) {
        die("Error fetching total bookings: " . $conn->error);
    }
    $row = $result->fetch_assoc();
    $totalRecords = $row['total'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $limit);

    // SQL query to get the limited records
    $sql = "SELECT * FROM booking WHERE order_status = 'pending' LIMIT $limit OFFSET $offset";
    $select = $conn->query($sql);

    if ($select->num_rows > 0) {
    ?>
        <table style="margin-left: 70px;">
            <tr style="background-color: #f6c23e">
                <th>Id</th>
                <th>Customer Id</th>
                <th>Service Id</th>
                <th>Name</th>
                <th>Start Date/Time</th>
                <th>End Date/Time</th>
                <th>Status</th>
                <th style="padding-left: 20px;">Reject</th>
            </tr>

            <?php
            while ($row = $select->fetch_assoc()) {
                $booking_Id = $row["booking_Id"];
                echo '<tr>';
                echo '<td>' . $row["booking_Id"] . '</td>';
                echo '<td>' . $row["customer_Id"] . '</td>';
                echo '<td>' . $row['service_id'] . '</td>';
                echo '<td>' . $row["customerName"] . '</td>';
                echo '<td>' . $row['arrival_date'] . '</td>';
                echo '<td>' . $row['departure_date'] . '</td>';
                echo '<td>' . $row['order_status'] . '</td>';
                echo "<td style='text-align: center;'><button onclick='rejectBooking($booking_Id)' style='border: 0px; color: #fff; background: #f54744; border-radius: 5px;'>Reject</button></td>";
                echo '</tr>';
            }
            ?>
        </table>

        <!-- Pagination -->
        <div style="text-align: right; width: 1064px; margin-left: 65px;">
            <button id="backBtn" style="margin-top: 20px;" onclick="loadBookingPage(<?php echo $page - 1; ?>)" <?php echo ($page <= 1 ? 'disabled' : ''); ?>>Back</button>

            <?php
            // Page Numbers
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    echo "<button style='background-color: #f6c23e; color: white; margin: 5px;' disabled>$i</button>";
                } else {
                    echo "<button style='margin: 5px;' onclick='loadBookingPage($i)'>$i</button>";
                }
            }
            ?>

            <button id="nextBtn" style="margin-top: 20px;" onclick="loadBookingPage(<?php echo $page + 1; ?>)" <?php echo ($page >= $totalPages ? 'disabled' : ''); ?>>Next</button>
        </div>

    <?php
    } else {
        echo "No pending bookings found.";
    }
    $conn->close();
    ?>

    <script>
        function rejectBooking(bookingId) {
            $.ajax({
                url: 'deleteData.php',
                method: 'GET',
                data: {
                    booking_Id: bookingId
                },
                success: function(response) {
                    // Reload the current page without a full reload
                    $('#requestDetails').load('index.php?page_booking=<?php echo $page; ?> #requestDetails');
                    $('#pendingRequests #total_booking_requests').load('index.php?page_booking=<?php echo $page; ?> #pendingRequests #total_booking_requests');
                }
            });
        }

        function loadBookingPage(page) {
            $.ajax({
                url: 'index.php',
                method: 'GET',
                data: {
                    page_booking: page
                },
                success: function(response) {
                    $('#requestDetails').html($(response).find('#requestDetails').html());
                }
            });
        }
    </script>
</div>