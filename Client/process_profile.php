<?php
session_start();
require 'connect.php';
$id = $_SESSION['id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$sql = "UPDATE customer 
SET name = '$name', gender = $gender, dob = '$dob', phone = '$phone', address='$address' 
WHERE id=$id";
echo $sql;
if (mysqli_query($connect, $sql)) {
    header('location:users.php?success=Update successful');
} else {
    die('Error: ' . mysqli_error($connect));
    // header('location:users.php?error=Update fail');
}

mysqli_close($connect);
