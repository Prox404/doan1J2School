<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css?v=2.1">
</head>
<body>
    <?php 
    
        if(!isset($connect)){
            require_once 'connect.php';
        }

        $user_id = $_SESSION['id'];

        $query = "SELECT * FROM customer WHERE id = '$user_id'";

        $result = mysqli_query($connect, $query);
        $customer = mysqli_fetch_array($result);

        // print_r($query);
        // die();
    ?>
    <div class="content_container">
        <form action="" method="post">
            <label for="address">Address</label>
            <input name="address" id="address" type="text" value="<?= $customer['address'] ?>">
            <label for="name">Tên người nhận</label>
            <input name="name" id="name" type="text" value="<?= $customer['name'] ?>">
            <label for="phone">Sdt người nhận</label>
            <input name="phone" id="phone" type="text" value="<?= $customer['phone'] ?>">
            <label for="note">Note</label>
            <input name="note" id="note" type="text"><br>
            <input type="submit" onclick="return confirm('Bạn muốn đặt hàng ?');" name="submit_order" value="Đặt hàng">
        </form>
    </div>
   <?php include './cart/process_order.php'; ?>
</body>
</html>