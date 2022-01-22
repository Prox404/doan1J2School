<?php
require 'connect.php';
// check email
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM customer WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    $number_row = mysqli_num_rows($result);
    if ($number_row == 1) {
        echo 'true';
    } else {
        echo 'false';
    }
}