<?php

if(!isset($_SESSION['id'])){
    header('location:signin.php');
    exit;
}