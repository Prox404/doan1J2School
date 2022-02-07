<!DOCTYPE html>
<html lang="vi">

</html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    </style>
</head>

<body>
    <div id="container">
        <?php require_once 'check_login.php'; ?>
        <?php include 'header.php'; ?>
        <?php include 'get_user_info.php'; ?>
        <div class="profile-account">
            <div class="profile-account-form">
                <h2 class="form-title">Thông tin tài khoản</h2>
                <form method="POST" class="profile-form" id="profile-form" action="process_profile.php">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" name="name" id="name" placeholder="Họ và tên" value="<?php echo $name; ?>">
                    <?php if ($gender == 0) { ?>
                        <div class="form-group">
                            <lable for="gender">Giới tính:</lable>
                            <input type="radio" name="gender" id="gender" value="1" />Nam
                            <input checked="checked" type="radio" name="gender" id="gender" value="0" />Nữ
                        </div>
                    <?php } elseif ($gender == 1) { ?>
                        <div class="form-group">
                            <lable for="gender">Giới tính:</lable>
                            <input checked="checked" type="radio" name="gender" id="gender" value="1" />Nam
                            <input type="radio" name="gender" id="gender" value="0" />Nữ
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="day-of-birth">Ngày sinh:</label>
                        <input type="date" name="dob" id="dob" value="<?php echo $dob; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <?php echo $email ?>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" name="phone" id="phone" placeholder="Số điện thoại" value=" <?php echo $phone?>" />
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" name="address" id="address" placeholder="Địa chỉ" value="<?php echo $address ?>" />
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="profile" id="profile" class="form-submit" value="Cập nhật" />
                    </div>
                    <div class="form-group form-button">
                        <a href="delete_account.php" class="form-submit">Xóa tài khoản</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>