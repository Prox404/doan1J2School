<?php

require_once "../vendor/autoload.php";

require_once 'connect.php';

if(!isset($_SESSION)){
    session_start();
}

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_GET['product'])){
    $spreadsheet = new Spreadsheet();
    $Excel_writer = new Xlsx($spreadsheet);
    
    $spreadsheet->setActiveSheetIndex(0);
    $activeSheet = $spreadsheet->getActiveSheet();
    
    $activeSheet->setCellValue('A1', 'ID');
    $activeSheet->setCellValue('B1', 'Name');
    $activeSheet->setCellValue('C1', 'Manufacturer');    
    $activeSheet->setCellValue('D1', 'Cost');
    $activeSheet->setCellValue('E1', 'Sold');
    $activeSheet->setCellValue('F1', 'Quantity');
    $activeSheet->setCellValue('G1', 'Rate');
    
    $query = "SELECT product.*,manufacturer.name as manufacturer_name, AVG(rate_product.rating) as rate FROM (product join manufacturer on manufacturer_id = manufacturer.id) LEFT join rate_product on product.id = rate_product.product_id GROUP BY product.id";
    $result = mysqli_query($connect, $query);
    if($result->num_rows > 0) {
        $i = 2;
        while($row = $result->fetch_assoc()) {
            $activeSheet->setCellValue('A'.$i , $row['id']);
            $activeSheet->setCellValue('B'.$i , $row['name']);
            $activeSheet->setCellValue('C'.$i , $row['manufacturer_name']);
            $activeSheet->setCellValue('D'.$i , $row['cost']);
            $activeSheet->setCellValue('E'.$i , $row['sold']);
            $activeSheet->setCellValue('F'.$i , $row['quantity']);
            $activeSheet->setCellValue('G'.$i , round($row['rate'],1));
            $i++;
        }
    }
    
    $filename = 'products.xlsx';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='. $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');

}

if(isset($_GET['employee'])){
    $spreadsheet = new Spreadsheet();
    $Excel_writer = new Xlsx($spreadsheet);
    
    $spreadsheet->setActiveSheetIndex(0);
    $activeSheet = $spreadsheet->getActiveSheet();
    
    $activeSheet->setCellValue('A1', 'ID');
    $activeSheet->setCellValue('B1', 'Name');
    $activeSheet->setCellValue('C1', 'Gender');    
    $activeSheet->setCellValue('D1', 'Birthday');
    $activeSheet->setCellValue('E1', 'Address');
    $activeSheet->setCellValue('F1', 'Phone');
    $activeSheet->setCellValue('G1', 'Email');
    
    $id = $_SESSION['id'];

    $query = "SELECT * FROM employee_query WHERE manager_id = '$id'";

    $result = mysqli_query($connect, $query);
    if($result->num_rows > 0) {
        $i = 2;
        while($row = $result->fetch_assoc()) {
            $gender = "Nam";
            if($row['gender'] == 0){
                $gender = "Nữ";
            }
            $activeSheet->setCellValue('A'.$i , $row['id']);
            $activeSheet->setCellValue('B'.$i , $row['name']);
            $activeSheet->setCellValue('C'.$i , $gender);
            $activeSheet->setCellValue('D'.$i , $row['dob']);
            $activeSheet->setCellValue('E'.$i , $row['address']);
            $activeSheet->setCellValue('F'.$i , $row['phone']);
            $activeSheet->setCellValue('G'.$i , $row['email']);
            $i++;
        }
    }
    
    $filename = 'employee.xlsx';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='. $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');

}

if(isset($_GET['manufacturer'])){
    $spreadsheet = new Spreadsheet();
    $Excel_writer = new Xlsx($spreadsheet);
    
    $spreadsheet->setActiveSheetIndex(0);
    $activeSheet = $spreadsheet->getActiveSheet();
    
    $activeSheet->setCellValue('A1', 'ID');
    $activeSheet->setCellValue('B1', 'Name');
    $activeSheet->setCellValue('C1', 'Product id');    
    $activeSheet->setCellValue('D1', 'Product name');


    $query = "SELECT manufacturer.*, product.id as product_id, product.name as product_name FROM `manufacturer` LEFT JOIN product ON manufacturer.id = product.manufacturer_id";

    $result = mysqli_query($connect, $query);
    if($result->num_rows > 0) {
        $i = 2;
        while($row = $result->fetch_assoc()) {
            $activeSheet->setCellValue('A'.$i , $row['id']);
            $activeSheet->setCellValue('B'.$i , $row['name']);
            $activeSheet->setCellValue('C'.$i , $row['product_id']);
            $activeSheet->setCellValue('D'.$i , $row['product_name']);
            $i++;
        }
    }
    
    $filename = 'manufacturer.xlsx';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='. $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');

}

if(isset($_GET['bill'])){
    $spreadsheet = new Spreadsheet();
    $Excel_writer = new Xlsx($spreadsheet);
    
    $spreadsheet->setActiveSheetIndex(0);
    $activeSheet = $spreadsheet->getActiveSheet();
    
    $activeSheet->setCellValue('A1', 'Mã đơn');
    $activeSheet->setCellValue('B1', 'Mã khách hàng');
    $activeSheet->setCellValue('C1', 'Tên người nhận');
    $activeSheet->setCellValue('D1', 'Thời gian đặt hàng');
    $activeSheet->setCellValue('E1', 'Số điện thoại');    
    $activeSheet->setCellValue('F1', 'Địa chỉ');    
    $activeSheet->setCellValue('G1', 'Ghi chú');    
    $activeSheet->setCellValue('H1', 'Mã mặt hàng');    
    $activeSheet->setCellValue('I1', 'Tên mặt hàng');    
    $activeSheet->setCellValue('J1', 'Trạng thái');    
    $activeSheet->setCellValue('K1', 'Số lượng');    
    $activeSheet->setCellValue('L1', 'Giá');    
    $activeSheet->setCellValue('M1', 'Tổng cộng');    
    


    $query = "SELECT * FROM bill as t1 JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id WHERE status = '2' OR status = '3'";

    $result = mysqli_query($connect, $query);
    if($result->num_rows > 0) {
        $i = 2;
        while($row = $result->fetch_assoc()) {

            $status = "Đơn thất bại";
            if($row['status'] == 2){
                $status = "Đơn thành công";
            }

            $activeSheet->setCellValue('A'.$i , $row['id']);
            $activeSheet->setCellValue('B'.$i , $row['customer_id']);
            $activeSheet->setCellValue('C'.$i , $row['recipient_name']);
            $activeSheet->setCellValue('D'.$i , $row['time_order']);
            $activeSheet->setCellValue('E'.$i , $row['customer_phone']);
            $activeSheet->setCellValue('F'.$i , $row['customer_address']);
            $activeSheet->setCellValue('G'.$i , $row['note']);
            $activeSheet->setCellValue('H'.$i , $row['product_id']);
            $activeSheet->setCellValue('I'.$i , $row['name']);
            $activeSheet->setCellValue('J'.$i , $row['cost']);
            $activeSheet->setCellValue('K'.$i , $status);
            $activeSheet->setCellValue('L'.$i , $row['cost']);
            $activeSheet->setCellValue('M'.$i , $row['total']);
            $i++;
        }
    }
    
    $filename = 'bill.xlsx';
    
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename='. $filename);
    header('Cache-Control: max-age=0');
    $Excel_writer->save('php://output');

}


?>
