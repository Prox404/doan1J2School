
<!DOCTYPE html>
<html lang="vi"></html>   
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="./css/main.css"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
    <script src="./js/notify.min.js"></script>
</head>
<body>
    <div id="container">
        <?php require_once './root/check_login.php'; ?>
        <?php include './root/header.php'; ?>
        <div id="space">
        </div>
        <?php include './cart/order_status_content.php'; ?>
        <div id="space">
        </div>
        <?php include './root/footer.php'; ?>
    </div>
</body>