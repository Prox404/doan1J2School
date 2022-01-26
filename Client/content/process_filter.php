<?php
// filter product
$filter_manufacturer = "";
$filter_type = "";
$start_price = $end_price = "";
if (isset($_GET['filter-submit'])) {
    $filter_query = "SELECT product.*, manufacturer.name as manufacturer_name, type.name as type_name FROM (product join manufacturer on manufacturer_id = manufacturer.id) join type on type_id = type.id  WHERE ";
    // filter manufacturer
    if (isset($_GET['filter-manufacturer']) && $_GET['filter-manufacturer'] != "") {
        $filter_manufacturer = $_GET['filter-manufacturer'];
        $filter_query .= "manufacturer_id = $filter_manufacturer";
    } 
    
    // filter type
    if (isset($_GET['filter-type']) && $_GET['filter-type'] != "") {
        $filter_type = $_GET['filter-type'];
        if (isset($_GET['filter-manufacturer']) && $_GET['filter-manufacturer'] != "") {
            $filter_query .= " AND ";
        }
        $filter_query .= "type_id = $filter_type";
    } 

    // filter price
    if (isset($_GET['start-price']) && $_GET['start-price'] != "" && isset($_GET['end-price']) && $_GET['end-price'] != "") {
        $start_price = $_GET['start-price'];
        $end_price = $_GET['end-price'];
        if (isset($_GET['filter-manufacturer']) && $_GET['filter-manufacturer'] != "" || isset($_GET['filter-type']) && $_GET['filter-type'] != "") {
            $filter_query .= " AND ";
        }
        $filter_query .= "cost BETWEEN $start_price AND $end_price";
    }

    if ($_GET['filter-manufacturer'] == "" && $_GET['filter-type'] == "" && ($_GET['start-price'] == "" || $_GET['end-price'] == "")) {
        $filter_query = "SELECT product.*,
         manufacturer.name as manufacturer_name, type.name as type_name FROM (product join manufacturer on manufacturer_id = manufacturer.id) join type on type_id = type.id";
    }

    $filter_result = mysqli_query($connect, $filter_query);
}

?>