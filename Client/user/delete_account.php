
<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once '../connect.php';

$id = $_SESSION['id'];
$sql = "DELETE FROM customer WHERE id = $id";
if (mysqli_query($connect, $sql)) {
    echo 1;
} else {
    echo "Xóa tài khoản thất bại!";
    die('Error: ' . mysqli_error($connect));
}
