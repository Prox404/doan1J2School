<?php

if(!isset($connect)){
    require_once '../root/connect.php';
}

$year = date("Y");

if (!empty($_GET['year'])) {
  $year = $_GET['year'];
}

$query1Year = "SELECT * FROM bill WHERE YEAR(bill.time_order) = $year";
$totalOfYear = "SELECT IFNULL(SUM(total), 0) as total_year FROM bill as t1 
JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail 
JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id 
WHERE YEAR(t1.time_order) = $year AND t1.status = 2";

$totalOfYearValueArray = mysqli_query($connect, $totalOfYear);
$totalOfYearValue = mysqli_fetch_array($totalOfYearValueArray);

$success_bill_year = 0;
$unSuccess_bill_year = 0;
$queryYearArray = mysqli_query($connect, $query1Year);

foreach ($queryYearArray as $bill_year) {
  if ($bill_year['status'] == 2) {
    $success_bill_year += 1;
  } else if ($bill_year['status'] == 3) {
    $unSuccess_bill_year += 1;
  }
}

$numberofItem = $success_bill_year + $unSuccess_bill_year;

echo '
<table style="width:100%;">
<tr>
<th class="collumn-right">
  Tiền bán hàng
</th>
<th class="collumn-left">₫
'. number_format($totalOfYearValue['total_year'] , 0, '', ',') .'
</th>
</tr>
<tr>
<th class="collumn-right">
  Số đơn hàng
</th>
<th class="collumn-left">
'. $numberofItem .'
</th>
</tr>
<tr>
<th class="collumn-right">
  Đơn thành công
</th>
<th class="collumn-left">
'. $success_bill_year .'
</th>
</tr>
<tr>
<th class="collumn-right">
  Đơn đã hủy
</th>
<th class="collumn-left">
'. $unSuccess_bill_year .'
</th>
</tr> </table>';
