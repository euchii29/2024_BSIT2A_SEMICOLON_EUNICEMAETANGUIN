<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="admin/style.css">

	<title>AdminHub</title>
</head>
<body>

	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">GADGET GROOVE</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx bxs-dashboard' ></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="sales_report">
					<i class='bx bxs-report'></i>
					<span class="text">Sales Report</span>
				</a>
			</li>
			<li>
				<a href="confirm_cancel.php">
					<i class='bx bxs-basket'></i>
					<span class="text">Order Management</span>
				</a>
			</li>
			<li>
				<a href="inventory.php">
				<i class='bx bxl-product-hunt'></i>
					<span class="text">Inventory</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
                    <span class="text">Log Out</span>
				</a>
			</li>
		</ul>
	</section>

	<section id="content">
		<nav>
			<i class='bx bx-menu' ></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/mamamo123.png">
			</a>
		</nav>

		<main>
			<div class="head-title">
				<div class="left">
							<h2>Welcome, Admin!</h2>
							<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
							<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a><br>
						</li>
					</ul>
				</div>
			</div>
			<hr>

<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $description = mysqli_real_escape_string($conn, $_POST['description']);
   $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'img/' . $product_image;

   if(empty($product_name) || empty($description) || empty($product_price) || empty($product_image)){
      $message[] = 'Please fill out all fields';
   }else{
      $insert = "INSERT INTO products(product_name, description,  price, product_img) VALUES('$product_name', '$description', '$product_price', '$product_image')";
      $upload = mysqli_query($conn, $insert);
      if($upload){
         if(move_uploaded_file($product_image_tmp_name, $product_image_folder)){
            $message[] = 'New product added successfully';
         } else {
            $message[] = 'Failed to upload the product image';
         }
      }else{
         $message[] = 'Could not add the product: ' . mysqli_error($conn);
      }
   }

}
?>

<?php
@include 'config.php';

// Toggle product status
if(isset($_GET['toggle_status'])){
   $id = $_GET['toggle_status'];
   $status = $_GET['status'];
   
   if($status == 'active'){
      mysqli_query($conn, "UPDATE products SET status = 'inactive' WHERE product_id = $id");
   } else {
      mysqli_query($conn, "UPDATE products SET status = 'active' WHERE product_id = $id");
   }
   header('location:admin_page.php');
}

// Add new product
if(isset($_POST['add_product'])){

   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $description = mysqli_real_escape_string($conn, $_POST['description']);
   $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'img/' . $product_image;

   if(empty($product_name) || empty($description) || empty($product_price) || empty($product_image)){
      $message[] = 'Please fill out all fields';
   }else{
      $insert = "INSERT INTO products(product_name, description, price, product_img, status) VALUES('$product_name', 'description', '$product_price', '$product_image', 'active')";
      $upload = mysqli_query($conn, $insert);
      if($upload){
         if(move_uploaded_file($product_image_tmp_name, $product_image_folder)){
            $message[] = 'New product added successfully';
         } else {
            $message[] = 'Failed to upload the product image';
         }
      }else{
         $message[] = 'Could not add the product: ' . mysqli_error($conn);
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="admin/css/style.css">
	<title>AdminHub</title>
</head>

			<?php
			if(isset($message)){
				foreach($message as $msg){
					echo '<span class="message">'.$msg.'</span>';
				}
			}
			?>

			<div class="container">
				<div class="admin-product-form-container">
					<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
						<h3>Add a New Product</h3>
						<input type="text" placeholder="Enter product name" name="product_name" class="box" required>
						<input type="text" placeholder="Enter product description" name="description" class="box" required>
						<input type="number" placeholder="Enter product price" name="product_price" class="box" required>
						<input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box" required>
						<input type="submit" class="btn" name="add_product" value="Add Product">
					</form>
				</div>

				<?php
				$select = mysqli_query($conn, "SELECT * FROM products");
				?>
				<div class="product-display">
					<table class="product-display-table">
						<thead>
							<tr>
								<th>Product Image</th>
								<th>Product Name</th>
								<th>Description</th>
								<th>Product Price</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php while($row = mysqli_fetch_assoc($select)){ ?>
							<tr>
								<td><img src="img/<?php echo htmlspecialchars($row['product_img']); ?>" height="100" alt=""></td>
								<td><?php echo htmlspecialchars($row['product_name']); ?></td>
								<td><?php echo htmlspecialchars($row['description']); ?></td>
								<td>₱<?php echo htmlspecialchars($row['price']); ?></td>
								<td>
									<a href="admin_update.php?edit=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-edit"></i> Edit </a>
									<a href="admin_page.php?toggle_status=<?php echo $row['product_id']; ?>&status=<?php echo $row['status']; ?>" class="btn"> 
										<?php echo $row['status'] == 'active' ? '<i class="fas fa-toggle-on"></i> Deactivate' : '<i class="fas fa-toggle-off"></i> Activate'; ?> 
									</a>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</main>
	</section>
	</body>
</html>

	<script src="admin/script.js"></script>
</body>
</html>





