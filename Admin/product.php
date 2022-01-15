<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh sach mat hang</title>
  <link rel="stylesheet" href="./CSS/style.css?v=2.4">
</head>

<body>

  <?php
  require_once './root/checkLogin.php';
  require_once './root/alert.php';
  if (!isset($connect)) {
    require_once './root/connect.php';
  }
  ?>

  <?php

  $page = 1;
  $search = "";

  if (isset($_GET['search'])) {
    $search = $_GET['search'];
  }

  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  }

  $number_of_post_query = "SELECT count(*) FROM product WHERE name like '%$search%'";
  $post_array = mysqli_query($connect, $number_of_post_query);
  $result_array = mysqli_fetch_array($post_array);
  $number_of_post = $result_array['count(*)'];
  $number_post_per_page = 3;
  $number_of_page = ceil($number_of_post / $number_post_per_page);
  $number_of_skip_page = $number_post_per_page * ($page - 1);

  $querry = "SELECT * FROM product WHERE name like '%$search%' LIMIT $number_post_per_page OFFSET $number_of_skip_page ";
  $result = mysqli_query($connect, $querry);
  ?>

  <?php
  if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sold_query = "SELECT sold FROM product WHERE id = $id";
    $sold_array = mysqli_query($connect, $sold_query);
    $sold_result = mysqli_fetch_array($sold_array);
    $sold_value = $sold_result['sold'];
    if ($sold_value == 0) {
      $delete = "DELETE FROM product WHERE id = '$id'";
      mysqli_query($connect, $delete);
      header("Refresh:0");
    } else {
      phpAlert('Không thể xóa: Hàng đã được bán');
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
      <h1 class="main-title">Các mặt hàng</h1>
      <div class="add-new-item">

        <a class="link-button" href="add_new_item.php"><i class="fas fa-plus-circle"></i>Thêm mat hang</a>

        <table class="styled-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Ảnh</th>
              <th>Tên mặt hàng</th>
              <th>Gía</th>
              <th>Còn lại</th>
              <th>Đã bán</th>
              <th>Manage</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($result as $product) { ?>
              <tr>
                <td>
                  <?= $product['id']  ?>
                </td>
                <td>
                  <img src="./photos/<?= $product['image']  ?>" alt="" style="width: 100px; border-radius: 5px; margin-left: auto; margin-right: auto;">
                </td>
                <td>
                  <?= $product['name']  ?>
                </td>
                <td>
                  <?= $product['cost']  ?>
                </td>
                <td>
                  <?= $product['quantity']  ?>
                </td>
                <td>
                  <?= $product['sold']  ?>
                </td>
                <td>
                  <a class="link-button" href="./view-infomation/item-information.php?id=<?= $product['id'] ?>"> Xem chi tiet</a>
                  <a class="link-button" href="./edit/edit_product.php?id=<?= $product['id'] ?>"> Sua</a>
                  <a onclick="return confirm('Xac nhan xoa ?')" class="link-button" href="?delete=<?= $product['id'] ?>"> Xoa</a>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>

        <div class="page_number_list">
          <?php for ($i = 1; $i <= $number_of_page; $i++) { ?>
            <div class="page_number">
              <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">
                <?php echo $i; ?>
              </a>
            </div>

          <?php } ?>
        </div>

      </div>
    </div>



    <div class="container-footer">
      <?php require_once "./root/footer.php"; ?>
    </div>
  </div>

  <?php mysqli_close($connect); ?>
</body>

</html>