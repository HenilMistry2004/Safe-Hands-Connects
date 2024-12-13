<div class="requestedWorkersDetails" id="requestedWorkersDetails">
    <?php
    include 'connection.php';

    // Set up pagination variables
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;

    // Query to get the total number of requested workers
    $totalSql = "SELECT COUNT(*) AS total FROM worker WHERE status = 'requested'";
    $result = $conn->query($totalSql);
    if (!$result) {
        die("Error fetching total workers: " . $conn->error);
    }
    $row = $result->fetch_assoc();
    $totalRecords = $row['total'];

    // Calculate total pages
    $totalPages = ceil($totalRecords / $limit);

    // SQL query to fetch the limited records
    $sql = "SELECT * FROM worker WHERE status = 'requested' LIMIT $limit OFFSET $offset";
    $select = $conn->query($sql);

    if ($select->num_rows > 0) {
        echo "<table style ='width: 1185px;'>";
        echo "<tr style ='background-color: #f54744'>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact No.</th>
        <th>Address</th>
        <th>Gender</th>
        <th>DOB</th>
        <th>Status</th> </tr>";

        while ($row = $select->fetch_assoc()) {
            $worker_id = $row["worker_id"];
            echo '<tr>';
            echo '<td>' . $row["worker_id"] . '</td>';
            echo '<td>' . $row["worker_name"] . '</td>';
            echo '<td>' . $row['worker_email_id'] . '</td>';
            echo '<td>' . $row['worker_contact'] . '</td>';
            echo '<td>' . $row['worker_address'] . '</td>';
            echo '<td>' . $row['worker_gender'] . '</td>';
            echo '<td>' . $row['worker_dob'] . '</td>';
            echo "<td style='text-align: center;'><button onclick='approveWorker($worker_id)' style='background: lightgreen; color: #fff; border-radius: 10px;' class='delete-btn'>Approve</button>";
            echo "<button onclick='rejectWorker($worker_id)' style='background: #f54744; margin-left: 5px; border-radius: 10px; color: #fff;' class='delete-btn'>Reject</button></td>";
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "No requests available.";
    }
    ?>

    <!-- Pagination -->
    <div style="text-align: right; width: 1185px;">
        <button id="backBtn" style="margin-top: 20px;" onclick="loadPage(<?php echo $page - 1; ?>)" <?php echo ($page <= 1 ? 'disabled' : ''); ?>>Back</button>

        <?php
        // Page Numbers
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $page) {
                echo "<button style='background-color: #f54744; color: white; margin: 5px;' disabled>$i</button>";
            } else {
                echo "<button style='margin: 5px;' onclick='loadPage($i)'>$i</button>";
            }
        }
        ?>

        <button id="nextBtn" style="margin-top: 20px;" onclick="loadPage(<?php echo $page + 1; ?>)" <?php echo ($page >= $totalPages ? 'disabled' : ''); ?>>Next</button>
    </div>

    <?php $conn->close(); ?>
</div>

<script>
    let currentPage = <?php echo $page; ?>;

    function loadPage(page) {
        currentPage = page;
        $.ajax({
            url: 'index.php',
            method: 'GET',
            data: {
                page: page
            },
            success: function(response) {
                $('#requestedWorkersDetails').html($(response).find('#requestedWorkersDetails').html());
            }
        });
    }

    function approveWorker(workerId) {
        $.ajax({
            url: 'workerStatus.php',
            method: 'POST',
            data: {
                approve: workerId
            },
            success: function() {
                reloadTable();
            }
        });
    }

    function rejectWorker(workerId) {
        $.ajax({
            url: 'workerStatus.php',
            method: 'POST',
            data: {
                reject: workerId
            },
            success: function() {
                reloadTable();
            }
        });
    }

    function reloadTable() {
        $.ajax({
            url: 'index.php',
            method: 'GET',
            data: {
                page: currentPage
            },
            success: function(response) {
                $('#requestedWorkersDetails').html($(response).find('#requestedWorkersDetails').html());
                $('#worker #total_booking_requests').load('index.php #worker #total_booking_requests');
            }
        });
    }
</script>