<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css?v=2.1">
</head>
<body>

    <?php 
        require_once 'connect.php';

        $id = $_GET['id'];
        $name = $_GET['name'];
        $query = "SELECT * FROM product WHERE manufacturer_id = '$id'";
        $result = mysqli_query($connect, $query);
    
    ?>
        
        <div class="grid-container">
            <div class="container-header">
                <?php require_once "./root/navbar.php"; ?>
            </div>
            <div class="container-menu">
                <?php require_once "./root/sidebar.php"; ?>
            </div>
            <div class="container-main">
                <h1 class="main-title"><?php echo $name; ?></h1>
                    
                <div class="content-container">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Anh
                                </th>
                                <th>
                                    Ten san pham
                                </th>
                                <th>
                                    Gia
                                </th>
                                <th>
                                    So luong
                                </th>
                                <th>
                                    Xem
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($result as $product){ ?>
                                <tr>
                                    <th><?= $product['id']; ?></th>
                                    <th><img src="photos/<?= $product['image']; ?>" alt="" class="cover-image"></th>
                                    <th><?= $product['name']; ?></th>
                                    <th><?= $product['cost']; ?></th>
                                    <th><?= $product['quantity']; ?></th>
                                    <th><a class="link-button" href="item-information.php?id=<?= $product['id']; ?>">Xem</a></th>
                                </tr>
                                
                            <?php } ?>
                            

                        </tbody>
                    </table>
                </div>
                
            </div>  
            <div class="container-footer">
                <?php require_once "./root/footer.php"; ?>
            </div>
        </div>

        <?php 
            mysqli_close($connect);
        ?>
        
</body>
<script src="./JS/validateform.js"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>