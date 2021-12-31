<!-- delete acount in php -->
<?php
session_start();
require_once 'connect.php';

$id = $_SESSION['id'];
echo $id;
$sql = "DELETE FROM customer WHERE id = $id";
if (mysqli_query($connect, $sql)) {
    header('location:users.php?success=Delete successful');
    header('location:signout.php');
} else {
    die('Error: ' . mysqli_error($connect));
    // header('location:users.php?error=Update fail');
}
