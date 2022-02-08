<!-- delete acount in php -->
<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once 'connect.php';

$id = $_SESSION['id'];
echo $id;
$sql = "DELETE FROM customer WHERE id = $id";
if (mysqli_query($connect, $sql)) {
    echo '<script> alert("Xóa thành công")</script>';
    include 'sign_out.php';
} else {
    die('Error: ' . mysqli_error($connect));
    // header('location:users.php?error=Update fail');
}
