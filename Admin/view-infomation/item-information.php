<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sản phẩm</title>
    <link rel="stylesheet" href="../CSS/style.css?v=2.5">
</head>
<body>

    <?php 
        require_once '../root/checkLogin.php';
        require_once '../root/alert.php';
        if(!isset($connect)){
            require_once '../root/connect.php';
        }
    ?>

    <?php
          if(isset($_GET['delete'])){
            $id = $_GET['delete'];
            
            $sold_query = "SELECT sold FROM product WHERE id = $id";
            $sold_array = mysqli_query($connect, $sold_query);
            $sold_result = mysqli_fetch_array($sold_array);
            $sold_value = $sold_result['sold'];
            if($sold_value == 0){
              $delete = "DELETE FROM product WHERE id = '$id'";
              mysqli_query($connect, $delete);
              header('location: ../product.php');
            }else{
              phpAlert('Không thể xóa: Hàng đã được bán');
            }
            
          }
          
    ?>

    <?php 


        $id = $_GET['id'];
        $product_query = "SELECT product.*,manufacturer.name as manufacturer_name  FROM (product 
            join manufacturer on manufacturer_id = manufacturer.id)
            where product.id = '$id'";
        $product_result = mysqli_query($connect, $product_query);
        $product = mysqli_fetch_array($product_result);
    ?>
        
        <div class="grid-container">
            <div class="container-header">
                <?php require_once "../root/navbar.php"; ?>
            </div>
            <div class="container-menu">
                <?php require_once "../root/sidebar_folder.php"; ?>
            </div>
            <div class="container-main">
                <h1 class="main-title">Thông tin mặt hàng</h1>
                    
                <div class="content-container">
                    <div class="item-infomation">
                        <img class="item-picture" src="../photos/<?php echo $product['image'] ?>" alt="">
                        <div class="infor">
                            <p class="item-name"><?php echo $product['name'] ?></p>
                            <p class="item-cost">Giá: đ<?php echo $product['cost'] ?></p>
                            <p class="ship-cost">Đã bán: <?= $product['sold'] ?></p>
                            <p class="number-of-item">Còn <?php echo $product['quantity'] ?></p>
                            <div class="space-between">
                                <a class="link-button" href="../edit/edit_product.php?id=<?php echo $product['id']; ?>"><i class="fas fa-edit"></i>Sửa</a>
                                <a class="link-button" href="?id=<?php echo $id; ?>&delete=<?php echo $product['id'];?>" onclick="return confirm('Bạn muốn xóa sản phẩm?');"><i class="fas fa-trash" ></i>Xóa</a>
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
                    $load_comment = "SELECT rate_product.*,customer.name FROM rate_product JOIN customer ON rate_product.customer_id = customer.id WHERE product_id = '$id'";
                    $comment_result = mysqli_query($connect, $load_comment);

                ?>

                <?php foreach($comment_result as $product_comment){ ?>
                    <div class="add-new-item comment-box">
                        <img class="comment_avt" src="https://i.ibb.co/gjYSPt9/97387265-911934715945271-6195268394929881088-o.jpg" alt="">
                        <div style="width: 100%">
                            <div class="head-comment">
                                <div class="left-head">
                                    <p><?= $product_comment['name'] ?></p>
                                </div>
                                <div class="right-head">

                                    <?php 
                                        $rating = $product_comment['rating'];
                                        for($i = 1 ; $i <= $rating; $i++){
                                            echo'
                                                <span class="fa fa-star checked"></span>
                                            ';
                                        }
                                        for($i = 1 ; $i <= 5 - $rating; $i++){
                                            echo'
                                                <span class="fa fa-star"></span>
                                            ';
                                        }
                                    ?>
                                    <p></p>
                                </div>
                            </div>

                            <div class="comment-content">
                                <p><?php echo nl2br($product_comment['comment']);  ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                
            </div>  
            <div class="container-footer">
                <?php require_once "../root/footer.php"; ?>
            </div>
        </div>

        <?php 
            mysqli_close($connect);
        ?>
        
</body>
<script src="../JS/validateform.js"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>