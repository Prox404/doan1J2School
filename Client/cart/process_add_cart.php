<?php
if (isset($_GET['addCart'])) {
            $id = $_GET['addCart'];

            $prouct_query = "SELECT * FROM product WHERE id = '$id'";
            
            $product_result = mysqli_query($connect, $prouct_query);
            if(mysqli_num_rows($product_result) == 0){
                phpAlert('Không có sản phẩm này');
                goto end_file;
            }
            $product_value = mysqli_fetch_array($product_result);


            if (empty($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['product_id'] = $id;
                $_SESSION['cart'][$id]['cart_quantity'] = 0;
                $_SESSION['cart'][$id]['cart_available_quantity'] = $product_value['quantity'];
                $_SESSION['cart'][$id]['cart_image'] = $product_value['image'];
                $_SESSION['cart'][$id]['cart_name'] = $product_value['name'];
                $_SESSION['cart'][$id]['cart_cost'] = $product_value['cost'];
                $_SESSION['cart'][$id]['sold'] = $product_value['sold'];
                $_SESSION['number_item'] += 1;
                header("Refresh:0");
            } else {
                $_SESSION['cart'][$id]['cart_quantity'] += 1;
            }
            end_file:
}
