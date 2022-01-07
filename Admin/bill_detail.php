<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/style.css?v=4.3">
</head>
<body>

        <?php 
            require_once 'checkLogin.php';
        ?>
        

        <?php 
            if(!isset($connect)){
                require_once 'connect.php';
            }

            if(!isset($_GET['bill_detail'])){
                header('location:bill.php'); 
            }

            $id = $_GET['bill_detail'];
            
            $query = "SELECT * FROM bill as t1 
            JOIN (
                SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total
                FROM bill_detail 
                JOIN product 
                ON bill_detail.product_id = product.id
            ) as t2 
            ON t1.id = t2.bill_id
            WHERE id = $id";

            $result = mysqli_query($connect, $query);

        ?> 

        <div class="grid-container">
            <div class="container-header">
                <?php require_once "./root/navbar.php"; ?>
            </div>
            <div class="container-menu">
                <?php require_once "./root/sidebar.php"; ?>
            </div>
            <div class="container-main">
                <h1 class="main-title">Chi tiết đơn hàng</h1>
                    
                <div class="add-new-item">

                    <table class="styled-table">
                        <thead>
                            <tr>

                                <th>ID</th>
                                <th>Tên người nhận</th>
                                <th>Thời gian đặt hàng</th>
                                <th>Sđt người nhận</th>
                                <th>Địa chỉ</th>
                                <th>Note</th>
                                <th>Số lượng</th>
                                <th>Tên mặt hàng</th>
                                <th>Gía mặt hàng</th>
                                <th>Tổng cộng</th>
                                
                            </tr>
                        </thead>
                        <tbody>

                            <?php $total = 0; foreach($result as $bill){ ?>
                                <tr>
                                    <td><?php echo $bill['id'] ?></td>
                                    <td><?php echo $bill['recipient_name'] ?></td>
                                    <td><?php echo $bill['time_order'] ?></td>
                                    <td><?php echo $bill['customer_phone'] ?></td>
                                    <td><?php echo $bill['customer_address'] ?></td>
                                    <td><?php echo $bill['note'] ?></td>
                                    <td><?php echo $bill['quantity'] ?></td>
                                    <td><?php echo $bill['name'] ?></td>
                                    <td><?php echo $bill['cost'] ?></td>
                                    <td><?php echo $bill['total'] ?></td>
                                    <?php $total += $bill['total']; ?>
                                    
                                </tr>
                            <?php } ?>

                            <tr>
                                <td>
                                   <b>Tổng cộng:</b> 
                                </td>

                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            
                                <td><b><?php echo $total; ?></b></td>
                            </tr>

                        </tbody>
                    </table>
                </div> 
                
            </div>  

            <?php mysqli_close($connect);?>
            <div class="container-footer">
                <?php require_once "./root/footer.php"; ?>
            </div>
        </div>

</body>
<script src="./JS/validateform.js?v=2.3"></script>
<script src="./JS/selectOption.js?v=2"></script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
</html>