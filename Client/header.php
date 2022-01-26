
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
        <a href="#">Hỗ trợ</a>
      </li>
      <?php session_start() ?>
      <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
        <li><a href="users.php">Welcome <?php echo $_SESSION['name']; ?></a></li>
        <li><a href="order_status.php">Đơn hàng</a></li>
        <li>
          <a href="cart.php">Giỏ hàng</a>
        <?php if (isset($_SESSION['number_item'])) { ?>
          <?php if ($_SESSION['number_item'] > 0) { ?>
            <div class="bubble"><?= $_SESSION['number_item'] ?></div></a></li>
          <?php } ?>
        <?php } ?>
        </li>
        <li>
          <a href="signout.php">Đăng xuất</a>
        </li>
      <?php } else { ?>
        <li >
          
          <a href="#" data-toggle="modal" data-target="#modal-signin" class="signin-btn"> Đăng nhập</a>
        </li>
        <li >
          

          <a href="#" data-toggle="modal" data-target="#modal-signup" class="signup-btn">Đăng ký</a>
        </li>
      <?php } ?>
    </ul>
  </div>
  <?php include 'signup.php'; ?>
  <?php include 'signin.php'; ?>
</body>


    <script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
