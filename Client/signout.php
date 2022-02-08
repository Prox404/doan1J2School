<?php
if (!isset($_SESSION)) {
    session_start();
}

// unset($_SESSION['id']);
// unset($_SESSION['name']);
// unset($_SESSION['email']);
// unset($_SESSION['token']);
// unset($_SESSION['cart']);
session_destroy();

header("location:index.php");

?>