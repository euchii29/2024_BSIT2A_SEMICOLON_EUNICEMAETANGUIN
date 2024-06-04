<?php
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit();
}

if (isset($_POST['confirm_order'])) {
    $order_id = $_POST['order_id'];
    $update_query = "UPDATE orderss SET status = 'confirmed' WHERE order_id = '$order_id' AND user_id = '$user_id'";
    mysqli_query($conn, $update_query);
} elseif (isset($_POST['cancel_order'])) {
    $order_id = $_POST['order_id'];
    $update_query = "UPDATE orderss SET status = 'cancelled' WHERE order_id = '$order_id' AND user_id = '$user_id'";
    mysqli_query($conn, $update_query);
}

$query = "SELECT orderss.order_id, products.product_name, orderss.order_date, orderss.status
          FROM orderss
          JOIN products ON orderss.product_id = products.product_id
          WHERE orderss.user_id = '$user_id'
          ORDER BY orderss.order_date DESC";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>My Orders</title>
</head>
<body>
    <h3>My Orders</h3>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['product_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    echo "<td>";
                    if ($row['status'] == 'pending') {
                        echo "<form action='' method='POST' style='display:inline-block;'>";
                        echo "<input type='hidden' name='order_id' value='" . htmlspecialchars($row['order_id']) . "'>";
                        echo "<button type='submit' name='confirm_order'>Confirm</button>";
                        echo "</form>";
                        echo "<form action='' method='POST' style='display:inline-block;'>";
                        echo "<input type='hidden' name='order_id' value='" . htmlspecialchars($row['order_id']) . "'>";
                        echo "<button type='submit' name='cancel_order'>Cancel</button>";
                        echo "</form>";
                    } else {
                        echo "No actions available";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No orders found</td></tr>";
            }
            ?>
            <hr>
        </tbody>
    </table>
</body>
</html>
