<?php
session_start();
error_reporting(0);

$welcomeMessage = isset($_SESSION['cName']) ? $_SESSION['cName'] : (isset($_SESSION['eName']) ? $_SESSION['eName'] : '');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Popup styling */
        .custom-popup {
            display: none;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffffff;
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

        @keyframes slideUp {
            from {
                top: 0;
            }

            to {
                top: -50px;
            }
        }
    </style>
</head>

<body>
    <!-- Popup element -->
    <div id="customPopup" class="custom-popup">
        <span id="popupMessage"></span>
    </div>

    <script>
        function showPopup(message, isError = false) {
            var popup = document.getElementById("customPopup");
            var popupMessage = document.getElementById("popupMessage");

            popupMessage.innerText = message;

            if (isError) {
                popup.style.color = "#d8000c"; // Error color
            } else {
                popup.style.color = "#28a745"; // Success color (green)
            }

            popup.style.display = "block";
            popup.style.animation = "slideDown 0.5s ease forwards";

            // Automatically hide the popup after 4 seconds
            setTimeout(function () {
                popup.style.animation = "slideUp 0.5s ease forwards";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 500); // 500ms matches the slideUp animation duration
            }, 4000); // 4000ms = 4 seconds
        }

        // Show appropriate messages based on session variables
        <?php if ($_SESSION['loginMessage'] == 1): ?>
            showPopup("Welcome! <?php echo $welcomeMessage; ?>");
        <?php endif; $_SESSION['loginMessage']= 0; ?>

        <?php if ($_SESSION['customerRegistrationMessage'] == 1): ?>
            showPopup("Welcome! <?php echo $welcomeMessage; ?>. You have been registered as a customer in 'Safe Hands Connects.'");
        <?php endif; $_SESSION['customerRegistrationMessage']= 0; ?>

        <?php if ($_SESSION['employeRegistrationMessage'] == 1): ?>
            showPopup("Welcome! <?php echo $welcomeMessage; ?>. Your request has been registered as a worker in 'Safe Hands Connects.'");
        <?php endif; $_SESSION['employeRegistrationMessage']= 0; ?>

        <?php if ($_SESSION['requestPanding'] == 1): ?>
            showPopup("<?php echo $welcomeMessage; ?>. Your request is under process as a worker in 'Safe Hands Connects.'");
        <?php endif; $_SESSION['requestPanding']= 0; ?>

        <?php if ($_SESSION['unmatchOPT'] == 1): ?>
            showPopup("OTP did not match.", true); // Display as error
        <?php endif; $_SESSION['unmatchOPT']= 0; ?>

        <?php if ($_SESSION['request'] == 1): ?>
            showPopup("Email or Password does not match.", true); // Display as error
        <?php endif; $_SESSION['request']= 0; ?>

        <?php if ($_SESSION['unSuccessfullOTP'] == 1): ?>
            showPopup("OTP did not match.", true); // Display as error
        <?php endif; $_SESSION['unSuccessfullOTP']= 0; ?>

        <?php if ($_SESSION['emailDoesNotExist'] == 1): ?>
            showPopup("Email does not exist in our records.", true); // Display as error
        <?php endif; $_SESSION['emailDoesNotExist']= 0; ?>

        <?php if ($_SESSION['emailInactive'] == 1): ?>
            showPopup("Your account is inactive. Please contact support.", true); // Display as error
        <?php endif; $_SESSION['emailInactive']= 0; ?>

        <?php if ($_SESSION['inactiveEmployee'] == 1): ?>
            showPopup("Your account is inactive. Please contact support.", true); // Display as error
        <?php endif; $_SESSION['inactiveEmployee']= 0; ?>

        <?php if ($_SESSION['inactiveCustomer'] == 1): ?>
            showPopup("Your account is inactive. Please contact support.", true); // Display as error
        <?php endif; $_SESSION['inactiveCustomer']= 0; ?>


</script>
</body>

</html>
