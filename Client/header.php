<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="./css/main.css?v2.2">
</head>

<body>
  <div class="header shadow-box">
    <a href="index.php" class="logo">
      <img src="https://i.ibb.co/6bZRxw4/P-ogrange.png" alt="" class="header-logo" />
    </a>
    <form action="" method="get" style="margin-right: auto;">
      <input type="search" placeholder="Search.." name="search">
    </form>
    
    <ul class="header-menu">
      <li>
        <a href="cart.php">Giỏ hàng
          
            <?php 
              if(isset($_SESSION['number_item'])){ 
                if($_SESSION['number_item'] >0){
                  echo '<div class="bubble">' . $_SESSION['number_item'] . '</div>';
                }
              }  
            ?>
          
        </a>
        
      </li>
      <li>
        <a href="order_status.php">Đơn hàng</a>
      </li>
      <li>
        <a href="#">Hỗ trợ</a>
      </li>
      <?php
      if (isset($_SESSION['email'])) {
        echo '<li><a href="users.php">Welcome ' . $_SESSION['name'] . '</a></li>';
        echo '<li>
        <a href="signout.php">Đăng xuất</a>
        </li>';
      } else {
        echo '<li>
        <a href="signin.php">Đăng nhập</a>
        </li>';
        echo '<li>
        <a href="signup.php">Đăng ký</a>
        </li>';
      }
      ?>
    </ul>
  </div>
</body>

</html>