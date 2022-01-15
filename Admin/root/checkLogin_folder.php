<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}

if(!isset($_SESSION["loged"])){
    header('location:../login.php'); 
}

?>