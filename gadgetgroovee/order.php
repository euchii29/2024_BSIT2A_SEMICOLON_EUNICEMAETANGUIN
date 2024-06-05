<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gadgetgroove";

$conn = new mysqli($servername, $username, $password, $dbname);
session_start();
$s_user_id = $_SESSION['user_id'];

if (isset($_GET['delete_from_cart'])) {
    $order_id = $_GET['delete_from_cart'];
    $delete_cart = "DELETE FROM orders WHERE order_id = '$order_id'";
    $sql_execute = mysqli_query($conn, $delete_cart);
    if ($sql_execute) {
        header("location: order.php?msg=cart_item_removed");
        exit(); // Stop further execution
    }
}

if (isset($_GET['cart_qty']) && isset($_GET['product_id'])) {
    $item_id = $_GET['product_id'];
    $cart_qty = $_GET['cart_qty'];

    // Insert the order into the database
    $insert_orders = "INSERT INTO orders (user_id, product_id, item_qty, order_status, price) 
                     VALUES ('$s_user_id', '$item_id', '$cart_qty', 'Order Placed', (SELECT price FROM products WHERE product_id = '$product_id') * '$cart_qty')";
    $insert_result = mysqli_query($conn, $insert_orders);
    if ($insert_result) {
        header("location: order.php?msg=order_placed");
        exit(); // Stop further execution
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$sql_get_orders = "SELECT o.order_id, m.product_name AS item_name, o.item_qty, o.order_status, o.price, o.item_id
                    FROM orders AS o
                    JOIN products AS m ON o.item_id = m.product_id
                    WHERE o.user_id = '$s_user_id'";
$order_results = mysqli_query($conn, $sql_get_orders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" href="order.css">
</head>
<body>

<div class="header">
    <h2 id="place_order">Place Your Order</h2>
    <nav>
        <ul>
            <li><a href="shop.php">Home</a></li>
        </ul>
    </nav>
</div>

<section id="product1" class="section-p1">
    <h1 class="title">Our Products</h1>
    <table class="table">
        <?php
        $get_items = "SELECT * FROM `products`";
        $get_result = mysqli_query($conn, $get_items);
        while ($row = mysqli_fetch_assoc($get_result)) { ?>
            <tr>
                <td id="item"><?php echo $row['product_name']; ?></td>
                <td><?php echo "Php " . number_format($row['price'], 2); ?></td>
                <td>
                <form action="cart.php" method="get">
                <div class="input-group">
                <input type="number" class="form-control" name="cart_qty">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"> <!-- Add this hidden input field -->
                <input type="submit" value="Order" class="btn btn-primary">
              </div>
          </form>
                </td>
            </tr>
        <?php }
        ?>
    </table>
</section>

<div class="status">
    <?php
    if (mysqli_num_rows($order_results) > 0) { ?>
        <h2>My Order Status</h2>

        <table class="orders" style="border: 2px solid black;">

            <tr>
                <th>Order ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
            <?php while ($order = mysqli_fetch_assoc($order_results)) { ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['item_name']; ?></td>
                    <td><?php echo $order['item_qty']; ?></td>
                    <td><?php echo $order['order_status']; ?></td>
                    <td><?php echo "Php " . number_format($order['price'], 2); ?></td>
                    <td>
                        <?php if ($order['order_status'] == 'Order Placed') { ?>
                            <a href="?delete_from_cart=<?php echo $order['order_id']; ?>&item_id=<?php echo $order['item_id']; ?>" class="cancel">Cancel</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <?php } else { ?>
        <p>Your cart is currently empty.</p>
    <?php } ?>
        </div>
        <div class="warn">
            <p>User will not be able to cancel their order if the seller receives it already
                (Order status will change to "Order Received" and so on)
            </p>
        </div>

</body>
</html>
