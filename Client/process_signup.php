<?php

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

require 'connect.php';
$sql = "SELECT count(*) FROM customers WHERE email = '$email'";
$result = mysqli_query($connect, $sql);
$number_row = mysqli_fetch_array($result)['count(*)'];

if($number_row == 1){
    header('location:signup.php?error=email_exist');
    exit;
}

$sql = "INSERT INTO customers(name,email,password) VALUES ('$name', '$email', '$password')";
mysqli_query($connect, $sql);

$sql = "SELECT * FROM customers WHERE email = '$email'";
$result = mysqli_query($connect, $sql);
$id = mysqli_fetch_array($result)['id'];
session_start();
$_SESSION['email'] = $email;
$_SESSION['id'] = $id;
$_SESSION['name'] = $name;
header('location:index.php');

mysqli_close($connect);
