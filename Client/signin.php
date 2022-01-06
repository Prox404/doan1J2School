<!DOCTYPE html>
<html lang="vi">

</html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="./css/main.css?v=2.2">
    <link rel="stylesheet" href="./css/styles.css">
    </style>
</head>

<body style="background-color: #FBF6F0;">
    <div id="container">
        <?php include 'header.php'; ?>
        <?php 
            if(isset($_SESSION['loggedin'])){
                header('location: index.php');
            }
        ?>
        <div class="signin">
            <div class="login-form">
                <img
                    src="https://i.ibb.co/6bZRxw4/P-ogrange.png"
                    alt=""
                    class="login-logo"
                />
                <h1 class="login-title"> Welcome</h1>
                <h1 class="login-title orange"> Prox Shopping Services</h1>
                <form method="POST" id="login-form" action="process_signin.php">

                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Email" />

                        <label for="pass">Mật khẩu:</label>
                        <input type="password" name="password" id="pass" placeholder="Mật khẩu" />
                        <br>
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập" />

                </form>
            </div>
        </div>
    </div>
</body>