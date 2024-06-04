<?php
session_start();
include('config.php');

// Check if user is not logged in or not an admin, then redirect to login page
if (!isset($_SESSION["logged_in"]) || $_SESSION["user_type"] !== 'Admin') {
    header("location: login.php");
    exit;
}

// Accept or Decline Order Logic
if(isset($_POST['action']) && isset($_POST['order_id'])) {
    $action = $_POST['action'];
    $order_id = $_POST['order_id'];
    
    if($action === 'confirm') {
        // Update order status to 't' for accepted
        $update_query = "UPDATE orders SET status = 'confirmed' WHERE order_id = '$order_id'";
    } elseif($action === 'cancel') {
        // Update order status to 'c' for declined
        $update_query = "UPDATE orders SET status = 'cancelled' WHERE order_id = '$order_id'";
    }
    
    if(mysqli_query($conn, $update_query)) {
        // Success message or redirect to the same page
        header("location: ".$_SERVER['PHP_SELF']);
        exit;
    } else {
        // Error message
        echo "Error updating order status: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <?php include 'admin_home.php'?>
    <link rel="stylesheet" href="admin/style.css">
</head>

<body>
    <div class="boxt">
        <h1>Pending Orders</h1>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch pending and to receive orders from the database
                $query = "SELECT order_id, user_id, product_id, price, total_amount, status,quantity FROM orders WHERE order_status IN ('pending', 'to receive')";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['order_id']}</td>";
                        echo "<td>{$row['product_name']}</td>";
                        echo "<td>{$row['price']}</td>";
                        echo "<td>{$row['quantity']}</td>";
                        echo "<td>{$row['total_amount']}</td>";
                        echo "<td>{$row['payment_method']}</td>";
                        echo "<td>{$row['order_date']}</td>";
                        // Check if status is 'p' and replace with 'Pending', or 't' and replace with 'To Receive'
                        if ($row['order_status'] === 'pending') {
                            echo "<td>Pending</td>";
                        } elseif ($row['order_status'] === 'to receive') {
                            echo "<td>To Receive</td>";
                        } else {
                            echo "<td>{$row['order_status']}</td>";
                        }
                        echo "<td>";
                        if ($row['order_status'] === 'p') {
                            echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
                            echo "<input type='hidden' name='order_id' value='".$row['order_id']."'>";
                            // Accept button
                            echo "<button type='submit' name='action' value='confirm' class='action-button' id='accept-button'>Confirm</button>";
                            // Decline button
                            echo "<button type='submit' name='action' value='cancel' class='action-button' id='decline-button'>Cancel</button>";
                            echo "</form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='16'>No pending or to receive orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>