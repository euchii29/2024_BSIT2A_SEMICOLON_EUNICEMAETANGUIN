<?php
include 'pm_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['product_id'];

    $sql = "DELETE FROM manage_products WHERE product_id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Product Not Found";
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<form method="post" action="pm_delete.php">
<hr>
    <h3>Delete Product</h3>
    ID: <input type="number" name="product_id">
    <input type="submit" value="Delete Product">
</form>
