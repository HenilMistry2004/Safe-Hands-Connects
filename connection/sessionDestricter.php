<?php
session_start();
error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <?php

    session_destroy();
    header('location: ../Index/index.php');

    ?>
</body>
</html>
