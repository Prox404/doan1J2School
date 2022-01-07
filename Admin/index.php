<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tổng quan</title>
    <link rel="stylesheet" href="./CSS/style.css?v=2.2">
</head>
<body>

  <?php 

      if(!isset($connect)){
        require_once 'connect.php';
      }

      require_once 'checkLogin.php';

      $query1month = "SELECT * FROM bill WHERE MONTH(TIMEDIFF(bill.time_order, CAST(CAST(NOW() AS DATE) AS DATETIME))) = 1";
      $totalOfDay = "SELECT IFNULL(SUM(total), 0) as total_day FROM bill as t1 JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id WHERE DATEDIFF(t1.time_order, CAST(CAST(NOW() AS DATE) AS DATETIME)) = 0 AND t1.status = 2";
      $queryToday = "SELECT * FROM bill WHERE DATEDIFF(bill.time_order, CAST(CAST(NOW() AS DATE) AS DATETIME)) = 0";
      $totalOfMonth = "SELECT IFNULL(SUM(total), 0) as total_month FROM bill as t1 JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id WHERE MONTH(TIMEDIFF(t1.time_order, CAST(CAST(NOW() AS DATE) AS DATETIME))) = 1 AND t1.status = 2";

      $totalOfDayValueArray = mysqli_query($connect, $totalOfDay);
      $totalOfDayValue = mysqli_fetch_array($totalOfDayValueArray);

      $queryTodayArray = mysqli_query($connect, $queryToday);

      $success_bill = 0;
      $unSuccess_bill = 0;

      foreach ($queryTodayArray as $bill_today ) {
        if($bill_today['status'] == 2){
          $success_bill +=1;
        }else if($bill_today['status'] == 3){
          $unSuccess_bill +=1;
        }
      }



      $totalOfMonthValueArray = mysqli_query($connect, $totalOfMonth);
      $totalOfMonthValue = mysqli_fetch_array($totalOfMonthValueArray);

      $success_bill_month = 0;
      $unSuccess_bill_month = 0;
      $queryMonthArray = mysqli_query($connect, $query1month);

      foreach ($queryMonthArray as $bill_month ) {
        if($bill_month['status'] == 2){
          $success_bill_month +=1;
        }else if($bill_month['status'] == 3){
          $unSuccess_bill_month +=1;
        }
      }

      $manufacturer_query = "SELECT count(*) as number_of_manufacturer FROM manufacturer";
      $number_of_manufacturer_array = mysqli_query($connect, $manufacturer_query);
      $number_of_manufacturer_result = mysqli_fetch_array($number_of_manufacturer_array);
      $number_of_manufacturer_value = $number_of_manufacturer_result['number_of_manufacturer'];

      $stocking_query = "SELECT count(*) as stocking FROM product WHERE quantity > 0";
      $stocking_array = mysqli_query($connect, $stocking_query);
      $stocking_result = mysqli_fetch_array($stocking_array);
      $stocking_value = $stocking_result['stocking'];

      $out_of_stock_soon_query = "SELECT count(*) as out_of_stock_soon FROM product WHERE quantity < 20";
      $out_of_stock_soon_array = mysqli_query($connect, $out_of_stock_soon_query);
      $out_of_stock_soon_result = mysqli_fetch_array($out_of_stock_soon_array);
      $out_of_stock_soon_value = $out_of_stock_soon_result['out_of_stock_soon'];

      $out_of_stock_query = "SELECT count(*) as out_of_stock FROM product WHERE quantity < 20";
      $out_of_stock_array = mysqli_query($connect, $out_of_stock_query);
      $out_of_stock_result = mysqli_fetch_array($out_of_stock_array);
      $out_of_stock_value = $out_of_stock_result['out_of_stock'];

      $top5spending = "SELECT id,name,gender,dob,spending FROM customer as cus JOIN ( SELECT sum(total) as spending,t1.customer_id FROM bill as t1 JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id GROUP BY t1.customer_id ) as cus2 ON cus.id = cus2.customer_id ORDER BY spending DESC LIMIT 5";
      $topSpending_result = mysqli_query($connect, $top5spending);
  ?>

  <?php 
  
    $year = date("Y");

      if(isset($_GET['year'])){
        $year = $_GET['year'];
      }

      $query1Year = "SELECT * FROM bill WHERE YEAR(bill.time_order) = $year";
      $totalOfYear = "SELECT IFNULL(SUM(total), 0) as total_year FROM bill as t1 JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id WHERE YEAR(t1.time_order) = $year AND t1.status = 2";

      $totalOfYearValueArray = mysqli_query($connect, $totalOfYear);
      $totalOfYearValue = mysqli_fetch_array($totalOfYearValueArray);

      $success_bill_year = 0;
      $unSuccess_bill_year = 0;
      $queryYearArray = mysqli_query($connect, $query1Year);

      foreach ($queryYearArray as $bill_year ) {
        if($bill_year['status'] == 2){
          $success_bill_year +=1;
        }else if($bill_year['status'] == 3){
          $unSuccess_bill_year +=1;
        }
      }
  
  ?>
        
        <div class="grid-container">
            <div class="container-header">
                <?php require_once "./root/navbar.php"; ?>
            </div>
            <div class="container-menu">
                <?php require_once "./root/sidebar.php"; ?>
            </div>
            <div class="container-main">
                
                <h1 class="main-title">Hoạt động hôm nay</h1>

                    <div class="today-activity">
                      <div class="today-activity-item">
                        <p>Tiền bán hàng</p>
                        <p><?= $totalOfDayValue['total_day'] ?> VND</p>
                      </div>
                      <div class="today-activity-item">
                        <p>Số đơn hàng thành công</p>
                        <p><?= $success_bill ?></p>
                      </div>
                      <div class="today-activity-item">
                        <p>Số đơn hủy</p>
                        <p><?= $unSuccess_bill ?></p>
                      </div>
                    </div>

                    <h1 class="main-title">Hoạt động tháng này</h1>

                        <div class="monthly-activity">
                          <div class="monthly-activity-item">
                           <p> <i class="far fa-chart-bar"></i> Hoạt động</p>
                            <table>
                              <tr>
                                <th class="collumn-right">
                                  Tiền bán hàng
                                </th>
                                <th class="collumn-left">
                                  <?= $totalOfMonthValue['total_month'] ?>
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Số đơn hàng
                                </th>
                                <th class="collumn-left">
                                  <?= $success_bill_month + $unSuccess_bill ?>
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Số đơn thành công
                                </th>
                                <th class="collumn-left">
                                  <?= $success_bill_month ?>
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Số đơn hủy
                                </th>
                                <th class="collumn-left">
                                  <?= $unSuccess_bill ?>
                                </th>
                              </tr>
                            </table>
                          </div>
                        
                          <div class="monthly-activity-item">
                           <p> <i class="fas fa-tags"></i> Thông tin kho</p>
                            <table>
                              <tr>
                                <th class="collumn-right">
                                  Nhà sản xuất
                                </th>
                                <th class="collumn-left">
                                  <?= $number_of_manufacturer_value ?>
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Còn hàng
                                </th>
                                <th class="collumn-left">
                                  <?= $stocking_value ?>
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Sắp hết hàng
                                </th>
                                <th class="collumn-left">
                                  <?= $out_of_stock_soon_value ?>
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Hết hàng
                                </th>
                                <th class="collumn-left">
                                <?= $out_of_stock_value ?>
                                </th>
                              </tr>
                            </table>
                          </div>
                        </div>
                    <h1 class="main-title">Hoạt động trong năm</h1>

                    <div class="year-activity">
                          <div class="year-activity-item">
                              <form action="" method="get">
                              <label for="year">Chọn năm</label>
                                <table>
                                  <tr>
                                    <th class="collumn-right" >
                                      <div class="custom-select">
                                        <select id="year" name="year">
                                          <option value="<?= date("Y") ?>"><?= date("Y") ?></option>
                                          <?php for($i = date("Y") ;  $i>= 2020 ; $i--){ ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                    </th>
                                    <th class="collumn-right">
                                      <input type="submit" value="  Nhập  ">
                                    </th>
                                  </tr>
                                </table>
                              </form>

                              <br>

                              <table style="width:99%; margin-left: 5px;">
                              <tr>
                                <th class="collumn-right">
                                  Tiền bán hàng
                                </th>
                                <th class="collumn-left">
                                  <?= $totalOfYearValue['total_year'] ?>
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Số đơn hàng
                                </th>
                                <th class="collumn-left">
                                  <?= $success_bill_year + $unSuccess_bill_year ?>
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Đơn thành công
                                </th>
                                <th class="collumn-left">
                                  <?= $success_bill_year ?>
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Đơn đã hủy
                                </th>
                                <th class="collumn-left">
                                <?= $unSuccess_bill_year ?>
                                </th>
                              </tr>
                            </table>
                          </div>
                    </div>

                    <h1 class="main-title">Khách hàng tiềm năng</h1>
                    
                    <div class="year-activity">
                      <div class="year-activity-item">
                        <table class="styled-table">
                          <thead>
                            <tr>
                              <td>ID</td>
                              <td>Tên</td>
                              <td>Giới tính</td>
                              <td>Ngày sinh</td>
                              <td>Chi tiêu</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($topSpending_result as $spending){ ?>
                              <tr>
                                <th><?= $spending['id'] ?></th>
                                <th><?= $spending['name'] ?></th>
                                <th><?= $spending['gender'] ?></th>
                                <th><?= $spending['dob'] ?></th>
                                <th><?= $spending['spending'] ?></th>
                              </tr>
                            <?php } ?>
                          </tbody>
                          </table>
                      </div>
                    </div>
                  
            </div>  
            <div class="container-footer">
                <?php require_once "./root/footer.php"; ?>
            </div>
        </div>

        
</body>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
<script src="./JS/selectOption.js"></script>
</html>