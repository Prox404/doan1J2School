<?php 
    
    if(isset($_POST['submit_order'])){
        $address = filter_var($_POST['address'],FILTER_SANITIZE_STRING);
        $name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
        $note = filter_var($_POST['note'],FILTER_SANITIZE_STRING);

        $add_bill = "INSERT INTO bill(customer_id, time_order, recipient_name, customer_phone, customer_address, note, status) VALUES ($user_id,CURRENT_TIMESTAMP, '$name', '$phone', '$address', '$note', 1)";
        mysqli_query($connect, $add_bill);

        $get_bill_id = "SELECT * FROM `bill` WHERE customer_id = '$user_id' ORDER BY id DESC LIMIT 1";
        $bill_id_array = mysqli_query($connect, $get_bill_id);
        $bill_id = mysqli_fetch_array($bill_id_array);
        $bill_id_value = $bill_id['id'];
        $cart = $_SESSION['cart'];
    
        foreach($cart as $id => $bill_value ){
            $product_id = $bill_value['product_id'];
            $quantity = $bill_value['cart_quantity'];
            $add_bill_detail = "INSERT INTO bill_detail (bill_id, product_id, quantity) VALUES ($bill_id_value, $product_id, $quantity)";
            mysqli_query($connect, $add_bill_detail);
            $new_sold =  (int)$bill_value['sold'] + $quantity;
            $new_quantity = (int)$bill_value['cart_available_quantity'] - $quantity;
            $update_quantity = "UPDATE product SET quantity = $new_quantity, sold = $new_sold WHERE id = '$product_id'";
            mysqli_query($connect, $update_quantity);
        }
        unset($_SESSION['cart']);
        unset($_SESSION['number_item']);
        header("location:order_status.php");
    }
?>