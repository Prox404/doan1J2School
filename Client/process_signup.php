<?php

session_start();
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$re_password = $_POST['re-password'];
$token = $name.'td5'.$password;

require 'connect.php';
$sql = "SELECT count(*) FROM customer WHERE email = '$email'";
$result = mysqli_query($connect, $sql);
$number_row = mysqli_fetch_array($result)['count(*)'];

if ($number_row == 1) {
    header('location:signup.php?error=email_exist');
    exit;
}

$sql = "INSERT INTO customer(name,email,password,token,dob,phone,address) VALUES ('$name', '$email', '$password', '$token',CURRENT_DATE, '', '')";
if (mysqli_query($connect, $sql)) {
    $sql = "SELECT * FROM customer WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    $id = mysqli_fetch_array($result)['id'];
    $_SESSION = [
        'loggedin' => true,
        'id' => $id,
        'name' => $name,
        'email' => $email,
        'token' => $token
    ];
    header('location:index.php?success=signup_success');
    exit;
} else {
    die('Error: ' . mysqli_error($connect));
    header('location:signup.php?error=signup_fail');
    exit;
}



mysqli_close($connect);
