<form method="post" action="pm_update.php">
    <hr>
    <h3>Update Product</h3>
    Product Id: <input type="number" name="product_id" value="<?php echo $row['product_id']; ?>">
    Price: <input type="number" name="price" value="<?php echo $row['price']; ?>">
    Quantity Available: <input type="number" name="qty_available" value="<?php echo $row['qty_available']; ?>" >
    Quantity Sold: <input type="number" name="qty_sold" value="<?php echo $row['qty_sold']; ?>">
    Quantity Returned: <input type="number" name="qty_returned" value="<?php echo $row['qty_returned']; ?>">
    Last Date Restocked: <input type="date" name="last_date_restock" value="<?php echo $row['last_date_restock']; ?>">
    Last Sale Date: <input type="date" name="last_sale_date" value="<?php echo $row['last_sale_date']; ?>">
    <input type="submit" value="Update Product">
</form>

<?php
include 'pm_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST ['product_id'];
    $price = $_POST ['price'];
    $qty_available = $_POST['qty_available'];
    $qty_sold = $_POST['qty_sold'];
    $qty_returned = $_POST['qty_returned'];
    $last_date_restock = $_POST['last_date_restock'];
    $last_sale_date = $_POST['last_sale_date'];
    $sql = "UPDATE manage_products SET product_id='$product_id', price='$price', qty_available=$qty_available, qty_sold=$qty_sold, qty_returned=$qty_returned, last_date_restock=$last_date_restock, last_sale_date=$last_sale_date  WHERE product_id=$product_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}
?>


