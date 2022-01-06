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
    <?php
    include 'check_login.php';
    // define variables and set to empty values
    $email = $password = "";
    $emailErr = $passwordErr = "";

    // Input field validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // String validation
        if (empty($_POST["email"])) {
            $emailErr = "Email không được để trống";
        } else {
            $email = test_input($_POST["email"]);
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Email không hợp lệ";
            }
        }
        // Password validation
        if (empty($_POST["password"])) {
            $passwordErr = "Mật khẩu không được để trống";
        } else {
            $password = test_input($_POST["password"]);
            // check if password only contains letters and numbers
            if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
                $passwordErr = "Mật khẩu chỉ được chứa chữ cái và số";
            }
        }
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    ?>
    <div id="container">
        <?php include 'header.php'; ?>
        <div class="signin">
            <div class="login-form">
                <img src="https://i.ibb.co/6bZRxw4/P-ogrange.png" alt="" class="login-logo" />
                <h1 class="login-title"> Welcome</h1>
                <h1 class="login-title orange"> Prox Shopping Services</h1>
                <form method="POST" id="signIn" class="signIn" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email" />
                    <span class="error"><?php echo $emailErr; ?></span>
                    <label for="pass">Mật khẩu:</label>
                    <input type="password" name="password" id="pass" placeholder="Mật khẩu" />
                    <span class="error"><?php echo $passwordErr; ?></span>
                    <br>
                    <input type="submit" name="signin" id="signin" class="form-submit" value="Đăng nhập" />
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['signin'])){
        if ($emailErr == "" && $passwordErr == ""){
            include 'process_signin.php';
        }
    }
    ?>
</body>