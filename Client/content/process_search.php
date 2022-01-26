<?php
// search product
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $search_query = "SELECT * FROM product WHERE name LIKE '%$search%'";
    $search_result = mysqli_query($connect, $search_query);
}
?>
