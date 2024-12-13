<div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer;" id="customer">
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

<div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer;" id="worker">


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

<div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer;" id="requestedWorkers">


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



<div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer;" id="services">

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

<div class="col-xl-3 col-md-6 mb-4" style="cursor: pointer;" id="pendingRequests">
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