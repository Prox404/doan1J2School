<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 1</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
        
        <div class="grid-container">
            <div class="container-header shadow-box">
                <?php require_once "./root/navbar.php"; ?>
            </div>
            <div class="container-menu shadow-box">
                <?php require_once "./root/sidebar.php"; ?>
            </div>
            <div class="container-main">
                
                <h1 class="main-title">Hoạt động hôm nay</h1>

                    <div class="today-activity">
                      <div class="today-activity-item">
                        <p>Tiền bán hàng</p>
                        <p>0,000 VND</p>
                      </div>
                      <div class="today-activity-item">
                        <p>Số đơn hàng</p>
                        <p>0,000 VND</p>
                      </div>
                      <div class="today-activity-item">
                        <p>Hàng khách trả</p>
                        <p>0,000 VND</p>
                      </div>
                    </div>

                    <h1 class="main-title">Hoạt động tháng này</h1>

                        <div class="monthly-activity">
                          <div class="monthly-activity-item shadow-box">
                           <p> <i class="far fa-chart-bar"></i> Hoạt động</p>
                            <table>
                              <tr>
                                <th class="collumn-right">
                                  Tiền bán hàng
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Số đơn hàng
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Số sản phẩm
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Khách hàng trả
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                            </table>
                          </div>
                          <div class="monthly-activity-item shadow-box">
                           <p> <i class="fas fa-tags"></i> Thông tin kho</p>
                            <table>
                              <tr>
                                <th class="collumn-right">
                                    Tồn kho
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Hết hàng
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Sắp hết hàng
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Vượt định mức
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                            </table>
                          </div>
                          <div class="monthly-activity-item shadow-box">
                           <p> <i class="far fa-question-circle"></i></i>Thông tin sản phẩm</p>
                            <table>
                              <tr>
                                <th class="collumn-right">
                                  Nhà sản xuất
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Chưa làm giá bán
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Chưa nhập giá mua
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
                              <tr>
                                <th class="collumn-right">
                                  Hàng chưa phân loại
                                </th>
                                <th class="collumn-left">
                                  0
                                </th>
                              </tr>
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
</html>