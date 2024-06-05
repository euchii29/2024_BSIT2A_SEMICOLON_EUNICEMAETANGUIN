<?php
$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "gadgetgroove"; 
$db_conn= "";

$conn = new mysqli($servername, $username, $password, $dbname);
session_start();

if(isset($_GET['product_id'])){
    $user_id = $_SESSION['user_id'];
    $item_id = $_GET['product_id']; // Changed from 'item_id' to 'product_id'
    $item_qty = $_GET['cart_qty'];
    
    // Fetch the price of the product
    $sql_get_price = "SELECT price FROM products WHERE product_id = '$item_id'";
    $result_price = mysqli_query($conn, $sql_get_price);
    $row_price = mysqli_fetch_assoc($result_price);
    $price = $row_price['price'];

    // Calculate total price
    $total_price = $price * $item_qty;
 
    $sql_add_to_cart = "INSERT INTO `orders`
           (`user_id`, `item_id`, `item_qty`, `order_status`, `price`)
           VALUES
           ('$user_id','$item_id','$item_qty', 'Order Placed', '$total_price')";
    $execute_cart = mysqli_query($conn, $sql_add_to_cart);
    
    if($execute_cart){
        header("location: order.php?msg=item_{$item_id}_added_to_cart");
    }
}

?>