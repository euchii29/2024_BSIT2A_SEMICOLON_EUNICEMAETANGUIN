<?php
session_start();
include 'config.php';

// Check if user is checking out
if (isset($_POST['checkout'])) {
    $user_id = $_SESSION['user_id'];
    $cartItems = $_SESSION['cart'] ?? [];

    if (!empty($cartItems)) {
        foreach ($cartItems as $item) {
            $sql = "INSERT INTO orders (user_id, product_name, price, quantity, total_amount, full_name, contact_no, address, payment_method, status, tracking_no)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending', '')";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issdiisss", $user_id, $item['product_name'], $item['price'], $item['quantity'], $item['total_amount'], $item['full_name'], $item['contact_no'], $item['address'], $item['payment_method']);

            if (!$stmt->execute()) {
                die("SQL error: " . $stmt->error);
            }
        }
        unset($_SESSION['cart']);

        // Redirect to order confirmation page
        header("Location: order_confirmation.php");
        exit();
    } else {
        $_SESSION['error'] = "Your cart is empty.";
        header("Location: cart.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    
<div id="sidebar" class="sidebar">
    <div class="logo">
        <img src="img/Facebook_cover_-_1-removebg-preview.png" alt="GadgetGroove Logo" width="150px">
    </div>
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa-solid fa-bars"></i></a>
    <a href="profile.php">Profile</a>
    <a href="#">About Us</a>
    <a href="#">Services</a>
    <a href="#">Contact</a>
    <a href="logout.php">Log Out</a>
</div>

<section id="header1">
    <ul id="navbar">
        <li><a href="javascript:void(0)" class="openbtn" onclick="openNav()"><i class="fa-solid fa-bars"></i></a></li>
    </ul> 
    <img src="img/Facebook_cover_-_1-removebg-preview.png" class="logo" alt="">
    
    <form action="search.php" method="get" class="nav-search">
        <select name="category" class="select-search" id="category-select">
            <option value="all">All</option>
            <option value="all categories">All Categories</option>
            <option value="uno gusto mo">uno gusto mo</option>
            <option value="sale">Sale</option>
        </select>
        <input type="text" name="description" placeholder="Search Description" class="search-input" id="description-bar">
        <button type="submit" class="search-icon" id="search-button">
            <span class="fa-solid fa-magnifying-glass"></span>
        </button>
    </form>

    <div>
        <ul id="navbar">
            <li><a class="active" href="home2.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="shop.php"><i class="fa-solid fa-shop"></i></a></li>
            <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            <li><a href="order_tracking.php"><i class="fa-solid fa-truck-fast"></i></a></li>
            <li><a href="order_history.php"><i class="fa-solid fa-clock-rotate-left"></i></a></li>
        </ul> 
    </div>
</section>

<div id="sidebar" class="sidebar">
    <!-- Sidebar content -->
</div>
<div class="container" style="margin-top: 30px; width: 90%;">
    <h1 style="font-weight: bold;">Order History</h1>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Full Name</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Payment Method</th>
                <th>Order Status</th>
                <th>Tracking Number</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $total_price = $row['quantity'] * $row['price'];
                        echo "<tr>";
                        echo "<td>" . $row['order_id'] . "</td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>Php " . $row['price'] . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>Php " . $total_price . "</td>";
                        echo "<td>" . $row['full_name'] . "</td>";
                        echo "<td>" . $row['contact_no'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>" . $row['payment_method'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>" . $row['tracking_no'] . "</td>";
                        echo "</tr>";
                        
                         if ($row['status'] == 't') {
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                            echo "<button type='submit' class='btn btn-success' name='received'>Receive</button>";
                            echo "</form>";
                        } elseif ($row['status'] == 'p') {
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                            echo "<button type='submit' class='btn btn-danger' name='cancel'>Cancel</button>";
                            echo "</form>";
                        } elseif ($row['status'] == 'r') {
                            echo "<button class='btn btn-success' disabled>Received</button>";
                        } elseif ($row['status'] == 'c') {
                            echo "<form method='post'>";
                            echo "<input type='hidden' name='order_id' value='" . $row['order_id'] . "'>";
                            echo "<button type='submit' class='btn btn-danger' name='delete'>Delete</button>";
                            echo "</form>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                }
            else {
                echo "<tr><td colspan='17'>No orders found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="script.js"></script>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
