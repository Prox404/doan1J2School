<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
    <link rel="stylesheet" href="../CSS/style.css?v=4.1">
</head>
<body>

        <?php 
            require_once '../root/checkLogin_folder.php';
            require_once '../root/level_2_permisson_folder.php';
        ?>

        <div class="grid-container">
            <div class="container-header">
                <?php require_once "../root/navbar.php"; ?>
            </div>
            <div class="container-menu">
                <?php require_once "../root/sidebar_folder.php"; ?>
            </div>
            <div class="container-main">
                <h1 class="main-title">Thêm nhân viên</h1>
                    
                <div class="add-new-item">
                    <form action="" method="post">
                        <label for="employee_name">Tên nhân viên</label>
                        <input name="employee_name" onkeyup="oku_add_check();" id="employee_name" type="text">
                        <label for="employee_phone_number">Số điện thoại</label>
                        <input name="employee_phone_number" onkeyup="oku_add_check();" id="employee_phone_number" type="text">
                        <label for="employee_address">Địa chỉ</label>
                        <input name="employee_address" onkeyup="oku_add_check();" id="employee_address" type="text">
                        <label for="employee_gender">Giới tính</label>
                        <span><input name="employee_gender" value="1" type="radio" style="height: auto;">Nam</span>
                        <span><input name="employee_gender" value="0" type="radio" style="height: auto;">Nữ</span>
                        <label for="employee_dob">Ngày sinh</label>
                        <input name="employee_dob" onkeyup="oku_add_check();" id="employee_dob" type="date">
                        <label for="employee_email">Email</label>
                        <input name="employee_email" onkeyup="oku_add_check();" id="employee_email" type="email">
                        <label for="employee_password">Mật khẩu</label>
                        <input name="employee_password" onkeyup="oku_add_check();" id="employee_password" type="password">
                        <br>
                        <input type="submit" onclick="return validate_add_employee();" name="add_employee" value="Nhập">
                    </form>
                </div> 
                
            </div>  
            <div class="container-footer">
                <?php require_once "../root/footer.php"; ?>
            </div>
        </div>

        <?php 
            require_once '../root/connect.php';
            if(isset($_POST['add_employee'])){
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
                } 
                if(isset($_POST['employee_password'])){
                    $employee_password = md5($_POST['employee_password']) ;
                } 

                if(isset($_POST['employee_password']) && isset($_POST['employee_email'])){
                    $token =  $_POST['employee_email'] . md5($_POST['employee_password'])  ;
                }

                $flag = true;

                if(strlen($employee_name) == 0){
                    $flag = false;
                }
                if(strlen($employee_phone_number) == 0){
                    $flag = false;
                }
                if(strlen($employee_address) == 0){
                    $flag = false;
                }
                if(strlen($employee_gender) == 0){
                    $flag = false;
                }
                if(strlen($employee_dob) == 0){
                    $flag = false;
                }
                if(strlen($employee_email) == 0){
                    $flag = false;
                }
                if(strlen($employee_password) == 0){
                    $flag = false;
                }

                if($flag == false ){
                    $flag = true;
                    phpAlert('Anh bạn à :))');
                    goto label_end;
                }
                
                $manager_id = $_SESSION['id'];
                $insert = "INSERT INTO employee (name, phone, address, gender, dob, email, password, level_id,token,manager_id) 
                VALUES ('$employee_name','$employee_phone_number', '$employee_address', $employee_gender, '$employee_dob', '$employee_email', '$employee_password', 1,'$token',$manager_id) ";
                mysqli_query($connect, $insert);
                require_once '../root/alert.php';
                phpAlert('Thanh cong');

                label_end:
            }
        ?>

</body>
<script src="../JS/validateform.js?v=2.4"></script>
<script src="../JS/selectOption.js?v=2"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>