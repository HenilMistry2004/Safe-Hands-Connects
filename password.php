<?php 
session_start();
$pss ="henil@123";

echo md5($pss) . "<br>";


// echo $_SESSION['otp'];   $2y$10$jTylk9fd4HwA8E83oq0AXeaIc18SMNRXWm4my2ukXKEZIjTuuTbYO

// $password = 'mysecretpassword';
// $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
// $hashedPassword = "$2y$10$jTylk9fd4HwA8E83oq0AXeaIc18SMNRXWm4my2ukXKEZIjTuuTbYO";


// $enteredPassword = 'mysecretpassword';
// $isPasswordValid = password_verify($enteredPassword, $hashedPassword);

// echo  "<br>" . $isPasswordValid;


// if ($isPasswordValid) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }
?>