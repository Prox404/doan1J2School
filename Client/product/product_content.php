<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/main.css?v=2.5">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
</head>

<body>


    <?php
    require_once 'connect.php';

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

        <h1 class="title">Nhà sản xuất</h1>

        <div class="shop-information">
            <p> <?php echo $product['manufacturer_name'] ?></p>
        </div>

        <h1 class="title">Mô tả</h1>
        <p>
            <?php echo nl2br($product['description']);  ?>
        </p>
    </div>

    <div class="content_container" id="comment-box">

        <form action="" method="post">
            <fieldset class="rating">
                <input type="radio" id="star5" name="rating" value="5" /><label class="full" for="star5" title="Awesome - 5 stars"></label>
                <input type="radio" id="star4" name="rating" value="4" /><label class="full" for="star4" title="Pretty good - 4 stars"></label>
                <input type="radio" id="star3" name="rating" value="3" /><label class="full" for="star3" title="Meh - 3 stars"></label>
                <input type="radio" id="star2" name="rating" value="2" /><label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                <input type="radio" id="star1" name="rating" value="1" /><label class="full" for="star1" title="Sucks big time - 1 star"></label>
            </fieldset>
            <textarea name="comment" id="" cols="30" rows="10"></textarea>
            <input name="btn_comment" type="submit" value="Bình luận">
        </form>

    </div>

    <?php
    $load_comment = "SELECT rate_product.*,customer.name FROM rate_product JOIN customer ON rate_product.customer_id = customer.id WHERE product_id = '$id'";
    $comment_result = mysqli_query($connect, $load_comment);

    ?>
    <?php foreach ($comment_result as $product_comment) { ?>
        <div class="content_container comment-box">
            <img class="comment_avt" src="https://i.ibb.co/gjYSPt9/97387265-911934715945271-6195268394929881088-o.jpg" alt="">
            <div style="width: 100%">
                <div class="head-comment">
                    <div class="left-head">
                        <p><?= $product_comment['name'] ?></p>
                    </div>
                    <div class="right-head">

                        <?php
                        $rating = $product_comment['rating'];
                        for ($i = 1; $i <= $rating; $i++) {
                            echo '
                                    <span class="fa fa-star checked"></span>
                                ';
                        }
                        for ($i = 1; $i <= 5 - $rating; $i++) {
                            echo '
                                    <span class="fa fa-star"></span>
                                ';
                        }
                        ?>
                        <p></p>
                    </div>
                </div>

                <div class="comment-content">
                    <p><?= $product_comment['comment'] ?></p>
                </div>
            </div>





        </div>
    <?php } ?>


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
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $check_sold = "SELECT * FROM bill JOIN bill_detail on bill.id = bill_detail.bill_id WHERE customer_id = '$user_id' AND product_id = '$id'";
        $check_sold_result = mysqli_query($connect, $check_sold);
        $number_result = mysqli_num_rows($check_sold_result);
        if ($number_result >= 1) {
            echo '
                <script>
                    document.getElementById("comment-box").style.display = "block";
                </script>
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


        // echo '
        // <script>
        //     alert("'. $post_comment .'")
        // </script>
        // ';
    }
    ?>


    <?php
    mysqli_close($connect);
    ?>

</body>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>

</html>