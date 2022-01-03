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
        <div class="signup">
            <div class="signup-form">
                <h2 class="form-title">Đăng ký</h2>
                <form method="POST" class="register-form" id="register-form" action="process_signup.php">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" name="name" id="name" placeholder="Họ và tên" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Email" />
                    </div>
                    <div class="form-group">
                        <label for="pass">Mật khẩu:</label>
                        <input type="password" name="password" id="password" placeholder="Mật khẩu" />
                    </div>
                    <div class="form-group">
                        <label for="re-pass">Nhập lại mật khẩu:</label>
                        <input type="password" name="re-password" id="re-password" placeholder="Nhập lại mật khẩu" />
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Đăng ký" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>