<?php

session_start();

unset($_SESSION['id']);
unset($_SESSION['name']);
unset($_SESSION['email']);
unset($_SESSION['token']);

header("location:index.php");

?>