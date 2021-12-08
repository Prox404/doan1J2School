<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>
        
        <div class="grid-container">
            <div class="container-header shadow-box">
                <?php require_once "./root/navbar.php"; ?>
            </div>
            <div class="container-menu shadow-box">
                <?php require_once "./root/sidebar.php"; ?>
            </div>
            <div class="container-main">
                <h1 class="main-title">Thêm mặt hàng</h1>
                    
                <div class="add-new-item shadow-box">
                    <form action="" method="get">
                      <label for="item-name">Tên mặt hàng</label>
                      <input onkeyup="oku_check();" id="item-name" type="text">
                      <label for="item-cost">Giá mặt hàng</label>
                      <input onkeyup="oku_check();" id="item-cost" type="number">
                      <label for="item-information">Mô tả mặt hàng</label>
                      <textarea onkeyup="oku_check();" name="" id="item-information" cols="30" rows="10"></textarea>
                      <label id="image-upload" for="item-image"> <i class="fas fa-upload"></i> Hình ảnh mặt hàng</label>
                      <input id="item-image" type="file" hidden>
                      <label for="number-of-item">Số lượng</label>
                      <input onkeyup="oku_check();" id="number-of-item" type="number">

                      <a href="#" class="link-button" onclick="return validate();">Nhập</a>
                    </form>

                </div> 
                
            </div>  
            <div class="container-footer">
                <?php require_once "./root/footer.php"; ?>
            </div>
        </div>

        
</body>
<script src="./JS/validateform.js"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>3