<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Order Management</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
     
            function loadOrders() {
                $.ajax({
                    url: 'fetch_orders.php',
                    type: 'GET',
                    success: function(data) {
                        $('#orderList').html(data);
                    }
                });
            }

            loadOrders();

                   
            $('#createForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'manage_orders.php',
                    type: 'POST',
                    data: $(this).serialize() + '&action=create',
                    success: function(data) {
                        alert(data);
                        loadOrders();
                    }
                });
            });


            $('#updateForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'manage_orders.php',
                    type: 'POST',
                    data: $(this).serialize() + '&action=update',
                    success: function(data) {
                        alert(data);
                        loadOrders();
                    }
                });
            });

            $('#deleteForm').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    url: 'manage_orders.php',
                    type: 'POST',
                    data: $(this).serialize() + '&action=delete',
                    success: function(data) {
                        alert(data);
                        loadOrders();
                    }
                });
            });
        });
    </script>
</head>
<body>
    <h2>Order Management</h2>

    <h3>Create Order</h3>
    <form id="createForm">
        <label for="customer_id">Customer ID:</label>
        <input type="text" id="customer_id" name="customer_id"><br><br>
        <label for="product">Product:</label>
        <input type="text" id="product" name="product"><br><br>
        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity"><br><br>
        <button type="submit">Create Order</button>
    </form>

    <h3>Update Order</h3>
    <form id="updateForm">
        <label for="id">Order ID:</label>
        <input type="text" id="id" name="id"><br><br>
        <label for="product">Product:</label>
        <input type="text" id="product" name="product"><br><br>
        <label for="quantity">Quantity:</label>
        <input type="text" id="quantity" name="quantity"><br><br>
        <button type="submit">Update Order</button>
    </form>

    <h3>Delete Order</h3>
    <form id="deleteForm">
        <label for="id">Order ID:</label>
        <input type="text" id="id" name="id"><br><br>
        <button type="submit">Delete Order</button>
    </form>

    <h3>Order List</h3>
    <div id="orderList"></div>
</body>
</html>
