<div class="customer" id="customerDetails">
    <?php
    include 'connection.php';

    try {
        // Get the current page number from the request, default is 1
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $limit = 10; // Number of records per page
        $offset = ($page - 1) * $limit; // Calculate the offset

        // Get the total number of active customers
        $totalSql = "SELECT COUNT(*) AS total FROM customer WHERE status = 'active';";
        $result = $conn->query($totalSql);

        if (!$result) {
            throw new Exception("Error fetching total customers: " . $conn->error);
        }

        $row = $result->fetch_assoc();
        $totalRecords = $row['total'];

        // Calculate the total number of pages
        $totalPages = ceil($totalRecords / $limit);

        // SQL query to get the limited records
        $sql = "SELECT * FROM customer WHERE status = 'active' LIMIT $limit OFFSET $offset;";
        $select = $conn->query($sql);

        if (!$select) {
            throw new Exception("SQL Error: " . $conn->error);
        }

    ?>
        <table style="margin-left: 65px;width: 1065px; display: block;">
            <tr style="background-color: #4e73df;">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No.</th>
                <th>Address</th>
                <th>Gender</th>
                <th>DOB</th>
                <th style="padding-left: 20px;">Delete</th>
            </tr>

            <?php
            if ($select->num_rows > 0) {
                while ($row = $select->fetch_assoc()) {
                    $id = $row["customer_id"];
                    echo '<tr>';
                    echo '<td>' . $row["customer_id"] . '</td>';
                    echo '<td>' . $row["customer_name"] . '</td>';
                    echo '<td>' . $row['customer_email_id'] . '</td>';
                    echo '<td>' . $row['customer_contact_no'] . '</td>';
                    echo '<td>' . $row['customer_address'] . '</td>';
                    echo '<td>' . $row['customer_gender'] . '</td>';
                    echo '<td>' . $row['customer_dob'] . '</td>';
                    echo "<td style='text-align: center;'><button style='background: transparent; color: #858796; border: 0px;' onclick='deleteCustomer($id)'><i class='fa fa-trash-o' style='color:#4e73df;'></i></button></td>";
                    echo '</tr>';
                }
            ?>
        </table>

        <!-- Pagination for Customers -->
        <div style="text-align: right;width: 1064px;margin-left: 65px;">
            <!-- Back Button -->
            <button id="backBtn" style="margin-top: 20px;" onclick="loadPreviousCustomerPage(<?php echo $page - 1; ?>)" <?php if ($page <= 1) echo 'disabled'; ?>>Back</button>

            <!-- Page Numbers -->
            <?php
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $page) {
                        // Highlight current page number
                        echo "<button style='background-color: #4e73df; color: white; margin: 5px;' disabled>$i</button>";
                    } else {
                        echo "<button style='margin: 5px;' onclick='goToCustomerPage($i)'>$i</button>";
                    }
                }
            ?>

            <!-- Next Button -->
            <button id="nextBtn" style="margin-top: 20px;" onclick="loadNextCustomerPage(<?php echo $page + 1; ?>)" <?php if ($page >= $totalPages) echo 'disabled'; ?>>Next</button>
        </div>

<?php
            } else {
                echo "<p>No record available.</p>";
            }
        } catch (Exception $e) {
            echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
        } finally {
            $conn->close();
        }
?>

<script>
    function deleteCustomer(id) {
        $.ajax({
            url: 'deleteData.php', // Ensure deleteData.php deletes the customer
            method: 'GET',
            data: {
                id: id
            },
            success: function(response) {
                // Reload the current page with the updated customer data
                loadCustomerPage();
            },
            error: function(xhr) {
                alert("Error deleting customer: " + xhr.responseText);
            }
        });
    }

    function loadPreviousCustomerPage(page) {
        if (page >= 1) {
            loadCustomerPage(page);
        }
    }

    function loadNextCustomerPage(page) {
        loadCustomerPage(page);
    }

    function goToCustomerPage(page) {
        loadCustomerPage(page);
    }

    function loadCustomerPage(page = <?php echo $page; ?>) {
        $.ajax({
            url: 'index.php',
            method: 'GET',
            data: {
                page: page
            },
            success: function(response) {
                $('#customerDetails').html($(response).find('#customerDetails').html());
                // Optionally reload customer count or other elements
                $('#customer #totalNumCustomer').load('index.php #customer #totalNumCustomer')
            },
            error: function(xhr) {
                alert("Error loading customer data: " + xhr.responseText);
            }
        });
    }
</script>
</div>