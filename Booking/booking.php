<?php
session_start();
// $worker_id = 2;
error_reporting(0);
include("../connection/connection.php");
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../Login/login.php");
    exit();
}

// session_start();
// include("../connection/connection.php");
// error_reporting(0);

$sub_service_id = $_POST['sub_service_id'];
$sub_service_price = $_POST['sub_service_price'];
$sub_service_name = $_POST['sub_service_name'];
$service_id = $_POST['service_id'];
$order_status = "Pending";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Dream Laundry</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="booking.css">

    <script>
        function isValidTime(date) {
            var hours = date.getHours();
            return hours >= 9 && hours <= 22; // 9 AM to 10 PM
        }

        function calculatePrice() {
            var arrivalString = document.getElementById('arrival').value;
            var departureString = document.getElementById('departure').value;

            var arrival = new Date(arrivalString);
            var departure = new Date(departureString);

            if (arrival >= departure) {
                alert('Departure time must be after arrival time.');
                document.getElementById('price').value = '';
                return false;
            }

            if (!isValidTime(arrival) || !isValidTime(departure)) {
                alert('Arrival and departure times must be between 9 AM and 10 PM.');
                document.getElementById('price').value = '';
                return false;
            }

            var duration = (departure - arrival) / (1000 * 60 * 60); // Duration in hours
            var subServicePrice = <?php echo $sub_service_price; ?>; // Use the dynamic price
            var price = duration * subServicePrice; // Dynamic price per hour
            document.getElementById('price').value = price.toFixed(2);
            return true;
        }

        function validations() {
            if (!calculatePrice()) {
                return false;
            }

            var arrivalString = document.getElementById('arrival').value;
            var departureString = document.getElementById('departure').value;
            var firstName = document.getElementById('first_name').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone').value;
            var address = document.getElementById('address').value;

            var arrival = new Date(arrivalString);
            var today = new Date();

            if (arrival < today) {
                alert('Worker arrival date cannot be in the past.');
                return false;
            }

            var differenceInTime = arrival.getTime() - today.getTime();
            var differenceInDays = Math.ceil(differenceInTime / (1000 * 3600 * 24));

            if (differenceInDays > 7) {
                alert('Booking arrival date cannot be more than a week from the current date.');
                return false;
            }

            if (arrivalString === '' || departureString === '' || firstName === '' || email === '' || phone === '' || address === '') {
                alert('Please fill out all required fields.');
                return false;
            }

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.match(emailRegex)) {
                alert('Please enter a valid email address.');
                return false;
            }

            var phoneRegex = /^\d{10}$/;
            if (!phone.match(phoneRegex)) {
                alert('Please enter a valid 10-digit phone number.');
                return false;
            }

            return true;
        }
        
        const apiKey = '11d441873f5f44d597790d6d1ec290c4';
        const apiEndpoint = "https://api.opencagedata.com/geocode/v1/json";

        const getCityName = async (latitude, longitude) => {
            const query = `${latitude},${longitude}`;
            const apiUrl = `${apiEndpoint}?key=${apiKey}&q=${query}&pretty=1`;

            try {
                const res = await fetch(apiUrl);
                const data = await res.json();

                console.log(data);
                console.log(latitude);
                console.log(longitude);
                const city = data.results[0].components.state_district;
                
                console.log(city);

                // Store city in the hidden form input
                document.getElementById("city").value = city;

            }catch (error) {
                console.error("Error fetching city name:", error);
                alert("Error fetching city name.");
            }
        };

        // Function to get geolocation and submit
        function getLocationAndSubmit() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const { latitude, longitude } = position.coords;
                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                    getCityName(latitude,longitude);
                }, function() {
                    alert('Unable to retrieve your location.');
                });
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        
        // Function to process payment with Razorpay
        function processPayment() {
            var price = document.getElementById('price').value;
            if (!price || parseFloat(price) <= 0) {
                alert('Please calculate the price before proceeding.');
                return;
            }
            options.amount = price * 100; // Convert to paisa
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        }
        // Fetch location on page load
        window.onload = function() {
            getLocationAndSubmit();
        }
    </script>
