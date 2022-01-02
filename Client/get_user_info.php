<?php
require 'connect.php';

$id = $_SESSION['id'];

$sql = "SELECT * FROM customer WHERE id = '$id'";
$result = mysqli_query($connect, $sql);
$user_info = mysqli_fetch_array($result);

