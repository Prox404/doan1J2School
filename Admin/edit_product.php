<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css?v=4.1">
</head>
<body>

        <?php 
            require_once 'checkLogin.php';
        ?>

        <?php
            require_once 'connect.php';

            $query = "SELECT * FROM manufacturer";
            $result = mysqli_query($connect, $query);

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
                <h1 class="main-title">Thêm mặt hàng</h1>
                    
                <div class="add-new-item">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="item-name">Tên mặt hàng</label>
                        <input name="product_name" onkeyup="oku_check();" id="item-name" type="text" value="<?php echo $product['name']; ?>">
                        <label for="item-cost">Giá mặt hàng</label>
                        <input name="product_cost" onkeyup="oku_check();" id="item-cost" type="number" value="<?php echo $product['cost']; ?>">
                        <label for="item-information">Mô tả mặt hàng</label>
                        <textarea onkeyup="oku_check();" name="product_description" id="item-information" cols="30" rows="10"><?php echo $product['description']; ?></textarea>
                        <label id="image-upload" for="item-image"> <i class="fas fa-upload"></i> Hình ảnh mặt hàng</label>
                        <input name="product_image" id="item-image" type="file" hidden >
                        <label>Hình ảnh cũ:</label>
                        <img class="old-image" src="photos/<?php echo $product['image']; ?>" alt="">
                        <label for="number-of-item">Số lượng</label>
                        <input name="product_quantity" onkeyup="oku_check();" id="number-of-item" type="number" value="<?php echo $product['quantity'] ?>">
                        <label for="manufacturer">Nhà sản xuất</label>
                        <div class="custom-select">
                            <select id="manufacturer" name="manufacturer">
                                <option value="0"><?php echo $product['manufacturer_name'] ?></option>
                                <?php foreach($result as $value){
                                    if($value['id'] == $product['manufacturer_id']){
                                        echo  '<option value="' . $value['id'] . ' selected ">' . $value['name'] . '</option>';
                                    }else{
                                        echo  '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
                                    }
                                }?>
                                    
                               
                            </select>
                        </div>
                        <br>
                        <input type="submit" onclick="return validate_edit();" name="edit_product" value="Nhập">
                    </form>
                </div> 
                
            </div>  
            <div class="container-footer">
                <?php require_once "./root/footer.php"; ?>
            </div>
        </div>

        <?php 
            if(isset($_POST['edit_product'])){
                if(isset($_POST['product_name'])){   
                    $product_name = filter_var($_POST['product_name'],FILTER_SANITIZE_STRING);
                }
                if(isset($_POST['product_cost'])){
                    $product_cost = filter_var($_POST['product_cost'],FILTER_SANITIZE_STRING);
                }
                if(isset($_POST['product_description'])){
                    $product_description = filter_var($_POST['product_description'],FILTER_SANITIZE_STRING);
                }
                if(isset($_POST['product_quantity'])){
                    $product_quantity = $_POST['product_quantity'];
                }
                if(isset($_POST['manufacturer'])){
                    if($_POST['manufacturer'] != 0){
                        $manufacturer = $_POST['manufacturer'];
                    }else{
                        $manufacturer = $product['manufacturer_id'];
                    }
                }
                if(isset($_FILES["product_image"])){
                    $product_image = $_FILES["product_image"];
                    if(strlen($product_image['tmp_name']) != 0 ){
                        $folder = 'photos/';
                        $file_extension = explode('.',$product_image['name'])[1];
                        $file_name =  time() . '.' . $file_extension;
                        $path_file = $folder . $file_name;
                        move_uploaded_file($product_image['tmp_name'], $path_file);
                    }else{
                        $file_name = $product['image'];
                    }
                    
                }

                $update = "UPDATE product 
                SET name = '$product_name',
                cost = $product_cost,
                description = '$product_description',
                image = '$file_name',
                quantity = $product_quantity,
                manufacturer_id = $manufacturer
                WHERE id = '$id'
                ";
                mysqli_query($connect, $update);
                require_once 'alert.php';
                phpAlert('Thanh cong');
            }
            mysqli_close($connect);
        ?>

</body>
<script src="./JS/uploadFile.js"></script>
<script src="./JS/validateform.js?v=2.2"></script>
<script src="./JS/selectOption.js"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>