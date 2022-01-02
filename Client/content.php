<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
<div id="content">
    <?php 
        if(!isset($connect)){
            require_once 'connect.php';
        }

        $search = "";

        if(isset($_GET['search'])){
            $search = $_GET['search'];
        }

        $query = "SELECT * FROM product WHERE name like '%$search%'";
        $result = mysqli_query($connect, $query);
    ?>
    <div class="menu">
        <h3 text-align: center>Danh mục sản phẩm</h3>
        <ul>
            <li>
                <a href="#">
                    <b>Các loại áo thun</b>
                </a>
            </li>
            <li>
                <a href="#">
                    <b>Các loại áo gió</b>
                </a>
            </li>
            <li>
                <a href="#">
                    <b>Áo sơ mi các loại:v</b>
                </a>
            </li>
            <li>
                <a href="#">
                    <b>Áo vest lịch lãm</b>
                </a>
            </li>
            <li>
                <a href="#">
                    <b>Áo khoác</b>
                </a>
            </li>
            <li>
                <a href="#">
                    <b>Áo phông</b>
                </a>
            </li>
            <li>
                <a href="#">
                    <b>Áo phao</b>
                </a>
            </li>
        </ul>
    </div>
    <div class="midle" text-align: center>
        <h1>Sản phẩm bán chạy</h1>
        <?php foreach($result as $product){ ?>
            <div class="each">
                <a href="#">
                    
                    <img src="../Admin/photos/<?= $product['image'] ?>" style="height: 180px;">
                    <p class="item-name"><?= $product['name'] ?></p>
                    <p class="item-cost"><?= $product['cost'] ?></p>
                    <a class="link-button" href="">Them vao gio hang</a>
                </a>
            </div>
        <?php } ?>
        
        
        
    </div>
</div>
</body>
</html>