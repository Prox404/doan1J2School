<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../CSS/style.css?v=2.4"> -->
</head>
<body>
  <?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    if(isset($_GET['signout'])){
      unset($_SESSION["loged"]);
      header('location:login.php');
    }
    if(isset($_GET['removeaccount'])){
      session_destroy();
      setcookie('token', "null", -1,'/','',0);
      header('location:login.php');
    }
  ?>

<div class="sidebar-menu">

  <div class="sidebar-header">
      <img
                src="https://i.ibb.co/6bZRxw4/P-ogrange.png"
                alt=""
                class="menu-logo"
      />

      <p class="menu-webname">Captain Prox</p>

  </div>
  
              <ul class="menu">
                <li class="menu-item">
                  <a href="./index.php" class="menu-link"><i class="far fa-eye"></i> <span>Tổng quan</span> </a>
                </li>
                <li class="menu-item">
                  <a href="./product.php" class="menu-link"><i class="fas fa-shopping-cart"></i> <span>Các mặt hàng</span></a>
                  <button onclick="product_child()" class="dropbtn" > <i class="fas fa-angle-down" id="product_btn"></i> </button>
                </li>
                <li class="menu-item dropdown-content" id="product">
                  <a href="./add/add_new_product.php" class="menu-link">• &nbsp; <span> Thêm mặt hàng</span> <i class="fas fa-angle-right"></i> </a>
                </li>

                <?php 
                  if(isset($_SESSION['level_id'])){
                    if($_SESSION['level_id'] == 2){
                      echo '
                      <li class="menu-item">
                        <a href="./employee_manager.php" class="menu-link"><i class="fas fa-user-plus"></i><span>Nhân viên</span></a>
                        <button onclick="employee_child()" class="dropbtn" > <i class="fas fa-angle-down" id="employee_btn"></i> </button>
                      </li>

                      <li class="menu-item dropdown-content" id="employee">
                        <a href="./add/add_employee.php" class="menu-link">• &nbsp; <span> Thêm nhân viên</span> <i class="fas fa-angle-right"></i> </a>
                      </li>

                      <li class="menu-item">
                        <a href="./manufacturer_manager.php" class="menu-link"><i class="fas fa-industry"></i><span>Nhà sản xuất</span></a>
                        <button onclick="manufacturer_child()" class="dropbtn" > <i class="fas fa-angle-down" id="manufacturer_btn"></i> </button>
                      </li>
                      
                      <li class="menu-item dropdown-content" id="manufacturer">
                        <a href="./add/add-manufacturer.php" class="menu-link">• &nbsp; <span> Thêm nhà sản xuất</span> <i class="fas fa-angle-right"></i> </a>
                      </li>
                      ';
                    }
                  } 
                
                ?>
                
                <li class="menu-item">
                  <a href="./bill.php" class="menu-link"><i class="fas fa-file-invoice"></i><span>Đơn hàng</span></a>
                </li>
                <li class="menu-item">
                  <a href="?signout=true" class="menu-link" onclick="return confirm('Bạn muốn đăng xuất ?');"><i class="fas fa-sign-out-alt"></i><span>Đăng xuất</span></a>
                </li>
                <li class="menu-item">
                  <a href="?removeaccount=true" class="menu-link" onclick="return confirm('Bạn muốn xóa phiên đăng nhập hiện tại ?');"><i class="fas fa-running"></i><span>Xóa phiên</span></a>
                </li>
                <li class="menu-item">
                  <a href="#" class="menu-link"><i class="fas fa-info-circle"></i><span>Thông tin</span></a>
                </li>
              </ul>
            </div>
</body>
<script>

function product_child() {
  document.getElementById("product").classList.toggle("show");
  document.getElementById("product_btn").classList.toggle("rotation");

}
function employee_child() {
  document.getElementById("employee").classList.toggle("show");
  document.getElementById("employee_btn").classList.toggle("rotation");

}
function manufacturer_child() {
  document.getElementById("manufacturer").classList.toggle("show");
  document.getElementById("manufacturer_btn").classList.toggle("rotation");
}
</script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>