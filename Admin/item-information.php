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
                <h1 class="main-title">Thông tin mặt hàng</h1>
                    
                <div class="content-container shadow-box">
                    <div class="item-infomation">
                        <img class="item-picture" src="https://source.unsplash.com/random" alt="">
                        <div class="infor">
                            <p class="item-name"> Áo khoác màu hường nam tính</p>
                            <p class="item-cost">Giá: đ100.000</p>
                            <p class="ship-cost">Phi van chuyen</p>
                            <p class="ship-cost">25.000</p>
                            <p class="number-of-item">Còn 20 sản phẩm trong kho</p>
                            <div class="space-between">
                                <a class="link-button" href=""><i class="fas fa-edit"></i>Sửa</a>
                                <a class="link-button" href=""><i class="fas fa-trash"></i>Xóa</a>
                            </div>
                        </div>
                    </div>

                    <h1 class="title">Thông tin shop</h1>
                    
                    <div class="shop-information">
                        <p>Tên người bán: Shop Đểu VN</p>
                        <p>Địa chỉ: Trung Quốc</p>
                        <p>Số sản phẩm đã bán: 0 chiếc</p>
                    </div>

                    <h1 class="title">Mô tả</h1>
                    <p>
                        Chiếc áo khoác màu hường cực kì nam tính cho những ai thích ấm áp vào mùa hè, mát mẻ vào mùa đông. Bên cạnh chất liệu
                        vải cực kì đểu, mặc như khum mặc thì form áo free size mặc thế éo nào cũng rộng. Nguồn gốc xuất xứ của hàng cực kì uy tín,
                        Made in USA sản xuất tại Trung Quốc - một tỉnh chuyên sản xuất đồ đểu tại Việt Nam.
                    </p>
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