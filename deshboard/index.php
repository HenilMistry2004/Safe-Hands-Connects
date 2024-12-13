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

    <link rel="stylesheet" href="../Css/deshboardStyle.css">

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

                        <?php
                        include 'tables/tableIcons/tableIcons.php';
                        ?>

                    </div>

                    <div class="card shadow mb-4" style="display: none;" id="display">

                        <?php
                        include 'tables/tableHeaders/tableHeaders.php';
                        ?>

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

                            <?php
                            include 'tables/customerDetails.php';
                            ?>

                            <?php
                            include 'tables/workersDetails.php';
                            ?>

                            <?php
                            include 'tables/requestedWorkersDetails.php';
                            ?>

                            <?php
                            include 'tables/serivceDetail.php';
                            ?>

                            <?php
                            include 'tables/requestDetails.php';
                            ?>

                            <?php
                            include 'tables/workerDeleteData.php';
                            ?>

                            <?php
                            include 'tables/bookingRequests.php';
                            ?>

                            <?php
                            include 'tables/tpsReport.php';
                            ?>


                            <div id="tpsTableReporte" class="tpsTableReporte" style="display: none;"></div>

                            <?php
                            include 'tables/misTableReporte.php';
                            ?>

                            <div class="misTableReporte" id="misTableReporte" class="misTableReporte"></div>

                        </div>

                    </div>
                </div>

            </div>

            <div class="charts" style="padding-right: 22px;padding-left: 22px;display: flex;">

                <div class="col-xl-12 col-lg-7" id="servicesSubServices">

                    <div class="card shadow" style="height: 450px;">
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

                <div class="col-xl-12 col-lg-7" id="genderDistributionGraph">

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

                <div class="col-xl-12 col-lg-7" id="bookingStatus">
                    <div class="card shadow" style="height: 450px;width: 390px;margin-left: 43px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Comparison of Pending, Rejected, and Completed Bookings</h6>
                        </div>
                        <div class="card-body" style="padding-top: 10px;">
                            <div class="chart-area">
                                <?php
                                include "Chart/DonutPieChart/donutPieChart.php";
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-7" id="orderDetails">
                    <div class="card shadow" style="height: 450px;width: 390px;margin-left: 43px;">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Total Order Price For Each Service</h6>
                        </div>
                        <div class="card-body" style="padding-top: 10px;">
                            <div class="chart-area">
                                <?php
                                include 'Chart/lineChart/lineChart.php';
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-12 col-lg-7" id="serviceOrderDetails">
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Total Order Price by Service</h6>
                        </div>
                        <div class="card-body" style="padding-top: 10px;">
                            <div class="chart-area">
                                <?php
                                include "Chart/PieChart/pieChart.php";
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
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