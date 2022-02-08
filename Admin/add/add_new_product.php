<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mặt hàng</title>
    <link rel="stylesheet" href="../CSS/style.css?v=4.4">
</head>
<body>

        <?php 
            require_once '../root/checkLogin.php';
        ?>

        <?php 
            require_once '../root/connect.php';
            require_once '../root/alert.php';

            $query = "SELECT * FROM manufacturer";
            $result = mysqli_query($connect, $query);
            $query_type = "SELECT * FROM type";
            $result_type = mysqli_query($connect, $query_type);

        ?> 

        <?php 
            if(isset($_POST['add_product'])){
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
                    $manufacturer = $_POST['manufacturer'];
                } 
                if(isset($_POST['type'])){
                    $type = $_POST['type'];
                } 
                if(isset($_FILES["product_image"])){
                    $product_image = $_FILES["product_image"];
                    $folder = '../photos/';
                    $file_extension = explode('.',$product_image['name'])[1];
                    $file_name =  time() . '.' . $file_extension;
                    $path_file = $folder . $file_name;
                    move_uploaded_file($product_image['tmp_name'], $path_file);
                }
                
                $flag = true;

                if(strlen($product_name) == 0){
                    $flag = false;
                }
                if(strlen($product_cost) == 0){
                    $flag = false;
                }
                if(strlen($product_description) == 0){
                    $flag = false;
                }
                if(strlen($product_quantity) == 0){
                    $flag = false;
                }
                if(strlen($manufacturer) == 0){
                    $flag = false;
                }
                if(strlen($type) == 0){
                    $flag = false;
                }
                if(strlen($file_name) == 0){
                    $flag = false;
                }
                if($file_extension != 'png' && $file_extension != 'jpg' && $file_extension != 'jpeg'){
                    $flag = false;
                }

                if($flag == false ){
                    $flag = true;
                    phpAlert('Anh bạn à :))');
                    goto label_end;
                }

                $insert = "INSERT INTO product (name, description, image, cost, quantity, manufacturer_id,type_id) VALUES ('$product_name','$product_description', '$file_name', $product_cost, $product_quantity, $manufacturer, $type) ";
                mysqli_query($connect, $insert);
                
                phpAlert('Thanh cong');
                header("location: ../product.php");

                label_end:
            }
        ?>

        <div class="grid-container">
            <div class="container-header">
                <?php require_once "../root/navbar.php"; ?>
            </div>
            <div class="container-menu">
                <?php require_once "../root/sidebar_folder.php"; ?>
            </div>
            <div class="container-main">
                <h1 class="main-title">Thêm mặt hàng</h1>
                    
                <div class="add-new-item">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="item-name">Tên mặt hàng</label>
                        <input name="product_name" onkeyup="oku_check();" id="item-name" type="text">
                        <label for="item-cost">Giá mặt hàng</label>
                        <input name="product_cost" onkeyup="oku_check();" id="item-cost" type="number">
                        <label for="item-information">Mô tả mặt hàng</label>
                        <textarea onkeyup="oku_check();" name="product_description" id="item-information" cols="30" rows="10"></textarea>
                        <label id="image-upload" for="item-image"> <i class="fas fa-upload"></i> Hình ảnh mặt hàng</label>
                        <input onchange="loadFile(event)" name="product_image" id="item-image" type="file" accept="image/png, image/jpeg, image/jpg" hidden >
                        <img id="review-image" class="old-image"/>
                        <label for="number-of-item">Số lượng</label>
                        <input name="product_quantity" onkeyup="oku_check();" id="number-of-item" type="number" min="1">
                        <label for="manufacturer">Nhà sản xuất</label>
                        <div class="custom-select">
                            <select id="manufacturer" name="manufacturer">
                                <option value="0">Nhà sản xuất:</option>
                                <?php foreach($result as $value){ ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <label for="type">Loại áo</label>
                        <div class="custom-select">
                            <select id="type" name="type">
                                <option value="0">Loại áo</option>
                                <?php foreach($result_type as $type_value){ ?>
                                    <option value="<?php echo $type_value['id']; ?>"><?php echo $type_value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <br>
                        <br>
                        <input type="submit" onclick="return validate_add_product();" name="add_product" value="Nhập">
                    </form>
                </div> 
                
            </div>  
            <div class="container-footer">
                <?php require_once "../root/footer.php"; ?>
            </div>
        </div>

        <?php 
            
            mysqli_close($connect);
        ?>

</body>
<script src="../JS/uploadFile.js"></script>
<script src="../JS/validateform.js?v=2.5"></script>
<script src="../JS/selectOption.js?v=2.2"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>
