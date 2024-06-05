
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Product Management System</h1>
        <?php
        include 'pm_conn.php';

        $sql = "SELECT product_id, price, qty_available, qty_sold, qty_returned, last_date_restock, last_sale_date FROM manage_products";
        $result = $conn->query($sql);

        if ($result === false) {
            echo "Error: " . $conn->error;
        } elseif ($result->num_rows > 0) {
            echo "<table><tr><th>/th><th>PRODUCT NAME/th><th>PRICE</th><th>QUANTITY AVAILABLE</th><th>QUANTITY SOLD</th><th>QUANTITY RETURNED</th><th>LAST DATE RESTOCK</th><th>LAST SALE DATE</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row["product_id"]) . "</td><td>" . htmlspecialchars($row["price"]) . "</td><td>" . htmlspecialchars($row["qty_available"]) . "</td><td>" . htmlspecialchars($row["qty_sold"]) . "</td><td>" . htmlspecialchars($row["qty_returned"]) . "</td><td>" . htmlspecialchars($row["last_date_restock"]) . "</td><td>" . htmlspecialchars($row["last_sale_date"]) . "</td></tr>";
            }
            echo "</table><br/>";
        } else {
            echo "0 results";
        }

        include 'pm_process.php';
        include 'pm_update.php';
        include 'pm_delete.php';

        $conn->close();
        ?>
    </div>
</body>
</html>

