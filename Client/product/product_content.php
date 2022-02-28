<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="./CSS/main.css?v=2.6"> -->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
</head>

<body>
    <?php include './product/get_info_product.php'; ?>
    


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
                    if (!isset($_SESSION)) {
                        session_start();
                    }
                    if (!isset($_SESSION['loggedin'])) {
                        echo '<a class="link-button" href="#" data-toggle="modal" data-target="#modal-signin" class="signin-btn"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</a>';
                    } else {
                        echo '<a class="link-button" href="?id=' . $id . '&addCart=' . $id . '"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <h3 class="title">Nhà sản xuất</h1>
        <div class="shop-information">
            <p> <?php echo $product['manufacturer_name'] ?></p>
        </div>
        <h3 class="title">Mô tả</h1>
        <p>
            <?php echo nl2br($product['description']);  ?>
        </p>
    </div>

    
   
    <?php include './cart/process_add_cart.php'; ?>
    <?php
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $check_sold = "SELECT * FROM bill JOIN bill_detail on bill.id = bill_detail.bill_id WHERE customer_id = '$user_id' AND product_id = '$id'";
        $check_sold_result = mysqli_query($connect, $check_sold);
        $number_result = mysqli_num_rows($check_sold_result);
        $check_rating_query = "SELECT * FROM rate_product WHERE product_id = '$id' AND customer_id = '$user_id'";
        $check_rating_result = mysqli_query($connect, $check_rating_query);
        $rating_result = mysqli_num_rows($check_rating_result);
        if ($number_result >= 1 && $rating_result < 1) {
            echo '
            <div class="content_container" id="comment-box">
            <form action="" method="post">
                <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                    <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                    <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                    <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
                </fieldset>
                <textarea name="comment" id="" cols="30" rows="10">Bạn nghĩ gì về sản phẩm ? hãy cho chúng tôi biết nhé ❤️</textarea>
                <input name="btn_comment" type="submit" value="Bình luận">
            </form>
        </div>
                ';
        }
    }
    ?>

    <?php
        if (isset($_POST['btn_comment'])) {
            $rating  = $_POST['rating'];
            $comment  = $_POST['comment'];
            $post_comment = "INSERT INTO rate_product VALUES ($id,$user_id,$rating,'$comment')";
            mysqli_query($connect, $post_comment);
            echo '<script>
            window.location.href = window.location.href;
            </script>';
        }
    ?>
    
    <?php
        if (isset($_POST['btn_edit_comment'])) {
            $rating  = $_POST['re_rating'];
            $comment  = $_POST['re_comment'];
            $edit_comment = "UPDATE `rate_product` SET `rating` = '$rating', `comment` = '$comment' WHERE `rate_product`.`product_id` = '$id' AND `rate_product`.`customer_id` = $user_id";
            mysqli_query($connect, $edit_comment);
            echo '<script>
            alert("Cảm ơn bạn đã đánh giá sản phẩm :3");
            window.location.href = window.location.href;
            </script>';
        }
    ?>

    <?php include './product/load_comment.php'; ?>


</body>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>

</html>