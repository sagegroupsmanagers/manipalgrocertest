<?php
	$link=mysqli_connect("localhost","root","root","shop");
	if (!$link) {
    		die('Not connected : ' . mysqli_error());
	}
	 $firstname = $_POST['firstname'];
	 $lastname = $_POST['lastname'];
	 $email = $_POST['email'];
	 $telephone = $_POST['telephone'];
	 $address_id = $_POST['address_id'];
	 $imei = $_POST['imei'];
	 
	 $address1 = $_POST['address1'];
	 $address2 = $_POST['address2'];
	 $city = $_POST['city'];
	 
	$qur_insert_oc_customer ="INSERT INTO oc_customer (firstname, lastname, email,telephone,address_id,imei) VALUES ('$firstname','$lastname','$email','$telephone','$address_id','$imei')";
	
	$query = "SELECT customer_id from oc_customer where `telephone` = '$telephone'";
	
	if(mysqli_query($link,$qur_insert_oc_customer)){
    
	echo 'insert into oc_customer table --> success';

	$result = mysqli_query($link,$query);
	if (!$result) {
    echo 'Could not run query: ';
    exit;
	}
	$row = mysqli_fetch_row($result);
	$cus_ID = $row[0];

	$qur_insert_oc_address = "INSERT INTO oc_address (customer_id,firstname, lastname,address_1,address_2,city) VALUES ('$cus_ID','$firstname','$lastname','$address1','$address2','$city')";
	
	if(mysqli_query($link,$qur_insert_oc_address)){
		echo 'inserted into oc_address table --> success';
	}else{
		die("Invalid query: "  .mysqli_error($link));
		echo 'insert into oc_address table -->failure';
	}
	}
	else{
		echo 'insert into oc_customer table -->failure';
	}
	mysqli_close($link);
?>
