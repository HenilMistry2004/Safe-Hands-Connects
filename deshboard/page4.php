<?php
session_start();
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
