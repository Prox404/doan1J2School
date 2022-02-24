
<?php
require_once 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product_query = "SELECT product.*,manufacturer.name as manufacturer_name FROM (product 
            join manufacturer on manufacturer_id = manufacturer.id)
            where product.id = '$id'";
    $product_result = mysqli_query($connect, $product_query);
    $product = mysqli_fetch_array($product_result);
    if (mysqli_num_rows($product_result) == 0) {
        header("location:index.php");
    }
} else {
    header("location:index.php");
}

?>