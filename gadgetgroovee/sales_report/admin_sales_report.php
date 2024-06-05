<?php
session_start();
include 'config.php';

$total_sales_query = "SELECT SUM(order_items.quantity * order_items.price) AS total_sales FROM order_items";
$total_sales_result = $mysqli->query($total_sales_query);
$total_sales = $total_sales_result->fetch_assoc()['total_sales'];

$total_orders_query = "SELECT COUNT(*) AS total_orders FROM orders";
$total_orders_result = $mysqli->query($total_orders_query);
$total_orders = $total_orders_result->fetch_assoc()['total_orders'];

$orders_by_status_query = "SELECT order_status, COUNT(*) AS count FROM orders GROUP BY order_status";
$orders_by_status_result = $mysqli->query($orders_by_status_query);
$orders_by_status = [];
while ($row = $orders_by_status_result->fetch_assoc()) {
    $orders_by_status[$row['order_status']] = $row['count'];
}

$total_quantity_query = "SELECT SUM(quantity) AS total_quantity FROM order_items";
$total_quantity_result = $mysqli->query($total_quantity_query);
$total_quantity = $total_quantity_result->fetch_assoc()['total_quantity'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Sales Report</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sales Report</h1>
        <table>
            <tr>
                <th>Total Sales</th>
                <td>₱<?= number_format($total_sales, 2) ?></td>
            </tr>
            <tr>
                <th>Total Orders</th>
                <td><?= $total_orders ?></td>
            </tr>
            <tr>
                <th>Total Quantity Sold</th>
                <td><?= $total_quantity ?></td>
            </tr>
        </table>
        <h2>Orders by Status</h2>
        <table>
            <tr>
                <th>Status</th>
                <th>Count</th>
            </tr>
            <?php foreach ($orders_by_status as $status => $count): ?>
                <tr>
                    <td><?= $status ?></td>
                    <td><?= $count ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

<?php
$mysqli->close();
?>
