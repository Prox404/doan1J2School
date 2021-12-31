<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

require 'connect.php';
$sql = "SELECT * FROM customer WHERE email = '$email' and password ='$password' ";
$result = mysqli_query($connect, $sql);
$number_row = mysqli_num_rows($result);

if ($number_row == 1) {
    $row = mysqli_fetch_array($result);
    $id = $row['id'];
    $name = $row['name'];
    $token = $row['token'];
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $name;
    $_SESSION['token'] = $token;
    header('location:index.php');
} else {
    header('location:signin.php?error=wrong_pass_or_email');
}

mysqli_close($connect);
