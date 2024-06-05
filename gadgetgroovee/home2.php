

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
                
                <li><a href="order_tracking.php"><i class="fa-solid fa-truck-fast"></i></a></li>
                <li><a href="order_history.php"><i class="fa-solid fa-clock-rotate-left"></i></a></li>
            </ul> 
        </div>
    </section>


    <section id="home2">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Welcome to Gadget Groove, a place where you can buy everything about Gadget. Sale everyday!</p>
        <a href="shop.php"><button> Shop Now</button></a>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/shipping.png" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/promotion.png" alt="">
            <h6>Promotion</h6>
        </div>
        <div class="fe-box">
            <img src="img/coinsreward.png" alt="">
            <h6>Coins Reward</h6>
        </div>
        <div class="fe-box">
            <img src="img/Vouchers.png" alt="">
            <h6>Vouchers</h6>
        </div>
        <div class="fe-box">
            <img src="img/cashback.png" alt="">
            <h6>Cashback</h6>
        </div>
        <div class="fe-box">
            <img src="img/globaldeals.png" alt="">
            <h6>Global Deals</h6>
        </div>
    </section>

    <section id="product" class="section-p1">
        <h2>Featured Products</h2>
        <section class="shop-section1">
            <div class="shop-images1">
                <div class="shop-link">
                    <h3>Shop Laptops</h3>
                    <img src="img/product/bakitayawmo.png" alt="card">
                    <a href="laptop.php">Shop now</a>
                </div>
                <div class="shop-link">
                    <h3>Shop Smartwatches</h3>
                    <img src="img/product/smartwatch.jpg" alt="card">
                    <a href="smartwatches.php">Shop now</a>
                </div>
                <div class="shop-link">
                    <h3>Shop Cellphones</h3>
                    <img src="img/product/cellphone.jpg" alt="card">
                    <a href="selpon.php">Shop now</a>
                </div>
                <div class="shop-link">
                    <h3>Shop Tablets</h3>
                    <img src="img/product/tabletss.jpg" alt="card">
                    <a href="tablets.php">Shop now</a>
                </div>
            </div>
        </section>
    </section>

    <section id="product1" class="section-p1">
        <h2>Recommended for you</h2>
        <div class="flash-container">
            <div class="flash">
                <img src="img/product/l.png" alt="">
                <div class="des">
                    <span>Laptop</span>
                    <h5>BMAX X15 PLUS Laptop Windows 11 </h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>₱16,526</h4>
                </div>
                <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
            </div>
            <div class="flash">
                <img src="img/product/laptoppp.png" alt="">
                <div class="des">
                    <span>Laptop</span>
                    <h5>ASUS Laptop Savior Intel Core i7 2023 </h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>₱18,990 - ₱22,593</h4>
                </div>
                <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
            </div>
            <div class="flash">
                <img src="img/product/selponv2.jpg" alt="">
                <div class="des">
                    <span>Laptop</span>
                    <h5>2023 Brand New Cellphone i14 Pro Max </h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>₱2,399 - ₱3,599</h4>
                </div>
                <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
            </div>
            <div class="flash">
                <img src="img/product/selpon.jpg" alt="">
                <div class="des">
                    <span>Selpon</span>
                    <h5>(New) vivo V30 5G </h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>₱24,999 - ₱27,999</h4>
                </div>
                <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
            </div>
        </div>
    </section>

    <footer>
        <a href="#" class="footer-title">Back to top</a>
        <div class="footer-items">
            <ul>
                <h3>Get to Know Us</h3>
                <li><a href="#">About us</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Press Release</a></li>
                <li><a href="#">Gadget Groove</a></li>
            </ul>
            <ul>
                <h3>Connect with Us</h3>
                <li><a href="#"><i class="fa-brands fa-facebook"></i> Facebook</a></li>
                <li><a href="#"><i class="fa-brands fa-twitter"></i> Twitter</a></li>
                <li><a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
            </ul>
            <ul>
                <h3>Make Money with Us</h3>
                <li><a href="#">Sell on Gadget Groove</a></li>
                <li><a href="#">Sell under Gadget Groove Accelerator</a></li>
                <li><a href="#">Protect and Build Your Brand</a></li>
                <li><a href="#">Gadget Groove Global Selling</a></li>
                <li><a href="#">Become an Affiliate</a></li>
                <li><a href="#">Fulfillment by Gadget Groove</a></li>
                <li><a href="#">Advertise Your Products</a></li>
                <li><a href="#">Gadget Groove Pay on Merchants</a></li>
            </ul>
            <ul>
                <div class="col-install">
                    <h3>Install App</h3>
                    <p> From App Store or Google Play</p>
                    <div class="row">
                        <img src="img/hmmm.png" alt="">
                    </div>
                    <p> Secured Payments Gateways</p>
                    <img src="img/pay.png" alt="">
                </div>
            </ul>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
