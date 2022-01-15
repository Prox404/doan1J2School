<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../CSS/style.css"> -->
</head>
<body>
    <?php 
        if(!isset($_SESSION)){
            session_start();
        }
    ?>
        <div class="header">
            <div class="empty"></div>
            <form action="" method="get" style="margin-right: auto; margin-left: auto;">
                <input id="header-search" name="search" class="fontAwesome" type="search" placeholder="&#xF002; Tìm kiếm gì đi ?">
            </form>
            <ul class="header-menu">
                <li>
                    <img class="header-avt" src="https://i.ibb.co/gjYSPt9/97387265-911934715945271-6195268394929881088-o.jpg" alt="">
                </li>
                <li>
                    <a href="#"><?php 
                    if(isset($_SESSION['name'])){
                        echo $_SESSION['name'];
                    }else{
                        echo 'User name';
                    }
                    ?>
                    
                    </a>
                </li>
                
            </ul>
        </div>
</body>
</html>

