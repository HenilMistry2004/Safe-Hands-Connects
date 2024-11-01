<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
include 'Connection.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $admin = "select * from admin where admin_email_id ='$email' and admin_password='$pass'";
    $checkAdmin = mysqli_query($conn, $admin);

    if (mysqli_num_rows($checkAdmin) > 0) {
        while ($row = mysqli_fetch_assoc($checkAdmin)) {
            $_SESSION['adminEmailId'] = $row['admin_email_id'];
            $_SESSION['adminName'] = $row['admin_name'];
            $_SESSION['adminLoggedIn'] = true;
        }
        header('location: index.php');
        exit; // Ensure script stops  here after redirection
    }else{
        header("Location: login.p");
    }
}


?> 
</body>
</html>