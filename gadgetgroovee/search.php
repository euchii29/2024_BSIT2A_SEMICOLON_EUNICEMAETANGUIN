<?php
include 'config.php';
// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

$query = strtolower($_GET['query'] ?? '');
$description = strtolower($_GET['description'] ?? '');

// SQL query to fetch products based on search query and description
$sql = "SELECT * FROM products WHERE LOWER(product_name) LIKE :query";
$parameters = ['query' => "%$query%"];

if (!empty($description)) {
    $sql .= " AND LOWER(description) LIKE :description";
    $parameters['description'] = "%$description%";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($parameters);

// Fetch filtered products
$filteredProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
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

    <h3>Search Results for "<?php echo htmlspecialchars($query); ?>"</h3>
    <div id="results" class="results-container">
        <?php if (empty($filteredProducts)): ?>
            <p>No results found</p>
        <?php else: ?>
            <?php foreach ($filteredProducts as $product): ?>
                <div class="flash1">
                    <img src="<?php echo htmlspecialchars($product['product_img']); ?>" alt="<?php echo htmlspecialchars($product['description']); ?>">
                    <div class="des1">
                        <span><?php echo htmlspecialchars($product['description']); ?></span>
                        <h5><?php echo htmlspecialchars($product['product_name']); ?></h5>
                        <h4><?php echo htmlspecialchars($product['price']); ?></h4>
                        <form action="shop.php" method="post">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                            <button type="submit" class="btn btn-warning my-3" name="add">Add to Cart <i class="fas fa-shopping-cart"></i></button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
