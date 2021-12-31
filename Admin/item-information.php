<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css?v=2">
</head>
<body>

    <?php 
        require_once 'checkLogin.php';
    ?>

    <?php
          if(isset($_GET['delete'])){
            $id = $_GET['delete'];
            $delete = "DELETE FROM product WHERE id = '$id'"; 
            header('Location: page-2.php'); 
            die();
            mysqli_query($connect, $delete);
          }
          
    ?>

    <?php 
        require_once 'connect.php';

        $id = $_GET['id'];
        $product_query = "SELECT product.*,manufacturer.name as manufacturer_name  FROM (product 
            join manufacturer on manufacturer_id = manufacturer.id)
            where product.id = '$id'";
        $product_result = mysqli_query($connect, $product_query);
        $product = mysqli_fetch_array($product_result);
    ?>
        
        <div class="grid-container">
            <div class="container-header">
                <?php require_once "./root/navbar.php"; ?>
            </div>
            <div class="container-menu">
                <?php require_once "./root/sidebar.php"; ?>
            </div>
            <div class="container-main">
                <h1 class="main-title">Thông tin mặt hàng</h1>
                    
                <div class="content-container">
                    <div class="item-infomation">
                        <img class="item-picture" src="photos/<?php echo $product['image'] ?>" alt="">
                        <div class="infor">
                            <p class="item-name"><?php echo $product['name'] ?></p>
                            <p class="item-cost">Giá: đ<?php echo $product['cost'] ?></p>
                            <p class="ship-cost">Phi van chuyen</p>
                            <p class="ship-cost">25.000</p>
                            <p class="number-of-item">Còn <?php echo $product['quantity'] ?></p>
                            <div class="space-between">
                                <a class="link-button" href="edit_product.php?id=<?php echo $product['id']; ?>"><i class="fas fa-edit"></i>Sửa</a>
                                <a class="link-button" href="item-information.php?id=<?php echo $id; ?>&delete=<?php echo $product['id'];?>" onclick="return confirm('Bạn muốn xóa sản phẩm?');"><i class="fas fa-trash" ></i>Xóa</a>
                            </div>
                        </div>
                    </div>

                    <h1 class="title">Nhà sản xuất</h1>
                    
                    <div class="shop-information">
                        <p> <?php echo $product['manufacturer_name'] ?></p>
                    </div>

                    <h1 class="title">Mô tả</h1>
                    <p>
                        <?php echo nl2br($product['description']);  ?>
                    </p>
                </div>
                
            </div>  
            <div class="container-footer">
                <?php require_once "./root/footer.php"; ?>
            </div>
        </div>

        <?php 
            mysqli_close($connect);
        ?>
        
</body>
<script src="./JS/validateform.js"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>