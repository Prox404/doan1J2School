
<!DOCTYPE html>
<html lang="vi"></html>   
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
    <?php require_once './root/check_login.php' ?>
    <div id="container">
        <?php include 'header.php'; ?>
        <div id="space">
        </div>
        <?php include './cart/cart_content.php'; ?>
        <div id="space">
        </div>
        <?php include 'footer.php'; ?>
    </div>
</body>