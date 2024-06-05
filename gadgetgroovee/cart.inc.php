<?php 

session_start();
require 'config.php';

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "ProductNo");
		if(!in_array($_GET["pnum"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'ProductNo'			=>	$_GET["pnum"],
				'ProductName'		=>	$_POST["pname"],
				'ProductPrice'		=>	$_POST["pprice"],
				'ProductQuantity'	=>	$_POST["pquantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'ProductNo'			=>	$_GET["pnum"],
			'ProductName'		=>	$_POST["pname"],
			'ProductPrice'		=>	$_POST["pprice"],
			'ProductQuantity'	=>	$_POST["pquantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["ProductNo"] == $_GET["pnum"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
}

?>