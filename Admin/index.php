<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tổng quan</title>
  <link rel="stylesheet" href="./CSS/style.css?v=3.3">
  <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <?php

  if (!isset($connect)) {
    require_once './root/connect.php';
  }

  require_once './root/checkLogin.php';

  $query1month = "SELECT * FROM bill WHERE MONTH(TIMEDIFF(bill.time_order, CAST(CAST(NOW() AS DATE) AS DATETIME))) = 1";
  $totalOfDay = "SELECT IFNULL(SUM(total), 0) as total_day FROM bill as t1 JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id WHERE DATEDIFF(t1.time_order, CAST(CAST(NOW() AS DATE) AS DATETIME)) = 0 AND t1.status = 2";
  $queryToday = "SELECT * FROM bill WHERE DATEDIFF(bill.time_order, CAST(CAST(NOW() AS DATE) AS DATETIME)) = 0";
  $totalOfMonth = "SELECT IFNULL(SUM(total), 0) as total_month FROM bill as t1 JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id WHERE MONTH(TIMEDIFF(t1.time_order, CAST(CAST(NOW() AS DATE) AS DATETIME))) = 1 AND t1.status = 2";

  $totalOfDayValueArray = mysqli_query($connect, $totalOfDay);
  $totalOfDayValue = mysqli_fetch_array($totalOfDayValueArray);

  $queryTodayArray = mysqli_query($connect, $queryToday);

  $success_bill = 0;
  $unSuccess_bill = 0;

  foreach ($queryTodayArray as $bill_today) {
    if ($bill_today['status'] == 2) {
      $success_bill += 1;
    } else if ($bill_today['status'] == 3) {
      $unSuccess_bill += 1;
    }
  }



  $totalOfMonthValueArray = mysqli_query($connect, $totalOfMonth);
  $totalOfMonthValue = mysqli_fetch_array($totalOfMonthValueArray);

  $success_bill_month = 0;
  $unSuccess_bill_month = 0;
  $queryMonthArray = mysqli_query($connect, $query1month);

  foreach ($queryMonthArray as $bill_month) {
    if ($bill_month['status'] == 2) {
      $success_bill_month += 1;
    } else if ($bill_month['status'] == 3) {
      $unSuccess_bill_month += 1;
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

  $out_of_stock_query = "SELECT count(*) as out_of_stock FROM product WHERE quantity = 0";
  $out_of_stock_array = mysqli_query($connect, $out_of_stock_query);
  $out_of_stock_result = mysqli_fetch_array($out_of_stock_array);
  $out_of_stock_value = $out_of_stock_result['out_of_stock'];

  $top5spending = "SELECT id,name,gender,dob,spending FROM customer as cus JOIN ( SELECT sum(total) as spending,t1.customer_id FROM bill as t1 JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id GROUP BY t1.customer_id ) as cus2 ON cus.id = cus2.customer_id ORDER BY spending DESC LIMIT 5";
  $topSpending_result = mysqli_query($connect, $top5spending);

  $top5product = "SELECT product.id,product.name,product.sold,AVG(rate_product.rating) as rate FROM product JOIN rate_product ON product.id = rate_product.product_id GROUP BY id ORDER BY sold DESC LIMIT 5";
  $topProduct = mysqli_query($connect, $top5product);
  ?>


  <div class="grid-container">
    <div class="container-header">
      <?php require_once "./root/navbar.php"; ?>
    </div>
    <div class="container-menu">
      <?php require_once "./root/sidebar.php"; ?>
    </div>
    <div class="container-main">

      <h1 class="main-title">Thống kê trong năm</h1>

      <div class="year-activity">
        <div class="year-activity-item">


          <div class="chart-data">
            <?php
            for ($i = 1; $i <= 12; $i++) {
              $month_data_query = "SELECT IFNULL(SUM(total), 0) as month_data FROM bill as t1 JOIN ( SELECT bill_detail.*,product.name,product.cost,product.cost * bill_detail.quantity as total FROM bill_detail JOIN product ON bill_detail.product_id = product.id ) as t2 ON t1.id = t2.bill_id WHERE MONTH(t1.time_order) = $i AND t1.status = 2";
              $month_data_array = mysqli_query($connect, $month_data_query);
              $month_data_result = mysqli_fetch_array($month_data_array);
              $month_data_value = $month_data_result['month_data'];
              echo '<p class="month-data">' . $month_data_value . '</p>';
            }
            ?>
          </div>
          <canvas id="yearChart"></canvas>
        </div>
      </div>

      <h1 class="main-title">Hoạt động hôm nay</h1>

      <div class="today-activity">
        <div class="today-activity-item">
          <p>Tiền bán hàng</p>
          <p><?= number_format($totalOfDayValue['total_day'] , 0, '', '.'); ?> VND</p>
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
              <th class="collumn-left">₫
                <?= number_format($totalOfMonthValue['total_month'] , 0, '', '.'); ?>
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
            <label for="year">Chọn năm: </label>
            <table>
              <tr>
                <th class="collumn-right">
                  <select id="year" name="year">
                    <option value="0" selected>Chọn năm</option>
                    <?php for ($i = date("Y"); $i >= 2020; $i--) { ?>
                      <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                  </select>
                </th>
                <th class="collumn-right">
                </th>
              </tr>
            </table>
          </form>

          <br>


          <div id="result" style="width: 100%;"></div>

        </div>
      </div>

      <h1 id="potential_customers" class="main-title">Khách hàng tiềm năng</h1>

      <div class="year-activity">
        <div class="year-activity-item">
          <table class="styled-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Chi tiêu</th>
                <th>Chi tiết</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($topSpending_result as $spending) { ?>
                <tr>
                  <td><?= $spending['id'] ?></td>
                  <td><?= $spending['name'] ?></td>
                  <td><?php if($spending['gender'] == 1) echo 'Nam'; else echo 'Nữ';   ?></td>
                  <td><?= $spending['dob'] ?></td>
                  <td>₫<?= number_format($spending['spending'] , 0, '', '.'); ?></td>
                  <td><a href="#popup1" class="link-button" onclick="user_bill(<?=$spending['id']?>);">Xem</a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <h1 class="main-title">Sản phẩm tiêu biểu</h1>

      <div class="year-activity">
        <div class="year-activity-item">
          <table class="styled-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Đã bán</th>
                <th>Đánh giá</th>
                <th>Xem chi tiết</th> 
              </tr>
            </thead>
            <tbody>
              <?php foreach ($topProduct as $top) { ?>
                <tr>
                  <td><?= $top['id'] ?></th>
                  <td><?= $top['name'] ?></td>
                  <td><?= $top['sold'] ?></td>
                  <td><?= round($top['rate'],1)  ?><span style="color: #FFED85 !important;" class="fa fa-star"></span></td>
                  <td><a class="link-button" href="./view-infomation/item-information.php?id=<?= $top['id'] ?>">Xem</a></td>
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

  <div id="popup1" class="overlay">
	<div class="popup">
		<h2>Thông tin khách hàng</h2>
		<a class="close" href="#potential_customers">&times;</a>
		<div class="content" >
    <table class='styled-table'>
            <thead>
              <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Thời gian đặt</th>
                <th>Người nhận</th>
                <th>Địa chỉ</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Gía</th>
                <th>Tổng cộng</th> 
              </tr>
            </thead>
            <tbody id="user_bill_detail">

            </tbody>
          </table>
		</div>
	</div>
</div>              
</body>
<script language="javascript">
  $(document).ready(function() {
    $('#year').on('change', function() {
      var optionSelected = $("option:selected", this);
      var valueSelected = this.value;

      $.ajax({
        url: "process/year_overview.php",
        type: "get",
        data: {
          year: valueSelected
        },
        success: function(result) {
          $('#result').html(result);
        }
      });

    });
  });
</script>
<script language="javascript">
  // $(document).ready(function() {
    function user_bill(id){
      $.ajax({
        url: "process/user_bill.php",
        type: "get",
        data: {
          user_id: id
        },
        success: function(user_result) {
          $('#user_bill_detail').html(user_result);
        }
      });
    };
  // });
</script>
<script>
  let number_array = document.getElementsByClassName('month-data');
  let chartData = [];
  for (i = 0; i <= 11; i++) {
    let value = number_array[i].textContent;
    chartData.push(value);
  }
  console.log(chartData);
</script>
<script>
  const ctx = document.getElementById('yearChart');
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
      datasets: [{
        label: '',
        data: chartData,
        backgroundColor: [
          '#F24052',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          '#A8F387',
          '#16D6FA',
          '#2ACCC8',
          '#F7D6E0',
          '#F2B5D4',
          '#FFEBA5'
        ],
        borderColor: 'transparent',
        borderWidth: 0,
        barThickness: 20

      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  });
</script>
<script src="https://kit.fontawesome.com/cb1ae4cd96.js" crossorigin="anonymous"></script>
<script src="./JS/selectOption.js"></script>

</html>