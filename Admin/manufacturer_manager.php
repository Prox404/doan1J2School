<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lí nhà sản xuất</title>
    <link rel="stylesheet" href="./CSS/style.css?v=4.3">
</head>
<body>

        <?php 
            require_once './root/checkLogin.php';
            require_once './root/level_2_permisson.php';
        ?>
        

        <?php 
            
            require_once './root/connect.php';
          
            $page = 1;
            $search = "";

            if(isset($_GET['search'])){
                $search = $_GET['search'];
            }
        
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            
            $number_of_post_query = "SELECT count(*) FROM manufacturer WHERE (name like '%$search%') OR (id = '$search')";
            $post_array = mysqli_query($connect, $number_of_post_query);
            $result_array = mysqli_fetch_array($post_array);
            $number_of_post = $result_array['count(*)'];
            $number_post_per_page = 3;
            $number_of_page = ceil($number_of_post/$number_post_per_page);
            $number_of_skip_page = $number_post_per_page * ($page - 1);

            $querry = "SELECT * FROM manufacturer WHERE (name like '%$search%') OR (id = '$search') LIMIT $number_post_per_page OFFSET $number_of_skip_page ";
            $result = mysqli_query($connect, $querry);

        ?> 

        <div class="grid-container">
            <div class="container-header">
                <?php require_once "./root/navbar.php"; ?>
            </div>
            <div class="container-menu">
                <?php require_once "./root/sidebar.php"; ?>
            </div>
            <div class="container-main">
                <h1 class="main-title">Danh sách nhân ziên</h1>
                    
                <div class="add-new-item">

                    <a class="link-button" href="./add/add-manufacturer.php"><i class="fas fa-plus-circle"></i>Thêm nhà sản xuất</a>
                    <a class="link-button exel" href="./root/export_exel.php?manufacturer=true"><i class="fas fa-file-excel"></i>Xuất file exel</a>

                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên nhà sản xuất</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($result as $manufacturer){ ?>
                                <tr>
                                    <td><?php echo $manufacturer['id'] ?></td>
                                    <td><a href="./view-infomation/manufacturer-info.php?id=<?php echo $manufacturer['id'];?>&name=<?php echo $manufacturer['name'];?>"><?php echo $manufacturer['name'] ?></a></td>
                            
                                    <td>
                                        <a class="link-button" href="./edit/edit-manufacturer.php?id=<?= $manufacturer['id']; ?>"><i class="fas fa-pencil-alt"></i>Sửa</a>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>

                    <div class="page_number_list">
                        <?php for($i = 1 ; $i<= $number_of_page ; $i++){?>
                            <div class="page_number">
                                <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </div>
                            
                        <?php } ?>
                    </div>
                    
                </div> 
                
            </div>  
            <div class="container-footer">
                <?php require_once "./root/footer.php"; ?>
            </div>
        </div>

</body>
<script src="./JS/validateform.js?v=2.3"></script>
<script src="./JS/selectOption.js?v=2"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>