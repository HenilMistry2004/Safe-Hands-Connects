<?php
// session_start(); // Ensure the session is started
error_reporting(0);
// Debugging: Print session variables to check if they're set correctly
// print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Space Dynamic - SEO HTML5 Template</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Ensure jQuery is loaded before your script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <script>
        $(document).ready(function() {
            $('#UserDetails').click(function() {
                $('#viewDetails').toggle(); // Toggle the visibility of .viewDetails
            });
        });
    </script>

    <?php
    if (isset($_SESSION['cEmail_ID'])) {
    ?>
        <div class="viewDetails" id="viewDetails" style="display: none;">
            <ol>
                <li>
                    <div class="userDetails">
                        <?php
                        echo "<p class='initial'>" . substr($_SESSION['cName'], 0, 1) . "</p>";
                        ?>
                    </div>
                </li>
                <li>
                    <p class="welcomeText">
                        Welcome!
                        <?php
                        echo $_SESSION['cName'];
                        ?>
                    </p>
                </li>
                <li>
                    <p class="userRole">
                        User: Customer
                    </p>
                </li>
                <!-- <li>
                    <p class="updateProfile">
                        Update Profile
                    </p>
                </li> -->
                <li>
                    <p class="logout">
                        <a href="../connection/sessionDestricter.php">
                            Logout
                        </a>
                    </p>
                </li>
            </ol>
        </div>
    <?php
    } elseif (isset($_SESSION['eEmail_ID'])){
    ?>
        <div class="viewDetails" id="viewDetails" style="display: none;">
            <ol>
                <li>
                    <div class="userDetails">
                        <?php
                        echo "<p class='initial'>" . substr($_SESSION['eName'], 0, 1) . "</p>";
                        ?>
                    </div>
                </li>
                <li>
                    <p class="welcomeText">
                        Welcome!
                        <?php
                        echo $_SESSION['eName'];
                        ?>
                    </p>
                </li>
                <li>
                    <p class="userRole">
                        User: Worker
                    </p>
                </li>
                <!-- <li>
                    <p class="updateProfile">
                        Update Profile
                    </p>
                </li> -->
                <li>
                    <p class="logout">
                        <a href="../connection/sessionDestricter.php">
                            Logout
                        </a>
                    </p>
                </li>
            </ol>
        </div>
    <?php
    }
    ?>

    <style>
        .viewDetails {
            margin-top: 100px;
            position: fixed;
            top: 20px;
            right: 20px;
            width: 255px;
            padding: 20px;
            background-color: #E0FFFF;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .userDetails {
            cursor: pointer;
            background-color: #F5F5DC;
            border: 2px solid black;
            height: 50px;
            width: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .userDetails .initial {
            margin: 0;
            font-size: 30px;
            color: black;
        }

        .welcomeText,
        .userRole,
        .updateProfile,
        .logout {
            font-family: Arial, sans-serif;
            color: #333;
            text-align: center;
            margin: 10px 0;
        }

        .welcomeText {
            font-size: 18px;
            font-weight: bold;
        }

        .userRole {
            font-size: 14px;
        }

        .updateProfile,
        .logout {
            font-size: 14px;
            color: #007BFF;
            cursor: pointer;
            transition: color 0.3s;
        }

        .updateProfile:hover,
        .logout:hover {
            color: #0056b3;
        }

        ol {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 15px;
        }
    </style>

</body>

</html>