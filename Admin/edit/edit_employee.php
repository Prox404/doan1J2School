<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa nhân viên</title>
    <link rel="stylesheet" href="../CSS/style.css?v=4.1">
</head>
<body>
        <?php            
            require_once '../root/level_2_permisson_folder.php';
            require_once '../root/checkLogin_folder.php';
        ?>

        <?php 
            require_once '../root/connect.php';
            if(!empty($_GET['id'])){
                $id = $_GET['id'];
            }else{
                header('Location: ../employee_manager.php');
            }
            $query = "SELECT * FROM employee WHERE id = '$id'";
            $result = mysqli_query($connect, $query);
            if(mysqli_num_rows($result) == 0){
                header('location: ../not_found.php');
            }
            $employee = mysqli_fetch_array($result);
        ?> 

        <?php 
            if(isset($_POST['edit_employee'])){
                if(isset($_POST['employee_name'])){   
                    $employee_name = filter_var($_POST['employee_name'],FILTER_SANITIZE_STRING);
                }
                if(isset($_POST['employee_phone_number'])){
                    $employee_phone_number = filter_var($_POST['employee_phone_number'],FILTER_SANITIZE_STRING);
                }
                if(isset($_POST['employee_address'])){
                    $employee_address = filter_var($_POST['employee_address'],FILTER_SANITIZE_STRING);
                }
                if(isset($_POST['employee_gender'])){
                    $employee_gender = $_POST['employee_gender'];
                }
                if(isset($_POST['employee_dob'])){
                    $employee_dob = $_POST['employee_dob'];
                } 
                if(isset($_POST['employee_email'])){
                    $employee_email = filter_var($_POST['employee_email'],FILTER_SANITIZE_STRING);
                    
                    if($_POST['employee_password'] == "defaultPASSWORD123$%^"){
                        $employee_password = $employee['password'];
                    }else{
                        $employee_password = md5($_POST['employee_password']) ;
                        
                    }

                    $token = $employee_email . $employee_password;
                } 
                if(isset($_POST['employee_password'])){
                    if($_POST['employee_password'] == "defaultPASSWORD123$%^"){
                        $employee_password = $employee['password'];
                    }else{
                        $employee_password = md5($_POST['employee_password']) ;
                    }

                    $token = $employee_email . $employee_password;
                } 
                

                $update = "UPDATE employee 
                SET name = '$employee_name',
                phone = '$employee_phone_number',
                gender = $employee_gender,
                dob =  '$employee_dob',
                email = '$employee_email',
                password = '$employee_password',
                token = '$token'
                WHERE id = $id";
                mysqli_query($connect, $update);
                require_once '../root/alert.php';
                phpAlert('Thanh cong');
                header('refresh:0');
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
                <h1 class="main-title">Sửa nhân ziên</h1>
                    
                <div class="add-new-item">
                    <form action="" method="post">
                        <label for="employee_name">Tên nhân ziên</label>
                        <input name="employee_name" onkeyup="oku_add_check();" id="employee_name" type="text" value="<?= $employee['name']; ?>">
                        <label for="employee_phone_number">Số điện thoại</label>
                        <input name="employee_phone_number" onkeyup="oku_add_check();" id="employee_phone_number" type="text" value="<?= $employee['phone']; ?>">
                        <label for="employee_address">Địa chỉ</label>
                        <input name="employee_address" onkeyup="oku_add_check();" id="employee_address" type="text" value="<?= $employee['address']; ?>">
                        <label for="employee_gender">Giới tính</label>
                        <?php 
                            if($employee['gender'] == 1){
                                echo '<span><input name="employee_gender" value="1" type="radio" style="height: auto;" checked >Nam</span>';
                                echo '<span><input name="employee_gender" value="0" type="radio" style="height: auto;">Nữ</span>';
                            }else{
                                echo '<span><input name="employee_gender" value="1" type="radio" style="height: auto;">Nam</span>';
                                echo '<span><input name="employee_gender" value="0" type="radio" style="height: auto;" checked >Nữ</span>';
                            }
                        ?>
                        <label for="employee_dob">Ngày sinh</label>
                        <input name="employee_dob" onkeyup="oku_add_check();" id="employee_dob" type="date" value="<?= $employee['dob']; ?>">
                        <label for="employee_email">Email</label>
                        <input name="employee_email" onkeyup="oku_add_check();" id="employee_email" type="email" value="<?= $employee['email']; ?>">
                        <label for="employee_password">Mật khẩu</label>
                        <input name="employee_password" onkeyup="oku_add_check();" id="employee_password" type="password" value="defaultPASSWORD123$%^">
                        <br>
                        <input type="submit" onclick="return validate_add_employee();" name="edit_employee" value="Nhập">
                    </form>
                </div> 
                
            </div>  
            <div class="container-footer">
                <?php require_once "../root/footer.php"; ?>
            </div>
        </div>

        

            <?php mysqli_close($connect); ?>

</body>
<script src="../JS/validateform.js?v=2.4"></script>
<script src="../JS/selectOption.js?v=2"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>