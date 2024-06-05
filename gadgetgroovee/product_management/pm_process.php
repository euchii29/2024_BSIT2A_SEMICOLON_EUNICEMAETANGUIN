<?php
include 'pm_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST ['product_name'];
    $price = $_POST ['price'];
    $qty_available = $_POST['qty_available'];
    $qty_sold = $_POST['qty_sold'];
    $qty_returned = $_POST['qty_returned'];
    $last_date_restock = $_POST['last_date_restock'];
    $last_sale_date = $_POST['last_sale_date'];

    $sql = "INSERT INTO manage_products (product_name, price, qty_available, qty_sold, qty_returned, last_date_restock, last_sale_date) VALUES ($product_name,$price, $qty_available, $qty_sold, $qty_returned, $last_date_restock, $last_sale_date)";
    
    if ($conn->query($sql) === TRUE) {
        echo "New product created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<form action="pm_process.php" method="post">
            <hr>
            <h3>Add New Product</h3>
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>

            <label for="qty_available">Quantity Available:</label>
            <input type="number" id="qty_available" name="qty_available" required>

            <label for="qty_sold">Quantity Sold:</label>
            <input type="number" id="qty_sold" name="qty_sold" required>

            <label for="qty_returned">Quantity Returned:</label>
            <input type="number" id="qty_returned" name="qty_returned" required>

            <label for="last_date_restock">Last Date Restocked:</label>
            <input type="date" id="last_date_restock" name="last_date_restock" required>

            <label for="last_sale_date">Last Sale Date:</label>
            <input type="date" id="last_sale_date" name="last_sale_date" required>

            <input type="submit" value="Add Product">
        </form>

