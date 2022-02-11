<?php
if (!isset($_SESSION)) {
    session_start();
}
include '../connect.php';
$id = $_SESSION['id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "UPDATE customer 
SET name = '$name', gender = $gender, dob = '$dob', phone = '$phone', address='$address' 
WHERE id=$id";
if (mysqli_query($connect, $sql)) {
    echo 1;
} else {
    echo "Cập nhật thất bại!";
    die('Error: ' . mysqli_error($connect));
}

