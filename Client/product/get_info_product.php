
<?php
require_once 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("location:index.php");
}

$product_query = "SELECT product.*,manufacturer.name as manufacturer_name  FROM (product 
            join manufacturer on manufacturer_id = manufacturer.id)
            where product.id = '$id'";
$product_result = mysqli_query($connect, $product_query);
$product = mysqli_fetch_array($product_result);
?>