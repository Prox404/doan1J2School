<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css?v=1.1">
    <link rel="stylesheet" href="./css/main.css?v=2.3">
</head>

<body>
    <div id="content">

        <?php
        if (!isset($connect)) {
            require_once 'connect.php';
        }
        // include 'get_product.php';
        include './content/process_get_product.php';
        // include search_product.php
        include './content/process_search.php';
        // include filter_product.php
        include './content/process_filter.php';
        // create cart
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['number_item'] = 0;
        }

        if (isset($_GET['addCart'])) {
            $id = $_GET['addCart'];

            $prouct_query = "SELECT * FROM product WHERE id = '$id'";
            $product_result = mysqli_query($connect, $prouct_query);
            $product_value = mysqli_fetch_array($product_result);

            if (empty($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['product_id'] = $id;
                $_SESSION['cart'][$id]['cart_quantity'] = 1;
                $_SESSION['cart'][$id]['cart_available_quantity'] = $product_value['quantity'];
                $_SESSION['cart'][$id]['cart_image'] = $product_value['image'];
                $_SESSION['cart'][$id]['cart_name'] = $product_value['name'];
                $_SESSION['cart'][$id]['cart_cost'] = $product_value['cost'];
                $_SESSION['cart'][$id]['sold'] = $product_value['sold'];
                $_SESSION['number_item'] += 1;
                header("Refresh:0");
            } else {
                $_SESSION['cart'][$id]['cart_quantity'] += 1;
            }
        }
        ?>

        <div class="slideshow-container">

            <div class="mySlides zoom">
                <div class="image-1">
                    <img src="https://img.freepik.com/free-vector/creative-sales-banner-with-abstract-details_52683-67038.jpg?size=626&ext=jpg" style="width:100%">
                    <div class="title">VỪA CHIA TAY <br> SALE NGẬP MẶT <br>VALENTINE</div>
                </div>
            </div>

            <div class="mySlides zoom">
                <div class="image-2">
                    <img src="https://img.freepik.com/free-vector/modern-sale-banner-with-text-space-area_1017-27331.jpg?size=626&ext=jpg" style="width:100%">
                    <div class="title">SALE BÙNG NỔ <br> BANH XÁC <br>NYC</div>
                </div>
            </div>

            <div class="mySlides zoom">
                <div class="image-3">
                    <img src="https://static.vecteezy.com/system/resources/thumbnails/001/338/306/small/black-friday-sale-banner-free-vector.jpg" style="width:100%">
                    <div class="title">XẢ KHO <br> CHỈ NGÀY HÔM NAY <br>MAI BÁN TIẾP</div>
                </div>
            </div>

            <div class="prev">
                <a onclick="plusSlides(-1)"><i class="fas fa-chevron-left"></i></a>
            </div>
            <div class="next">
                <a onclick="plusSlides(1)"><i class="fas fa-chevron-right"></i></a>
            </div>

        </div>
        <br>

        <div style="text-align:center">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
        <div class="menu">
<<<<<<< HEAD
            <?php include './content/menu_item.php'; ?>
            <?php include './content/menu_filter.php'; ?>
=======
            <h3 text-align: center>Danh mục sản phẩm</h3>
            <div class="filter">
                <form method="$_GET" action="" name="filter">
                    <select name="filter-manufacturer" class="filter-manufacturer">
                        <option value="" selected>Tất cả</option>
                        <?php foreach ($manufacturer_result as $manufacturer) { ?>
                            <option value="<?php echo $manufacturer['id'] ?>"><?php echo $manufacturer['name'] ?></option>
                        <?php } ?>
                    </select>
                    <h3>Loại sản phẩm</h3>
                    <select name="filter-type" class="filter-type">
                        <option value="" selected>Tất cả</option>
                        <?php foreach ($type_result as $type) { ?>
                            <option value="<?php echo $type['id'] ?>"><?php echo $type['name'] ?></option>
                        <?php } ?>
                    </select>
                    <h3>Giá</h3>
                    <input type="text" name="start-price" placeholder="Giá từ" value="<?php
                                                                                        if (isset($_GET['start-price'])) {
                                                                                            echo $_GET['start-price'];
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>">
                    <input type="text" name="end-price" placeholder="Giá đến" value="<?php
                                                                                        if (isset($_GET['end-price'])) {
                                                                                            echo $_GET['end-price'];
                                                                                        } else {
                                                                                            echo "";
                                                                                        } ?>">
                                                                                        <br>
                    <button type="submit" class="btn btn-primary" name="filter-submit">Áp dụng</button>
                </form>
            </div>
>>>>>>> 346116728096754828dc8ba672b3e1cc53e6004a

        </div>
        <div class="midle" text-align: center>
            <?php if (!empty($search_result)) { ?>
                <h2 class="search-result">Kết quả tìm kiếm cho "<?= $search ?>"</h2>
                <div class="commodity">
                    <?php foreach ($search_result as $product) { ?>
                        <div class="commodity-item">
                            <a href="product.php?id=<?= $product['id'] ?>">
                                <img class="commodity-image" src="../Admin/photos/<?= $product['image'] ?>" style="height: 180px;">
                                <div>
                                    <p class="item-name"><?= $product['name'] ?></p>
                                    <p class="item-cost"><?= $product['cost'] ?>VNĐ</p>
                                </div>
                                <a class="link-button" href="?<?php if (!empty($search)) {
                                                                    echo "search=" .  $search . "&";
                                                                } ?>addCart=<?= $product['id'] ?>">Thêm vào giỏ hàng</a>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } else if (!empty($filter_result)) { ?>
                <h2 class="filter-result">Kết quả</h2>
                <div class="commodity">
                    <?php foreach ($filter_result as $product) { ?>
                        <div class="commodity-item">
                            <a href="product.php?id=<?= $product['id'] ?>">
                                <img class="commodity-image" src="../Admin/photos/<?= $product['image'] ?>" style="height: 180px;">
                                <div>
                                    <p class="item-name"><?= $product['name'] ?></p>
                                    <p class="item-cost"><?= $product['cost'] ?>VNĐ</p>
                                </div>
                                <a class="link-button" href="?<addCart=<?= $product['id'] ?>">Thêm vào giỏ hàng</a>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <h2 class="all-product">Tất cả sản phẩm</h2>
                <div class="commodity">
                    <?php foreach ($result as $product) { ?>
                        <div class="commodity-item">
                            <a href="product.php?id=<?= $product['id'] ?>">
                                <img class="commodity-image" src="../Admin/photos/<?= $product['image'] ?>" style="height: 180px;">
                                <div>
                                    <p class="item-name"><?= $product['name'] ?></p>
                                    <p class="item-cost"><?= $product['cost'] ?>VNĐ</p>
                                </div>
                                <a class="link-button" href="?addCart=<?= $product['id'] ?>">Thêm vào giỏ hàng</a>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
</body>

</html>