</head>

<body>
    <?php include '../Header_Footer/header.php'; ?>

    <div id="contact" class="contact-us section" style="margin-top: 103px; height: 885px;">
        <div class="container col-lg-8" data-wow-duration="0.5s" data-wow-delay="0.25s">
            <div class="row justify-content-center" style="margin-top: -105px;">
                <div class="col-lg-6">
                    <form onsubmit="return validations()" method="post" action="process_booking.php" class="booking-form">
                        <h1 class="text-center mb-4"><i class="far fa-calendar-alt"></i> Booking <?php echo $sub_service_name; ?></h1>

                        <div class="mb-3">
                            <label for="arrival" class="form-label">Worker Arrival</label>
                            <input id="arrival" type="datetime-local" name="arrival" class="form-control" onchange="calculatePrice()" required>
                        </div>

                        <div class="mb-3">
                            <label for="departure" class="form-label">Worker Departure</label>
                            <input id="departure" type="datetime-local" name="departure" class="form-control" onchange="calculatePrice()" required>
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label">Name</label>
                            <input id="first_name" type="text" name="first_name" class="form-control" value="<?php echo htmlspecialchars($_SESSION['cName']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['cEmail_ID']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input id="phone" type="tel" name="phone" class="form-control" value="<?php echo htmlspecialchars($_SESSION['userContactNumber']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input id="address" type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($_SESSION['userAddress']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Total Price (in INR)</label>
                            <input id="price" type="text" name="price" class="form-control" readonly required>
                        </div>

                        <!-- Hidden fields for latitude, longitude, and city -->
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <input type="hidden" name="city" id="city">
                        
                        <button id="rzp-button1" type="button" class="btn btn-primary w-100" onclick="getLocationAndSubmit()">Proceed to Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            key: "rzp_test_32YHuvq99MSAda",
            amount: 0, // This will be dynamically set before opening the payment modal
            currency: "INR",
            name: "Safe Hands Connect",
            description: "Laundry Service Booking",
            image: "https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.istockphoto.com%2Fillustrations%2Fhand-in-hand-vector",
            theme: {
                color: "#f54744"
            },
            handler: function(response) {
                // Redirect to process_booking.php with the form data and payment details
                var form = $('<form action="process_booking.php" method="POST">' +
                    '<input type="hidden" name="razorpay_payment_id" value="' + response.razorpay_payment_id + '">' +
                    '<input type="hidden" name="arrival" value="' + $('#arrival').val() + '">' +
                    '<input type="hidden" name="departure" value="' + $('#departure').val() + '">' +
                    '<input type="hidden" name="first_name" value="' + $('#first_name').val() + '">' +
                    '<input type="hidden" name="email" value="' + $('#email').val() + '">' +
                    '<input type="hidden" name="phone" value="' + $('#phone').val() + '">' +
                    '<input type="hidden" name="price" value="' + $('#price').val() + '">' +
                    '<input type="hidden" name="address" value="' + $('#address').val() + '">' +
                    '<input type="hidden" name="latitude" value="' + $('#latitude').val() + '">' +
                    '<input type="hidden" name="longitude" value="' + $('#longitude').val() + '">' +
                    '<input type="hidden" name="city" value="' + $('#city').val() + '">' + // Include city here
                    '<input type="hidden" name="service_id" value="<?php echo $service_id; ?>">' +
                    '<input type="hidden" name="sub_service_id" value="<?php echo $sub_service_id; ?>">' +
                    '</form>');
                $('body').append(form);
                form.submit();
            },
            prefill: {
                name: "",
                email: "",
                contact: ""
            }
        };

        document.getElementById('rzp-button1').onclick = function(e) {
            var price = document.getElementById('price').value;
            if (!price || parseFloat(price) <= 0) {
                alert('Please calculate the price before proceeding.');
                return;
            }
            options.amount = price * 100; // Convert to paisa
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>

</html>
