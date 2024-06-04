<?php
session_start(); 
if(isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    if(isset($_SESSION['cart'][$product_id])) {

        unset($_SESSION['cart'][$product_id]);
        echo "Item removed from the cart.";
    } else {
        echo "Item not found in the cart.";
    }
} else {
    echo "No item ID provided.";
}
?>
