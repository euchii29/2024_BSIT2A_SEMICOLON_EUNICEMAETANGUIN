<?php
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["usertype"] !== "admin") {
    header("Location: login.php");
    exit();
}

include_once 'admin_page.php';

?>
