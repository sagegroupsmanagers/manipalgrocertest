<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysqli_error());
	}
	
	 $firstname = $_POST['firstname'];
	 $lastname = $_POST['lastname'];
	 $email = $_POST['email'];
	 
	 $telephone = $_GET['telephone'];
	
	 $address1 = $_POST['address1'];
	 $address2 = $_POST['address2'];
	 
	 $query = "SELECT customer_id from oc_customer where `telephone` = '$telephone'";
	 
	$result = mysqli_query($link,$query);
	if (!$result) {
    echo 'Could not run query: ';
    exit;
	}
	$row = mysqli_fetch_row($result);
	$cus_ID = $row[0];
	 
	$update_query_occustomer = "UPDATE oc_customer SET firstname ='".$firstname."', lastname = '".$lastname."', email = '".$email."', telephone = '".$telephone."' WHERE customer_id = '".$cus_ID."' ";
	
	$update_query_ocaddress = "UPDATE oc_address SET firstname ='".$firstname."', lastname = '".$lastname."',address_1 ='".$address1."', address_2 = '".$address2."' WHERE customer_id = '".$cus_ID."' ";
	
	if(mysqli_query($link,$update_query_occustomer)){
		
		echo 'UPDATE into oc_customer table --> success';

	}else{
		die("Invalid query: "  .mysqli_error($link));
		echo 'UPDATE into oc_customer table -->failure';
	}
	if(mysqli_query($link,$update_query_ocaddress)){
		echo 'UPDATE into oc_address table --> success';
	}else{
		
		echo 'UPDATE into oc_address table -->failure';
	}
	mysqli_close($link);
?>
