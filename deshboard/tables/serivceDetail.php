<div id="serivceDetail" style="display: none;">

    <style>
        /* Additional styling for sub-service details */
        .sub-service-details {
            display: none;
            background-color: #e9e9e9;
            padding: 10px;
            border-radius: 4px;
            position: absolute;
            z-index: 1000;
            left: 100%;
            top: 0;
            margin-left: 10px;
        }

        .sub-service-item {
            margin-left: 30px;
            margin-right: 55px;
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .sub-service-item:hover .sub-service-details {
            display: block;
        }
    </style>


    <?php
    include 'connection.php';

    // Get the current page number from the request, default is 1
    $page = isset($_GET['page_service']) ? intval($_GET['page_service']) : 1;
    $serviceLimit = 5; // Number of records per page is now set to 5
    $offset = ($page - 1) * $serviceLimit; // Calculate the offset

    // SQL query to get the total number of active services
    $totalSql = "SELECT COUNT(*) AS total FROM service WHERE status = 'active'";
    $result = $conn->query($totalSql);
    if (!$result) {
        die("Error fetching total services: " . $conn->error);
    }
    $row = $result->fetch_assoc();
    $totalRecords = $row['total'];

    // Calculate the total number of pages
    $totalPages = ceil($totalRecords / $serviceLimit);

    // SQL query to get the limited records
    $sql = "SELECT * FROM service WHERE status = 'active' LIMIT $serviceLimit OFFSET $offset";
    $select = $conn->query($sql);

    if ($select->num_rows > 0) {
    ?>

        <table id="serivceDetailTable" style="margin-left: 60px;">
            <tr style="background-color: #36b9cc">
                <th>Service Id</th>
                <th>Service Name</th>
                <th>Description</th>
                <th>Services Images Path</th>
                <th style="padding-left: 12px;">Delete</th>
                <th style="padding-left: 40px; width: 100px;">Sub-Services</th>
            </tr>

            <?php
            while ($row = $select->fetch_assoc()) {
                $service_id = $row["service_id"];
                echo '<tr>';
                echo '<td>' . $row["service_id"] . '</td>';
                echo '<td>' . $row["service_name"] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['services_image'] . '</td>';
                echo "<td style='text-align: center;'><button style='background: transparent; border: 0px; color: #858796;' onclick='deleteServices($service_id, $page)'><i class='fa fa-trash-o' style='color:#36b9cc;'></i></button></td>";

                $sub_service_sql = "SELECT * FROM sub_service WHERE service_id = $service_id";
                $sub_service = $conn->query($sub_service_sql);

                echo "<td>";
                if ($sub_service->num_rows > 0) {
                    echo "<ul style='display: inline;'>";
                    while ($sub_row = $sub_service->fetch_assoc()) {
                        $subServiceId = $sub_row['sub_service_id'];
                        $subServiceName = $sub_row['sub_service_name'];
                        $subServiceDescription = $sub_row['description'];
                        $subServicePrice = $sub_row['sub_service_price'];
                        echo "<li class='sub-service-item' style='width: 120px;'>$subServiceName
                                    <div class='sub-service-details'>
                                        <p><strong>sub-service-id:</strong> $subServiceId</p><hr>
                                        <p><strong>Description:</strong> $subServiceDescription</p><hr>
                                        <p><strong>Price:</strong> $subServicePrice</p>
                                    </div>
                                </li>";
                    }
                    echo "</ul>";
                } else {
                    echo "No Sub-Services";
                }

                echo "</td>";
                echo '</tr>';
            }
            echo '</table>';
            ?>

            <!-- Pagination -->
            <div style="text-align: right; width: 1064px; margin-left: 65px;" id="servicesDetailsPages">
                <button id="backBtn" style="margin-top: 20px;" onclick="loadServicePage(<?php echo $page - 1; ?>)" <?php echo ($page <= 1 ? 'disabled' : ''); ?>>Back</button>

                <?php
                // Page Numbers
                for ($i = 1; $i <= $totalPages; $i++) {
                    if ($i == $page) {
                        echo "<button style='background-color: #36b9cc; color: white; margin: 5px;' disabled>$i</button>";
                    } else {
                        echo "<button style='margin: 5px;' onclick='loadServicePage($i)'>$i</button>";
                    }
                }
                ?>

                <button id="nextBtn" style="margin-top: 20px;" onclick="loadServicePage(<?php echo $page + 1; ?>)" <?php echo ($page >= $totalPages ? 'disabled' : ''); ?>>Next</button>
            </div>

        <?php
    } else {
        echo "No active services found.";
    }
    $conn->close();

        ?>
        <div id="serviceFormPopup" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Add Service</h3>
                <form id="serviceForm" action="insert.php" method="post" enctype="multipart/form-data" style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <label style="display: block; margin-bottom: 5px;">Service Name</label>
                    <input type="text" name="serviceName" id="serviceName" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                    <label style="display: block; margin-bottom: 5px;">Description</label>
                    <input type="text" name="servicesDescription" id="description" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                    <label style="display: block; margin-bottom: 5px;">Services Images Path</label>
                    <input type="file" name="servicesImagesPath" id="path" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                    <input type="checkbox" id="addSubServices" onclick="toggleSubServiceFields()"> Add Sub-Services<br><br>

                    <div id="subServicesContainer" style="display: none;">
                        <div id="subServiceFields">
                            <h4>Sub-Service</h4>
                            <label style="display: block; margin-bottom: 5px;">Sub-Service Name</label>
                            <input type="text" name="subServiceName[]" class="subServiceName" style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                            <label style="display: block; margin-bottom: 5px;">Description</label>
                            <input type="text" name="subServiceDescription[]" class="subServiceDescription" style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                            <label style="display: block; margin-bottom: 5px;">Price</label>
                            <input type="text" name="subServicePrice[]" class="subServicePrice" onkeypress="return /[0-9]/i.test(event.key)" style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                            <button type="button" onclick="addSubServiceFields()">Add Another Sub-Service</button>
                        </div>
                    </div>
                    <input type="button" value="Insert" id="insert" onclick="insertServices()" style="background-color: #f54744; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                </form>
            </div>
        </div>

        <script>
            function toggleSubServiceFields() {
                const container = document.getElementById("subServicesContainer");
                container.style.display = document.getElementById("addSubServices").checked ? "block" : "none";
            }

            function addSubServiceFields() {
                const container = document.getElementById("subServicesContainer");
                const subServiceFields = document.getElementById("subServiceFields").cloneNode(true);
                subServiceFields.querySelectorAll('input').forEach(input => input.value = ''); // Clear the values of cloned fields
                container.appendChild(subServiceFields);
            }

            function insertServices() {
                var lastpage = <?php echo $totalPages; ?>;

                // Retrieve single values
                var name = document.getElementById("serviceName").value;
                var description = document.getElementById("description").value;
                // var price = document.getElementById("price").value; // Uncomment if needed
                var path = document.getElementById("path").files[0]; // Use .files[0] to get the file object

                // Retrieve multiple values
                var subServiceNames = Array.from(document.querySelectorAll("input[name='subServiceName[]']")).map(el => el.value);
                var subServiceDescriptions = Array.from(document.querySelectorAll("input[name='subServiceDescription[]']")).map(el => el.value);
                var subServicePrices = Array.from(document.querySelectorAll("input[name='subServicePrice[]']")).map(el => el.value);

                // Prepare FormData object to handle file uploads
                var formData = new FormData();
                formData.append("serviceName", name);
                formData.append("servicesDescription", description);
                // formData.append("servicePrice", price); // Uncomment if needed
                formData.append("servicesImagesPath", path);

                // Append sub-service data
                subServiceNames.forEach((name, index) => {
                    formData.append("subServiceName[]", name);
                    formData.append("subServiceDescription[]", subServiceDescriptions[index]);
                    formData.append("subServicePrice[]", subServicePrices[index]);
                });

                // Perform AJAX request
                $.ajax({
                    url: 'insert.php',
                    method: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from automatically transforming the data into a query string
                    contentType: false, // Prevent jQuery from setting the content type header
                    success: function(response) {
                        $('#services #totalNumServices').load('index.php #services #totalNumServices');
                        $('#serviceFormPopup #serviceForm').load('index.php #serviceFormPopup #serviceForm');
                        loadServicePage(lastpage);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error); // Handle errors
                    }
                });
            }

            var serviceModal = document.getElementById("serviceFormPopup");
            var closeBtns = document.getElementsByClassName("close");

            for (let i = 0; i < closeBtns.length; i++) {
                closeBtns[i].onclick = function() {
                    serviceModal.style.display = "none";
                }
            }

            window.onclick = function(event) {
                if (event.target == serviceModal) {
                    serviceModal.style.display = "none";
                }
            }
        </script>


        <div id="subServiceFormPopup" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h3>Add Sub-Service</h3>
                <form action="insert_sub_service.php" method="post" style="background-color: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <input type="hidden" name="serviceId" id="subServiceServiceId">
                    <label style="display: block; margin-bottom: 5px;">Sub-Service Name</label>
                    <input type="text" name="subServiceName" id="subServiceName" required style="width: 100%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 4px;"><br>
                    <input type="button" value="Insert" id="insertSubService" onclick="insertSubService()" style="background-color: #f54744; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                </form>
            </div>
        </div>

        <script>
            function deleteServices(service_id, currentPage) {
                $.ajax({
                    url: 'deleteData.php',
                    method: 'GET',
                    data: {
                        service_id: service_id
                    },
                    success: function(response) {
                        // Reload the current page after deletion
                        loadServicePage(currentPage);
                        $('#services #totalNumServices').load('index.php #services #totalNumServices');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }


            function loadServicePage(page) {
                $.ajax({
                    url: 'index.php',
                    method: 'GET',
                    data: {
                        page_service: page
                    },
                    success: function(response) {
                        $('#serivceDetail').html($(response).find('#serivceDetail').html());
                        $('#services #totalNumServices').load('index.php #services #totalNumServices');
                    }
                });
            }
        </script>

        <style>
            /* The Modal (background) */
            .modal {
                display: none;
                /* Hidden by default */
                position: fixed;
                /* Stay in place */
                z-index: 1;
                /* Sit on top */
                left: 0;
                top: 0;
                width: 100%;
                /* Full width */
                height: 100%;
                /* Full height */
                overflow: auto;
                /* Enable scroll if needed */
                background-color: rgba(0, 0, 0, 0.4);
                /* Black with opacity */
            }

            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 100px auto;
                /* Center modal vertically and horizontally */
                padding: 20px;
                border: 1px solid #888;
                width: 60%;
                /* Set width of modal */
                max-width: 600px;
                /* Limit maximum width */
                border-radius: 8px;
                /* Add rounded corners */
            }

            /* Close Button */
            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            ul {
                list-style-type: none;
                padding: 0;
            }

            ul li {
                margin: 5px 0;
                padding: 5px;
                /* background-color: #f1f1f1; */
                border-radius: 4px;
            }
        </style>

        <script>
            var modal = document.getElementById("serviceFormPopup");

            var btn = document.getElementById("openFormBtn");

            var span = document.getElementsByClassName("close")[0];

            btn.onclick = function() {
                modal.style.display = "block";
            }

            span.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>

        <?php
        include 'connection.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $serviceName = $_POST['serviceName'];
            $servicesDescription = $_POST['servicesDescription'];
            $servicePrice = $_POST['servicePrice'];
            $servicesImagesPath = $_FILES['servicesImagesPath']['name'];

            // Handle file upload
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["servicesImagesPath"]["name"]);
            move_uploaded_file($_FILES["servicesImagesPath"]["tmp_name"], $target_file);

            $stmt = $conn->prepare("INSERT INTO service (service_name, description, service_price, services_image, status) VALUES (?, ?, ?, ?, 'active')");
            $stmt->bind_param("ssis", $serviceName, $servicesDescription, $servicePrice, $servicesImagesPath);

            if ($stmt->execute()) {
                echo "Service added successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }

        // include 'connection.php';

        // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //     $serviceName = $_POST['serviceName'];
        //     $servicesDescription = $_POST['servicesDescription'];

        //     $servicePrice = $_POST['servicePrice'];
        //     $servicesImagesPath = $_FILES['servicesImagesPath']['name'];

        //     // Handle file upload
        //     $target_dir = "ServiceImage/";

        //     $target_file = $target_dir . basename($servicesImagesPath);

        //     if (move_uploaded_file($_FILES["servicesImagesPath"]["tmp_name"], $target_file)) {

        //         $stmt = $conn->prepare("INSERT INTO service (service_name, description, service_price, services_image, status) VALUES (?, ?, ?, ?, 'active')");
        //         $stmt->bind_param("ssis", $serviceName, $servicesDescription, $servicePrice, $target_file);

        //         if ($stmt->execute()) {
        //             echo "Service added successfully.";
        //         } else {
        //             echo "Error: " . $stmt->error;
        //         }

        //         $stmt->close();
        //         $conn->close();
        //     }
        // }
        ?>
</div>