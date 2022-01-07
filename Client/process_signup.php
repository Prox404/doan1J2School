<?php

// Connect to database
if(!isset($_SESSION)){
    session_start();
}
require 'connect.php';

if ($connect->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// create token
$token = md5(uniqid(rand(), true));

// Insert data into database
$sql = "SELECT * FROM customer WHERE email = '$email'";
$result = mysqli_query($connect, $sql);
$number_row = mysqli_num_rows($result);

// check if email is already exist
if ($number_row == 1) {
    header('location:signup.php?error=email_existed');
} else {
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
    } else {
        die('Error: ' . mysqli_error($connect));
        header('location:signup.php?error=signup_fail');
    }
}
mysqli_close($connect);
