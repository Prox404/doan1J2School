<?php

// Connect to database
if(!isset($_SESSION)){
    session_start();
}
require '../connect.php';

if ($connect->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$re_password = $_POST['re-password'];


// Insert data into database
$sql = "SELECT * FROM customer WHERE email = '$email'";
$result = mysqli_query($connect, $sql);
$number_row = mysqli_num_rows($result);

// check if email is already exist
if ($number_row == 1) {
    // echo "Email đã tồn tại!";
} else {
    $token = md5(uniqid(rand() . time()));
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
        // echo 1;
    } else {
        die('Error: ' . mysqli_error($connect));
        // echo "Đăng ký thất bại!";
    }
}
mysqli_close($connect);
