<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./CSS/style.css?v=2.2">
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
</head>
<body style="background-color: #FBF6F0;">
    <?php 
        session_start();
        require_once './root/connect.php';
        require_once './root/alert.php';
        require_once './root/validate.php';
    ?>

    <?php 
        if(isset($_SESSION["loged"])){
            header('location: index.php');
        }
    ?>

    <?php
        
        if(!isset($_GET['resetPassword'])){
            header('location: not_found.php');
        }else{
            $resetPassword = $_GET['resetPassword'];
        }

        if(!isset($_GET['email'])){
            header('location: not_found.php');
        }else{
            $email = $_GET['email'];
        }

        $query = "SELECT * FROM employee WHERE password = '$resetPassword' AND email = '$email'";


        $rows = mysqli_query($connect,$query);
        $count = mysqli_num_rows($rows);
    
        if($count < 1){
            header('location: not_found.php');
        }else{
            $row_arr = mysqli_fetch_array($rows);
            $id = $row_arr['id'];
        }

    ?>

    <?php 
        if(isset($_POST['reset_Password'])){
            $password = $_POST['password'];
            $rePassword = $_POST['rePassword'];

            if(checkPassword($password) == false || $password != $rePassword || strlen($password) == 0){
                phpAlert('Anh bạn à :))');
                goto end_php;
            }


            $udate_password = md5($password);
            $token = $email . md5($password);

            $update = "UPDATE employee SET password = '$udate_password', token = '$token' WHERE id = '$id'";

            mysqli_query($connect, $update);

            phpAlert('Thành công!');

            header("refresh:3;url = login.php");
            
            end_php:
        }
    ?>

    <div class="login-form">
        <img
                src="https://i.ibb.co/6bZRxw4/P-ogrange.png"
                alt=""
                class="login-logo"
        />
        <h1 class="login-title">Welcome</h1>
        <h1 class="login-title orange">Prox Shopping Services</h1>
        <form action="" method="post">

            <label for="password">Nhập mật khẩu mới</label>
            <input name="password" id="password" type="password" placeholder="Password" autocomplete="off">

            <label for="rePassword">Nhập lại mật khẩu mới</label>
            <input name="rePassword" id="re_password" type="password" placeholder="Re-Password" autocomplete="off">

            <br>
            <br>

            <input type="submit" onclick="return checkResetPassword();" name="reset_Password" value="Submit">
            
        </form>
    </div>

    
</body>
<script src="./JS/validateform.js"></script>
</html>