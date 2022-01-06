<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/main.css?v=2.2">
</head>
<body>
    <?php 

        if(!isset($_SESSION)){
            session_start();
        }

        if(!isset($_SESSION['loggedin'])){
            header('location: index.php');
        }

        if(!isset($connect)){
            require_once 'connect.php';
        }

        $total = 0;

    ?>

    <?php  
        if(isset($_GET['clearCart'])){
            if($_GET['clearCart'] == true){
                unset($_SESSION['cart']);
                unset($_SESSION['number_item']);
                header("Refresh:0; url=cart.php");
            }
        }
    ?>

    <?php if(isset($_GET['deleteItem'])){
                    $delete_id = $_GET['deleteItem'];
                    unset($_SESSION['cart'][$delete_id]);
                    $_SESSION['number_item'] -=1;
                    header("Refresh:0; url=cart.php");
    } ?>
    <?php if(isset($_GET['sub'])){
                    $sub_id = $_GET['sub'];
                    if($_SESSION['cart'][$sub_id]['cart_quantity'] > 1){
                        $_SESSION['cart'][$sub_id]['cart_quantity'] -=1;
                    }
                    header("Refresh:0; url=cart.php");
    } ?>
    <?php if(isset($_GET['add'])){
                    $add_id = $_GET['add'];
                    if($_SESSION['cart'][$add_id]['cart_quantity'] < $_SESSION['cart'][$add_id]['cart_available_quantity']){
                        $_SESSION['cart'][$add_id]['cart_quantity'] +=1;
                    }
                    header("Refresh:0; url=cart.php");
    } ?>

    <div class="content_container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Anh</th>
                    <th>Ma san pham </th>
                    <th>Ten san pham </th>
                    <th>So luong </th>
                    <th>Con lai</th>
                    <th>Gia</th>
                    <th>Tong</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if(!empty($_SESSION['cart'])){
                        $cart = $_SESSION['cart'];
                    }else{
                        echo '<tr>
                            <td colspan="8"><b>Cart empty!</b></td>
                        </tr>';
                        die();
                    }  
                ?>

                
                <?php foreach($cart as $id => $cart_item){ ?>
                    <tr>
                        
                        <td>
                            <img src="../Admin/photos/<?= $cart_item['cart_image'] ?>" width="100px" style="border-radius: 5px;">
                        </td>
                        <td>
                            <?= $cart_item['product_id'] ?>
                            
                        </td>
                        <td>
                            <?= $cart_item['cart_name'] ?>
                        </td>
                        <td>
                            <div class="bubble"><a style="color: #fff;" href="?sub=<?=  $cart_item['product_id'] ?>">-</a></div>
                            <?= $cart_item['cart_quantity'] ?>
                            <div class="bubble"><a style="color: #fff;" href="?add=<?=  $cart_item['product_id'] ?>">+</a></div>
                        </td>
                        <td>
                            <?= $cart_item['cart_available_quantity'] ?>
                        </td>
                        <td>
                            <?= $cart_item['cart_cost'] ?>
                        </td>
                        <td>
                            <?php echo $cart_item['cart_cost'] * $cart_item['cart_quantity']; $total += $cart_item['cart_cost']  * $cart_item['cart_quantity'] ;?>
                        </td>
                        <td>
                            <a onclick="return confirm('Bạn muốn xóa <?= $cart_item['cart_name'] ?> ra khỏi giỏ hàng ?')" href="?deleteItem=<?= $cart_item['product_id'] ?>" class="link-button green">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td> <b>Tổng tiền</b> </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td> <b> <?= $total ?></b></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <a onclick="return confirm('Xóa tất cả ở trong giỏ hàng ?');" class="link-button" href="?clearCart=true">Xóa tất cả</a>
        <a class="link-button" href="order.php">Đặt hàng</a>
    </div>

    

    
</body>
</html>