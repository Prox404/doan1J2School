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
            require_once 'connect.php';
            
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }else{
                header('Location: page-5.php');
            }
            
            $query = "SELECT * FROM manufacturer WHERE id = '$id'";
            $result = mysqli_query($connect, $query);
            $manufacturer = mysqli_fetch_array($result);
        ?> 

        <div class="grid-container">
            <div class="container-header">
                <?php require_once "./root/navbar.php"; ?>
            </div>
            <div class="container-menu">
                <?php require_once "./root/sidebar.php"; ?>
            </div>
            <div class="container-main">
                <h1 class="main-title">Thêm nhà sản xuất</h1>
                    
                <div class="add-new-item">
                    <form action="" method="post" enctype="multipart/form-data">
                        <label for="manufacturer_name">Tên nhà sản xuất</label>
                        <input name="manufacturer_name" onkeyup="oku_check_add_manufacturer();" id="manufacturer_name" type="text" value="<?= $manufacturer['name'];?>" >
                        
                        <br>
                        <input type="submit" onclick="return add_manufacturer_validate();" name="edit_manufacturer" value="Nhập">
                    </form>
                </div> 
                
            </div>  
            <div class="container-footer">
                <?php require_once "./root/footer.php"; ?>
            </div>
        </div>

        <?php 
            if(isset($_POST['edit_manufacturer'])){
                if(isset($_POST['manufacturer_name'])){   
                    $manufacturer_name = filter_var($_POST['manufacturer_name'],FILTER_SANITIZE_STRING);
                }
            
                $update = "UPDATE manufacturer SET name = '$manufacturer_name' WHERE id = '$id' ";
                mysqli_query($connect, $update);
                require_once 'alert.php';
                phpAlert('Thanh cong');
            }
            mysqli_close($connect);
        ?>

</body>

<script src="./JS/validateform.js?v=2.2"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>