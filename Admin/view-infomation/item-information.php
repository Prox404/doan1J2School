<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sản phẩm</title>
    <link rel="stylesheet" href="../CSS/style.css?v=2.7">
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <?php
    require_once '../root/checkLogin.php';
    require_once '../root/alert.php';
    if (!isset($connect)) {
        require_once '../root/connect.php';
    }
    ?>

    <?php
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $sold_query = "SELECT sold FROM product WHERE id = $id";
        $sold_array = mysqli_query($connect, $sold_query);
        if (mysqli_num_rows($sold_array) == 0) {
            phpAlert('Không tồn tại mặt hàng này');
            goto end_file;
        }
        $sold_result = mysqli_fetch_array($sold_array);
        $sold_value = $sold_result['sold'];
        if ($sold_value == 0) {
            $delete = "DELETE FROM product WHERE id = '$id'";
            require_once '../auto_update_image.php';
            header('location: ../product.php');
        } else {
            phpAlert('Không thể xóa: Hàng đã được bán');
        }
        end_file:
    }

    ?>

    <?php


    $id = $_GET['id'];
    $product_query = "SELECT product.*,manufacturer.name as manufacturer_name, AVG(rate_product.rating) as rate FROM (product join manufacturer on manufacturer_id = manufacturer.id) join rate_product on product.id = rate_product.product_id where product.id = '$id'";
    $product_result = mysqli_query($connect, $product_query);
    $product = mysqli_fetch_array($product_result);
    if (is_null($product['id'])) {
        header('location:../not_found.php');
    }
    ?>

    <div class="grid-container">
        <div class="container-header">
            <?php require_once "../root/navbar.php"; ?>
        </div>
        <div class="container-menu">
            <?php require_once "../root/sidebar_folder.php"; ?>
        </div>
        <div class="container-main">
            <h1 class="main-title">Thông tin mặt hàng</h1>

            <div class="content-container">
                <div class="item-infomation">
                    <img class="item-picture" src="../photos/<?php echo $product['image'] ?>" alt="">
                    <div class="infor">
                        <p class="item-name"><?php echo $product['name'] ?></p>

                        <p align="right"><span>
                                <?php
                                if ($product['rate'] == 0) {
                                    echo 'Chưa có đánh giá';
                                } else {
                                    echo round($product['rate'], 1) . "/5<span class='fa fa-star checked'></span> ";
                                }
                                ?>
                            </span></p>
                        <p class="item-cost">Giá: ₫<?php echo number_format($product['cost'], 0, '', ','); ?></p>
                        <p class="ship-cost">Đã bán: <?= $product['sold'] ?></p>
                        <p class="number-of-item">Còn <?php echo $product['quantity'] ?></p>
                        <div class="space-between">
                            <a class="link-button" href="../edit/edit_product.php?id=<?php echo $product['id']; ?>"><i class="fas fa-edit"></i>Sửa</a>
                            <a class="link-button" href="?id=<?php echo $id; ?>&delete=<?php echo $product['id']; ?>" onclick="return confirm('Bạn muốn xóa sản phẩm?');"><i class="fas fa-trash"></i>Xóa</a>
                        </div>
                    </div>
                </div>

                <h1 class="title">Nhà sản xuất</h1>

                <div class="shop-information">
                    <p> <?php echo $product['manufacturer_name'] ?></p>
                </div>

                <h1 class="title">Mô tả</h1>
                <p>
                    <?php echo nl2br($product['description']);  ?>
                </p>
            </div>

            <div class="year-activity chart-box">
                <div class="year-activity-item">

                    <h1 class="title" style="margin: 5px 0px 5px 0px; font-size: 17px;">Lượng mua trong tháng</h1>


                    <div class="chart-data">
                        <?php

                        function is_leap_year($year)
                        {
                            $x = false;
                            if ($year % 4 == 0) {
                                if ($year % 100 == 0) {
                                    if ($year % 400 == 0) {
                                        $x = true;
                                    }
                                } else {
                                    $x = true;
                                }
                            }
                            return $x;
                        }
                        $month = date('m');
                        $year = date("Y");

                        if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) {
                            $day = 31;
                        } else if ($month == 4 || $month == 6 || $month == 9 || $month == 11) {
                            $day = 30;
                        } else if ($month == 2) {
                            if (is_leap_year($year) == true) {
                                $day = 29;
                            } else {
                                $day = 28;
                            }
                        }

                        for ($i = 1; $i <= $day; $i++) {
                            $month_data_query = "SELECT IFNULL(COUNT(quantity),0) AS quantity from bill_detail JOIN bill ON bill_detail.bill_id = bill.id WHERE DAY(time_order) = '$i' and bill_detail.product_id = '$id' AND status = 2 and month(time_order) = '$month' and year(time_order) = '$year'";
                            $month_data_array = mysqli_query($connect, $month_data_query);
                            $month_data_result = mysqli_fetch_array($month_data_array);
                            $month_data_value = $month_data_result['quantity'];
                            echo '<p class="month-data">' . $month_data_value . '</p>';
                        }
                        ?>
                    </div>
                    <canvas id="yearChart"></canvas>
                </div>
            </div>


            <?php
            $load_comment = "SELECT rate_product.*,customer.name FROM rate_product JOIN customer ON rate_product.customer_id = customer.id WHERE product_id = '$id'";
            $comment_result = mysqli_query($connect, $load_comment);

            ?>

            <?php foreach ($comment_result as $product_comment) { ?>
                <div class="add-new-item comment-box">
                    <img class="comment_avt" src="https://i.ibb.co/gjYSPt9/97387265-911934715945271-6195268394929881088-o.jpg" alt="">
                    <div style="width: 100%">
                        <div class="head-comment">
                            <div class="left-head">
                                <p><?= $product_comment['name'] ?></p>
                            </div>
                            <div class="right-head">

                                <?php
                                $rating = $product_comment['rating'];
                                for ($i = 1; $i <= $rating; $i++) {
                                    echo '
                                                <span class="fa fa-star checked"></span>
                                            ';
                                }
                                for ($i = 1; $i <= 5 - $rating; $i++) {
                                    echo '
                                                <span class="fa fa-star"></span>
                                            ';
                                }
                                ?>
                                <p></p>
                            </div>
                        </div>

                        <div class="comment-content">
                            <p><?php echo nl2br($product_comment['comment']);  ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>


            
        </div>
        <div class="container-footer">
            <?php require_once "../root/footer.php"; ?>
        </div>
    </div>

    <?php
    mysqli_close($connect);
    ?>

</body>
<script>
    const d = new Date();
    let dayOfMonth = 0;
    let month = d.getMonth() +1;
    let year = d.getFullYear();
    let day_arr = [];

    function is_leap_year(year) {
        let x = false;
        if (year % 4 == 0) {
            if (year % 100 == 0) {
                if (year % 400 == 0) {
                    x = true;
                }
            } else {
                x = true;
            }
        }
        return x;
    }

    if (month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12) {
        dayOfMonth = 31;
    } else if (month == 4 || month == 6 || month == 9 || month == 11) {
        dayOfMonth = 30;
    } else if (month == 2) {
        if (is_leap_year(year)) {
            dayOfMonth = 29;
        } else {
            dayOfMonth = 28;
        }
    }

    let number_array = document.getElementsByClassName('month-data');
    let chartData = [];
    for (i = 0; i < dayOfMonth; i++) {
        let value = number_array[i].textContent;
        chartData.push(value);
        day_arr[i] = i+1;
    }
</script>
<script>
    const ctx = document.getElementById('yearChart');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: day_arr,
            datasets: [{
                label: '',
                data: chartData,
                fill: false,
                borderColor: 'rgba(255, 159, 64, 1)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
<script src="../JS/validateform.js"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>

</html>