
<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!isset($connect)) {
        require_once 'connect.php';
    }
    $total = 0;
    include './cart/cart_content_set.php';
    ?>

    <div class="content_container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Ảnh</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Sớ lượng</th>
                    <th>Còn lại</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                } else {
                    echo '<tr>
                            <td colspan="8"><b>Cart empty!</b></td>
                        </tr>';
                    die();
                }
                ?>


                <?php foreach ($cart as $id => $cart_item) { ?>
                    <tr>

                        <td>
                            <img src="../Admin/photos/<?= $cart_item['cart_image'] ?>" width="100px" style="border-radius: 5px;">
                        </td>
                        <td>
                            <?= $cart_item['product_id'] ?>

                        </td>
                        <td>
                            <?= $cart_item['cart_name'] ?>
                        </td>
                        <td>
                            <div class="bubble"><a style="color: #fff;" href="?sub=<?= $cart_item['product_id'] ?>">-</a></div>
                            <?= $cart_item['cart_quantity'] ?>
                            <div class="bubble"><a style="color: #fff;" href="?add=<?= $cart_item['product_id'] ?>">+</a></div>
                        </td>
                        <td>
                            <?= $cart_item['cart_available_quantity'] ?>
                        </td>
                        <td>
                            <?= $cart_item['cart_cost'] ?>
                        </td>
                        <td>
                            <?php echo $cart_item['cart_cost'] * $cart_item['cart_quantity'];
                            $total += $cart_item['cart_cost']  * $cart_item['cart_quantity']; ?>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn muốn xóa <?= $cart_item['cart_name'] ?> ra khỏi giỏ hàng ?')" href="?deleteItem=<?= $cart_item['product_id'] ?>" class="link-button green">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td> <b>Tổng tiền</b> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td> <b> <?= $total ?></b></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <a onclick="return confirm('Xóa tất cả ở trong giỏ hàng ?');" class="link-button" href="?clearCart=true">Xóa tất cả</a>
        <a class="link-button" href="order.php">Đặt hàng</a>
    </div>

</body>

</html>