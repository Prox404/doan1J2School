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
        <?php
        if (!isset($_SESSION['loggedin'])) {
            header('location:index.php');
        }
        ?>
        <?php include 'get_user_info.php'; ?>
        <div class="profile-account">
            <div class="profile-account-form">
                <h2 class="form-title">Thông tin tài khoản</h2>
                <form method="POST" class="profile-form" id="profile-form" action="process_profile.php">
                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" name="name" id="name" placeholder="Họ và tên" value="<?php $user_info['name'] ?>" />
                    </div>
                    <?php if ($user_info['gender'] == 0) { ?>
                        <div class="form-group">
                            <lable for="gender">Giới tính:</lable>
                            <input type="radio" name="gender" id="gender" value="1" />Nam
                            <input checked="checked" type="radio" name="gender" id="gender" value="0" />Nữ
                        </div>
                    <?php } elseif ($user_info['gender'] == 1) { ?>
                        <div class="form-group">
                            <lable for="gender">Giới tính:</lable>
                            <input checked="checked" type="radio" name="gender" id="gender" value="1" />Nam
                            <input type="radio" name="gender" id="gender" value="0" />Nữ
                        </div>
                    <?php } ?>
                    <div class="form-group">
                        <label for="day-of-birth">Ngày sinh:</label>
                        <input type="date" name="dob" id="dob" value="<?php $user_info['dob'] ?>" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <?php $user_info['email'] ?>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" name="phone" id="phone" placeholder="Số điện thoại" value=" <?php $user_info['phone']?>" />
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" name="address" id="address" placeholder="Địa chỉ" value="<?php $user_info['address'] ?>" />
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