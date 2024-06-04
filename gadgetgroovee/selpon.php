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
                <li><a class="active" href="home2.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="shop.php"><i class="fa-solid fa-shop"></i></a></li>
                <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i><p id="count">0</p> </a></li>
                <li><a href="order_tracking.php"><i class="fa-solid fa-truck-fast"></i></a></li>
            </ul> 
        </div>
    </section>

    <section id="product1" class="section-p1">
    <div class="flash-container">
    <div class="flash">
            <img src="img/product/c.jpeg" alt="">
            <div class="des">
              <span>Cellphone</span>
              <h5>Vivo V30 5G</h5>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4>22,799 - 23, 949</h4>
            </div>
            <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
        </div>
        <div class="flash">
            <img src="img/product/3.jpg" alt="">
            <div class="des">
              <span>Cellphone</span>
              <h5>[NEW] Tecno Spark Go 2024 </h5>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4>₱3,799</h4>
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
        <div class="flash">
            <img src="img/product/selponv2.jpg" alt="">
            <div class="des">
              <span>Cellphone</span>
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
            <img src="img/product/finix.jpeg" alt="">
            <div class="des">
              <span>Cellphone</span>
              <h5>Infinix Note 40 </h5>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4>₱2,080 - ₱2,980</h4>
            </div>
            <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
        </div>
        <div class="flash">
            <img src="img/product/sung.jpg" alt="">
            <div class="des">
              <span>Cellphone</span>
              <h5>Samsung Galaxy A35 5G</h5>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4>₱4,990</h4>
            </div>
            <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
        </div>
        <div class="flash">
            <img src="img/product/xiao.jpg" alt="">
            <div class="des">
              <span>Cellphone</span>
              <h5>Xiaomi Redmi 13C</h5>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4>₱3,799</h4>
            </div>
            <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
        </div>
        <div class="flash">
            <img src="img/product/real.jpg" alt="">
            <div class="des">
              <span>Cellphone</span>
              <h5>Realme C55</h5>
              <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
              </div>
              <h4>32,999</h4>
            </div>
            <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
        </div>
    
    
    