<?php 
    if(!isset($connect)){
        require_once '../root/connect.php';
    }
    if (isset($_GET['user_id'])){
        $id = $_GET['user_id'];
    }else{
        echo 'Không có kết quả';
        goto end_file;
    }

    $query = "SELECT customer.name, customer.email, customer.phone, bill.time_order, bill.recipient_name, bill.customer_address, product.name as product_name, product.cost, bill_detail.quantity, product.cost * bill_detail.quantity as total FROM bill JOIN bill_detail on bill.id = bill_detail.bill_id JOIN product ON bill_detail.product_id = product.id JOIN customer on bill.customer_id = customer.id WHERE customer_id = '$id' and (status = 2 or status = 3) ORDER BY time_order DESC LIMIT 50";
    $result = mysqli_query($connect, $query);
    foreach ($result as $user) {
         echo "<tr>
         <td>" . $user['name'] . "</td>
         <td>" . $user['email'] . "</td>
         <td>" . $user['phone'] . "</td>
         <td>" . $user['time_order'] . "</td>
         <td>" . $user['recipient_name'] . "</td>
         <td>" . $user['customer_address'] . "</td>
         <td>" . $user['product_name'] . "</td>
         <td>" . number_format( $user['cost']  , 0, '', '.') . "</td>
         <td>" . $user['quantity'] . "</td>
         <td>" . number_format($user['total']  , 0, '', '.')  . "</td>
       </tr> ";
        
    }
    end_file:
?>
