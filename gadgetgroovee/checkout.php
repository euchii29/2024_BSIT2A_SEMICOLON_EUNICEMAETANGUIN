<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Checkout</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body 

<?php
include 'config.php';
session_start();
?>
	<div class="container" style="margin-top: 30px; width: 90%;">
	    <div style="clear:both">
	    <h1 style="font-weight: bold;">Checkout</h1>
	    <p>For: <?php echo $_SESSION['user_id']?> <?php echo $_SESSION['user_id']; ?></p><br>
	    <div class="table-responsive">
	        <table class="table table-bordered">
	            <tr>
	            	<th>Item Name</th>
	        	    <th>Quantity</th>
	    	        <th>Price</th>
		            <th>Total/Quantity</th>
	            </tr>
	            <?php
	            	include ('config.php');
	            	
            		$sql = "SELECT * FROM cart WHERE cart_id = ?";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("location: checkout.php?error=sqlerror");
                        exit();
                    } else {
                    mysqli_stmt_bind_param($stmt, "i", $_SESSION['cart_id']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    $total = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
            	?>
	            <tr>
	                <td><?php echo $row["Item Name"] ; ?></td>
	                <td><?php echo $row["Quantity"]; ?></td>	
	                <td>₱ <?php echo $row["Price"]; ?></td>
	                <td>₱ <?php echo $row["Total Quantity"]; ?></td>               
	            </tr>
	            <?php
	            	$total += $row['quantity'];
	            	$listNames[] = $row['Product_id']." (".$row['quantity'].")";;

	            	$allproducts = implode(", ", $listNames);

	            	$_SESSION['allproducts'] = $allproducts;
					}
				}
				?>	 
	            <tr>
	                <td colspan="3" align="right" style="font-weight: bold;">Total</td>
	                <td align="right">₱ <?php echo $total; ?></td>
	            </tr>
	        </table>
	    </div>
	</div>
  </div>

	<div style="display: flex; flex-direction: row; width: 90%; justify-content: center; margin:auto; padding:10px 10px;">
	<div class="container" style="margin-top:15px; width:45%; ">
	    <div style="clear:both">
	    <h2 style="font-weight: bold;">Delivery Details</h2><br>
	    <div class="table-responsive">
	        <table class="table table-bordered">
	            <tr>
	            	<th width="30%">Name:</th>
	        	    <td width="70%"><?php echo $_SESSION['user_id']." ".$_SESSION['user_id']; ?></td>
	            </tr>
	            <tr>
	                <th width="30%">Address to be delivered: </th>
	        	    <td width="70%">
	        	    	<form method="POST" action="includes/cart.inc.php">
	        	    		<input type="text" name="address" style="color:black;">
	        	    		<input type="submit" name="address_btn" class="btn btn-primary">
	        	    		<br><br>
	        	    	</form>
	        	    	<?php echo "Current Address: ".$_SESSION['user_id']; ?>
	        	    </td>
	            </tr>
	            <tr>
	                <th width="30%">Phone Number:</th>
	        	    <td width="70%">+ <?php echo $_SESSION['user_id'];?></td>
	            </tr>
	            <tr>
	                <th width="30%">Date of Purchase:</th>
	        	    <td width="70%">
	        	    	<?php 
	        	    		$mydate=getdate(date("U"));
							echo "$mydate[month] $mydate[mday], $mydate[year]";
	        	    	?>
	        	    </td>
	            </tr>
	        </table>
	    </div>
	</div>
	</div>

	<div class="container" style="margin-top:15px; width:45%;">
    <div style="clear:both">
        <h2 style="font-weight: bold;">Summary</h2><br>
        <div class="table-responsive">
            <form method="POST" action="includes/cart.inc.php" name="payment" id="payment">
                <div>
                    <label for="paymentM">Payment Method:</label>
                    <select class="form-select" aria-label="Default select example" id="paymentM" name="paymentM">
                        <option disabled selected>Select Option...</option>
                        <option value="Cash on Delivery">Cash on Delivery</option>
                        <option value="Online Payment">Online Payment</option>
                     
                    </select>
                </div><br>

                <table class="table table-bordered">
                    <tr>
                        <th>Total Price :</th>
                        <td>₱ <?php echo $total; ?></td>