<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/main.css?v=2.3">
</head>

<body>


    <?php
    require_once './connect.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('location: index.php');
    }

    $product_query = "SELECT product.*,manufacturer.name as manufacturer_name  FROM (product 
            join manufacturer on manufacturer_id = manufacturer.id)
            where product.id = '$id'";
    $product_result = mysqli_query($connect, $product_query);
    $product = mysqli_fetch_array($product_result);
    ?>



    <div class="content_container">
        <div class="item-infomation">
            <img class="item-picture" src="../Admin/photos/<?= $product['image'] ?>" alt="">
            <div class="infor">
                <p class="item-name"><b><?php echo $product['name'] ?></b></p>
                <p class="item-cost">Giá: đ<?php echo $product['cost'] ?></p>
                <p class="ship-cost">Phi van chuyen</p>
                <p class="ship-cost">25.000</p>
                <p class="number-of-item">Còn <?php echo $product['quantity'] ?></p>
                <div class="space-between">
                    <?php
                        if(!isset($_SESSION)){
                            session_start();
                        }

                        if (!isset($_SESSION['loggedin'])) {
                            echo '<a class="link-button" href="#" data-toggle="modal" data-target="#modal-signin" class="signin-btn"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</a>';
                        }else{
                            echo '<a class="link-button" href="?id=' . $id . '&addCart=' . $id . '"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</a>';
                        }
                        
                    ?>
                    
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

    <?php
    if (isset($_GET['addCart'])) {
        $id = $_GET['addCart'];

        $prouct_query = "SELECT * FROM product WHERE id = '$id'";
        $product_result = mysqli_query($connect, $prouct_query);
        $product_value = mysqli_fetch_array($product_result);

        if (!isset($_SESSION['cart'])) {
            $_SESSION['number_item'] = 0;
        }

        if (empty($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['product_id'] = $id;
            $_SESSION['cart'][$id]['cart_quantity'] = 1;
            $_SESSION['cart'][$id]['cart_available_quantity'] = $product_value['quantity'];
            $_SESSION['cart'][$id]['cart_image'] = $product_value['image'];
            $_SESSION['cart'][$id]['cart_name'] = $product_value['name'];
            $_SESSION['cart'][$id]['cart_cost'] = $product_value['cost'];
            $_SESSION['number_item'] += 1;
        } else {
            $_SESSION['cart'][$id]['cart_quantity'] += 1;
        }
    }
    ?>



    <?php
    mysqli_close($connect);
    ?>

</body>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>

</html>