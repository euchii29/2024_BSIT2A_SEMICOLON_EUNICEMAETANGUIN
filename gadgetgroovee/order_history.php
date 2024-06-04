<?php

include 'config.php';
include 'login.php';
session_start();
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "User not logged in.";
    exit;
}

$username = $_SESSION['username']; // Retrieve username from session

// Prepare the SQL statement
$sql = "SELECT * FROM orders WHERE username = ?";
$stmt = $conn->prepare($sql);

// Bind the username parameter
$stmt->bind_param("s", $username);

// Execute the query
$stmt->execute();

// Get the result
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output data of each row in a table
    echo "<table border='1'>";
    echo "<tr><th>Order ID</th><th>Order Date</th><th>Total Amount</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["order_id"] . "</td>";
        echo "<td>" . $row["order_date"] . "</td>";
        echo "<td>$" . $row["total_amount"] . "</td>";
        echo "</tr>";
        // You can output more details as needed
    }
    echo "</table>";
} else {
    echo "No orders found for this customer.";
}

$stmt->close();
$conn->close();

?>
