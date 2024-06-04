<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["usertype"] !== "user") {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

    <div id="sidebar" class="sidebar">
        <div class="logo">
            <img src="img/Facebook_cover_-_1-removebg-preview.png" alt="GadgetGroove Logo" width="150px">
        </div>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"><i class="fa-solid fa-bars"></i></a>
        <a href="#">Profile</a>
        <a href="#">About Us</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
        <a href="logout.php">Log Out</a>
    </div>

    <!-- Header Section -->
    <section id="header1">
        <ul id="navbar">
            <li><a href="javascript:void(0)" class="openbtn" onclick="openNav()"><i class="fa-solid fa-bars"></i></a></li>
        </ul> 
        <img src="img/Facebook_cover_-_1-removebg-preview.png" class="logo" alt=""></a>
    
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
                <li><a class="active" href="shop.php"><i class="fa-solid fa-shop"></i></a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li><a href="order_tracking.php"><i class="fa-solid fa-truck-fast"></i></a></li>
                <li><a href="order_history.php"><i class="fa-solid fa-clock-rotate-left"></i></a></li>
            </ul>    
        </div>
    </section>
    
    <section id="page-header">
        <h2>#Unlock endless possibilities </h2><h2>with cutting-edge gadgets!</h2>
    </section>

    
    <?php

include 'config.php'; // Make sure you include your database connection

if (isset($_POST['add'])){
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], "product_id");

        if (in_array($_POST['product_id'], $item_array_id)) {
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'shop.php'</script>";
        } else {
            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['product_id']
        );

        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <!-- Sidebar and Header Section -->

    <section id="product1" class="section-p1">
        <h1 class="title">Our Products</h1>

        <div class="product-container">
            <?php
            $select = mysqli_query($conn, "SELECT * FROM products");
            if(mysqli_num_rows($select) > 0){
                while($row = mysqli_fetch_assoc($select)){
            ?>
            <div class="product-box">
                <img src="img/<?php echo htmlspecialchars($row['product_img']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                <h3><?php echo htmlspecialchars($row['product_name']); ?></h5>
                <h5><?php echo htmlspecialchars($row['description']); ?></h3>
                <p>₱<?php echo htmlspecialchars($row['price']); ?></p>
                <form action="shop.php" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                    <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                </form>
            </div>
            <?php
                }
            } else {
                echo '<p>No products available.</p>';
            }
            ?>
        </div>
    </section>

    <!-- Footer Section -->

    <script src="script.js"></script>
</body>
</html>
