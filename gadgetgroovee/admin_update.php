<?php

@include 'config.php';

$product_id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
   $description = mysqli_real_escape_string($conn, $_POST['description']);
   $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'img/' . $product_image;

   if(empty($product_name) || empty($description) || empty($product_price)){
      $message[] = 'Please fill out all fields!';
   } else {
      if(empty($product_image)){
         $update_data = "UPDATE products SET product_name='$product_name', description='$description', price='$product_price' WHERE product_id='$product_id'";
      } else {
         $update_data = "UPDATE products SET product_name='$product_name', description='$description', price='$product_price', product_img='$product_image' WHERE product_id='$product_id'";
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
      }

      $upload = mysqli_query($conn, $update_data);

      if($upload){
         header('location:admin_page.php');
      } else {
         $message[] = 'Could not update the product: ' . mysqli_error($conn);
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="admin/css/style.css">
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $msg){
         echo '<span class="message">'.$msg.'</span>';
      }
   }
?>

<div class="container">

<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM products WHERE product_id='$product_id'");
      if($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update the Product</h3>
      <input type="text" class="box" name="product_name" value="<?php echo htmlspecialchars($row['product_name']); ?>" placeholder="Enter the product name">
      <input type="text" class="box" name="description" value="<?php echo htmlspecialchars($row['description']); ?>" placeholder="Enter the product description">
      <input type="number" min="0" class="box" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>" placeholder="Enter the product price">
      <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg">
      <input type="submit" value="Update Product" name="update_product" class="btn">
      <a href="admin_page.php" class="btn">Go Back!</a>
   </form>

   <?php } else { echo 'Product not found'; } ?>

</div>

</div>

</body>
</html>
