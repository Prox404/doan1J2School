<!DOCTYPE html>
<html lang="vi">

</html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script type="text/javascript" src="./js/main.js"></script>
</head>

<body style="background-color: #FBF6F0;">
    <?php
    include 'check_login.php';
    // define variables and set to empty values
    $name = $email = $password = $re_password = "";
    $nameErr = $emailErr = $passwordErr = $re_passwordErr = "";

    // Input field validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // String validation
        if (empty($_POST["name"])) {
            $nameErr = "Tên không được để trống";
        } else {
            $name = test_input($_POST["name"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Tên chỉ được chứa chữ cái và khoảng trắng";
            }
        }

        if (empty($_POST["email"])) {
            $emailErr = "Email không được để trống";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email không hợp lệ";
            }
        }

        if (empty($_POST["password"])) {
            $passwordErr = "Mật khẩu không được để trống";
        } else {
            $password = test_input($_POST["password"]);
            // check if password only contains letters and numbers
            if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
                $passwordErr = "Mật khẩu chỉ được chứa chữ cái và số";
            }
        }

        if (empty($_POST["re-password"])) {
            $re_passwordErr = "Nhập lại mật khẩu không được để trống";
        } else {
            $re_password = test_input($_POST["re-password"]);
            // check if password only contains letters and numbers
            if (!preg_match("/^[a-zA-Z0-9]*$/", $re_password)) {
                $re_passwordErr = "Nhập lại mật khẩu chỉ được chứa chữ cái và số";
            }
        }

        // Check if password and re-password are the same
        if ($password != $re_password) {
            $re_passwordErr = "Mật khẩu không trùng khớp";
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } ?>
    <div id="container">
        <?php include 'header.php'; ?>
        <div class="signup">
            <div class="login-form">
                <img src="https://i.ibb.co/6bZRxw4/P-ogrange.png" alt="" class="login-logo" />
                <h1 class="login-title"> Welcome</h1>
                <h1 class="login-title orange"> Prox Shopping Services</h1>
                <form method="POST" class="signUp" id="signUp" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                    <label for="name">Tên:</label>
                    <input type="text" name="name" id="name" placeholder="Họ và tên" />
                    <span class="error"><?php echo $nameErr; ?></span>

                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email" />
                    <span class="error"><?php echo $emailErr; ?></span>

                    <label for="pass">Mật khẩu:</label>
                    <input type="password" name="password" id="password" placeholder="Mật khẩu" />
                    <span class="error"><?php echo $passwordErr; ?></span>


                    <label for="re-pass">Nhập lại mật khẩu:</label>
                    <input type="password" name="re-password" id="re-password" placeholder="Nhập lại mật khẩu" />
                    <span class="error"><?php echo $re_passwordErr; ?></span>
                    <br>

                    <input type="submit" name="signup" id="signup" class="form-submit" value="Đăng ký" />

                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['signup'])) {
        if ($nameErr == "" && $emailErr == "" && $passwordErr == "" && $re_passwordErr == "") {
            include 'process_signup.php';
        }
    }
    ?>
</body>