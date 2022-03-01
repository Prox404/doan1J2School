<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./CSS/style.css?v=2.2">
</head>
<body style="background-color: #FBF6F0;">
    <?php 
        session_start();
        require_once './root/connect.php';
    ?>

    <?php 
        if(isset($_SESSION["loged"])){
            header('location: index.php');
        }
    ?>
    <?php 

        require_once './root/alert.php';

        if(isset($_COOKIE['login_status'])){
            phpAlert($_COOKIE['login_status']);
        }

        

        
        

		if(isset($_POST["login_submit"])){
            $token = "daylatokencuibap";

            if(isset($_COOKIE['token'])){
                $token = $_COOKIE['token'];
            }

			$email = $_POST["email_log"];
            $origin_password = $_POST["password_log"];
            
            $flag = true;

            $log_query = "SELECT * FROM employee WHERE email = '$email'";
            $log_rows = mysqli_query($connect,$log_query);
            $log_count = mysqli_num_rows($log_rows);

            if($log_count >=1){
               
            }else{
                $flag = false;
                $msg = 'Email không tồn tại';
            }
            if(strlen($email) == 0){
                $flag = false;
                $msg = 'Không được để email trống !';
            }

            if($flag == false){
                phpAlert($msg);
                goto not_log;
            }

			$password = md5($_POST["password_log"]);
			$query = "select * from employee where (email = '$email' and password = '$password') or token = '$token'";
			$rows = mysqli_query($connect,$query);
			$count = mysqli_num_rows($rows);
            
			if($count >= 1){
				$_SESSION["loged"] = 'true';
                $_SESSION["email"] = $email;
				$token = $email . $password;
                $data = mysqli_fetch_array($rows);
                $_SESSION["level_id"] = $data['level_id'];
                $_SESSION["id"] = $data['id'];
                $_SESSION["name"] = $data['name'];
				if(isset($_POST['remember_me'])){
					if($_POST['remember_me'] == 'on' && !empty($origin_password))
					    setcookie('token', "$token", time()+60*60*24,'/','',0);
				}
				header("location:index.php");
				setcookie("login_status", "Đăng nhập thành công!", time()+1, "/","", 0);
			}
			else{
				header("location:login.php");
				setcookie("login_status", "Đăng nhập không thành công!", time()+1, "/","", 0);
			}

            not_log:
			
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

            <label for="email">Email</label>
            <input name="email_log" id="email" type="email" placeholder="Email" value="
            <?php 
                if(isset($_SESSION["email"])){
                     echo $_SESSION["email"];
                }
            ?>" autocomplete="off">

            <label for="password">Password</label>
            <input name="password_log" id="password" type="password" placeholder="Password" autocomplete="off">

            <label for="remember_me">Remember me <input id="remember" name="remember_me" type="checkbox"></label>

            <br>
            <br>

            <input name="login_submit" class="login-submit" type="submit" value="Submit" onclick="return loginValidate()">
            
        </form>
        <p class="forgot-password">Quên mật khẩu ? <b><a href="forgot_password.php"> Đặt lại mật khẩu</a></b></p>
    </div>
    
</body>
<script src="./JS/loginValidate.js"></script>
</html>