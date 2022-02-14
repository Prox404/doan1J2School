
<body>
    <?php include './cart/product_detail_content.php'; ?>
    <div class="content_container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Ảnh</th>
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

                <?php $total = 0;
                foreach ($result as $bill) { ?>
                    <tr>
                        <td><img src="../Admin/photos/<?php echo $bill['image'] ?>" width="100px" style="border-radius: 5px;"></td>
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




</body>

</html>