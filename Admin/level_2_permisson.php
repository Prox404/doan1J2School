<?php 
    if(!isset($_SESSION)){ 
        session_start(); 
    }
    if(isset($_SESSION['level_id'])){
        if($_SESSION['level_id'] !=2){
            header('location:index.php');
        }
    }

?>