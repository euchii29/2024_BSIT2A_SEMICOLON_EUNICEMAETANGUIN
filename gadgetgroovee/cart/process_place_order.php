<?php

function generateReferenceNumber() {
    return strtoupper(uniqid('ORD'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];
    $total_amount = $_POST['total_amount'];
    $payment_status = "Pending"; 
    $order_status = "Processing";
    $reference_number = generateReferenceNumber();
    $order_date = date("Y-m-d H:i:s");


    $sql = "INSERT INTO orders (customer_id, reference_number, tracking_number, order_status, order_date, total_amount, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssds", $customer_id, $reference_number, $tracking_number, $order_status, $order_date, $total_amount, $payment_status);

    if ($stmt->execute()) {
        
        header("Location: order_details.php?ref=" . $reference_number);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="customer_id">Customer ID:</label>
        <input type="text" id="customer_id" name="customer_id" required><br><br>
        
        <label for="total_amount">Total Amount:</label>
        <input type="text" id="total_amount" name="total_amount" required><br><br>
        
        
        <button type="submit">Place Order</button>
    </form>
</body>
</html>