<?php
if (isset($_GET['clearCart'])) {
    if ($_GET['clearCart'] == true) {
        unset($_SESSION['cart']);
        unset($_SESSION['number_item']);
        header("Refresh:0; url=cart.php");
    }
}
?>

<?php if (isset($_GET['deleteItem'])) {
    $delete_id = $_GET['deleteItem'];
    unset($_SESSION['cart'][$delete_id]);
    $_SESSION['number_item'] -= 1;
    header("Refresh:0; url=cart.php");
} ?>
<?php if (isset($_GET['sub'])) {
    $sub_id = $_GET['sub'];
    if ($_SESSION['cart'][$sub_id]['cart_quantity'] > 1) {
        $_SESSION['cart'][$sub_id]['cart_quantity'] -= 1;
    }
    header("Refresh:0; url=cart.php");
} ?>
<?php if (isset($_GET['add'])) {
    $add_id = $_GET['add'];
    if ($_SESSION['cart'][$add_id]['cart_quantity'] < $_SESSION['cart'][$add_id]['cart_available_quantity']) {
        $_SESSION['cart'][$add_id]['cart_quantity'] += 1;
    }
    header("Refresh:0; url=cart.php");
} ?>