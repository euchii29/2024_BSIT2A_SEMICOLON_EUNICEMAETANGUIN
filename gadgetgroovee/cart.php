<?php
session_start();

include 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['remove'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id"] == $_POST['product_id']) {
                unset($_SESSION['cart'][$key]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); 
                echo "<script>alert('Product has been removed...!')</script>";
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }

    if (isset($_POST['update_quantity'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id"] == $_POST['product_id']) {
                $_SESSION['cart'][$key]['quantity'] = $_POST['quantity'];
                echo "<script>window.location = 'cart.php'</script>";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" >
</head>
<body class="bg-light">

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
        <div class="nav-search">
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
        </div>
        <div>
            <ul id="navbar">
                <li><a href="home2.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="shop.php"><i class="fa-solid fa-shop"></i></a></li>
                <li><a class="active" href href="cart.php"><i class="fa-solid fa-cart-shopping"></i> </a></li>
                <li><a href="order_tracking.php"><i class="fa-solid fa-truck-fast"></i></a></li>
                <li><a href="order_history.php"><i class="fa-solid fa-clock-rotate-left"></i></a></li>
            </ul> 
        </div>
    </section>


<div class="container-fluid">
    <div class="row px-5">
        <div class="col-md-7">
            <div class="shopping-cart">
                <h4><br>Shopping Cart</h4>
                <hr>

                <?php
                $total = 0;
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $key => $value) {
                        $product_id = $value['product_id'];
                        
                        
                        $sql = "SELECT * FROM products WHERE product_id = $product_id";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $product_name = $row['product_name'];
                                $price = $row['price'];
                                $product_img= $row ['product_img'];
                                $product_qty = isset($value['quantity']) ? $value['quantity'] : 1;
                                $total += $price * $product_qty;
                ?>
                

                <form action="cart.php" method="post" class="cart-items">
                    <div class="border rounded">
                        <div class="row bg-white">
                            <div class="col-md-3 pl-0">
                                <img src="<?php echo $product_image; ?>" alt="image<?php echo $product_id; ?>" class="img-fluid">
                            </div>
                                <div class="col-md-6">
                                    <h5 class="pt-2"><?php echo $product_name; ?></h5>
                                    <h5 class="pt-2">Php <?php echo number_format($price, 2); ?></h5>
                                    <button type="submit" class="btn btn-danger mx-2" name="remove">Remove</button>
                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                </div>
                        </div>
                    </div>
                </form>

                <?php
                    }
                }
                }
                } else {
                    echo "<h5>Cart is Empty</h5>";
                }
                ?>
            </div>
        </div>

        <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">
            <div class="pt-4">
                <h6>ORDER DETAILS</h6>
                <hr>
                <div class="row order-details">
                    <div class="col-md-6">
                        <?php
                            if (isset($_SESSION['cart'])) {
                                $count  = count($_SESSION['cart']);
                                echo "<h6>Price ($count items)</h6>";
                            } else {
                                echo "<h6>Price (0 items)</h6>";
                            }
                        ?>
                        <h6>Delivery Charges</h6>
                        <hr>
                        <h6>Amount Payable</h6>
                        <div class="input-box">
                            <label for="payment_method"><h6>Payment Method<h6></label>
                            <select name="payment_method" id="payment_method" required>
                                <option value="">Select Payment Method</option>
                                <option value="C">COD</option>
                                <option value="O">Online Payment</option>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <h6><?php echo "Php " . number_format($total, 2); ?></h6>
                            <h6 class="text-success">FREE</h6>
                            <hr>
                            <h6><?php echo "Php " . number_format($total, 2); ?></h6>
                        </div>
                </div>
                        <form id="checkout-form" action="checkout.php" method="post">
                            <a href="checkout.php" class="checkout">
                            <button type="button" class="btn btn-success btn-block">Check Out</button>
                            </a>
                        </form>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6Jty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src = "script.js"></script>
</body>
</html>
