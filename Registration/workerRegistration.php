<!DOCTYPE html>
<html>

<head>
    <title>Login form with JavaScript Validation</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-space-dynamic.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

    <link rel="stylesheet" href="../Login/login.css">


    <script>
        function showPopup(message) {
            var popup = document.getElementById("customPopup");
            var popupMessage = document.getElementById("popupMessage");

            popupMessage.innerText = message;
            popup.style.display = "block";

            // Show the popup with sliding effect
            popup.style.animation = "slideDown 0.5s ease forwards";

            // Automatically hide the popup after 4 seconds
            setTimeout(function() {
                popup.style.animation = "slideUp 0.5s ease forwards";
                setTimeout(function() {
                    popup.style.display = "none";
                }, 500); // 500ms matches the slideUp animation duration
            }, 5000); // 4000ms = 4 seconds
        }

        function passwordValidation(password) {
            var pattern = /^(?=.*[!@#$%^&*(),.?":{}|<>])(?=.*\d)(?=.*[a-zA-Z]).{8,12}$/;
            return pattern.test(password);
        }

        function validation() {
            var name = document.getElementById("name").value;
            var contact = document.getElementById("contact").value;
            var email = document.getElementById("email").value;
            var gender = document.querySelector('input[name="gender"]:checked');
            var month = document.getElementById("month").value;
            var day = document.getElementById("day").value;
            var year = document.getElementById("year").value;
            var address = document.getElementById("address").value;
            var password = document.getElementById("password-s").value;
            var cPassword = document.getElementById("confPassword-s").value;

            var currentDate = new Date();
            var selectedDate = new Date(year, month - 1, day);
            var age = currentDate.getFullYear() - selectedDate.getFullYear();
            var monthDiff = currentDate.getMonth() - selectedDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < selectedDate.getDate())) {
                age--;
            }

            if (name == "" || contact == "" || email == "" || month == "Month" || day == "Day" || year == "Year" || address == "" || !gender || password == "" || cPassword == "") {
                showPopup("Please fill in all the details.");
                return false;
            }

            if (age < 18) {
                showPopup("Age less than 18 is not eligible.");
                return false;
            }

            if (selectedDate > currentDate) {
                showPopup("Date of Birth cannot be in the future.");
                return false;
            }

            if (contact.length !== 10) {
                showPopup("Contact No. must be 10 digits.");
                return false;
            }

            if (!passwordValidation(password)) {
                showPopup("Password should be 8-12 characters long, containing at least one letter, one number, and one special character.");
                return false;
            }

            if (password !== cPassword) {
                showPopup("Confirm password does not match.");
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


        // Fetch location on page load
        window.onload = function() {
            getLocationAndSubmit();
        }
    </script>


</head>

<body>

    <!-- Custom Popup for Messages -->
    <div id="customPopup" class="custom-popup">
        <p id="popupMessage"></p>
    </div>

    <style>
        /* Popup styling */
        .custom-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffff;
            padding: 15px 20px;
            border-radius: 0 0 5px 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
            font-size: 16px;
            color: #d8000c;
            z-index: 9999;
            width: 300px;
            text-align: center;
            animation: slideDown 0.5s ease forwards;
        }

        @keyframes slideDown {
            from {
                top: -50px;
            }

            to {
                top: 0;
            }
        }
    </style>


    <?php
    include '../Header_Footer/header.php';
    ?>

    <style>
        .form-control:focus {
            border-color: red;
            box-shadow: 0 0 0 0rem transparent;
        }
    </style>

    <div id="contact" class="contact-us section" style="margin-top: 29px;padding-top: 55px;padding-bottom: 110px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 align-self-center" data-wow-duration="0.5s" data-wow-delay="0.25s">
                </div>
                <div class="col-lg-6" data-wow-duration="0.5s" data-wow-delay="0.25s">
                    <form id="contact" onsubmit="return validation()" action="registrationProcess.php" method="post" style="width: 460px;">
                        <div class="row" style="margin-top: 35px;">
                            <h3 style="margin-top: -55px; margin-left: 40px;">Workers Registration</h3>
                            <input type="hidden" name="value" value="employee">

                            <div class="col-lg-6" style="width: 425px;">
                                <fieldset>
                                    <div class="input-group" style="margin-bottom: 0px;">
                                        <label class="placeholder" for="name">Name</label>
                                        <input class="form-control" name="name" style="background-color: #d1f3ff; " id="name" type="text" onkeypress="return /[a-zA-Z ]/i.test(event.key)" placeholder="">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6" style="width: 425px;">
                                <fieldset>
                                    <div class="input-group" style="margin-bottom: 0px;">
                                        <label class="placeholder" for="contact">Contact No.</label>
                                        <input class="form-control" maxlength="10" style="background-color: #d1f3ff; " minlength="10" onkeypress="return /[0-9]/i.test(event.key)" name="contact" id="contact" type="text" placeholder="">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6" style="width: 425px;">
                                <fieldset>
                                    <div class="input-group" style="margin-bottom: 0px;">
                                        <label class="placeholder" for="email">Email</label>
                                        <input class="form-control" name="email" style="background-color: #d1f3ff; " id="email" type="email" placeholder="">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6" style="width: 425px; margin-bottom: 30px;">
                                <fieldset>
                                    <div class="input-group" style="display: flex; margin-bottom: 0px;">
                                        <label style="margin-left: -15px;">Gender* :</label>
                                        <input type="radio" name="gender" value="Male" id="male" style="margin-left: 115px; height: 14px;width: 25px; margin-top: 15px;" checked>
                                        <label for="male" style="margin-left: 135px;">Male</label>
                                        <input type="radio" name="gender" value="Female" id="female" style="height: 14px;width: 25px; margin-left: 80px; margin-top: 15px;">
                                        <label for="female" style="margin-left: 240px;">Female</label>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6" style="width: 425px;">
                                <fieldset>
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <label style="margin-top: -40px; margin-left: -15px;">Date Of Birth* :</label><br>
                                        <span style="margin-left: 0px;">
                                            <select name="month" id="month" style="height: 44px;border: 0;background-color: #d1f3ff; border-bottom-left-radius: 20px;border-top-left-radius: 20px;padding-left: 15px; width: 110px;">
                                                <option style="color: #cdcdcd;">Month</option>
                                                <?php
                                                for ($i = 1; $i <= 12; $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </span>
                                        <span>
                                            <select name="day" id="day" style="height: 44px; border: 0;background-color: #d1f3ff; padding-left: 30px; margin-left: 35px; width: 110px;">
                                                <option style="color: #cdcdcd;">Day</option>
                                                <?php
                                                for ($i = 1; $i <= 31; $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </span>
                                        <span>
                                            <select name="year" id="year" style="height: 44px;border: 0; background-color: #d1f3ff; padding-left: 30px; margin-left: 36px; width: 110px; border-bottom-right-radius: 25px;border-top-right-radius: 25px;">
                                                <option style="color: #cdcdcd;">Year</option>
                                                <?php
                                                for ($i = 1995; $i <= date("Y"); $i++) {
                                                    echo "<option value='$i'>$i</option>";
                                                }
                                                ?>
                                            </select>
                                        </span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6" style="width: 425px;">
                                <fieldset>
                                    <div class="input-group" style="margin-bottom: 0px;">
                                        <label style="margin-left: -15px;">Services* :</label>
                                        <select name="service" id="user" class="user" style="margin-top: 41px; background-color: #d1f3ff; border: 0px; padding-left: 15px; height: 45px; margin-bottom: 18px; border-bottom-left-radius: 23px; border-bottom-right-radius: 23px; border-top-left-radius: 23px; border-top-right-radius: 23px; width: 401px;" required>
                                            <option value="">Select Service</option>
                                            <!-- Service options populated by PHP -->
                                            <?php
                                            include '../connection/connection.php';

                                            $sql = "SELECT * FROM service WHERE status = 'active'";
                                            $select = $conn->query($sql);

                                            echo "<script>var subServices = {};</script>"; // Initialize subServices array in JavaScript

                                            if ($select->num_rows > 0) {
                                                while ($row = $select->fetch_assoc()) {
                                                    $serviceId = $row['service_id'];
                                                    $serviceName = $row['service_name'];
                                                    echo "<option value='$serviceId'>$serviceName</option>";

                                                    // Fetch sub-services
                                                    $sub_service_sql = "SELECT * FROM sub_service WHERE service_id = $serviceId";
                                                    $sub_service = $conn->query($sub_service_sql);

                                                    echo "<script>subServices[$serviceId] = [];</script>";
                                                    if ($sub_service->num_rows > 0) {
                                                        while ($sub_row = $sub_service->fetch_assoc()) {
                                                            $subServiceId = $sub_row['sub_service_id'];
                                                            $subServiceName = $sub_row['sub_service_name'];
                                                            echo "<script>subServices[$serviceId].push({id: '$subServiceId', name: '$subServiceName'});</script>";
                                                        }
                                                    }
                                                }
                                            }

                                            $conn->close();
                                            ?>
                                        </select>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6" style="width: 425px;">
                                <fieldset>
                                    <div class="input-group" style="margin-bottom: 0px;">
                                        <label style="margin-left: -15px;">Sub-Services* :</label>
                                        <select name="sub_services" id="sub-service-dropdown" class="user" style="margin-top: 41px; background-color: #d1f3ff; border: 0px; padding-left: 15px; height: 45px; margin-bottom: 18px; border-bottom-left-radius: 23px; border-bottom-right-radius: 23px; border-top-left-radius: 23px; border-top-right-radius: 23px; width: 401px;" required>
                                            <option value="">Select Sub-Service</option>
                                        </select>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6" style="width: 425px;">
                                <fieldset>
                                    <div class="input-group" style="margin-bottom: 0px;">
                                        <label class="placeholder" for="address">Address</label>
                                        <input class="form-control" style="background-color: #d1f3ff; " name="address" id="address" type="text" placeholder="">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6" style="width: 425px;">
                                <fieldset>
                                    <div class="input-group" style="margin-bottom: 0px;">
                                        <label for="password" class="placeholder">Password</label>
                                        <input class="form-control" style="background-color: #d1f3ff; " name="password" id="password-s" type="password" placeholder="">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-6" style="width: 425px;">
                                <fieldset>
                                    <div class="input-group" style="margin-bottom: 0px;">
                                        <label for="confPassword" class="placeholder">Confirm Password</label>
                                        <input class="form-control" style="background-color: #d1f3ff; " name="confPassword" id="confPassword-s" type="password" placeholder="">
                                        <span class="lighting"></span>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col-lg-12">
                                <fieldset style="display: flex;">
                                    <!-- Updated checkbox ID to match JavaScript -->
                                    <input id="rememberMe" type="checkbox" name="twoFacter" value="0" style="width: 10px;">
                                    <label for="rememberMe" style="margin-top: 10px; margin-left: 5px;">Enable Two Factor Authentication</label>
                                </fieldset>
                            </div>

                            <!-- Hidden fields for latitude, longitude, and city -->
                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">
                            <input type="hidden" name="city" id="city">
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-button" style="width: 400px;">Submit</button>
                                </fieldset>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Listen for changes on the service dropdown
        document.getElementById('user').addEventListener('change', function() {
            var serviceId = this.value;
            var subServiceDropdown = document.getElementById('sub-service-dropdown');

            // Clear existing sub-services
            subServiceDropdown.innerHTML = '<option value="">Select Sub-Service</option>';

            // Populate sub-services if service is selected
            if (serviceId && subServices[serviceId]) {
                subServices[serviceId].forEach(function(subService) {
                    var option = document.createElement('option');
                    option.value = subService.id;
                    option.text = subService.name;
                    subServiceDropdown.appendChild(option);
                });
            }
        });
    </script>

    <script>
        // Get the checkbox element by its correct ID
        const checkbox = document.getElementById('rememberMe');

        // Add an event listener for the change event
        checkbox.addEventListener('change', function() {
            // If the checkbox is checked, set its value to 1
            if (this.checked) {
                this.value = '1';
            } else {
                // If the checkbox is not checked, set its value to 0
                this.value = '0';
            }
        });
    </script>

    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js'></script>
    <script src="../Login/script.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/animation.js"></script>
    <script src="../assets/js/imagesloaded.js"></script>
    <script src="../assets/js/templatemo-custom.js"></script>

</body>

</html>