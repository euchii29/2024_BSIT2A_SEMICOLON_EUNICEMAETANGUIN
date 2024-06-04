
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GADGET GROOVE</title>
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
        <form action = "search.php" method = "get" class = "nav-search">
            <select name = "category" class="select-search" id = "category-select">
                <option>All</option>
                <option>All Categories</option>
            </select>
            <input type="text" placeholder="Search" class="search-input" id="search-bar">
            <button type="submit" class="search-icon" id="search-icon">
                <span class="fa-solid fa-magnifying-glass"></span></button>
        </form>
        <div>
            <ul id="navbar">
                <li><a href="home2.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="shop.php"><i class="fa-solid fa-shop"></i></a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
                <li><a href="order_tracking.php"><i class="fa-solid fa-truck-fast"></i></a></li>
                <li><a href="order_history.php"><i class="fa-solid fa-clock-rotate-left"></i></a></li>
            </ul> 
        </div>
    </section>

    <div class="container">
        <h1>Track Your Order</h1>
        <form action="track_order.php" method="GET">
            <label for="order_id">Order ID:</label>
            <input type="text" id="order_id" name="order_id" required>
            <button type="submit">Track Order</button>
        </form>
    </div>
</body>
</html>
