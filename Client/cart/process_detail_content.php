<?php
    if (!isset($connect)) {
        require_once 'connect.php';
    }
    $page = 1;
    if (!isset($_GET['bill_detail'])) {
        header('location:order_status.php');
    }

    $id = $_GET['bill_detail'];

    $query = "SELECT * FROM bill as t1 
            JOIN (
                SELECT bill_detail.*,product.name,product.image,product.cost,product.cost * bill_detail.quantity as total
                FROM bill_detail 
                JOIN product 
                ON bill_detail.product_id = product.id
            ) as t2 
            ON t1.id = t2.bill_id
            WHERE id = $id";

    $result = mysqli_query($connect, $query);
?>