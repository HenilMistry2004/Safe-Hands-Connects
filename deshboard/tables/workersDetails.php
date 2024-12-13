<div class="workers" id="workersDetails" style="display: none;">
    <?php
    include 'connection.php';

    // Get the current page number from the request, default is 1
    $page = isset($_GET['page_worker']) ? intval($_GET['page_worker']) : 1;
    $limit = 10; // Number of records per page
    $offset = ($page - 1) * $limit; // Calculate the offset

    try {
        // SQL query to get the total number of active workers
        $totalSql = "SELECT COUNT(*) AS total FROM worker WHERE status = 'active';";
        $result = $conn->query($totalSql);
        if (!$result) {
            die("Error fetching total workers: " . $conn->error);
        }
        $row = $result->fetch_assoc();
        $totalRecords = $row['total'];

        // Calculate the total number of pages
        $totalPages = ceil($totalRecords / $limit);

        // SQL query to get the limited records
        $sql = "SELECT * FROM worker WHERE status = 'active' LIMIT $limit OFFSET $offset;";
        $select = $conn->query($sql);

        if ($select->num_rows > 0) {
            echo '<table>';
            echo "<tr style ='background-color: #1cc88a'>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact No.</th>
                                                <th>Address</th>
                                                <th>Gender</th>
                                                <th>DOB</th>
                                                <th>Delete</th> 
                                            </tr>";

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
                echo "<td style='text-align: center;'><button onclick='deleteWorker($worker_id)' class='delete-btn'><i class='fa fa-trash-o' style='color:#1cc88a;'></i></button></td>";
                echo '</tr>';
            }
            echo '</table>';

            // Pagination
            echo '<div style="text-align: right;width: 1064px;margin-left: 65px;">';
            echo '<button id="backBtn" style="margin-top: 20px;" onclick="loadPreviousWorkerPage(' . ($page - 1) . ')" ' . ($page <= 1 ? 'disabled' : '') . '>Back</button>';

            // Page Numbers
            for ($i = 1; $i <= $totalPages; $i++) {
                if ($i == $page) {
                    echo "<button style='background-color: #1cc88a; color: white; margin: 5px;' disabled>$i</button>";
                } else {
                    echo "<button style='margin: 5px;' onclick='goToWorkerPage($i)'>$i</button>";
                }
            }

            // Next Button
            echo '<button id="nextBtn" style="margin-top: 20px;" onclick="loadNextWorkerPage(' . ($page + 1) . ')" ' . ($page >= $totalPages ? 'disabled' : '') . '>Next</button>';
            echo '</div>';
        } else {
            echo "No active workers found.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
    ?>

    <script>
        function deleteWorker(worker_id) {
            const currentPage = <?php echo $page; ?>;

            $.ajax({
                url: 'deleteData.php',
                method: 'GET',
                data: {
                    worker_id: worker_id,
                    page_worker: currentPage // Pass the current page to maintain pagination

                },
                success: function(response) {
                    loadWorkerPage(currentPage);
                    $('#workersDetails table').load('index.php #workersDetails table');
                    $('#worker span').load('index.php #worker span');
                }
            });
        }

        function loadPreviousWorkerPage(page) {
            if (page >= 1) {
                loadWorkerPage(page);
            }
        }

        function loadNextWorkerPage(page) {
            loadWorkerPage(page);
        }

        function goToWorkerPage(page) {
            loadWorkerPage(page);
        }

        function loadWorkerPage(page = <?php echo $page; ?>) {
            $.ajax({
                url: 'index.php',
                method: 'GET',
                data: {
                    page_worker: page
                },
                success: function(response) {
                    $('#workersDetails').html($(response).find('#workersDetails').html());
                    // Optionally reload worker count or other elements
                    $('#worker #totalNumWorker').load('index.php #worker #totalNumWorker')
                }
            });
        }
    </script>
</div>