<?php
session_start();

if (!isset($_SESSION['adminLoggedIn'])) {
    header("Location: ../Login/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHC Admin </title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="index.js"></script>

    <style>
        table th,
        td {
            padding-left: 15px;
        }

        #costomerHeader {
            display: none;
        }

        #workerHeader {
            display: none;
        }

        #serviceHeader {
            display: none;
        }

        #customerDetails {
            display: none;
        }

        #workersDetails {
            display: none;
        }

        #serivceDetails {
            display: none;
        }
    </style>

</head>

<body id="page-top">
    <?php
    include "Connection.php";
    ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-handshake"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SHC</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active" style="background-color: #4e73df;">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item" style="background-color: #4e73df;">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Report</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Report:</h6>
                        <span class="collapse-item" id="tps">Daily Report</span>
                        <span class="collapse-item" id="mis">Monthly Report</span>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item" style="background-color: #4e73df;">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Deleted Data</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Deleted Data:</h6>
                        <p class="collapse-item" id="deleteCustomer" onclick="return customerDeletedData()">Customer</p>
                        <p class="collapse-item" id="deleteWorker" onclick="return workerDeletedData()">worker</p>

                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item" id="chartMenu">
                <a class="nav-link" style="cursor: pointer;">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Charts</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button" style="background: #4e73df; border: 1px solid #4e73df;">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span> -->
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="page4.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">

                    <div class="row">



                        <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer; max-width: 20%;" id="customer">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style=" font-size: 25px;">
                                                Customer</div>
                                        </div>
                                        <div class="col-auto">
                                            <span id="totalNumCustomer">
                                                <?php

                                                include "Connection.php";

                                                $sql = "SELECT COUNT(customer_id) AS total_customers FROM customer where status = 'active'";

                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo "Total customers: " . $row['total_customers'];
                                                } else {
                                                    echo "No customers found.";
                                                }

                                                mysqli_close($conn);
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer; max-width: 20%;" id="worker">


                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2" style="padding-right: 20px;">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style=" font-size: 25px;">Worker</div>
                                        </div>
                                        <div class="col-auto">
                                            <span id="total_booking_requests" id="deleteNumWorker">
                                                <?php

                                                include "Connection.php";

                                                $sql = "SELECT COUNT(worker_id) AS total_worker FROM worker where status = 'active'";

                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo "Total workers: " . $row['total_worker'];
                                                } else {
                                                    echo "No customers found.";
                                                }

                                                mysqli_close($conn);
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer; max-width: 20%;" id="requestedWorkers">


                            <div class="card border-left-success shadow h-100 py-2" style="border-left: .25rem solid #f54744;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2" style="padding-right: 20px;">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style=" font-size: 25px; color: #f54744;">Worker Request</div>
                                        </div>
                                        <div class="col-auto">
                                            <span id="total_booking_requests" id="deleteNumWorker">
                                                <?php

                                                include "Connection.php";

                                                $sql = "SELECT COUNT(worker_id) AS total_worker FROM worker where status = 'requested'";

                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo "Total workers: " . $row['total_worker'];
                                                } else {
                                                    echo "No customers found.";
                                                }

                                                mysqli_close($conn);
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer; max-width: 20%;" id="services">

                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2" style="padding-right: 20px;">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="font-size: 25px;">Services
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <span id="totalNumServices">
                                                <?php
                                                include "Connection.php";

                                                $sql = "SELECT COUNT(service_id) AS total_service FROM service where status = 'active'";

                                                $result = mysqli_query($conn, $sql);

                                                if (mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo "Total service:  " . $row['total_service'];
                                                } else {
                                                    echo "No customers found.";
                                                }

                                                mysqli_close($conn);
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer; max-width: 20%;" id="pendingRequests">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="font-size: 25px;">
                                                Booking Requests</div>
                                        </div>
                                        <div class="col-auto">
                                            <span id="total_booking_requests">
                                                <?php
                                                include "Connection.php";
                                                $sql = "SELECT COUNT(booking_id) AS total_booking FROM booking WHERE order_status = 'pending'";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo "Total Request: " . $row['total_booking'];
                                                } else {
                                                    echo "Total Request: 0";
                                                }
                                                mysqli_close($conn);
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card shadow mb-4" style="display: none;" id="display">
                        <div class="card-header py-3" id="costomerHeader">
                            <h6 class="m-0 font-weight-bold text-primary" style=" font-size: 25px; padding-left: 500px; ">Customer Details</h6>
                        </div>

                        <div class="card-header py-3-1" id="workerHeader">
                            <h6 class="m-0 font-weight-bold text-primary-1" style="font-size: 25px;padding-left: 510px;color: #1cc88a;">Worker Details</h6>
                        </div>

                        <div class="card-header py-3-16" id="requestWorkersHeader">
                            <h6 class="m-0 font-weight-bold text-primary-1" style="font-size: 25px;padding-left: 510px;color: #f54744;">Worker Request</h6>
                        </div>

                        <div class="card-header py-3-2" id="serviceHeader">
                            <h6 class="m-0 font-weight-bold text-primary-2" style="font-size: 25px;padding-left: 510px; color:#36b9cc;">Service Details</h6>
                            <div class="add" style=" margin-left: 1155px; margin-top: -25px; padding-bottom: 0px;" id="openFormBtn"><button style="width: 60px;background-color: #36b9cc;color: #fff;border: 0;border-radius: 8px;">Add</button></div>
                        </div>

                        <div class="card-header py-3-3" id="bookingRequestHeader">
                            <h6 class="m-0 font-weight-bold text-primary-1" style="font-size: 25px;padding-left: 510px; color: #f6c23e;">Booking Request</h6>
                        </div>

                        <div class="card-header py-3-4" id="deletedCostomerHeader">
                            <h6 class="m-0 font-weight-bold text-primary" style=" font-size: 25px; padding-left: 500px; ">Customer Deleted Details</h6>
                        </div>

                        <div class="card-header py-3-1" id="deletedWorkerHeader">
                            <h6 class="m-0 font-weight-bold text-primary-1" style="font-size: 25px;padding-left: 510px;color: #f54744;">Worker Deleted Details</h6>
                        </div>

                        <div class="card-header py-3-7" id="TPSHrader">
                            <h6 class="m-0 font-weight-bold text-primary-1" style="font-size: 25px;padding-left: 510px;color: #f54744;">Daliy Services Details</h6>
                        </div>

                        <div class="card-header py-3-5" id="MISHeader">
                            <h6 class="m-0 font-weight-bold text-primary-1" style="font-size: 25px;padding-left: 510px;color: #f54744;">Monthly Servives Details</h6>
                        </div>

                        <div class="card-body" id="allTablesDetails">

                            <style>
                                /* Table Styling */
                                table {
                                    width: 90%;
                                    border-collapse: collapse;
                                    margin: 0 auto;
                                    font-size: 16px;
                                }

                                th,
                                td {
                                    border: 1px solid #ddd;
                                    padding: 8px;
                                    text-align: left;
                                }

                                th {
                                    color: #fff;
                                }

                                tr:nth-child(even) {
                                    background-color: #f2f2f2;
                                }

                                tr:hover {
                                    background-color: #ddd;
                                }

                                /* Button Styling */
                                .delete-btn {
                                    background: transparent;
                                    border: 0px;
                                    color: #858796;
                                    cursor: pointer;
                                }

                                .delete-btn:hover {
                                    color: #5a5c69;
                                }
                            </style>


                            <div class="customer" id="customerDetails">
                                <?php
                                include 'connection.php';

                                // Get the current page number from the request, default is 1
                                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                                $limit = 10; // Number of records per page
                                $offset = ($page - 1) * $limit; // Calculate the offset

                                // Get the total number of active customers
                                $totalSql = "SELECT COUNT(*) AS total FROM customer WHERE status = 'active';";
                                $result = $conn->query($totalSql);
                                if (!$result) {
                                    die("Error fetching total customers: " . $conn->error);
                                }
                                $row = $result->fetch_assoc();
                                $totalRecords = $row['total'];

                                // Calculate the total number of pages
                                $totalPages = ceil($totalRecords / $limit);

                                try {
                                    // SQL query to get the limited records
                                    $sql = "SELECT * FROM customer WHERE status = 'active' LIMIT $limit OFFSET $offset;";
                                    $select = $conn->query($sql);
                                    if (!$select) {
                                        die("SQL Error: " . $conn->error);
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
                                            echo "No record available.";
                                        }
                                    } catch (Exception $e) {
                                        echo "Error: " . $e->getMessage();
                                    }

                                    $conn->close();
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
                                        }
                                    });
                                }
                            </script>
                            </div>

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

                            <div class="customerDeletedData">
                                <script>
                                    function customerDeletedData() {
                                        $.ajax({
                                            url: 'customerDeletedData.php',
                                            method: 'GET',
                                            data: {},
                                            success: function(response) {
                                                $('.deletedCustomerTable').html(response); // Replace content of .tpsTableReporte with response
                                                $('.deletedCustomerTable').show();
                                            }
                                        });
                                    }
                                </script>
                                <div class="deletedCustomerTable"></div>
                            </div>

                            <div class=" workerDeleteData">

                                <script>
                                    function workerDeletedData() {
                                        $.ajax({
                                            url: 'workerDeletedData.php',
                                            method: 'GET',
                                            data: {},
                                            success: function(response) {
                                                $('.deletedWorkerTable').html(response); // Replace content of .tpsTableReporte with response
                                                $('.deletedWorkerTable').show();
                                            }
                                        });
                                    }
                                </script>
                                <div class="deletedWorkerTable"></div>


                            </div>

                            <div id="tpsReport">
                                <form id="dateForm" method='post' action="">
                                    <input type="date" name="date" id="date">
                                    <input type="button" value="Submit" id="submitBtn" onclick="tpsReports()">
                                </form>
                                <script>
                                    function tpsReports() {
                                        var date = document.getElementById("date").value;
                                        $.ajax({
                                            url: 'tps_mis.php',
                                            method: 'POST',
                                            data: {
                                                date: date
                                            },
                                            success: function(response) {
                                                $('.tpsTableReporte').html(response);
                                                $('.tpsTableReporte').show();
                                            }
                                        });
                                    }
                                </script>
                            </div>

                            <div id="tpsTableReporte" class="tpsTableReporte" style="display: none;"></div>

                            <div id="misRreport">
                                <form id="dateForm" method='post' action="">
                                    <label>Month: </label>
                                    <input type="text" name="month" id="month">
                                    <label>Year: </label>
                                    <input type="text" name="year" id="year">
                                    <input type="button" value="Submit" id="submitBtn" onclick="tpsReport()">
                                </form>
                                <script>
                                    function tpsReport() {
                                        var month = document.getElementById("month").value;
                                        var year = document.getElementById("year").value;
                                        $.ajax({
                                            url: 'tps_mis.php',
                                            method: 'POST',
                                            data: {
                                                year: year,
                                                month: month
                                            },
                                            success: function(response) {
                                                $('.misTableReporte').html(response); // Replace content of .tpsTableReporte with response
                                                $('.misTableReporte').show();
                                            }
                                        });
                                    }
                                </script>
                            </div>

                            <div class="misTableReporte" id="misTableReporte" class="misTableReporte"></div>

                        </div>

                    </div>
                </div>

            </div>

            <!-- <div class="charts" style="padding-right: 22px;padding-left: 22px;display: flex;">

                <div class="col-xl-12 col-lg-7">

                    <div class="card shadow mb-4" style="height: 440px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Sales Bar Chart</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-area">
                                <?php
                                // include "charts.php";
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->

            <div class="charts" style="padding-right: 22px;padding-left: 22px;display: flex;">

                <div class="col-xl-12 col-lg-7">

                    <div class="card shadow" style="height: 450px;width: 740px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Active Services and Sub-Services Booking Count</h6>
                        </div>
                        <div class="card-body" style="padding-top: 10px;">
                            <div class="chart-area">
                                <?php include "Chart/StackedBarChart/StackedBarChart.php"; ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-7" style="margin-top: 475px;margin-left: -770px;">

                    <div class="card shadow" style="height: 450px;width: 390px;margin-left: 43px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Gender Distribution of Workers</h6>
                        </div>
                        <div class="card-body" style="padding-top: 10px;">
                            <div class="chart-area">
                                <?php
                                include "Chart/bulletChart/bulletChart.php";

                                // include "Chart/PieChart/pieChart.php";
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-7" style="margin-top: 475px;margin-left: -305px;">
                    <div class="card shadow" style="height: 450px;width: 390px;margin-left: 43px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Comparison of Pending, Rejected, and Completed Bookings</h6>
                        </div>
                        <div class="card-body" style="padding-top: 10px;">
                            <div class="chart-area">
                                <?php
                                // include "Chart/PieChart/pieChart.php"; 


                                include "Chart/DonutPieChart/donutPieChart.php";
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-7" style="margin-left: -304px;margin-top: 475px;">
                    <div class="card shadow" style="height: 450px;width: 390px;margin-left: 43px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Total Order Price by Service</h6>
                        </div>
                        <div class="card-body" style="padding-top: 10px;">
                            <div class="chart-area">
                                <?php
                                //  include "Chart/PieChart/pieChart.php";
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-7" style="margin-left: -775px;">
                    <div class="card shadow" style="height: 450px;width: 451px;margin-left: 43px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Total Order Price by Service</h6>
                        </div>
                        <div class="card-body" style="padding-top: 10px;">
                            <div class="chart-area">
                                <?php
                                include "Chart/PieChart/pieChart.php";

                                // include "Chart/DonutPieChart/donutPieChart.php"; 

                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="Charts" style="width: 60%;box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);margin-left: 40px;border-radius: 5px;">
                <div class="hedint" style="margin-bottom: 15px;">
                    <h6 class="m-0 font-weight-bold text-primary" style="font-size: 1.2rem; color: #007bff; font-weight: 600; margin: 0;">
                        Active Services and Sub-Services Booking Count
                    </h6>
                </div>
                <div class="graph" style="width: 100%; height: auto; background-color: #fff;">
                    <?php
                    // include "Chart/StackedBarChart/StackedBarChart.php";
                    ?>
                </div>
            </div> -->

        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>