<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./CSS/style.css?v=2">
</head>
<body style="background-color: #FBF6F0;">
    <div class="login-form">
        <img
                src="https://i.ibb.co/6bZRxw4/P-ogrange.png"
                alt=""
                class="login-logo"
        />
        <h1 class="login-title">Welcome</h1>
        <h1 class="login-title orange">Prox Shopping Services</h1>
        <form action="" method="post">

            <label for="username">Name</label>
            <input name="username_log" id="username" type="text" placeholder="User name" autocomplete="off">

            <label for="password">Password</label>
            <input name="password_log" id="password" type="password" placeholder="Password" autocomplete="off">

            <label for="remember_me">Remember me <input id="remember" name="remember_me" type="checkbox"></label>

            <br>
            <br>
            <br>

            <input name="login_submit" class="login-submit" type="submit" value="Submit" onclick="return loginValidate()">

        </form>
    </div>

    <?php 
        if(isset($_POST['login_submit'])){
            $tk = filter_var($_POST['username_log'],FILTER_SANITIZE_STRING);
            $mk = md5(filter_var($_POST['password_log'],FILTER_SANITIZE_STRING));
        }
    ?>
    
</body>
<script src="./JS/loginValidate.js"></script>
</html>