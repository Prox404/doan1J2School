<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css?v=2.3">
</head>

<body>
    <?php

    if (!isset($_SESSION['loggedin'])) {
        header('location:index.php');
    }
    if (!isset($connect)) {
        require_once 'connect.php';
    }

    $page = 1;
    $user_id = $_SESSION['id'];





    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }

    $number_of_post_query = "SELECT count(*) FROM bill WHERE customer_id = '$user_id'";

    $post_array = mysqli_query($connect, $number_of_post_query);
    $result_array = mysqli_fetch_array($post_array);
    $number_of_post = $result_array['count(*)'];
    $number_post_per_page = 5;
    $number_of_page = ceil($number_of_post / $number_post_per_page);
    $number_of_skip_page = $number_post_per_page * ($page - 1);

    $querry = "SELECT * FROM bill WHERE customer_id = '$user_id' ORDER BY id DESC LIMIT $number_post_per_page OFFSET $number_of_skip_page ";
    $result = mysqli_query($connect, $querry);

    ?>


    <div class="content_container">
        <table class="styled-table">
            <thead>
                <tr>

                    <th>ID</th>
                    <th>Tên người nhận</th>
                    <th>Sđt người nhận</th>
                    <th>Địa chỉ</th>
                    <th>Tình trạng đơn</th>

                </tr>
            </thead>
            <tbody>

                <?php foreach ($result as $bill) { ?>
                    <tr>
                        <td><a href="bill_detail.php?bill_detail=<?php echo $bill['id'] ?>"><?php echo $bill['id'] ?></a></td>
                        <td><a href="bill_detail.php?bill_detail=<?php echo $bill['id'] ?>"><?php echo $bill['recipient_name'] ?></a></td>
                        <td><a href="bill_detail.php?bill_detail=<?php echo $bill['id'] ?>"><?php echo $bill['customer_phone'] ?></a></td>
                        <td><a href="bill_detail.php?bill_detail=<?php echo $bill['id'] ?>"><?php echo $bill['customer_address'] ?></a></td>
                        <td><a href="bill_detail.php?bill_detail=<?php echo $bill['id'] ?>">
                                <?php
                                if ($bill['status'] == 1) {
                                    echo "Chờ duyệt đơn";
                                } else if ($bill['status'] == 2) {
                                    echo "Đã duyệt đơn";
                                } else if ($bill['status'] == 3) {
                                    echo "Đã hủy đơn";
                                }
                                ?>
                            </a>
                        </td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>
        <div class="page_number_list">
            <?php for ($i = 1; $i <= $number_of_page; $i++) { ?>
                <div class="page_number">
                    <a href="?page=<?php echo $i; ?>">
                        <?php echo $i; ?>
                    </a>
                </div>

            <?php } ?>
        </div>
    </div>




</body>

</html>