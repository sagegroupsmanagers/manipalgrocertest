<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
	die('Not connected : ' . mysql_error());
	}
	
	$order_id = $_POST['order_id'];
	$product_id = $_POST['product_id'];
	$name = $_POST['name'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$total = $quantity * $price;
	
	$qur_insert_order_product ="INSERT INTO `oc_order_product`(`order_id`, `product_id`, `name`, `quantity`, `price`, `total`) VALUES ('$order_id', '$product_id', '$name', '$quantity', '$price', '$total')";    
    if(mysqli_query($link,$qur_insert_order_product)){
		echo "success";
	}
	else {
		die("Invalid query: "  .mysqli_error($link));
		echo "failure";
	}
 @mysqli_close($link);
 
?>