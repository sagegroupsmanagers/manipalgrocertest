<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
	die('Not connected : ' . mysql_error());
	}
	
	$telephone = $_POST['telephone'];
	$qur_search_custID ="SELECT oc.`customer_id`,oc.`firstname`,oc.`lastname`,oc.`email`,ocr.`address_1` FROM `oc_customer` AS oc,`oc_address` AS ocr WHERE oc.`telephone`='9483631417' AND oc.`customer_id`=ocr.`customer_id`";
	$resultCustID = mysqli_query($link,$qur_search_custID);
	if (!$resultCustID) {
		echo 'Could not Retrieve Customer Details ';
    }
	$row = mysqli_fetch_row($resultCustID);
	$phone = $telephone;
    $cust_id = $row[0];
	//echo $cust_id;
	$cust_fname = $row[1];
	//echo $cust_fname;
	$cust_lname = $row[2];
	//echo $cust_lname;
	$cust_email = $row[3];
	//echo $cust_email;
	$cust_addr = $row[4];
	//echo $cust_addr;
	
	$subtotal = $_POST['subtotal'];
	$discount = $_POST['discount'];
	$delivery_fee = $_POST['delivery_fee'];
	$payment_mode = $_POST['payment_mode'];
	$delivery_address = $_POST['delivery_address'];
	$delivery_status = "0";
	
	$total = $subtotal - $discount;
	
	/*$result =array();
	$json = array("status" => 1, "info" => $result);*/
	$qur_insert_order ="INSERT INTO `oc_order`(`customer_id`,`firstname`,`lastname`,`email`,`telephone`,`payment_firstname`,`payment_lastname`,`payment_address_1`,`payment_method`,`shipping_firstname`,`shipping_lastname`,`shipping_address_1`,`total`,`order_status_id`) VALUES ('$cust_id','$cust_fname','$cust_lname','$cust_email','$phone','$cust_fname','$cust_lname','$cust_addr','$payment_mode','$cust_fname','$cust_lname','$delivery_address','$total','$delivery_status')";    
    if(mysqli_query($link,$qur_insert_order)){
		echo "success";
	}
	else {
		echo "failure";
	}
 @mysqli_close($link);
 /* Output header */
 /*header('Content-type: application/json');
 echo json_encode($json);*/
?>