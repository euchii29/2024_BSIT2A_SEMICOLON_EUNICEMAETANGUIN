<?php
session_start();
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method'];

    $user_id = $_SESSION["user_id"];

    $sql = "INSERT INTO orders (user_id, full_name, contact_no, address, payment_method) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $user_id, $full_name, $contact_number, $address, $payment_method);

    if ($stmt->execute()) {
        header("location: orders.php");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
