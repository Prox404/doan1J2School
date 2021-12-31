<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sach mat hang</title>
    <link rel="stylesheet" href="./CSS/style.css?v=2.2">
</head>
<body>

<?php 
    require_once 'checkLogin.php';
?>

        <?php 
          require_once 'connect.php';
          
            $page = 1;
            $search = "";

            if(isset($_GET['search'])){
                $search = $_GET['search'];
            }

            require_once 'connect.php';
        
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }
            
            $number_of_post_query = "SELECT count(*) FROM product WHERE name like '%$search%'";
            $post_array = mysqli_query($connect, $number_of_post_query);
            $result_array = mysqli_fetch_array($post_array);
            $number_of_post = $result_array['count(*)'];
            $number_post_per_page = 3;
            $number_of_page = ceil($number_of_post/$number_post_per_page);
            $number_of_skip_page = $number_post_per_page * ($page - 1);

            $querry = "SELECT * FROM product WHERE name like '%$search%' LIMIT $number_post_per_page OFFSET $number_of_skip_page ";
            $result = mysqli_query($connect, $querry);

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
                    <div class="commodity">
                      <?php foreach($result as $product_item){ ?>
                        <div class="commodity-item">
                          <img
                            src="photos/<?php echo $product_item['image']; ?>"
                            alt="unsplash"
                            class="commodity-image"
                          />
                          <h2 class="item-name"><a href="./item-information.php?id=<?php echo $product_item['id'] ?>"><?php echo $product_item['name']; ?></a></h2>
                          <div class="space-between"> 
                              <p class="cost">đ<?php echo $product_item['cost']; ?></p>
                              <p class="sold">Còn lại <?php echo $product_item['quantity']; ?></p>
                          </div>
                          <div class="space-between">
                              <a class="link-button" href="edit_product.php?id=<?php echo $product_item['id']; ?>">Sửa</a>
                              <a class="link-button" href="item-information.php?delete=<?php echo $product_item['id']; ?>" onclick="return confirm('Bạn muốn xóa sản phẩm?');" >Xóa</a>
                          </div>
                        </div>
                      <?php } ?>
                    </div>

                <div class="page_number_list">
                  <?php for($i = 1 ; $i<= $number_of_page ; $i++){?>
                      <div class="page_number">
                        <a href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">
                            <?php echo $i; ?>
                        </a>
                      </div>
                      
                  <?php } ?>
                </div>
                
            </div>  

           

            <div class="container-footer">
                <?php require_once "./root/footer.php"; ?>
            </div>
        </div>

        <?php
          if(isset($_GET['delete'])){
            $id = $_GET['delete'];
            $delete = "DELETE FROM product WHERE id = '$id'";

            mysqli_query($connect, $delete);
          }
        ?>
</body>
</html>