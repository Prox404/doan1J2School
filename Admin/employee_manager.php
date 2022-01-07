<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css?v=4.3">
</head>
<body>

        <?php 
            require_once 'checkLogin.php';
            require_once 'level_2_permisson.php';
        ?>
        

        <?php 
            
            require_once 'connect.php';

 
            if(isset($_GET['delete'])){
                $id = $_GET['delete'];
                $delete = "DELETE FROM employee WHERE id = '$id'";
                mysqli_query($connect, $delete);
                header("Refresh:0");
            }
          
            $page = 1;
            $search = "";

            if(isset($_GET['search'])){
                $search = $_GET['search'];
            }
        
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            
            $number_of_post_query = "SELECT count(*) FROM employee WHERE (name like '%$search%') OR (id = '$search') OR (email LIKE '%$search%') OR (phone = '$search')";
            $post_array = mysqli_query($connect, $number_of_post_query);
            $result_array = mysqli_fetch_array($post_array);
            $number_of_post = $result_array['count(*)'];
            $number_post_per_page = 1;
            $number_of_page = ceil($number_of_post/$number_post_per_page);
            $number_of_skip_page = $number_post_per_page * ($page - 1);

            $querry = "SELECT * FROM employee WHERE (name like '%$search%') OR (id = '$search') OR (email LIKE '%$search%') OR (phone LIKE '$search') LIMIT $number_post_per_page OFFSET $number_of_skip_page ";
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

                    <a class="link-button" href="add_employee.php"><i class="fas fa-user-plus"></i>Thêm nhân viên</a>

                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Birthday</th>
                                <th>Email</th>
                                <th>Manage</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach($result as $employee){ ?>
                                <tr>
                                    <td><?php echo $employee['id'] ?></td>
                                    <td><?php echo $employee['name'] ?></td>
                                    <td><?php echo $employee['phone'] ?></td>
                                    <td><?php echo $employee['address'] ?></td>
                                    <td>
                                        <?php 
                                            if($employee['gender'] == 1){
                                                echo "Nam";
                                            }else{
                                                echo "Nữ";
                                            } 
                                        ?>
                                    </td>
                                    <td><?php echo $employee['dob'] ?></td>
                                    <td><?php echo $employee['email'] ?></td>
                                    
                                    <td>
                                        <a class="link-button" href="edit_employee.php?id=<?php echo $employee['id'];?>"><i class="fas fa-user-edit"></i>Sửa</a>
                                        <a class="link-button" href="?search=<?php echo $search; ?>&page=<?php echo $page; ?>&delete=<?php echo $employee['id']; ?>" onclick="return confirm('Đồng ý xóa <?= $employee['name']; ?> ?');"><i class="fas fa-user-times"></i>Xóa</a>
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