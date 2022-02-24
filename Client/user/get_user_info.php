<?php
require 'connect.php';
if(!isset($_SESSION)){
    session_start();
}
$id = $_SESSION['id'];

$sql = "SELECT * FROM customer WHERE id = '$id' ";
$result = mysqli_query($connect, $sql);
$user_info = mysqli_fetch_array($result);
if(mysqli_num_rows($result) == 0){
    $name = "";
    $gender = "";
    $dob = "";
    $email = "";
    $phone = "";
    $address = "";
}else{
    $name = $user_info['name'];
    $gender = $user_info['gender'];
    $dob = $user_info['dob'];
    $email = $user_info['email'];
    $phone = $user_info['phone'];
    $address = $user_info['address'];
}
