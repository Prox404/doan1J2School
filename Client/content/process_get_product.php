<?php
// get manufacturer
$manufacturer_query = "SELECT * FROM manufacturer";
$manufacturer_result = mysqli_query($connect, $manufacturer_query);
// get type product
$type_query = "SELECT * FROM type";
$type_result = mysqli_query($connect, $type_query);
$query = "SELECT * FROM product";
$result = mysqli_query($connect, $query);
?>