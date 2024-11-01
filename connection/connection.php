<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "safehandsconnect";
        $conn = new mysqli($servername, $username, $password, $db);

        if ($conn->connect_error) {

            die("Connection failed: " . $conn->connect_error);
        } else {
        //    echo 'Crested connection.';
        }
        ?>
    </body>
</html>
