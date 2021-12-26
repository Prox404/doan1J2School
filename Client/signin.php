<!DOCTYPE html>
<html lang="vi">

</html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/styles.css">
    </style>
</head>

<body>
    <div id="container">
        <?php include 'header.php'; ?>
        <div class="signin">
            <div class="signin-form">
                <h2 class="form-title">Đăng nhập</h2>
                <form method="POST" class="login-form" id="login-form" action="process_signin.php">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label for="pass">Mật khẩu:</label>
                        <input type="password" name="pass" id="pass" placeholder="Mật khẩu" />
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>